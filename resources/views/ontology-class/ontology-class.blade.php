@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>
        Ontology Classes Manager
        <small>Manage all ontology classes</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">Ontology Classes Manager</li>
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
                <a href="{{route('ontology_class.create')}}">
                    <button type="button" class="btn btn-block btn-success">Add</button>
                </a>

                <div class="box-header">

                    <h3 class="box-title">Ontology Classes Database </h3>
                    <form style="float: right;" method="post" action="{{route('ontology_class.search', ['search' => 'search'])}}">
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
                            <th>Subclass</th>
                            <th>Synonyms</th>
                            <th>Ontology</th>
                            <th>Imported From</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody id="table-search">
                        @foreach ($classes as $class)
                            <tr>

                                <td>{{$class->id}}</td>
                                <td>{{$class->name}}</td>
                                <td>{{$class->subclass}}</td>
                                <td>{{$class->synonyms}}</td>
                                <td>{{strtoupper($class->ontology)}}</td>
                                <td><a href="{{$class->imported_from}}">{{$class->imported_from}}</a></td>
                                <td><a href="{{route('ontology_class.show', $class->id)}}">
                                        <button type="button" class="btn btn-block btn-info btn-sm">Info</button>
                                    </a></td>
                                <td><a href="{{route('ontology_class.edit', $class->id)}}">
                                        <button type="button" class="btn btn-block btn-warning btn-sm">Edit</button>
                                    </a></td>
                                <td>
                                    <form method="post" action="{{route('ontology_class.destroy', $class->id)}}">
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
        {{ $classes->links() }}
    </ul>

@stop

@section('footer')
    .
@stop

