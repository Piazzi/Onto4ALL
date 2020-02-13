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
            <h3 class="box-title">Edit Ontology Class</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form method="post" action="{{route('ontology_class.update', $ontologyClass->id)}}" role="form">
                @csrf
                <input name="_method" type="hidden" value="PATCH">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Preferred Name</label>
                            <input required value="{{$ontologyClass->name}}" name="name" type="text" class="form-control"
                                   placeholder="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Sub Class</label>
                            <input value="{{$ontologyClass->subclass}}" name="subclass" type="text"
                                   class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Synonyms (has_synonym)</label>
                            <input value="{{$ontologyClass->synonyms}}" name="synonyms" type="text"
                                   class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Imported From</label>
                            <input value="{{$ontologyClass->imported_from}}" name="imported_from" type="text"
                                   class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Example Of Usage</label>
                    <input required value="{{$ontologyClass->example_of_usage}}" name="example_of_usage" type="text"
                           class="form-control">
                </div>

                <div class="form-group">
                    <label>Definition</label>
                    <textarea required name="definition" class="form-control" rows="3" placeholder="Enter ...">{{$ontologyClass->definition}}</textarea>
                </div>
                <div class="form-group">
                    <label>Formal Definition (has_associated_axiom)</label>
                    <textarea name="formal_definition" class="form-control" rows="3" placeholder="Enter ...">{{$ontologyClass->formal_definition}}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>ID</label>
                            <input required name="class_id"  value="{{$ontologyClass->class_id}}" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Label</label>
                            <input required name="label"  value="{{$ontologyClass->label}}" type="text" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Is Defined By</label>
                            <input name="is_defined_by"  value="{{$ontologyClass->is_defined_by}}" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Disjoint With</label>
                            <input name="disjoint_with"  value="{{$ontologyClass->disjoint_with}}" type="text" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Elucidation</label>
                            <textarea rows="3" placeholder="Edit..." name="elucidation" type="text" class="form-control">{{$ontologyClass->elucidation}}</textarea>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Editor note (comments)</label>
                    <textarea placeholder="" name="comments" class="form-control form-textarea"> {{$ontologyClass->comments}}</textarea>
                </div>
                <button class="btn btn-success btn-block" type="submit">Submit</button>
            </form>
        </div>
        <!-- /.box-body -->
    </div>
@stop
