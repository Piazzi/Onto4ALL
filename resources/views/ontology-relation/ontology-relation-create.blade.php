@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>
        Ontology Relations Manager
        <small>Manage all ontology relations</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home', app()->getLocale())}}"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">Ontology Classes Relations</li>
    </ol>
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
            <h3 class="box-title">Add a Ontology Relation</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form method="POST" action="{{route('ontology_relation.store', app()->getLocale())}}" role="form" token="{{ csrf_token() }}">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Name</label>
                            <input required value="{{old('name')}}" name="name" type="text" class="form-control"
                                   placeholder="">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Domain</label>
                            <input value="{{old('domain')}}" name="domain" type="text" class="form-control"
                                   placeholder="">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Range</label>
                            <input  value="{{old('range')}}" name="range" type="text" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Similar Relation</label>
                            <input value="{{old('similar_relation')}}" name="similar_relation" type="textarea"
                                   class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Cardinality</label>
                            <input value="{{old('cardinality')}}" name="cardinality" type="number" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Imported From </label>
                            <input value="{{old('imported_from')}}" name="imported_from" type="text"
                                   class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Example Of Usage</label>
                            <input value="{{old('example_of_usage')}}" name="example_of_usage" type="text"
                                   class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Definition</label>
                    <textarea required name="definition" class="form-control" rows="3" placeholder="Enter ..."></textarea>
                </div>
                <div class="form-group">
                    <label>Semi Formal Definition</label>
                    <textarea name="semi_formal_definition" class="form-control" rows="3" placeholder="Enter ..."></textarea>
                </div>
                <div class="form-group">
                    <label>Formal Definition</label>
                    <textarea name="formal_definition" class="form-control" rows="3" placeholder="Enter ..."></textarea>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>ID</label>
                            <input required value="{{old('relation_id')}}" name="relation_id" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Label</label>
                            <input required value="{{old('label')}}" name="label" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Label PT</label>
                            <input value="{{old('label_pt')}}" name="label_pt" type="text" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Synonyms (has_synonym)</label>
                            <input value="{{old('synonyms')}}" name="synonyms" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Is Defined By</label>
                            <input value="{{old('is_defined_by')}}" name="is_defined_by" type="text" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Editor note (comments) </label>
                    <textarea name="comments" class="form-control" rows="3" placeholder="Enter ...">
                </textarea>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Inverse Of</label>
                            <input value="{{old('inverse_of')}}" name="inverse_of" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Subproperty Of</label>
                            <input value="{{old('subproperty_of')}}" name="subproperty_of" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Superproperty Of</label>
                            <input value="{{old('superproperty_of')}}" name="superproperty_of" type="text" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Ontology</label>
                    <select  name="ontology" class="form-control">
                        <option value="bfo" >BFO</option>
                        <option value="iao" >IAO</option>
                        <option value="iof" >IOF</option>
                    </select>
                </div>

                <button  class="btn btn-success btn-block" type="submit">Submit</button>
            </form>
        </div>
        <!-- /.box-body -->
    </div>
    <script src="{{asset('js/MultipleCheckbox.js')}}" type="text/javascript"></script>

@stop

@section('footer')
    .
@stop


