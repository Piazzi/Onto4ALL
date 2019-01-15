<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ontology;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\OntologyStoreRequest;


class OntologyController extends Controller
{
    /**
     * Display a listing of the user ontologies .
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ontologies = Ontology::where('user_id','=', Auth::user()->id)->where('favourite','=', 0)->paginate(10);
        $favouriteOntologies = Ontology::where('user_id','=', Auth::user()->id)->where('favourite','=', 1)->get();
        return view('ontologies.ontologies', compact('ontologies', 'favouriteOntologies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ontologies.ontologies_store');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param OntologyStoreRequest $request
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
        $ontology = Ontology::findOrFail($id);
        return view('ontologies.ontologies_edit', compact('ontology', 'id'));
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
        $ontology = Ontology::where('id','=', $id)->where('user_id','=', $request->user()->id)->first();
        $ontology->update($request->all());
        return redirect()->route('ontologies.index')->with('Sucess', 'Your ontology has been updated with success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $ontology = Ontology::where('id','=', $id)->where('user_id','=', $request->user()->id)->first();
        $ontology->delete();
        return redirect()->route('ontologies.index')->with('Sucess', 'Your ontology has been deleted with success');
    }

    /**
     * Finds the ontology user and then download
     * @param Request $request
     * @return Response
     */
    public function download(Request $request)
    {
        $file = Ontology::where('user_id','=', $request->userId)->where('id','=', $request->ontologyId)->first();

        $response = Response::create($file->file, 200);
        $response->header('Content-Type', 'text/xml');
        $response->header('Cache-Control', 'public');
        $response->header('Content-Description', 'File Transfer');
        $response->header('Content-Disposition', 'attachment; filename=' . $file->name . '');
        $response->header('Content-Transfer-Encoding', 'binary');

        return $response;
    }

    /**
     * Change the status of the 'favourite' column
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveAsFavourite(Request $request)
    {
        $countOntologies = Ontology::where('user_id','=', $request->userId)->where('favourite','=', 1)->count();
        if($countOntologies >= 5)
        {
            return redirect()->route('ontologies.index')->with('Error', 'You already have 5 ontologies marked as favourite.');
        }
        $ontology = Ontology::where('id','=', $request->ontologyId)->where('user_id','=', $request->userId)->first();
        $ontology->favourite = 1;
        $ontology->save();
        return redirect()->route('ontologies.index')->with('Sucess', 'Your ontology has been added to favorites');
    }

    /**
     * Unmark the favourite column from a ontology
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveAsNormal(Request $request)
    {
        $countOntologies = Ontology::where('user_id','=', $request->userId)->where('favourite','=', 0)->count();
        if($countOntologies >= 10)
        {
            Ontology::where('user_id', '=', $request->user()->id)->where('favourite','=', 0)->orderBy('created_at', 'asc')->first()->delete();
        }
        $ontology = Ontology::where('id','=', $request->ontologyId)->where('user_id','=', $request->userId)->first();
        $ontology->favourite = 0;
        $ontology->save();
        return redirect()->route('ontologies.index')->with('Sucess', 'Your ontology has been unmarked as favorite');
    }
}
