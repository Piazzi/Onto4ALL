@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>
        Ontology Relations Manager
        <small>Manage all ontology relations</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">Ontology Classes Relations</li>
    </ol>
@stop

@section('content')

    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Ontology Relation Info</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Name</label>
                        <input disabled value="{{$ontologyRelation->name}}" type="text" class="form-control">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Domain</label>
                        <input disabled value="{{$ontologyRelation->domain}}" type="text" class="form-control">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Range</label>
                        <input disabled value="{{$ontologyRelation->range}}" type="text" class="form-control">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Similar Relation</label>
                        <input disabled value="{{$ontologyRelation->similar_relation}}" type="text" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Cardinality</label>
                        <input disabled value="{{$ontologyRelation->cardinality}}" type="text" class="form-control">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Imported From</label>
                        <input disabled value="{{$ontologyRelation->imported_from}}" type="text" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Example Of Usage</label>
                        <input disabled value="{{$ontologyRelation->example_of_usage}}" type="text" class="form-control">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Definition</label>
                <textarea disabled class="form-control form-textarea"> {{$ontologyRelation->definition}}</textarea>
            </div>
            <div class="form-group">
                <label>Formal Definition</label>
                <textarea disabled class="form-control form-textarea"> {{$ontologyRelation->formal_definition}}</textarea>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>ID</label>
                        <input disabled value="{{$ontologyRelation->relation_id}}" type="text" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Label</label>
                        <input disabled value="{{$ontologyRelation->label}}" type="text" class="form-control">
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Synonyms (has_synonym)</label>
                        <input disabled value="{{$ontologyRelation->synonyms}}" type="text" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Is Defined By</label>
                        <input disabled value="{{$ontologyRelation->is_defined_by}}" type="text" class="form-control">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Editor note (comments)</label>
                <textarea disabled class="form-control form-textarea"> {{$ontologyRelation->comments}}</textarea>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Inverse Of</label>
                        <input disabled value="{{$ontologyRelation->inverse_of}}" type="text" class="form-control">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Subproperty Of</label>
                        <input disabled value="{{$ontologyRelation->subproperty_of}}" type="text" class="form-control">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Superproperty Of</label>
                        <input disabled value="{{$ontologyRelation->superproperty_of}}" type="text" class="form-control">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Ontology</label>
                <select disabled name="ontology" class="form-control">
                    <option @if(strpos($ontologyRelation->ontology, 'bfo') !== false)selected @endif >BFO</option>
                    <option @if(strpos($ontologyRelation->ontology, 'iao') !== false)selected @endif >IAO</option>
                    <option @if(strpos($ontologyRelation->ontology, 'iof') !== false)selected @endif >IOF</option>
                </select>
            </div>

            <a href="/ontology_relation">
                <button class="btn btn-success btn-block" type="button">Go back</button>
            </a>
        </div>
    </div>
@stop

@section('footer')
    .
@stop


