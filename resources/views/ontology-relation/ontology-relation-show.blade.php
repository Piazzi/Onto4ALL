@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')

@stop

@section('content')

    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Ontology Relation Info</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="form-group">
                <label>Name</label>
                <input disabled value="{{$ontologyRelation->name}}" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label>Domain</label>
                <input disabled value="{{$ontologyRelation->domain}}" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label>Range</label>
                <input disabled value="{{$ontologyRelation->range}}" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label>Similar Relation</label>
                <input disabled value="{{$ontologyRelation->similar_relation}}" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label>Cardinality</label>
                <input disabled value="{{$ontologyRelation->cardinality}}" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label>Imported From</label>
                <input disabled value="{{$ontologyRelation->imported_from}}" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label>Example Of Usage</label>
                <input disabled value="{{$ontologyRelation->example_of_usage}}" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label>Definition</label>
                <textarea disabled class="form-control form-textarea"> {{$ontologyRelation->definition}}</textarea>
            </div>
            <div class="form-group">
                <label>Formal Definition</label>
                <textarea disabled class="form-control form-textarea"> {{$ontologyRelation->formal_definition}}</textarea>
            </div>
            <a href="/ontology_relation">
                <button class="btn btn-success btn-block" type="button">Go back</button>
            </a>
        </div>
        <!-- /.box-body -->
    </div>
@stop
