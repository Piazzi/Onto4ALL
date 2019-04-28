@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-ban"></i> Alert!</h4>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@stop

@section('content')

    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Ontology Class</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form method="post" action="{{route('ontology_class.update', $ontologyClass->id)}}" role="form"
            ">
            @csrf
            <input name="_method" type="hidden" value="PATCH">
            <div class="form-group">
                <label>Name</label>
                <input required value="{{$ontologyClass->name}}" name="name" type="text" class="form-control"
                       placeholder="">
            </div>
            <div class="form-group">
                <label>Super Class</label>
                <input value="{{$ontologyClass->superclass}}" name="superclass" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label>Sub Class</label>
                <input value="{{$ontologyClass->subclass}}" name="subclass" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label>Definition</label>
                <textarea required value="{{$ontologyClass->definition}}" name="definition" class="form-control"
                          rows="3"
                          placeholder="Enter ...">{{$ontologyClass->definition}}</textarea>
            </div>
            <div class="form-group">
                <label>Formal Definition</label>
                <textarea value="{{$ontologyClass->formal_definition}}" name="formal_definition" class="form-control"
                          rows="3"
                          placeholder="Enter ...">{{$ontologyClass->formal_definition}}</textarea>
            </div>
            <div class="form-group">
                <label>Synonyms</label>
                <input value="{{$ontologyClass->synonyms}}" name="synonyms" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label>Imported From</label>
                <input value="{{$ontologyClass->imported_from}}" name="imported_from" type="text"
                       class="form-control">
            </div>
            <div class="form-group">
                <label>Example Of Usage</label>
                <input required value="{{$ontologyClass->example_of_usage}}" name="example_of_usage" type="text"
                       class="form-control">
            </div>
            <button class="btn btn-success btn-block" type="submit">Submit</button>
            </form>
        </div>
        <!-- /.box-body -->
    </div>
@stop
