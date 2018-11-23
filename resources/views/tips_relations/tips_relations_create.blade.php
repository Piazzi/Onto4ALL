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
          <h3 class="box-title">Add a Tip Relation</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
        <form  method="POST" action="{{route('tips_relations.store')}}" role="form" token="{{ csrf_token() }}">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Name</label>
                        <input required value="{{old('name')}}" name="name" type="text" class="form-control" placeholder="">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Domain</label>
                        <input required value="{{old('domain')}}" name="domain" type="text" class="form-control" placeholder="">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Range</label>
                        <input required value="{{old('range')}}" name="range" type="text" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Similar Relation</label>
                        <input required value="{{old('similar_relation')}}" name="similar_relation" type="textarea" class="form-control"  >
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Cardinality</label>
                        <input required value="{{old('cardinality')}}" name="cardinality" type="number" class="form-control"  >
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea required value="{{old('description')}}" name="description" class="form-control" rows="3" placeholder="Enter ..."></textarea>
            </div>
            <button class="btn btn-success btn-block" type="submit">Submit</button>
        </form>
        </div>
        <!-- /.box-body -->
</div>
@stop
