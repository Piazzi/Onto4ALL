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

    @if (session()->has('Success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Alert!</h4>
            <strong>{{ session('Success') }}</strong>
        </div>
    @endif

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

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <a href="{{route('ontology_relation.create', app()->getLocale())}}">
                    <button type="button" class="btn btn-block btn-success">Add</button>
                </a>

                <div class="box-header">

                    <h3 class="box-title">Ontology Relations Database </h3>

                    <form style="float: right;" method="post" action="{{route('ontology_relation.search', ['search' => 'search', 'locale' => app()->getLocale()])}}">
                        @csrf
                        @method('POST')
                        <div class="box-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input  id="table-search-input" type="text" name="search"
                                        class="form-control pull-right" placeholder="Search">
                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Domain</th>
                            <th>Range</th>
                            <th>Similar Relation</th>
                            <th>Cardinality</th>
                            <th>Ontology</th>
                            <th>Imported From</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody id="table-search">
                        @foreach ($relations as $ontologyRelation)
                            <tr>
                                <td>{{$ontologyRelation->id}}</td>
                                <td>{{$ontologyRelation->name}}</td>
                                <td>{{$ontologyRelation->domain}}</td>
                                <td>{{$ontologyRelation->range}}</td>
                                <td>{{$ontologyRelation->similar_relation}}</td>
                                <td>{{$ontologyRelation->cardinality}}</td>
                                <td>{{strtoupper($ontologyRelation->ontology)}}</td>
                                <td><a>{{$ontologyRelation->imported_from}}</a></td>
                                <td><a href="{{route('ontology_relation.show', ['ontology_relation' => $ontologyRelation->id, 'locale'=>app()->getLocale()])}}">
                                        <button type="button" class="btn btn-block btn-info btn-sm">Info</button>
                                    </a></td>
                                <td><a href="{{route('ontology_relation.edit', ['ontology_relation' => $ontologyRelation->id, 'locale'=>app()->getLocale()])}}">
                                        <button type="button" class="btn btn-block btn-warning btn-sm">Edit</button>
                                    </a></td>
                                <td>
                                    <form method="post"
                                          action="{{route('ontology_relation.destroy', ['ontology_relation' => $ontologyRelation->id, 'locale'=>app()->getLocale()])}}">
                                        @csrf
                                        <input name="_method" type="hidden" value="DELETE">
                                        <button type="submit" class="btn btn-block btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>

    <ul class="pagination pagination-sm no-margin ">
        {{ $relations->links() }}
    </ul>



@stop
@section('right-sidebar')
@stop

@section('footer')
    .
@stop
