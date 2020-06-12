<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OntologyRelation;
use App\Http\Requests\OntologyRelationStoreRequest;


class OntologyRelationController extends Controller
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
    public function index()
    {
        $relations = OntologyRelation::select()->paginate(10);
        return view('ontology-relation.ontology-relation', compact('relations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ontology-relation.ontology-relation-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param OntologyRelationStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(OntologyRelationStoreRequest $request)
    {
        OntologyRelation::create($request->all());
        return redirect()->route('ontology_relation.index')->with('Success', 'Your relation has been successfully stored')->withInput();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ontologyRelation = OntologyRelation::findOrFail($id);
        return view('ontology-relation.ontology-relation-show', compact('ontologyRelation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ontologyRelation = OntologyRelation::findOrFail($id);
        return view('ontology-relation.ontology-relation-edit', compact('ontologyRelation', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param OntologyRelationStoreRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(OntologyRelationStoreRequest $request, $id)
    {
        $ontologyRelation = OntologyRelation::findOrFail($id);
        $ontologyRelation->update($request->all());
        return redirect()->route('ontology_relation.index')->with('Success', 'Your relation has been successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ontologyRelation = OntologyRelation::findOrFail($id);
        $ontologyRelation->delete();
        return redirect()->back()->with('Success', 'Your relation has been deleted with success');
    }

    /**
     * Search's for the given name on the database
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request)
    {
        $relations = OntologyRelation::where('name','Like',  '%' .$request->search. '%')->paginate(10);
        return view('ontology-relation.ontology-relation', compact('relations'));
    }
}
