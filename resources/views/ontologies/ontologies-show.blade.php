@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')

@stop

@section('content')
    <div class="box box-success">

        <div class="box-header with-border">
            <div class="row">
                <div class="col-md-2">
                    <h1 style="vertical-align: middle;" class="box-title"> {{ $ontology->name }} </h1>
                </div>
                <div class="col-md-10">
                    <div class="text-right">
                        {{ __('XML File') }}
                        <a
                            href="{{ route('ontologies.download', ['locale' => app()->getLocale(), 'userId' => auth()->user()->id, 'ontologyId' => $ontology->id]) }}">
                            <button class="btn btn-default"><i class="fa fa-fw fa-download"></i>
                            </button>
                        </a>
                        {{ __('OWL File') }}
                        <a
                            href="{{ route('ontologies.downloadOWL', ['locale' => app()->getLocale(), 'userId' => auth()->user()->id, 'ontologyId' => $ontology->id]) }}">
                            <button class="btn btn-default"><i class="fa fa-fw fa-download"></i>
                            </button>
                        </a>
                        {{ __('SVG File') }}
                        <a
                            href="{{ route('ontologies.downloadSVG', ['locale' => app()->getLocale(), 'userId' => auth()->user()->id, 'ontologyId' => $ontology->id]) }}">
                            <button class="btn btn-default"><i class="fa fa-fw fa-download"></i>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
            
        </div>

       
        <div class="row">
            <div class="col-md-12">
                
                <div style="margin-bottom: 20px;" id="graph"></div>
            </div>
        </div>


        <div class="panel-group">
            <a data-toggle="collapse" href="#collapse3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                         
                        <h4 class="panel-title">
                        {{__("General Information")}} <i class="fa fa-fw fa-expand"></i>
                        </h4>                        
                    </div>
                </a>
                <div id="collapse3" class="panel-collapse ">
                            <div class="box-body">

                                <div class="row">
                                    <div class="col-md-12">
                                    <div class="form-group">
                                        <label>IRI</label>
                                        <label  class="form-control form-textarea"> https://onto4alleditor.com/en/ontologies/{{ $ontology->id }} </label>
                                    </div> 
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>{{ __('Name') }}</label>
                                            <label class="form-control">{{ $ontology->name }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>{{ __('Created By') }}</label>
                                            <label class="form-control">{{ $ontology->user->name }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Publication Date</label>
                                            <label class="form-control"> {{ $ontology->publication_date }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Last Uploaded</label>
                                            <label class="form-control"> {{ $ontology->last_uploaded }}</label>
                                        </div>
                                    </div>
                                </div>

                               

                                <div class="row">
                                    <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea disabled class="form-control form-textarea"> {{ $ontology->description }}</textarea>
                                    </div> 
                                    </div>
                                </div>
                                

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Link</label>
                                            <label class="form-control"><a href="{{ $ontology->link }}">
                                                    {{ $ontology->link }}
                                                </a></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Domain</label>
                                            <label class="form-control"> {{ $ontology->domain }}</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>General Purpose</label>
                                    <label class="form-control"> {{ $ontology->general_purpose }}</label>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Profiles Users</label>
                                            <label class="form-control"> {{ $ontology->profile_users }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Intended Use</label>
                                            <label class="form-control"> {{ $ontology->intended_use }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Type Of Ontology</label>
                                            <label class="form-control"> {{ $ontology->type_of_ontology }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Degree Of Formality</label>
                                            <label class="form-control"> {{ $ontology->degree_of_formality }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Scope</label>
                                            <label class="form-control"> {{ $ontology->scope }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Competence Questions</label>
                                    <label class="form-control"> {{ $ontology->competence_questions }}</label>
                                </div>
                                <div class="form-group">
                                    <label>Namespaces</label>
                                    <label class="form-control"> {{ $ontology->namespace }}</label>
                                </div>
                                <div class="form-group">
                                    <label>{{ __('Collaborators') }}</label>
                                    @foreach ($ontology->users as $user)
                                        <label class="form-control"> {{ $user->name }}</label>
                                    @endforeach
                                </div>
                            </div>
                            <!-- /.box-body -->
                </div>
            </div>
        </div>
        <div class="panel-group ">
            <a data-toggle="collapse" href="#collapse1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">{{__("Classes")}} <i class="fa fa-fw fa-expand"></i>
                        </h4>
                    </div>
                </a>
                <div id="collapse1" class="panel-collapse collapse">

                    <div class="container">
                        <div class="row">
                            <div class="informations-no">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="tab-pane active" id="classes-tab">

                                            <h4 id="nome"></h4>

                                            <div class="form-group">
                                                <label>SubClassOf</label>
                                                <input id="SubClassOf" disabled="" type="text" class="form-control"
                                                    placeholder="">
                                            </div>
                                            <div class="form-group">
                                                <label>Equivalence</label>
                                                <input id="Equivalence" disabled type="text" class="form-control"
                                                    placeholder="">
                                            </div>
                                            <div class="form-group">
                                                <label>Instances</label>
                                                <input id="Instances" disabled type="text" class="form-control"
                                                    placeholder="">
                                            </div>
                                            <div class="form-group">
                                                <label>TargetForKey</label>
                                                <input id="TargetForKey" disabled type="text" class="form-control"
                                                    placeholder="">
                                            </div>
                                            <div class="form-group">
                                                <label>DisjointWith</label>
                                                <input id="DisjointWith" disabled type="text" class="form-control"
                                                    placeholder="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="panel-group">
            <a data-toggle="collapse" href="#collapse2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            {{__("Relations")}} <i class="fa fa-fw fa-expand"></i>
                        </h4>
                    </div>
                </a>
                <div id="collapse2" class="panel-collapse collapse">
                    <div class="container">
                        <div class="row">
                            <div class="informations-aresta">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="tab-pane active" id="classes-tab">

                                            <h4 id="nome"></h4>


                                            <div class="form-group">
                                                <label>domain</label>
                                                <input id="domain" disabled="" type="text" class="form-control"
                                                    placeholder="">
                                            </div>
                                            <div class="form-group">
                                                <label>range</label>
                                                <input id="range" disabled="" type="text" class="form-control"
                                                    placeholder="">
                                            </div>
                                            <div class="form-group">
                                                <label>Equivalence</label>
                                                <input id="Equivalence" disabled type="text" class="form-control"
                                                    placeholder="">
                                            </div>
                                            <div class="form-group">
                                                <label>InverseOf</label>
                                                <input id="InverseOf" disabled="" type="text" class="form-control"
                                                    placeholder="">
                                            </div>

                                            <div class="form-group">
                                                <label>equivalentTo</label>
                                                <input id="equivalentTo" disabled="" type="text" class="form-control"
                                                    placeholder="">
                                            </div>
                                            <div class="form-group">
                                                <label>disjointWith</label>
                                                <input id="disjointWith-relations" disabled="" type="text"
                                                    class="form-control" placeholder="">
                                            </div>
                                            <div class="form-group">
                                                <label>TargetForKey</label>
                                                <input id="TargetForKey" disabled type="text" class="form-control"
                                                    placeholder="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        

        <a href="{{ route('ontologies.index', app()->getLocale()) }}">
            <button class="btn btn-success btn-block" type="button">Go back</button>
        </a>
    </div>


    @php
    $xml = str_replace('"', '\"', $ontology->xml_string);
    @endphp

@stop

@section('footer')

    @push('js')

        <script type="text/javascript">
            // Parses URL parameters. Supported parameters are:
            // - lang=xy: Specifies the language of the user interface.
            // - touch=1: Enables a touch-style user interface.
            // - storage=local: Enables HTML5 local storage.
            // - chrome=0: Chromeless mode.
            var urlParams = (function(url) {
                var result = new Object();
                var idx = url.lastIndexOf('?');

                if (idx > 0) {
                    var params = url.substring(idx + 1).split('&');

                    for (var i = 0; i < params.length; i++) {
                        idx = params[i].indexOf('=');

                        if (idx > 0) {
                            result[params[i].substring(0, idx)] = params[i].substring(idx + 1);
                        }
                    }
                }
                return result;
            })(window.location.href);

            // Default resources are included in grapheditor resources
            mxLoadResources = false;
        </script>

        <!-- MxGraph -->
        <script type="text/javascript" src="../../grapheditor/js/Init.js"></script>
        <script type="text/javascript" src="../../grapheditor/deflate/pako.min.js"></script>
        <script type="text/javascript" src="../../grapheditor/deflate/base64.js"></script>
        <script type="text/javascript" src="../../grapheditor/jscolor/jscolor.js"></script>
        <script type="text/javascript" src="../../grapheditor/sanitizer/sanitizer.min.js"></script>
        <script type="text/javascript" src="../../grapheditor/js/mxClient.js"></script>
        <script type="text/javascript" src="../../grapheditor/js/EditorUi.js"></script>
        <script type="text/javascript" src="../../grapheditor/js/Editor.js"></script>
        <script type="text/javascript" src="../../grapheditor/js/Graph.js"></script>
        <script type="text/javascript" src="../../grapheditor/js/Format.js"></script>
        <script type="text/javascript" src="../../grapheditor/js/Shapes.js"></script>
        <script type="text/javascript" src="../../grapheditor/js/Actions.js"></script>

        <script src="../../grapheditor/src/js/util/mxUtils.js"></script>
        <script type="text/javascript">
            var container = document.getElementById("graph");
            var graph = new Graph(container, null, null, null, null);

            graph.transparentBackground = false;
            graph.resetViewOnRootChange = false;
            graph.autoScroll = false;
            graph.setEnabled(false);


            try {
                let xmlString = "<?php echo "$xml"; ?>";
                var doc = mxUtils.parseXml(xmlString);
                var codec = new mxCodec(doc);
                codec.decode(doc.documentElement, graph.getModel());
                graph.fit();

            } catch (error) {
                console.log(error);
            } finally {
                graph.getModel().endUpdate();
            }

            let parser, xmlDoc;
            parser = new DOMParser();

            xmlDoc = parser.parseFromString("<?php echo "$xml"; ?>", "text/xml");

            // Esconde os elementos que serão utilizados para clonar
            $('.informations-no:last').css('display', 'none');
            $('.informations-aresta:last').css('display', 'none');

            for (let i = 0; i < xmlDoc.getElementsByTagName("object").length; i++) {
                if (xmlDoc.getElementsByTagName("object")[i].getAttribute("label") != null) {

                    let SubClassOf;
                    let DisjointWith;
                    let Equivalence;
                    let TargetForKey;
                    let Instances;
                    let Domain;
                    let Range;
                    let InverseOf;

                    let classe;

                    // Apenas arestas tem o atributo domain
                    if (xmlDoc.getElementsByTagName("object")[i].getAttribute("domain") != null) {
                        var newel = $('.informations-aresta:first').clone();
                        newel.css('display', 'block')
                        $(newel).insertAfter(".informations-aresta:last");


                        if (xmlDoc.getElementsByTagName("object")[i].getAttribute("SubClassOf") != null || xmlDoc
                            .getElementsByTagName("object")[i].getAttribute("SubClassOf") != "")
                            SubClassOf = xmlDoc.getElementsByTagName("object")[i].getAttribute("SubClassOf");

                        if (xmlDoc.getElementsByTagName("object")[i].getAttribute("DisjointWith") != null || xmlDoc
                            .getElementsByTagName("object")[i].getAttribute("DisjointWith") != "")
                            DisjointWith = xmlDoc.getElementsByTagName("object")[i].getAttribute("DisjointWith");

                        if (xmlDoc.getElementsByTagName("object")[i].getAttribute("Equivalence") != null || xmlDoc
                            .getElementsByTagName("object")[i].getAttribute("Equivalence") != "")
                            Equivalence = xmlDoc.getElementsByTagName("object")[i].getAttribute("Equivalence");

                        if (xmlDoc.getElementsByTagName("object")[i].getAttribute("TargetForKey") != null || xmlDoc
                            .getElementsByTagName("object")[i].getAttribute("TargetForKey") != "")
                            TargetForKey = xmlDoc.getElementsByTagName("object")[i].getAttribute("TargetForKey");

                        if (xmlDoc.getElementsByTagName("object")[i].getAttribute("domain") != null || xmlDoc
                            .getElementsByTagName("object")[i].getAttribute("domain") != "")
                            Domain = xmlDoc.getElementsByTagName("object")[i].getAttribute("domain");

                        if (xmlDoc.getElementsByTagName("object")[i].getAttribute("range") != null || xmlDoc
                            .getElementsByTagName("object")[i].getAttribute("range") != "")
                            Range = xmlDoc.getElementsByTagName("object")[i].getAttribute("range");

                        if (xmlDoc.getElementsByTagName("object")[i].getAttribute("InverseOf") != null || xmlDoc
                            .getElementsByTagName("object")[i].getAttribute("domain") != "")
                            InverseOf = xmlDoc.getElementsByTagName("object")[i].getAttribute("InverseOf");



                        $('.informations-aresta:last').find('#nome').text(xmlDoc.getElementsByTagName("object")[i].getAttribute(
                            "label"));
                        $('.informations-aresta:last').find('#SubClassOf').val(SubClassOf);
                        $('.informations-aresta:last').find('#DisjointWith').val(DisjointWith);
                        $('.informations-aresta:last').find('#Equivalence').val(Equivalence);
                        $('.informations-aresta:last').find('#TargetForKey').val(TargetForKey);
                        $('.informations-aresta:last').find('#Domain').val(Domain);
                        $('.informations-aresta:last').find('#Range').val(Range);
                        $('.informations-aresta:last').find('#InverseOf').val(InverseOf);

                    } else {
                        var newel = $('.informations-no:first').clone();
                        newel.css('display', 'block')
                        $(newel).insertAfter(".informations-no:last");
                        classe = ".informations-no:last";



                        if (xmlDoc.getElementsByTagName("object")[i].getAttribute("SubClassOf") != null || xmlDoc
                            .getElementsByTagName("object")[i].getAttribute("SubClassOf") != "")
                            SubClassOf = xmlDoc.getElementsByTagName("object")[i].getAttribute("SubClassOf");

                        if (xmlDoc.getElementsByTagName("object")[i].getAttribute("DisjointWith") != null || xmlDoc
                            .getElementsByTagName("object")[i].getAttribute("DisjointWith") != "")
                            DisjointWith = xmlDoc.getElementsByTagName("object")[i].getAttribute("DisjointWith");

                        if (xmlDoc.getElementsByTagName("object")[i].getAttribute("Equivalence") != null || xmlDoc
                            .getElementsByTagName("object")[i].getAttribute("Equivalence") != "")
                            Equivalence = xmlDoc.getElementsByTagName("object")[i].getAttribute("Equivalence");

                        if (xmlDoc.getElementsByTagName("object")[i].getAttribute("TargetForKey") != null || xmlDoc
                            .getElementsByTagName("object")[i].getAttribute("TargetForKey") != "")
                            TargetForKey = xmlDoc.getElementsByTagName("object")[i].getAttribute("TargetForKey");

                        if (xmlDoc.getElementsByTagName("object")[i].getAttribute("Instances") != null || xmlDoc
                            .getElementsByTagName("object")[i].getAttribute("Instances") != "")
                            Instances = xmlDoc.getElementsByTagName("object")[i].getAttribute("Instances");

                        $('.informations-no:last').find('#nome').text(xmlDoc.getElementsByTagName("object")[i].getAttribute(
                            "label"));
                        $('.informations-no:last').find('#SubClassOf').val(SubClassOf);
                        $('.informations-no:last').find('#DisjointWith').val(DisjointWith);
                        $('.informations-no:last').find('#Equivalence').val(Equivalence);
                        $('.informations-no:last').find('#TargetForKey').val(TargetForKey);
                        $('.informations-no:last').find('#Instances').val(Instances);

                    }


                }
            }
        </script>
    @endpush

@stop
