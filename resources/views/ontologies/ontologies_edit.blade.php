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
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Name</label>
                            <input required value="{{$ontology->name}}" name="name" type="text" class="form-control"
                                   placeholder="">
                            <span class="badge bg-red">Dont forget to include the extension ".xml" on the end of the name</span>
                            <span class="badge bg-red">Example: <strong>Ontology.xml</strong></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Created By</label>
                            <input disabled value="{{$ontology->created_by}}" name="created_by" type="text"
                                   class="form-control">
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Publication Date</label>
                            <input value="{{$ontology->publication_date}}" name="publication_date" type="date"
                                   class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Last Uploaded</label>
                            <input value="{{$ontology->last_uploaded}}" name="last_uploaded" type="date" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea value="{{$ontology->description}}" name="description" class="form-control" rows="3"
                              placeholder="Enter ...">{{$ontology->description}}</textarea>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Link</label>
                            <input value="{{$ontology->link}}" name="link" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Domain</label>
                            <input value="{{$ontology->domain}}" name="domain" type="text" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>General Purpose</label>
                    <input  value="{{$ontology->general_purpose}}" name="general_purpose" type="text" class="form-control">
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Profile Users</label>
                            <input  value="{{$ontology->profile_users}}" name="profile_users" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Intended User</label>
                            <input  value="{{$ontology->intended_use}}" name="intended_use" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Type of Ontology</label>
                            <input  value="{{$ontology->type_of_ontology}}" name="type_of_ontology" type="text" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Degree of Formality</label>
                            <input  value="{{$ontology->degree_of_formality}}" name="degree_of_formality" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Scope</label>
                            <input  value="{{$ontology->scope}}" name="scope" type="text" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Competence Questions</label>
                    <input  value="{{$ontology->competence_questions}}" name="competence_questions" type="text" class="form-control">
                </div>

                <button class="btn btn-success btn-block" type="submit">Submit</button>
            </form>
        </div>
        <!-- /.box-body -->
    </div>
@stop

@section('footer')
    .
@stop