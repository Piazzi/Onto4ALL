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
            <h3 class="box-title">{{__('Edit Ontology')}}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form method="post"
                  action="{{route('ontologies.update',['ontology' => $ontology->id, 'locale' => app()->getLocale()])}}"
                  role="form">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{__('Name')}}</label>
                            <input required value="{{$ontology->name}}" name="name" type="text" class="form-control"
                                   placeholder="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{__('Created By')}}</label>
                            <input disabled value="{{$ontology->user->name}}" name="created_by" type="text"
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
                            <input value="{{$ontology->last_uploaded}}" name="last_uploaded" type="date"
                                   class="form-control">
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
                    <input value="{{$ontology->general_purpose}}" name="general_purpose" type="text"
                           class="form-control">
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Profile Users</label>
                            <input value="{{$ontology->profile_users}}" name="profile_users" type="text"
                                   class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Intended User</label>
                            <input value="{{$ontology->intended_use}}" name="intended_use" type="text"
                                   class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Type of Ontology</label>
                            <input value="{{$ontology->type_of_ontology}}" name="type_of_ontology" type="text"
                                   class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Degree of Formality</label>
                            <input value="{{$ontology->degree_of_formality}}" name="degree_of_formality" type="text"
                                   class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Scope</label>
                            <input value="{{$ontology->scope}}" name="scope" type="text" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Competence Questions</label>
                    <input value="{{$ontology->competence_questions}}" name="competence_questions" type="text"
                           class="form-control">
                </div>
                <div class="form-group">
                    <label>Namespace</label>
                    <select data-placeholder="{{$ontology->namespace}}" id="namespace-select" style="width: 100%; " class="js-example-basic-multiple js-example-tags" name="namespace[]" multiple="multiple">
                        <option value="http://www.w3.org/2002/07/owl#">http://www.w3.org/2002/07/owl#</option>
                        <option value="http://www.w3.org/1999/02/22-rdf-syntax-ns">http://www.w3.org/1999/02/22-rdf-syntax-ns</option>
                        <option value="http://www.w3.org/2000/01/rdf-schema#">http://www.w3.org/2000/01/rdf-schema#</option>
                        <option value="http://www.w3.org/XML/1998/namespace">http://www.w3.org/XML/1998/namespace</option>
                        <option value="http://www.w3.org/2001/XMLSchema#">http://www.w3.org/2001/XMLSchema#</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>{{__('Collaborators')}}</label>
                    <select id="collaborators-select" style="width: 100%" class="js-example-basic-multiple" name="collaborators[]" multiple="multiple">
                        @foreach($users as $user)
                            <option @foreach($ontology->users as $collaborator) @if($collaborator->id == $user->id)selected @endif @endforeach value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                    </select>
                </div>
                <button class="btn btn-success btn-block" type="submit">Submit</button>
            </form>
        </div>
        <!-- /.box-body -->
    </div>
    <script>
        //$('#collaborators-select').val(data['collaborators']).trigger('change');
        $(document).ready(function () {
            $('.js-example-basic-multiple').select2({
                theme: 'classic'
            });
            $('.js-example-tags').select2({
                theme: 'classic',
                tags: true
            });
        });
    </script>
@stop

@section('footer')
    .
@stop