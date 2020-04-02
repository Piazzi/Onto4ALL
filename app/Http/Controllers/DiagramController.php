<?php

namespace App\Http\Controllers;

use App\Ontology;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiagramController extends Controller
{
    /**
     * Search for the diagram with the given id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function openDiagram(Request $request)
    {
        $ontology = Ontology::select('file','user_id')->where('id', $request->id)->get();
        if(Auth::user()->id == $ontology[0]['user_id'])
        {
            $response = array(
                'status' => 'success',
                'file' => $ontology[0]['file']

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
