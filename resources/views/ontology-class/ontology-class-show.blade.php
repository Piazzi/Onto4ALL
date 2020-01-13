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

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Preferred Name</label>
                        <input disabled value="{{$ontologyClass->name}}" type="text" class="form-control">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Super Class</label>
                        <input disabled value="{{$ontologyClass->superclass}}" type="text" class="form-control">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Sub Class Of</label>
                        <input disabled value="{{$ontologyClass->subclass}}" type="text" class="form-control">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Synonyms (has_synonym)</label>
                        <input disabled value="{{$ontologyClass->synonyms}}" type="text" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Imported From</label>
                        <input disabled value="{{$ontologyClass->imported_from}}" type="text" class="form-control">
                    </div>
                </div>
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
                <label>Formal Definition (has_associated_axiom)</label>
                <textarea disabled class="form-control form-textarea"> {{$ontologyClass->formal_definition}}</textarea>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>ID</label>
                        <input disabled value="{{$ontologyClass->class_id}}" type="text" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Label</label>
                        <input disabled value="{{$ontologyClass->label}}" type="text" class="form-control">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Elucidation</label>
                <input disabled value="{{$ontologyClass->elucidation}}" type="text" class="form-control">
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Is Defined By</label>
                        <input disabled value="{{$ontologyClass->is_defined_by}}" type="text" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Disjoint With</label>
                        <input disabled value="{{$ontologyClass->disjoint_with}}" type="text" class="form-control">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Editor note (comments)</label>
                <textarea disabled class="form-control form-textarea"> {{$ontologyClass->comments}}</textarea>
            </div>

            <a href="/ontology_class">
                <button class="btn btn-success btn-block" type="button">Go back</button>
            </a>
        </div>
        <!-- /.box-body -->
    </div>
@stop
