<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;
use App\TipsRelation;
use App\TipClass;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::all();
        $tips_relations = TipsRelation::all();
        $tips_class = TipClass::all();
        return view('index', compact('menus','tips_relations','tips_class')); /* Editor */
    }

    public function save()
    {
        return 'a';
    }
}
