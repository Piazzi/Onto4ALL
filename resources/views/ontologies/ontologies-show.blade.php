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
            <a data-toggle="collapse" href="#collapse">
                <div class="panel panel-default">
                    <div class="panel-heading">

                        <h4 class="panel-title">
                            {{ __('General Information') }} <i class="fa fa-fw fa-expand"></i>
                        </h4>
                    </div>
            </a>
            <div id="collapse" class="panel-collapse ">
                <div class="box-body">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>IRI</label>
                                <label class="form-control form-textarea">
                                    https://onto4alleditor.com/en/ontologies/{{ $ontology->id }} </label>
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
                                <textarea disabled
                                    class="form-control form-textarea"> {{ $ontology->description }}</textarea>
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
                    <h4 class="panel-title">{{ __('Classes') }} <i class="fa fa-fw fa-expand"></i>
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
                                        <input id="Equivalence" disabled type="text" class="form-control" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label>Instances</label>
                                        <input id="Instances" disabled type="text" class="form-control" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label>TargetForKey</label>
                                        <input id="TargetForKey" disabled type="text" class="form-control" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label>DisjointWith</label>
                                        <input id="DisjointWith" disabled type="text" class="form-control" placeholder="">
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
        <a data-toggle="collapse" href="#collapse4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        {{ __('Instances') }} <i class="fa fa-fw fa-expand"></i>
                    </h4>
                </div>
        </a>
        <div id="collapse4" class="panel-collapse collapse">
            <div class="container">
                <div class="row">
                    <div class="informations-instance">
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="tab-pane active" id="classes-tab">

                                    <h4 id="nome"></h4>

                                    <div class="form-group">
                                        <label>types</label>
                                        <input id="types" disabled="" type="text" class="form-control" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label>sameAs</label>
                                        <input id="sameAs" disabled="" type="text" class="form-control" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label>differentAs</label>
                                        <input id="differentAs" disabled type="text" class="form-control" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label>objectProperties</label>
                                        <input id="objectProperties" disabled="" type="text" class="form-control"
                                            placeholder="">
                                    </div>

                                    <div class="form-group">
                                        <label>dataProperties</label>
                                        <input id="dataProperties" disabled="" type="text" class="form-control"
                                            placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label>negativeObjectProperties</label>
                                        <input id="negativeObjectProperties" disabled type="text" class="form-control"
                                            placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label>negativeDataProperties</label>
                                        <input id="negativeDataProperties" disabled type="text" class="form-control"
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
                        {{ __('Relations') }} <i class="fa fa-fw fa-expand"></i>
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
                                        <input id="domain" disabled="" type="text" class="form-control" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label>range</label>
                                        <input id="range" disabled="" type="text" class="form-control" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label>Equivalence</label>
                                        <input id="Equivalence" disabled type="text" class="form-control" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label>InverseOf</label>
                                        <input id="InverseOf" disabled="" type="text" class="form-control"
                                            placeholder="">
                                    </div>

                                    <div class="form-group">
                                        <label>disjointWith</label>
                                        <input id="disjointWith-relations" disabled="" type="text" class="form-control"
                                            placeholder="">
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


    <div class="panel-group">
        <a data-toggle="collapse" href="#collapse3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        {{ __('Annotation Propeties') }} <i class="fa fa-fw fa-expand"></i>
                    </h4>
                </div>
        </a>
        <div id="collapse3" class="panel-collapse collapse">
            <div class="container">
                <div class="row">
                    <div class="informations-annotation">
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="tab-pane active" id="classes-tab">

                                    <h4 id="nome"></h4>


                                    <div class="form-group">
                                        <label>comment</label>
                                        <input id="comment" disabled="" type="text" class="form-control" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label>isDefinedBy</label>
                                        <input id="isDefinedBy" disabled="" type="text" class="form-control"
                                            placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label>seeAlso</label>
                                        <input id="seeAlso" disabled type="text" class="form-control" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label>backwardCompartibleWith</label>
                                        <input id="backwardCompartibleWith" disabled="" type="text" class="form-control"
                                            placeholder="">
                                    </div>

                                    <div class="form-group">
                                        <label>deprecated</label>
                                        <input id="deprecated" disabled="" type="text" class="form-control"
                                            placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label>incompatibleWith</label>
                                        <input id="incompatibleWith" disabled type="text" class="form-control"
                                            placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label>priorVersion</label>
                                        <input id="priorVersion" disabled type="text" class="form-control"
                                            placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label>versionInfo</label>
                                        <input id="versionInfo" disabled type="text" class="form-control" placeholder="">
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

    <div id="scroll"></div>

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
        <script src="../../js/Compiler.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                if ($(location).attr('hash') != null) {

                    $($(location).attr('hash')).parent().parent().parent().parent().parent().parent().parent().collapse('show');

                    $('html, body').animate({
                        scrollTop: $($(location).attr('hash')).offset().top
                    }, 'slow');
                }
            });

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
            $('.informations-no:last').hide();
            $('.informations-aresta:last').hide();
            $('.informations-annotation:last').hide();
            $('.informations-instance:last').hide();

            for (let i = 0; i < xmlDoc.getElementsByTagName("object").length; i++) {


                //Annotation Properties
                var newel = $('.informations-annotation:first').clone();
                newel.show();
                $(newel).insertAfter(".informations-annotation:last");

                $('.informations-annotation:last').find('#nome').text(xmlDoc.getElementsByTagName("object")[i].getAttribute(
                    "label"));
                $('.informations-annotation:last').find('#comment').val(xmlDoc.getElementsByTagName("object")[i].getAttribute(
                    "comment"));
                $('.informations-annotation:last').find('#isDefinedBy').val(xmlDoc.getElementsByTagName("object")[i]
                    .getAttribute("isDefinedBy"));
                $('.informations-annotation:last').find('#seeAlso').val(xmlDoc.getElementsByTagName("object")[i].getAttribute(
                    "seeAlso"));
                $('.informations-annotation:last').find('#backwardCompartibleWith').val(xmlDoc.getElementsByTagName("object")[i]
                    .getAttribute("backwardCompartibleWith"));
                $('.informations-annotation:last').find('#deprecated').val(xmlDoc.getElementsByTagName("object")[i]
                    .getAttribute("deprecated"));
                $('.informations-annotation:last').find('#incompatibleWith').val(xmlDoc.getElementsByTagName("object")[i]
                    .getAttribute("incompatibleWith"));
                $('.informations-annotation:last').find('#priorVersion').val(xmlDoc.getElementsByTagName("object")[i]
                    .getAttribute("priorVersion"));
                $('.informations-annotation:last').find('#versionInfo').val(xmlDoc.getElementsByTagName("object")[i]
                    .getAttribute("versionInfo"));

                if (xmlDoc.getElementsByTagName("object")[i].getAttribute("label") != null) {

                    // Apenas instancias tem o atributo types
                    if (xmlDoc.getElementsByTagName("object")[i].getAttribute("types") != null) {

                        var newel = $('.informations-instance:first').clone();
                        newel.show();
                        $(newel).insertAfter(".informations-instance:last");

                        $('.informations-instance:last').find('#nome').text(xmlDoc.getElementsByTagName("object")[i]
                            .getAttribute(
                                "label"));
                        $('.informations-instance:last').find('#nome').attr('id', xmlDoc.getElementsByTagName("object")[i]
                            .getAttribute(
                                "label"));

                        $('.informations-instance:last').find('#types').val(xmlDoc.getElementsByTagName("object")[i]
                            .getAttribute("types"));

                        $('.informations-instance:last').find('#sameAs').val(xmlDoc.getElementsByTagName("object")[i]
                            .getAttribute("sameAs"));

                        $('.informations-instance:last').find('#differentAs').val(xmlDoc.getElementsByTagName("object")[i]
                            .getAttribute("differentAs"));

                        $('.informations-instance:last').find('#objectProperties').val(xmlDoc.getElementsByTagName("object")[i]
                            .getAttribute("objectProperties"));

                        $('.informations-instance:last').find('#dataProperties').val(xmlDoc.getElementsByTagName("object")[i]
                            .getAttribute("dataProperties"));

                        $('.informations-instance:last').find('#negativeObjectProperties').val(xmlDoc.getElementsByTagName(
                                "object")[i]
                            .getAttribute("negativeObjectProperties"));

                        $('.informations-instance:last').find('#negativeDataProperties').val(xmlDoc.getElementsByTagName(
                                "object")[i]
                            .getAttribute("negativeDataProperties"));


                    } else
                        // Apenas arestas tem o atributo domain
                        if (xmlDoc.getElementsByTagName("object")[i].getAttribute("domain") != null) {
                            var newel = $('.informations-aresta:first').clone();
                            newel.show();
                            $(newel).insertAfter(".informations-aresta:last");

                            $('.informations-aresta:last').find('#nome').text(xmlDoc.getElementsByTagName("object")[i]
                                .getAttribute("label"));

                            $('.informations-aresta:last').find('#nome').attr('id', xmlDoc.getElementsByTagName("object")[i]
                                .getAttribute(
                                    "label"));


                            $('.informations-aresta:last').find('#SubClassOf').val(xmlDoc.getElementsByTagName("object")[i]
                                .getAttribute("SubClassOf"));

                            $('.informations-aresta:last').find('#DisjointWith').val(xmlDoc.getElementsByTagName("object")[i]
                                .getAttribute("DisjointWith"));

                            $('.informations-aresta:last').find('#Equivalence').val(xmlDoc.getElementsByTagName("object")[i]
                                .getAttribute("Equivalence"));

                            $('.informations-aresta:last').find('#TargetForKey').val(xmlDoc.getElementsByTagName("object")[i]
                                .getAttribute("TargetForKey"));

                            $('.informations-aresta:last').find('#Domain').val(xmlDoc.getElementsByTagName("object")[i]
                                .getAttribute("Domain"));

                            $('.informations-aresta:last').find('#Range').val(xmlDoc.getElementsByTagName("object")[i]
                                .getAttribute("Range"));

                            $('.informations-aresta:last').find('#InverseOf').val(xmlDoc.getElementsByTagName("object")[i]
                                .getAttribute("InverseOf"));

                        } else {
                            var newel = $('.informations-no:first').clone();
                            newel.show();
                            $(newel).insertAfter(".informations-no:last");


                            $('.informations-no:last').find('#nome').text(xmlDoc.getElementsByTagName("object")[i].getAttribute(
                                "label"));

                            $('.informations-no:last').find('#nome').attr('id', xmlDoc.getElementsByTagName("object")[i]
                                .getAttribute(
                                    "label"));


                            $('.informations-no:last').find('#SubClassOf').val(xmlDoc.getElementsByTagName("object")[i]
                                .getAttribute("SubClassOf"));

                            $('.informations-no:last').find('#DisjointWith').val(xmlDoc.getElementsByTagName("object")[i]
                                .getAttribute("DisjointWith"));

                            $('.informations-no:last').find('#Equivalence').val(xmlDoc.getElementsByTagName("object")[i]
                                .getAttribute("Equivalence"));

                            $('.informations-no:last').find('#TargetForKey').val(xmlDoc.getElementsByTagName("object")[i]
                                .getAttribute("TargetForKey"));

                            $('.informations-no:last').find('#Instances').val(xmlDoc.getElementsByTagName("object")[i]
                                .getAttribute("Instances"));

                        }
                }
            }
        </script>
    @endpush

@stop
