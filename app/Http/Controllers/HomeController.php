<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;
use App\TipsRelation;

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
        return view('index', compact('menus','tips_relations')); /* Editor */
    }

    public function save()
    {
        return 'a';
    }
}
