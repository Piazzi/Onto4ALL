@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')

@stop

@section('content')

    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Tip's Class Info</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="form-group">
                <label>Name</label>
                <input disabled value="{{$tip_class->name}}" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label>Super Class</label>
                <input disabled value="{{$tip_class->superclass}}" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label>Sub Class</label>
                <input disabled value="{{$tip_class->subclass}}" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label>Synonyms</label>
                <input disabled value="{{$tip_class->synonyms}}" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label>Imported From</label>
                <input disabled value="{{$tip_class->imported_from}}" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label>Example Of Usage</label>
                <input disabled value="{{$tip_class->example_of_usage}}" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label>Definition</label>
                <textarea disabled class="form-control form-textarea"> {{$tip_class->definition}}</textarea>
            </div>
            <a href="/tips_class">
                <button class="btn btn-success btn-block" type="button">Go back</button>
            </a>
        </div>
        <!-- /.box-body -->
    </div>
@stop
