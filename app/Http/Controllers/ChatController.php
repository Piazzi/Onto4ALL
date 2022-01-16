<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use GuzzleHttp\Psr7\Request;

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
    public function updateChat($id)
    {
        $mesagens = Chat::select()->where('ontology_id', $id)->latest("created_at")->limit(150)->orderBy("id")->get();
        return view('ontologies.chat', compact('mesagens'));
    }
}
