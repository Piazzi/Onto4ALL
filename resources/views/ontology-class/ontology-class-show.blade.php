@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')

@stop

@section('content')

    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Ontology Class Info</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="form-group">
                <label>Name</label>
                <input disabled value="{{$ontologyClass->name}}" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label>Super Class</label>
                <input disabled value="{{$ontologyClass->superclass}}" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label>Sub Class</label>
                <input disabled value="{{$ontologyClass->subclass}}" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label>Synonyms</label>
                <input disabled value="{{$ontologyClass->synonyms}}" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label>Imported From</label>
                <input disabled value="{{$ontologyClass->imported_from}}" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label>Example Of Usage</label>
                <input disabled value="{{$ontologyClass->example_of_usage}}" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label>Definition</label>
                <textarea disabled class="form-control form-textarea"> {{$ontologyClass->definition}}</textarea>
            </div>
            <div class="form-group">
                <label>Formal Definition</label>
                <textarea disabled class="form-control form-textarea"> {{$ontologyClass->formal_definition}}</textarea>
            </div>
            <a href="/ontology_class">
                <button class="btn btn-success btn-block" type="button">Go back</button>
            </a>
        </div>
        <!-- /.box-body -->
    </div>
@stop
