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
            <h3 class="box-title">Edit Ontology</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form method="post" action="{{route('ontologies.update', $ontology->id)}}" role="form">
            @csrf
            <input name="_method" type="hidden" value="PATCH">
            <div class="form-group">
                <label>Name</label>
                <input required value="{{$ontology->name}}" name="name" type="text" class="form-control"
                       placeholder="">
                <span class="badge bg-red">Dont forget to include the extension ".xml" on the end of the name</span>
                <span class="badge bg-red">Example: <strong>Ontology.xml</strong></span>
            </div>
            <div class="form-group">
                <label>Publication Date</label>
                <input  value="{{$ontology->publication_date}}" name="publication_date" type="date" class="form-control">
            </div>
            <div class="form-group">
                <label>Last Uploaded</label>
                <input  value="{{$ontology->last_uploaded}}" name="last_uploaded" type="date" class="form-control">
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea  value="{{$ontology->description}}" name="description" class="form-control" rows="3"
                          placeholder="Enter ...">{{$ontology->description}}</textarea>
            </div>
            <div class="form-group">
                <label>Link</label>
                <input  value="{{$ontology->link}}" name="link" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label>Created By</label>
                <input  value="{{$ontology->created_by}}" name="created_by" type="text"
                       class="form-control">
            </div>
            <button class="btn btn-success btn-block" type="submit">Submit</button>
            </form>
        </div>
        <!-- /.box-body -->
    </div>
@stop
