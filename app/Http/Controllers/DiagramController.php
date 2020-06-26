<?php

namespace App\Http\Controllers;

use App\Ontology;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiagramController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Search for the diagram with the given id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function openDiagram(Request $request)
    {
        $ontology = Ontology::where('id', $request->id)->first();
        if(Auth::user()->id == $ontology['user_id'])
        {
            $response = array(
                'status' => 'success',
                'id' => $ontology['id'],
                'file' => $ontology['file'],
                'name' => $ontology['name'],
                'publication_date' => $ontology['publication_date'],
                'last_uploaded'=> $ontology['last_uploaded'],
                'description'=> $ontology['description'],
                'link'=> $ontology['link'],
                'user_id'=> $ontology['user_id'],
                'favourite'=> $ontology['favourite'],
                'domain'=> $ontology['domain'],
                'general_purpose'=> $ontology['general_purpose'],
                'profile_users'=> $ontology['profile_users'],
                'intended_use'=> $ontology['intended_use'],
                'type_of_ontology'=> $ontology['type_of_ontology'],
                'degree_of_formality'=> $ontology['degree_of_formality'],
                'scope'=> $ontology['scope'],
                'competence_questions'=> $ontology['competence_questions']
            );

            return response()->json($response);
            //return $ontology;
        }
        else
        {
            return 'Denied Access';
        }

    }

    /**
     * Returns the latest diagram edited by the user
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function openRecentDiagram(Request $request)
    {
        $id = Auth::user()->id;
        $latestDiagram = Ontology::select('file', 'user_id')->where('user_id', $id)->latest()->first();
        if($id == $latestDiagram->user_id)
        {
            $response = array(
                'status' => 'success',
                'file' => $latestDiagram->file

            );

            return response()->json($response);
            //return $ontology;
        }
        else
        {
            return 'Denied Access';
        }
    }
}
