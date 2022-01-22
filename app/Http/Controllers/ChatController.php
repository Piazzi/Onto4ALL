<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Ontology;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateChat(Request $request)
    {
        $mesagens = Chat::select()->where('ontology_id', $request->ontology_id)->latest("created_at")->limit(150)->orderBy("id")->get();
        /*$ontology = $mesagens->ontology;

        if (Auth::user()->id == $ontology['user_id'] || $ontology->users->contains(Auth::user()->id)) {*/

            return view('ontologies.chat', compact('mesagens'));
        //}
    }

    public function sendChat(Request $request)
    {
        if ($request->ontology_id > 0) {

            $ontology = Ontology::where('id', $request->ontology_id)->first();

            if (Auth::user()->id == $ontology['user_id'] || $ontology->users->contains(Auth::user()->id)) {
                if (strlen($request['message']) > 0) {
                    if (Auth::user() != null) {
                        $data = $request->all();
                        $data['user_id'] = Auth::user()->id;

                        Chat::create($data);

                        $retorno['status'] = "SUCESSO";
                    } else {
                        $retorno['status'] = "ERRO";
                    }
                } else {
                    $retorno['status'] = "ERRO";
                }
            } else {
                $retorno['status'] = "ERRO";
            }
        } else {
            $retorno['status'] = "ERRO";
        }

        echo json_encode($retorno);
    }
}
