<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ontology;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\OntologyStoreRequest;


class OntologyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ontologies = Ontology::select()->paginate(10);
        return view('ontologies.ontologies', compact('ontologies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OntologyStoreRequest $request)
    {
        $ontology = Ontology::create($request->all());
        return redirect()->route('ontologies.index')->with('Sucess', 'Your ontology has been successfully stored')->withInput();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $ontology = Ontology::findOrFail($id);

        return view('ontologies.ontologies_show', compact('ontology'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
