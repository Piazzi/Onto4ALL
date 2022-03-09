<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OntologyClass;
use App\Http\Requests\OntologyClassStoreRequest;
use Illuminate\Support\Facades\Auth;

class OntologyClassController extends Controller
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
    public function store(OntologyClassStoreRequest $request, $locale)
    {
        OntologyClass::create($request->all());
        return redirect()->route('ontology_class.index', $locale)->with('Success', 'Your ontology class has been successfully stored')->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($locale, $id )
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
    public function edit($locale, $id)
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
    public function update(OntologyClassStoreRequest $request, $locale, $id)
    {
        $ontologyClass = OntologyClass::findOrFail($id);
        $ontologyClass->update($request->all());
        return redirect()->route('ontology_class.index', $locale)->with('Success', 'Your ontology class has been successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($locale, $id)
    {
        $ontologyClass = OntologyClass::findOrFail($id);
        $ontologyClass->delete();
        return redirect()->back()->with('Success', 'Your ontology class has been deleted with success');
    }


    /**
     * Search's for the given name on the database
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request, $locale)
    {
        $classes = OntologyClass::where('name','Like',  '%' .$request->search. '%')->paginate(10);
        return view('ontology-class.ontology-class', compact('classes'));
    }

    /**
     * Return classes by user.
     *
     * @return \Illuminate\Http\Response
     */
    public function getClasses()
    {
        $classes = OntologyClass::select()->whereIn('ontology', explode(',',Auth::user()->ontology))->get();

        return response()->json($classes);
    }
}
