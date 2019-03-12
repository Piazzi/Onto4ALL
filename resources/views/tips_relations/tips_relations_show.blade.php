@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')

@stop

@section('content')

    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Tip Relation Info</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="form-group">
                <label>Name</label>
                <input disabled value="{{$tips_relation->name}}" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label>Domain</label>
                <input disabled value="{{$tips_relation->domain}}" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label>Range</label>
                <input disabled value="{{$tips_relation->range}}" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label>Similar Relation</label>
                <input disabled value="{{$tips_relation->similar_relation}}" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label>Cardinality</label>
                <input disabled value="{{$tips_relation->cardinality}}" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label>Imported From</label>
                <input disabled value="{{$tips_relation->imported_from}}" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label>Example Of Usage</label>
                <input disabled value="{{$tips_relation->example_of_usage}}" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea disabled class="form-control form-textarea"> {{$tips_relation->description}}</textarea>
            </div>
            <a href="/tips_relations">
                <button class="btn btn-success btn-block" type="button">Go back</button>
            </a>
        </div>
        <!-- /.box-body -->
    </div>
@stop
