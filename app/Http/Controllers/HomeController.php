<?php

namespace App\Http\Controllers;

use App\Ontology;
use DOMDocument;
use Illuminate\Http\Request;
use App\Menu;
use App\TipsRelation;
use App\TipClass;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

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
        $ontologies = Ontology::where('user_id', '=', Auth::user()->id)->get();
        return view('index', compact('menus', 'tips_relations', 'tips_class', 'ontologies')); /* Editor */
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function aboutUs()
    {
        $tips_relations = TipsRelation::all();
        $tips_class = TipClass::all();
        return view('about_us', compact('tips_relations', 'tips_class'));
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

        $size = Ontology::where('user_id', '=', $request->user()->id)->where('favourite', '=', 0)->count();
        if ($size > 9)
        {
            Ontology::where('user_id', '=', $request->user()->id)->where('favourite', '=', 0)->orderBy('created_at', 'asc')->first()->delete();
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

    /**
     * Export the diagram to .SVG format
     * @param Request $request
     * @return Response
     */
    public function exportImage(Request $request)
    {
        $response = Response::create($request->data, 200);
        $response->header('Content-Description', 'File Transfer');
        $response->header('Content-Disposition', 'attachment; filename=' . $request->fileName . '');
        $response->header('Content-Type', 'image/svg');
        return $response;
    }

    /**
     * Export the diagram to .OWL format
     * @param Request $request
     * @return Response
     */
    public function exportOWL(Request $request)
    {
        $dom = new DOMDocument('1.0', 'utf-8');
        $ontology = $dom->createElement('Ontology');
        $ontology->setAttribute('host','www.ontoforall.com');
        $ontology->setAttribute('xmlns:xsi','http://www.w3.org/2001/XMLSchema-instance');
        $ontology->setAttribute('xsi:schemaLocation','http://www.w3.org/2002/07/owl# http://www.w3.org/2009/09/owl2-xml.xsd');
        $ontology->setAttribute('xmlns','http://www.w3.org/2002/07/owl#');
        $ontology->setAttribute('xml:base','http://example.com/myOntology');
        //$ontology->setAttribute('xmlns:rdfs','http://www.w3.org/2000/01/rdf-schema#');
        //$ontology->setAttribute('xmlns:xsd','http://www.w3.org/2001/XMLSchema#');
        //$ontology->setAttribute('xmlns:rdf','http://www.w3.org/1999/02/22-rdf-syntax-ns#');
        //$ontology->setAttribute('xmlns:xml','http://www.w3.org/XML/1998/namespace');
        $ontology->setAttribute('ontologyIRI','http://example.com/myOntology');

        /*
        $prefixRdf = $dom->createElement('Prefix');
        $prefixRdf->setAttribute('name','rdf');
        $prefixRdf->setAttribute('IRI','http://www.w3.org/1999/02/22-rdf-syntax-ns#');

        $prefixRdfs = $dom->createElement('Prefix');
        $prefixRdfs->setAttribute('name','rdfs');
        $prefixRdfs->setAttribute('IRI','http://www.w3.org/2000/01/rdf-schema#');

        $prefixXsd = $dom->createElement('Prefix');
        $prefixXsd->setAttribute('name','xsd');
        $prefixXsd->setAttribute('IRI','http://www.w3.org/2001/XMLSchema#');

        $prefixOwl = $dom->createElement('Prefix');
        $prefixOwl->setAttribute('name','owl');
        $prefixOwl->setAttribute('IRI','http://www.w3.org/2002/07/owl#');

        $ontology->appendChild($prefixRdf);
        $ontology->appendChild($prefixRdfs);
        $ontology->appendChild($prefixXsd);
        $ontology->appendChild($prefixOwl);
        */
        $dom->appendChild($ontology);

        $xml = simplexml_load_string($request->xml); // Convert the XML string into a XML object
        foreach($xml->root->mxCell as $element)
        {
            if($element['value'])
            {
                if($element['edge'] == null)
                {
                    $declaration = $dom->createElement('Declaration');
                    $class = $dom->createElement('Class');
                    $class->setAttribute('IRI', '#' . $element['value']);
                    $declaration->appendChild($class);
                    $ontology->appendChild($declaration);
                }
                else
                {

                }
            }
        }

        $response = Response::create($dom->saveXML(), 200);
        $response->header('Content-Description', 'File Transfer');
        $response->header('Content-Disposition', 'attachment; filename=' . $request->fileName . '');
        $response->header('Content-Type', 'text/xml');
        $response->header('Content-Transfer-Encoding', 'binary');
        $response->header('Cache-Control', 'public');

        return $response;
    }
}
