@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>
        Ontology Classes Manager
        <small>Manage all ontology classes</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home', app()->getLocale())}}"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">Ontology Classes Manager</li>
    </ol>
@stop

@section('content')

    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Ontology Class Info</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Preferred Name</label>
                        <input disabled value="{{$ontologyClass->name}}" type="text" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
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

            <div class="form-group">
                <label>Ontology</label>
                <select disabled name="ontology" class="form-control">
                    <option @if(strpos($ontologyClass->ontology, 'bfo') !== false)selected @endif >BFO</option>
                    <option @if(strpos($ontologyClass->ontology, 'iao') !== false)selected @endif >IAO</option>
                    <option @if(strpos($ontologyClass->ontology, 'iof') !== false)selected @endif >IOF</option>
                </select>
            </div>

            <a href="{{route('ontology_class.index', app()->getLocale())}}">
                <button class="btn btn-success btn-block" type="button">Go back</button>
            </a>
        </div>
        <!-- /.box-body -->
    </div>
@stop

@section('footer')
    .
@stop

