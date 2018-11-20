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
                <label>Domain</label>
            <input value="{{$tips_relation->domain}}" name="domain" type="text" class="form-control" >
            </div>
            <div class="form-group">
                <label>Range</label>
                <input value="{{$tips_relation->range}}" name="range" type="text" class="form-control"  >
            </div>
            <div class="form-group">
                <label>Similar Relation</label>
            <input value="{{$tips_relation->similar_relation}}" name="similar_relation"  type="text" class="form-control" >
            </div>
            <div class="form-group">
                <label>Cardinality</label>
                <input value="{{$tips_relation->cardinality}}" name="cardinality" type="text" class="form-control"  >
            </div>
            <button class="btn btn-success btn-block" type="submit">Submit</button>
        </form>
        </div>
        <!-- /.box-body -->
</div>
@stop
