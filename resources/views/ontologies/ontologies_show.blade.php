@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')

@stop

@section('content')

<div class="box box-success">
        <div class="box-header with-border">
          <h3  class="box-title"><strong> {{$ontology->name}} </strong></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="form-group">
                <label>Name</label>
                <label class="form-control">{{$ontology->name}}</label>
            </div>
            <div class="form-group">
                <label>Publication Date</label>
                <label class="form-control"> {{$ontology->publication_date}}</label>
            </div>
            <div class="form-group">
                <label>Last Uploaded</label>
                <label class="form-control"> {{$ontology->last_uploaded}}</label>
            </div>

            <div class="form-group">
              <label>Description</label>
              <textarea disabled class="form-control form-textarea"> {{$ontology->description}}</textarea>
            </div>
            <div class="form-group">
              <label>Link</label>
            <label class="form-control"><a href="{{$ontology->link}}"> {{$ontology->link}} </a></label>
            </div>

            <div class="form-group">
                <label>Created By</label>
                <label class="form-control"> {{$ontology->created_by}}</label>
            </div>

             <a href="/ontologies"><button class="btn btn-success btn-block" type="button">Go back</button></a>
        </div>
        <!-- /.box-body -->
      </div>
@stop
