@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>
        Ontology Relations Manager
        <small>Manage all ontology relations</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i>Home</a></li>
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
            <h3 class="box-title">Edit Relation</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form method="post" action="{{route('ontology_relation.update', $ontologyRelation->id)}}" role="form">
                @csrf
                <input name="_method" type="hidden" value="PATCH">

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Name</label>
                            <input required value="{{$ontologyRelation->name}}" name="name" type="text"
                                   class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Domain</label>
                            <input required value="{{$ontologyRelation->domain}}" name="domain" type="text"
                                   class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Range</label>
                            <input required value="{{$ontologyRelation->range}}" name="range" type="text"
                                   class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Similar Relation</label>
                            <input value="{{$ontologyRelation->similar_relation}}" name="similar_relation" type="text"
                                   class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Cardinality</label>
                            <input value="{{$ontologyRelation->cardinality}}" name="cardinality" type="text"
                                   class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Imported From</label>
                            <input value="{{$ontologyRelation->imported_from}}" name="imported_from" type="text"
                                   class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Example Of Usage</label>
                            <input required value="{{$ontologyRelation->example_of_usage}}" name="example_of_usage"
                                   type="text"
                                   class="form-control">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Definition</label>
                    <textarea required value="{{$ontologyRelation->definition}}" name="description" class="form-control"
                              rows="3" placeholder="Enter ...">{{$ontologyRelation->definition}}</textarea>
                </div>
                <div class="form-group">
                    <label>Formal Definition</label>
                    <textarea required value="{{$ontologyRelation->formal_definition}}" name="description"
                              class="form-control"
                              rows="3" placeholder="Enter ...">{{$ontologyRelation->formal_definition}}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>ID</label>
                            <input required name="relation_id"  value="{{$ontologyRelation->relation_id}}" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Label</label>
                            <input required name="label"  value="{{$ontologyRelation->label}}" type="text" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Synonyms (has_synonym)</label>
                            <input name="synonyms"  value="{{$ontologyRelation->synonyms}}" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Is Defined By</label>
                            <input name="is_defined_by" value="{{$ontologyRelation->is_defined_by}}" type="text"
                                   class="form-control">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Editor note (comments)</label>
                    <textarea name="comments"  class="form-control form-textarea"> {{$ontologyRelation->comments}}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Inverse Of</label>
                            <input name="inverse_of"  value="{{$ontologyRelation->inverse_of}}" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Subproperty Of</label>
                            <input name="subproperty_of"  value="{{$ontologyRelation->subproperty_of}}" type="text"
                                   class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Superproperty Of</label>
                            <input name="superproperty_of" value="{{$ontologyRelation->superproperty_of}}" type="text"
                                   class="form-control">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Ontology</label>
                    <select name="ontology" class="form-control">
                        <option @if(strpos($ontologyRelation->ontology, 'bfo') !== false)selected @endif >BFO</option>
                        <option @if(strpos($ontologyRelation->ontology, 'iao') !== false)selected @endif >IAO</option>
                        <option @if(strpos($ontologyRelation->ontology, 'iof') !== false)selected @endif >IOF</option>
                    </select>
                </div>

                <button class="btn btn-success btn-block" type="submit">Submit</button>
            </form>
        </div>
        <!-- /.box-body -->
    </div>
    <script src="../../js/MultipleCheckbox.js" type="text/javascript"></script>
@stop

@section('footer')
    .
@stop


