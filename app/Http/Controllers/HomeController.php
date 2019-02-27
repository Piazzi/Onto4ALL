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
        $ontology->setAttribute('xmlns:rdfs','http://www.w3.org/2000/01/rdf-schema#');
        $ontology->setAttribute('xmlns:xsd','http://www.w3.org/2001/XMLSchema#');
        $ontology->setAttribute('xmlns:rdf','http://www.w3.org/1999/02/22-rdf-syntax-ns#');
        $ontology->setAttribute('xmlns:xml','http://www.w3.org/XML/1998/namespace');
        $ontology->setAttribute('ontologyIRI','http://example.com/myOntology');


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

        $dom->appendChild($ontology);

        $xml = simplexml_load_string($request->xml); // Convert the XML string into a XML object

        function createClassElement($name, $dom, $ontology)
        {
            $declaration = $dom->createElement('Declaration');
            $class = $dom->createElement('Class');
            $class->setAttribute('IRI', $name);
            $declaration->appendChild($class);
            $ontology->appendChild($declaration);
        }

        function createObjectPropertyElement($name, $dom, $ontology)
        {
            $declaration = $dom->createElement('Declaration');
            $objectProperty = $dom->createElement('ObjectProperty');
            $objectProperty->setAttribute('IRI', $name);
            $declaration->appendChild($objectProperty);
            $ontology->appendChild($declaration);
        }

        foreach ($xml->root->object as $object)
        {
            if($object->mxCell['edge'] == null)
            {
                createClassElement($object['label'], $dom, $ontology);
            }
            else if($object->mxCell['source'] && $object->mxCell['target'])
            {
                createObjectPropertyElement($object['label'], $dom, $ontology);
            }
            foreach ($object->attributes() as $name => $value)
            {
                if($name != 'id' && $name != 'label' && $value != null)
                {
                    $annotationAssertion = $dom->createElement('AnnotationAssertion');
                    $annotationProperty = $dom->createElement('AnnotationProperty');
                    
                    if($name == 'importedFrom')
                        $annotationProperty->setAttribute('IRI','imported_from');
                    else if ($name == 'alternativeTerm')
                        $annotationProperty->setAttribute('IRI','alternative_term');
                    else if ($name == 'exampleOfUsage')
                        $annotationProperty->setAttribute('IRI','example_of_usage');
                    else if ($name == 'SubClassOf')
                        $annotationProperty->setAttribute('IRI','SubClass_Of');
                    else
                    $annotationProperty->setAttribute('IRI',$name);

                    $iri = $dom->createElement('IRI');
                    $iri->textContent = $object['label'];
                    $literal = $dom->createElement('Literal');
                    $literal->setAttribute('datatypeIRI','&rdf;PlainLiteral');
                    $literal->textContent = $value;
                    $annotationAssertion->appendChild($annotationProperty);
                    $annotationAssertion->appendChild($iri);
                    $annotationAssertion->appendChild($literal);
                    $ontology->appendChild($annotationAssertion);

                }
            }

        }

        foreach($xml->root->mxCell as $element)
        {
            if($element['value'])
            {
                if($element['edge'] == null)
                {
                    createClassElement($element['value'], $dom, $ontology);
                }
                else if($element['source'] && $element['target'])
                {
                   createObjectPropertyElement($element['value'], $dom, $ontology);
                }
            }
        }

        // Formating the XML text
        $dom->preserveWhiteSpace = false;
        $dom->formatOutput = true;

        $response = Response::create($dom->saveXML(), 200);
        $response->header('Content-Description', 'File Transfer');
        $response->header('Content-Disposition', 'attachment; filename=' . $request->fileName . '');
        $response->header('Content-Type', 'text/xml');
        $response->header('Content-Transfer-Encoding', 'binary');
        $response->header('Cache-Control', 'public');

        return $response;
    }
}
