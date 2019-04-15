<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OntologyClass;
use App\Http\Requests\OntologyClassStoreRequest;

class OntologyClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = OntologyClass::select()->paginate(10);
        return view('ontology-class.ontology-class', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ontology-class.ontology-class-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param OntologyClassStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(OntologyClassStoreRequest $request)
    {
        OntologyClass::create($request->all());
        return redirect()->route('ontology_class.index')->with('Sucess', 'Your ontology class has been successfully stored')->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ontologyClass = OntologyClass::findOrFail($id);
        return view('ontology-class.ontology-class-show', compact('ontologyClass'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ontologyClass = OntologyClass::findOrFail($id);
        return view('ontology-class.ontology-class-edit', compact('ontologyClass', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param OntologyClassStoreRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(OntologyClassStoreRequest $request, $id)
    {
        $ontologyClass = OntologyClass::findOrFail($id);
        $ontologyClass->update($request->all());
        return redirect()->route('ontology_class.index')->with('Sucess', 'Your ontology class has been successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ontologyClass = OntologyClass::findOrFail($id);
        $ontologyClass->delete();
        return redirect()->back()->with('Sucess', 'Your ontology class has been deleted with success');
    }


    /**
     * Search's for the given name on the database
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request)
    {
        $classes = OntologyClass::where('name','Like',  '%' .$request->search. '%')->paginate(10);
        return view('ontology-class.ontology-class', compact('classes'));
    }
}
