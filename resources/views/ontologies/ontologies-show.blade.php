@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')

@stop

@section('content')

    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title"><strong> {{$ontology->name}} </strong></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="form-group">
                <label>Name</label>
                <label class="form-control">{{$ontology->name}}</label>
            </div>
            <div class="form-group">
                <label>Created By</label>
                <label class="form-control">{{$ontology->user->name}}</label>
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
                <label>Domain</label>
                <label class="form-control"> {{$ontology->domain}}</label>
            </div>
            <div class="form-group">
                <label>General Purpose</label>
                <label class="form-control"> {{$ontology->general_purpose}}</label>
            </div>
            <div class="form-group">
                <label>Profiles Users</label>
                <label class="form-control"> {{$ontology->profile_users}}</label>
            </div>
            <div class="form-group">
                <label>Intended Use</label>
                <label class="form-control"> {{$ontology->intended_use}}</label>
            </div>
            <div class="form-group">
                <label>Type Of Ontology</label>
                <label class="form-control"> {{$ontology->type_of_ontology}}</label>
            </div>
            <div class="form-group">
                <label>Degree Of Formality</label>
                <label class="form-control"> {{$ontology->degree_of_formality}}</label>
            </div>
            <div class="form-group">
                <label>Scope</label>
                <label class="form-control"> {{$ontology->scope}}</label>
            </div>
            <div class="form-group">
                <label>Competence Questions</label>
                <label class="form-control"> {{$ontology->competence_questions}}</label>
            </div>
            <div class="form-group">
                <label>Namespaces</label>
                <label class="form-control"> {{$ontology->namespace}}</label>
            </div>
            <div class="form-group">
                <label>{{__('Collaborators')}}</label>
                @foreach($ontology->users as $user)
                    <label class="form-control"> {{$user->name}}</label>
                @endforeach
            </div>
            <a href="{{route('ontologies.index', app()->getLocale())}}">
                <button class="btn btn-success btn-block" type="button">Go back</button>
            </a>
        </div>
        <!-- /.box-body -->
    </div>
@stop

@section('footer')
    .
@stop
