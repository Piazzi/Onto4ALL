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
          <h3 class="box-title">Edit Relation</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
        <form  method="post" action="{{route('tips_relations.update', $tips_relation->id)}}" role="form" ">
            @csrf
            <input name="_method" type="hidden" value="PATCH">
            <div class="form-group">
                <label>Name</label>
                <input required value="{{$tips_relation->name}}" name="name" type="text" class="form-control" placeholder="">
            </div>
            <div class="form-group">
                <label>Domain</label>
                <input required value="{{$tips_relation->domain}}" name="domain" type="text" class="form-control" >
            </div>
            <div class="form-group">
                <label>Range</label>
                <input required value="{{$tips_relation->range}}" name="range" type="text" class="form-control"  >
            </div>
            <div class="form-group">
                <label>Similar Relation</label>
            <input required value="{{$tips_relation->similar_relation}}" name="similar_relation"  type="text" class="form-control" >
            </div>
            <div class="form-group">
                <label>Cardinality</label>
                <input required value="{{$tips_relation->cardinality}}" name="cardinality" type="text" class="form-control"  >
            </div>
            <div class="form-group">
                <label>Imported From</label>
                <input required value="{{$tips_relation->imported_from}}" name="imported_from" type="text" class="form-control"  >
            </div>
            <div class="form-group">
                <label>Example Of Usage</label>
            <input required value="{{$tips_relation->example_of_usage}}" name="example_of_usage"  type="text" class="form-control" >
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea required value="{{$tips_relation->description}}" name="description" class="form-control" rows="3" placeholder="Enter ...">{{$tips_relation->description}}</textarea>
            </div>
            <button class="btn btn-success btn-block" type="submit">Submit</button>
        </form>
        </div>
        <!-- /.box-body -->
</div>
@stop
