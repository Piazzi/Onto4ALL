<?php

namespace App\Http\Controllers;

use App\Ontology;
use Illuminate\Http\Request;
use App\Menu;
use App\TipsRelation;
use App\TipClass;
use Illuminate\Http\Response;

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
        return view('index', compact('menus', 'tips_relations', 'tips_class')); /* Editor */
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function aboutUs()
    {
        return view('about_us');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function tutorial()
    {
        return view('tutorial');
    }

    /**
     * Save the editor diagram into a XML file.
     * @param Request $request
     * @return Response
     *
     */
    public function saveXML(Request $request)
    {
        $response = Response::create($request->xml, 200);
        $response->header('Content-Type', 'text/xml');
        $response->header('Cache-Control', 'public');
        $response->header('Content-Description', 'File Transfer');
        $response->header('Content-Disposition', 'attachment; filename=' . $request->fileName . '');
        $response->header('Content-Transfer-Encoding', 'binary');

        $size = Ontology::where('user_id', '=', $request->user()->id)->where('favourite','=', 0)->count();
        if ($size > 9) {
            Ontology::where('user_id', '=', $request->user()->id)->where('favourite','=', 0)->orderBy('created_at', 'asc')->first()->delete();
        }
        $ontology = new Ontology();
        $ontology->name = $request->fileName;
        $ontology->file = $request->xml;
        $ontology->user_id = $request->user()->id;
        $ontology->created_by = $request->user()->name;
        $ontology->favourite = 0;
        $ontology->save();

        return $response;
    }
}
