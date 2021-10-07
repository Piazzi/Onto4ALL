@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')

@stop

@section('content')
    <div class="box box-success">
        <div id="graph"></div>

        <div class="text-right">
                {{__('XML File')}}
                <a href="{{route('ontologies.download', ['locale' => app()->getLocale() ,'userId' => auth()->user()->id ,'ontologyId' => $ontology->id])}}">
                    <button class="btn btn-default"><i class="fa fa-fw fa-download"></i>
                    </button>
                </a>
                {{__('OWL File')}}
                <a href="{{route('ontologies.downloadOWL', ['locale' => app()->getLocale() , 'userId' => auth()->user()->id ,'ontologyId' => $ontology->id])}}">
                    <button class="btn btn-default"><i class="fa fa-fw fa-download"></i>
                    </button>
                </a>
        </div>

        <div class="box-header with-border">
            <h3 class="box-title"><strong> {{$ontology->name}} </strong></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{__('Name')}}</label>
                        <label>Name</label>
                        <label class="form-control">{{$ontology->name}}</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{__('Created By')}}</label>
                        <label class="form-control">{{$ontology->user->name}}</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Publication Date</label>
                        <label class="form-control"> {{$ontology->publication_date}}</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Last Uploaded</label>
                        <label class="form-control"> {{$ontology->last_uploaded}}</label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Description</label>
                <textarea disabled class="form-control form-textarea"> {{$ontology->description}}</textarea>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Link</label>
                        <label class="form-control"><a href="{{$ontology->link}}"> {{$ontology->link}} </a></label>
                    </div>
                    </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Domain</label>
                        <label class="form-control"> {{$ontology->domain}}</label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>General Purpose</label>
                <label class="form-control"> {{$ontology->general_purpose}}</label>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Profiles Users</label>
                        <label class="form-control"> {{$ontology->profile_users}}</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Intended Use</label>
                        <label class="form-control"> {{$ontology->intended_use}}</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Type Of Ontology</label>
                        <label class="form-control"> {{$ontology->type_of_ontology}}</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Degree Of Formality</label>
                        <label class="form-control"> {{$ontology->degree_of_formality}}</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Scope</label>
                        <label class="form-control"> {{$ontology->scope}}</label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Competence Questions</label>
                <label class="form-control"> {{$ontology->competence_questions}}</label>
            </div>
            <div class="form-group">
                <label>Namespaces</label>
                <label class="form-control"> {{$ontology->namespace}}</label>
            </div>
            <div class="form-group">
                <label>{{__('Collaborators')}}</label>
                @foreach($ontology->users as $user)
                    <label class="form-control"> {{$user->name}}</label>
                @endforeach
            </div>  
            <div class="form-group">
                <label>XML</label>
                <textarea class="form-control" rows="13" cols="100" id="textarea">{{$ontology->xml_string}}</textarea>
            </div>

            <div class="row">
                <div class="informations">
                    <div class="col-md-4">
                        <div class="form-group">
                            <h4 id="#nome"></h4>
                            <label>SubClassOf</label>
                            <label id="#SubClassOf" class="form-control"></label>
                            <label>DisjointWith</label>
                            <label id="#DisjointWith" class="form-control"></label>
                            <label>Equivalence</label>
                            <label id="#Equivalence" class="form-control"></label>
                            <label>TargetForKey</label>
                            <label id="#TargetForKey" class="form-control"></label>
                            <label>Instances</label>
                            <label id="#Instances" class="form-control"></label>
                            <label>label</label>
                            <label id="#label" class="form-control"></label>
                            <label>seeAlso</label>
                            <label id="#seeAlso" class="form-control"></label>
                            <label>isDefinedBy</label>
                            <label id="#isDefinedBy" class="form-control"></label>
                            <label>comment</label>
                            <label id="#comment" class="form-control"></label>
                            <label>versionInfo</label>
                            <label id="#versionInfo" class="form-control"></label>
                            <label>priorVersion</label>
                            <label id="#priorVersion" class="form-control"></label>
                            <label>deprecated</label>
                            <label id="#isDefinedBy" class="form-control"></label>
                            <label>incompatibleWith</label>
                            <label id="#incompatibleWith" class="form-control"></label>
                            <label>backwardCompatibleWith</label>
                            <label id="#backwardCompatibleWith" class="form-control"></label>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>


            <a href="{{route('ontologies.index', app()->getLocale())}}">
                <button class="btn btn-success btn-block" type="button">Go back</button>
            </a>
        </div>
        <!-- /.box-body -->
    </div>
@stop

@php
    $xml = str_replace('"','\"',$ontology->xml_string);
@endphp

@section('footer')

@push('js')

<script src="../../grapheditor/src/js/util/mxUtils.js"></script>
<script type="text/javascript">

   /*var doc = mxUtils.parseXml("<?php echo"$xml"?>");
    var graph = new Graph(container, null, null, null, null);
    var outputSvg = graph.getSvg("#FFFFFF", 1, null, null, true, null, null);

    document.getElementById('graph').appendChild(outputSvg);*/

    let parser, xmlDoc;
    parser = new DOMParser();
    
    xmlDoc = parser.parseFromString("<?php echo"$xml"?>", "text/xml");


    for (let i = 0; i < xmlDoc.getElementsByTagName("object").length; i++){
        if(xmlDoc.getElementsByTagName("object")[i].getAttribute("label") != null ){

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
            

            if(xmlDoc.getElementsByTagName("object")[i].getAttribute("SubClassOf") != null || xmlDoc.getElementsByTagName("object")[i].getAttribute("SubClassOf") != "")
                SubClassOf = xmlDoc.getElementsByTagName("object")[i].getAttribute("SubClassOf");
            
            if(xmlDoc.getElementsByTagName("object")[i].getAttribute("DisjointWith") != null || xmlDoc.getElementsByTagName("object")[i].getAttribute("DisjointWith") != "")
                DisjointWith = xmlDoc.getElementsByTagName("object")[i].getAttribute("DisjointWith");

            if(xmlDoc.getElementsByTagName("object")[i].getAttribute("Equivalence") != null || xmlDoc.getElementsByTagName("object")[i].getAttribute("Equivalence") != "")
                Equivalence = xmlDoc.getElementsByTagName("object")[i].getAttribute("Equivalence");

            if(xmlDoc.getElementsByTagName("object")[i].getAttribute("Instances") != null || xmlDoc.getElementsByTagName("object")[i].getAttribute("Instances") != "")
                Instances = xmlDoc.getElementsByTagName("object")[i].getAttribute("Instances");

            if(xmlDoc.getElementsByTagName("object")[i].getAttribute("label") != null || xmlDoc.getElementsByTagName("object")[i].getAttribute("label") != "")
                label = xmlDoc.getElementsByTagName("object")[i].getAttribute("label");

            if(xmlDoc.getElementsByTagName("object")[i].getAttribute("seeAlso") != null || xmlDoc.getElementsByTagName("object")[i].getAttribute("seeAlso") != "")
                seeAlso = xmlDoc.getElementsByTagName("object")[i].getAttribute("seeAlso");

            if(xmlDoc.getElementsByTagName("object")[i].getAttribute("isDefinedBy") != null || xmlDoc.getElementsByTagName("object")[i].getAttribute("isDefinedBy") != "")
                isDefinedBy = xmlDoc.getElementsByTagName("object")[i].getAttribute("isDefinedBy");

            if(xmlDoc.getElementsByTagName("object")[i].getAttribute("comment") != null || xmlDoc.getElementsByTagName("object")[i].getAttribute("comment") != "")
                comment = xmlDoc.getElementsByTagName("object")[i].getAttribute("comment");

            if(xmlDoc.getElementsByTagName("object")[i].getAttribute("versionInfo") != null || xmlDoc.getElementsByTagName("object")[i].getAttribute("versionInfo") != "")
                versionInfo = xmlDoc.getElementsByTagName("object")[i].getAttribute("versionInfo");

            if(xmlDoc.getElementsByTagName("object")[i].getAttribute("priorVersion") != null || xmlDoc.getElementsByTagName("object")[i].getAttribute("priorVersion") != "")
                priorVersion = xmlDoc.getElementsByTagName("object")[i].getAttribute("priorVersion");

            if(xmlDoc.getElementsByTagName("object")[i].getAttribute("deprecated") != null || xmlDoc.getElementsByTagName("object")[i].getAttribute("deprecated") != "")
                deprecated = xmlDoc.getElementsByTagName("object")[i].getAttribute("deprecated");

            if(xmlDoc.getElementsByTagName("object")[i].getAttribute("incompatibleWith") != null || xmlDoc.getElementsByTagName("object")[i].getAttribute("incompatibleWith") != "")
                incompatibleWith = xmlDoc.getElementsByTagName("object")[i].getAttribute("incompatibleWith");

            if(xmlDoc.getElementsByTagName("object")[i].getAttribute("backwardCompatibleWith") != null || xmlDoc.getElementsByTagName("object")[i].getAttribute("backwardCompatibleWith") != "")
                backwardCompatibleWith = xmlDoc.getElementsByTagName("object")[i].getAttribute("backwardCompatibleWith");

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
