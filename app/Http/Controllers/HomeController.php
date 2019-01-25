<?php

namespace App\Http\Controllers;

use App\Ontology;
use Illuminate\Http\Request;
use App\Menu;
use App\TipsRelation;
use App\TipClass;
use Illuminate\Http\Response;
use Imagick;

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
        $tips_relations = TipsRelation::all();
        $tips_class = TipClass::all();
        return view('about_us', compact( 'tips_relations', 'tips_class'));
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
        if ($size > 9)
        {
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

    public function exportImage(Request $request)
    {

       if($request->imageFormat == 'svg')
       {
           $response = Response::create($request->data, 200);
           $response->header('Content-Description', 'File Transfer');
           $response->header('Content-Disposition', 'attachment; filename=' . $request->fileName . '');
           $response->header('Content-Type', 'image/svg');
           return $response;
       }
       else if($request->imageFormat == 'png')
       {
           $response = Response::create($request->image, 200);
           $response->header('Content-Description', 'File Transfer');
           $response->header('Content-Disposition', 'attachment; filename=' . $request->fileName . '');
           $response->header('Content-Type', 'image/png');

           $image = new Imagick();
           $image->setBackgroundColor(new ImagickPixel('transparent'));
           $image->readImageBlob(file_get_contents($response));
           $image->setImageFormat("png24");
           $image->resizeImage(1024, 768, imagick::FILTER_LANCZOS, 1);
           $image->writeImage('image.png');
           return $response;
       }
        return 'a';
    }
}
