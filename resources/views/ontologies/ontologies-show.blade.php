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
            <a href="{{route('ontologies.index', app()->getLocale())}}">
                <button class="btn btn-success btn-block" type="button">Go back</button>
            </a>
        </div>
        <!-- /.box-body -->
    </div>
@stop

@section('footer')

@push('js')

<script type="text/javascript">

    var doc = mxUtils.parseXml('<mxGraphModel dx="894" dy="654" grid="1" gridSize="10" guides="1" tooltips="1" connect="0" arrows="0" fold="1" page="1" pageScale="2" pageWidth="827" pageHeight="1169"><root><mxCell id="0"/><mxCell id="1" parent="0"/><object SubClassOf="Label" Constraint="" DisjointWith="" Equivalence="" TargetForKey="" Instances="" label="Thing" seeAlso="" isDefinedBy="" comment="" versionInfo="" priorVersion="" deprecated="" incompatibleWith="" backwardCompatibleWith="" id="2"><mxCell style="ellipse;whiteSpace=wrap;html=1;aspect=fixed;dashed=1;Class;" vertex="1" parent="1"><mxGeometry x="20" y="20" width="80" height="80" as="geometry"/></mxCell></object><object label="Label" SubClassOf="" Constraint="" DisjointWith="" Equivalence="" TargetForKey="" Instances="" seeAlso="" isDefinedBy="" comment="" versionInfo="" priorVersion="" deprecated="" incompatibleWith="" backwardCompatibleWith="" id="3"><mxCell style="ellipse;whiteSpace=wrap;html=1;aspect=fixed;strokeColor=#f39c12;Class;" vertex="1" parent="1"><mxGeometry x="250" y="90" width="80" height="80" as="geometry"/></mxCell></object><object label="Label" SubClassOf="Label" Constraint="" DisjointWith="" Equivalence="" TargetForKey="" Instances="" seeAlso="" isDefinedBy="" comment="" versionInfo="" priorVersion="" deprecated="" incompatibleWith="" backwardCompatibleWith="" id="4"><mxCell style="ellipse;whiteSpace=wrap;html=1;aspect=fixed;strokeColor=#f39c12;Class;" vertex="1" parent="1"><mxGeometry x="240" y="290" width="80" height="80" as="geometry"/></mxCell></object><object label="is_a" domain="Label" range="Label" inverseOf="" equivalentTo="" subpropertyOf="" disjointWith="" functional="" inverseFunctional="" transitive="" symetric="" asymmetric="" reflexive="" irreflexive="" seeAlso="" isDefinedBy="" comment="" versionInfo="" priorVersion="" deprecated="" incompatibleWith="" backwardCompatibleWith="" DisjointWith="" Equivalence="" id="5"><mxCell style="html=1;verticalAlign=bottom;endArrow=block;strokeColor=#004C99;Relation;" edge="1" parent="1" source="4" target="3"><mxGeometry width="80" relative="1" as="geometry"><mxPoint x="20" y="390" as="sourcePoint"/><mxPoint x="100" y="390" as="targetPoint"/><Array as="points"><mxPoint x="200" y="230"/></Array></mxGeometry></mxCell></object><object label="is_a" domain="Thing" range="Label" inverseOf="" equivalentTo="" subpropertyOf="" disjointWith="" functional="" inverseFunctional="" transitive="" symetric="" asymmetric="" reflexive="" irreflexive="" seeAlso="" isDefinedBy="" comment="" versionInfo="" priorVersion="" deprecated="" incompatibleWith="" backwardCompatibleWith="" id="6"><mxCell style="html=1;verticalAlign=bottom;endArrow=block;strokeColor=#004C99;Relation;" edge="1" parent="1" source="2" target="3"><mxGeometry width="80" relative="1" as="geometry"><mxPoint x="20" y="390" as="sourcePoint"/><mxPoint x="100" y="390" as="targetPoint"/></mxGeometry></mxCell></object></root></mxGraphModel>');
    var graph = new Graph(container, null, null, null, null);
    var outputSvg = graph.getSvg("#FFFFFF", 1, null, null, true, null, null);

    document.getElementById('graph').appendChild(outputSvg);

</script>
@endpush
    .
@stop
