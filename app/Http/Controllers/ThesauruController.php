<?php

namespace App\Http\Controllers;

use App\Thesauru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;


class ThesauruController extends Controller
{

    /**
     * Returns the thesaurus editor view
     */
    public function editor()
    {
        return view('thesaurus-editor');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $thesaurus = Thesauru::where('user_id','=', Auth::user()->id)->latest()->paginate(10);
        return view('thesaurus.thesaurus', compact('thesaurus'));
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
     */
    public static function store(Request $request)
    {
        // verifies if the user has trespassed the total number os thesaurus
        $size = Thesauru::where('user_id', '=', $request->user()->id)->count();
        if ($size > 9)
        {
            Thesauru::where('user_id', '=', $request->user()->id)->orderBy('created_at', 'asc')->first()->delete();
        }
        $thesauru = new Thesauru();
        $thesauru ->name = $request->fileName;
        $thesauru ->file = $request->xml;
        $thesauru ->user_id = $request->user()->id;
        $thesauru ->created_by = $request->user()->name;
        $thesauru ->save();

        /// Updates the ontology if already exists in the ontology manager
        $savedthesaurus = Thesauru::where('user_id', $request->user()->id)->get();
        foreach($savedthesaurus as $savedThesauru)
        {
            if($savedThesauru->name == $request->fileName)
            {
                $savedThesauru->file = $request->xml;
                $savedThesauru->updated_at = $thesauru->created_at;
                $savedThesauru->save();
            }
        }
    }

    /**
     * Finds the ontology user and then download as a XML file.
     * @param Request $request
     * @return Response
     */
    public function download(Request $request)
    {
        $file = Thesauru::where('user_id','=', $request->userId)->where('id','=', $request->thesauruId)->first();

        $response = Response::create($file->file, 200);
        $response->header('Content-Type', 'text/xml');
        $response->header('Cache-Control', 'public');
        $response->header('Content-Description', 'File Transfer');
        $response->header('Content-Disposition', 'attachment; filename=' . $file->name . '');
        $response->header('Content-Transfer-Encoding', 'binary');

        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $thesauru = Thesauru::findOrFail($id);
        if($thesauru->user_id != Auth::user()->id)
            return view('lockscreen');
        return view('thesaurus.thesaurus-show', compact('thesauru'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $thesauru = Thesauru::findOrFail($id);
        if($thesauru->user_id != Auth::user()->id)
            return view('lockscreen');
        return view('thesaurus.thesaurus-edit', compact('thesauru', 'id'));
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
        $thesauru = Thesauru::where('id','=', $id)->where('user_id','=', $request->user()->id)->first();
        $thesauru->update($request->all());
        return redirect()->route('thesaurus.index')->with('Success', 'Your thesauru has been updated with success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $thesauru = Thesauru::where('id','=', $id)->where('user_id','=', Auth::user()->id)->first();
        $thesauru->delete();
        return redirect()->route('thesaurus.index')->with('Success', 'Your thesauru has been deleted with success');
    }
}
