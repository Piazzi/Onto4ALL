<?php

namespace App\Http\Controllers;

use http\Env\Response;
use Illuminate\Http\Request;
use App\TipClass;
use App\Http\Requests\TipClassStoreRequest;

class TipClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tips_class = TipClass::select()->paginate(10);
        return view('tips_class.tips_class', compact('tips_class'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tips_class.tips_class_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TipClassStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(TipClassStoreRequest $request)
    {
        $tip_class = TipClass::create($request->all());
        return redirect()->route('tips_class.index')->with('Sucess', 'Your Tip Class has been successfully stored')->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tip_class = TipClass::findOrFail($id);
        return view('tips_class.tips_class_show', compact('tip_class'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tip_class = TipClass::findOrFail($id);
        return view('tips_class.tips_class_edit', compact('tip_class', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TipClassStoreRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(TipClassStoreRequest $request, $id)
    {
        $tip_class = TipClass::findOrFail($id);
        $tip_class->update($request->all());
        return redirect()->route('tips_class.index')->with('Sucess', 'Your relation has been successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tip_class = TipClass::findOrFail($id);
        $tip_class->delete();
        return redirect()->back()->with('Sucess', 'Your relation has been deleted with success');
    }


    /**
     * Search's for the given name on the database
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request)
    {
        $tips_class = TipClass::where('name','Like',  '%' .$request->search. '%')->paginate(10);
        return view('tips_class.tips_class', compact('tips_class'));
    }
}
