@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')

@stop

@section('content')
    <div class="box box-success">

        <div class="box-header with-border">
            <h3 class="box-title"><strong> {{ $ontology->name }} </strong></h3>
        </div>

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
        </div>

        <div id="graph"></div>


        <div class="panel-group">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" href="#collapse1">Informações dos nós</a>
                    </h4>
                </div>
                <div id="collapse1" class="panel-collapse collapse">

                    <div class="informations-no">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h4 id="#nome"></h4>
                                        <div class="tab-pane active" id="classes-tab">
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
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" href="#collapse2">Informações das arestas</a>
                    </h4>
                </div>
                <div id="collapse2" class="panel-collapse collapse">
                    <div class="container">
                        <div class="row">
                            <div class="informations-aresta">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h4 id="#nome"></h4>
                                        <div class="tab-pane active" id="classes-tab">
                                            <div class="form-group">
                                                <label>SubClassOf</label>
                                                <div class="tab-pane active" id="object-properties-tab">
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
                                                        <label>equivalentTo</label>
                                                        <input id="equivalentTo" disabled="" type="text"
                                                            class="form-control" placeholder="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>subpropertyOf</label>
                                                        <input id="subpropertyOf" disabled="" type="text"
                                                            class="form-control" placeholder="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>inverseOf</label>
                                                        <input id="inverseOf" disabled="" type="text" class="form-control"
                                                            placeholder="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>disjointWith</label>
                                                        <input id="disjointWith-relations" disabled="" type="text"
                                                            class="form-control" placeholder="">
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input id="functional" type="checkbox" disabled>
                                                                Functional
                                                            </label>
                                                        </div>

                                                        <div class="checkbox">
                                                            <label>
                                                                <input id="inverseFunctional" type="checkbox" disabled>
                                                                Inverse Functional
                                                            </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <label>
                                                                <input id="transitive" type="checkbox" disabled>
                                                                Transitive
                                                            </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <label>
                                                                <input id="symetric" type="checkbox" disabled>
                                                                Symetric
                                                            </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <label>
                                                                <input id="asymmetric" type="checkbox" disabled>
                                                                Asymmetric
                                                            </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <label>
                                                                <input id="reflexive" type="checkbox" disabled>
                                                                Reflexive
                                                            </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <label>
                                                                <input id="irreflexive" type="checkbox" disabled>
                                                                Irreflexive
                                                            </label>
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
                </div>
            </div>
        </div>

        <!-- /.box-header -->
        <div class="panel-group">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" href="#collapse3">Informações Gerais</a>
                    </h4>
                </div>
                <div id="collapse3" class="panel-collapse collapse">
                    <div class="container">
                        <div class="row">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('Name') }}</label>
                                            <label>Name</label>
                                            <label class="form-control">{{ $ontology->name }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('Created By') }}</label>
                                            <label class="form-control">{{ $ontology->user->name }}</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Publication Date</label>
                                            <label class="form-control"> {{ $ontology->publication_date }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Last Uploaded</label>
                                            <label class="form-control"> {{ $ontology->last_uploaded }}</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea disabled
                                        class="form-control form-textarea"> {{ $ontology->description }}</textarea>
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

            for (let i = 0; i < xmlDoc.getElementsByTagName("object").length; i++) {
                if (xmlDoc.getElementsByTagName("object")[i].getAttribute("label") != null) {


                    if (i != 0) {
                        var newel = $('.informations:last').clone();
                        $(newel).insertAfter(".informations:last");
                    }

                    var SubClassOf;
                    var DisjointWith;
                    var Equivalence;
                    var TargetForKey;
                    var Instances;
                    var label;
                    var seeAlso;
                    var isDefinedBy;
                    var comment;
                    var versionInfo;
                    var priorVersion;
                    var deprecated;
                    var incompatibleWith;
                    var backwardCompatibleWith;


                    if (xmlDoc.getElementsByTagName("object")[i].getAttribute("SubClassOf") != null || xmlDoc
                        .getElementsByTagName("object")[i].getAttribute("SubClassOf") != "")
                        SubClassOf = xmlDoc.getElementsByTagName("object")[i].getAttribute("SubClassOf");

                    if (xmlDoc.getElementsByTagName("object")[i].getAttribute("DisjointWith") != null || xmlDoc
                        .getElementsByTagName("object")[i].getAttribute("DisjointWith") != "")
                        DisjointWith = xmlDoc.getElementsByTagName("object")[i].getAttribute("DisjointWith");

                    if (xmlDoc.getElementsByTagName("object")[i].getAttribute("Equivalence") != null || xmlDoc
                        .getElementsByTagName("object")[i].getAttribute("Equivalence") != "")
                        Equivalence = xmlDoc.getElementsByTagName("object")[i].getAttribute("Equivalence");

                    if (xmlDoc.getElementsByTagName("object")[i].getAttribute("Instances") != null || xmlDoc
                        .getElementsByTagName("object")[i].getAttribute("Instances") != "")
                        Instances = xmlDoc.getElementsByTagName("object")[i].getAttribute("Instances");

                    if (xmlDoc.getElementsByTagName("object")[i].getAttribute("label") != null || xmlDoc.getElementsByTagName(
                            "object")[i].getAttribute("label") != "")
                        label = xmlDoc.getElementsByTagName("object")[i].getAttribute("label");

                    if (xmlDoc.getElementsByTagName("object")[i].getAttribute("seeAlso") != null || xmlDoc.getElementsByTagName(
                            "object")[i].getAttribute("seeAlso") != "")
                        seeAlso = xmlDoc.getElementsByTagName("object")[i].getAttribute("seeAlso");

                    if (xmlDoc.getElementsByTagName("object")[i].getAttribute("isDefinedBy") != null || xmlDoc
                        .getElementsByTagName("object")[i].getAttribute("isDefinedBy") != "")
                        isDefinedBy = xmlDoc.getElementsByTagName("object")[i].getAttribute("isDefinedBy");

                    if (xmlDoc.getElementsByTagName("object")[i].getAttribute("comment") != null || xmlDoc.getElementsByTagName(
                            "object")[i].getAttribute("comment") != "")
                        comment = xmlDoc.getElementsByTagName("object")[i].getAttribute("comment");

                    if (xmlDoc.getElementsByTagName("object")[i].getAttribute("versionInfo") != null || xmlDoc
                        .getElementsByTagName("object")[i].getAttribute("versionInfo") != "")
                        versionInfo = xmlDoc.getElementsByTagName("object")[i].getAttribute("versionInfo");

                    if (xmlDoc.getElementsByTagName("object")[i].getAttribute("priorVersion") != null || xmlDoc
                        .getElementsByTagName("object")[i].getAttribute("priorVersion") != "")
                        priorVersion = xmlDoc.getElementsByTagName("object")[i].getAttribute("priorVersion");

                    if (xmlDoc.getElementsByTagName("object")[i].getAttribute("deprecated") != null || xmlDoc
                        .getElementsByTagName("object")[i].getAttribute("deprecated") != "")
                        deprecated = xmlDoc.getElementsByTagName("object")[i].getAttribute("deprecated");

                    if (xmlDoc.getElementsByTagName("object")[i].getAttribute("incompatibleWith") != null || xmlDoc
                        .getElementsByTagName("object")[i].getAttribute("incompatibleWith") != "")
                        incompatibleWith = xmlDoc.getElementsByTagName("object")[i].getAttribute("incompatibleWith");

                    if (xmlDoc.getElementsByTagName("object")[i].getAttribute("backwardCompatibleWith") != null || xmlDoc
                        .getElementsByTagName("object")[i].getAttribute("backwardCompatibleWith") != "")
                        backwardCompatibleWith = xmlDoc.getElementsByTagName("object")[i].getAttribute(
                            "backwardCompatibleWith");

                    $('[id$=nome]').last().text(xmlDoc.getElementsByTagName("object")[i].getAttribute("label"));
                    $('[id$=SubClassOf]').last().text(SubClassOf);
                    $('[id$=DisjointWith]').last().text(DisjointWith);
                    $('[id$=Equivalence]').last().text(Equivalence);
                    $('[id$=TargetForKey]').last().text(TargetForKey);
                    $('[id$=Instances]').last().text(Instances);
                    $('[id$=label]').last().text(label);
                    $('[id$=seeAlso]').last().text(seeAlso);
                    $('[id$=isDefinedBy]').last().text(isDefinedBy);
                    $('[id$=comment]').last().text(comment);
                    $('[id$=versionInfo]').last().text(versionInfo);
                    $('[id$=priorVersion]').last().text(priorVersion);
                    $('[id$=deprecated]').last().text(deprecated);
                    $('[id$=incompatibleWith]').last().text(incompatibleWith);
                    $('[id$=backwardCompatibleWith]').last().text(backwardCompatibleWith);
                }
            }
        </script>
    @endpush

@stop
