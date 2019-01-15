@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    @if (session()->has('Sucess'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Alert!</h4>
            <strong>{{ session('Sucess') }}</strong>
        </div>
    @endif

    @if (session()->has('Error'))
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-ban"></i> Alert!</h4>
            <strong>{{ session('Error') }}</strong>
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

    <div  class="callout callout-warning">

        <h4> <i class="icon fa fa-info"></i> Suas ontologias marcadas como favoritas!</h4>

        <p>Você pode marcar até 5 ontologias como favoritas. Elas ficaram salvas aqui</p>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <a href="{{route('ontologies.create')}}">
                    <button type="button" class="btn btn-block btn-success">Add a new ontology</button>
                </a>
                <div class="box-header with-border">

                    <h3 class="box-title">Your favorite ontologies </h3>

                    <div class="box-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input id="table-search-input" type="text" name="table_search"
                                   class="form-control pull-right" placeholder="Search">
                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Created At</th>
                            <th>Description</th>
                            <th>Link</th>
                            <th>Created By</th>
                            <th>XML File</th>
                            <th>Details</th>
                            <th>Update</th>
                            <th>Favourite</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody id="table-search">
                        @foreach ($favouriteOntologies as $ontology)
                            <tr>

                                <td><span class="label label-success">{{$ontology->name}}</span></td>
                                <td>{{$ontology->created_at}}</td>
                                <td>
                                    @php
                                        $Description = str_limit($ontology->description, 20);
                                    @endphp
                                    {{$Description}}
                                </td>
                                <td>
                                    @php
                                        $Link = str_limit($ontology->link, 15);
                                    @endphp
                                    <a href="{{$ontology->link}}">{{$Link}}</a>
                                </td>
                                <td>{{$ontology->created_by}}</td>
                                <td>
                                    <a href="{{route('ontologies.download', [ 'userId' => auth()->user()->id ,'ontologyId' => $ontology->id])}}">
                                        <button class="btn btn-success"><i class="fa fa-fw fa-download"></i></button>
                                    </a>
                                </td>
                                <td><a href="{{route('ontologies.show', $ontology->id)}}">
                                        <button class="btn btn-success"><i class="fa fa-fw fa-plus"></i></button>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{route('ontologies.edit',$ontology->id)}}">
                                        <button class="btn btn-success"><i class="fa fa-fw fa-edit"></i></button>
                                    </a>
                                </td>
                                <td>
                                    <form method="POST"
                                          action="{{route('ontologies.normal', [ 'userId' => auth()->user()->id ,'ontologyId' => $ontology->id])}}">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-success"><i style="color: #ffe70a" class="fa fa-fw fa-star"></i></button>
                                    </form>
                                </td>
                                <td>
                                    <form method="post"
                                          action="{{route('ontologies.destroy', $ontology->id)}}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit"><i  class="fa fa-fw fa-trash-o" ></i></button>
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

    <div class="callout callout-info">
        <h4> <i class="icon fa fa-info"></i> Suas Ontologias!</h4>

        <p>Suas últimas 10 ontologias salvas ficaram guardadas aqui.</p>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="box">

                <div class="box-header with-border">

                    <h3 class="box-title">Your recent ontologies </h3>

                    <div class="box-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input id="table-search-input" type="text" name="table_search"
                                   class="form-control pull-right" placeholder="Search">
                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Created At</th>
                            <th>Created By</th>
                            <th>XML File</th>
                            <th>Details</th>
                            <th>Favourite</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody id="table-search">
                        @foreach ($ontologies as $ontology)
                            <tr>

                                <td><span class="label label-success">{{$ontology->name}}</span></td>
                                <td>{{$ontology->created_at}}</td>
                                <td>{{$ontology->created_by}}</td>
                                <td>
                                    <a href="{{route('ontologies.download', [ 'userId' => auth()->user()->id ,'ontologyId' => $ontology->id])}}">
                                        <button class="btn btn-success"><i class="fa fa-fw fa-download"></i></button>
                                    </a>
                                </td>
                                <td><a href="{{route('ontologies.show', $ontology->id)}}">
                                        <button class="btn btn-success"><i class="fa fa-fw fa-plus"></i></button>
                                    </a>
                                </td>
                                <td>
                                    <form method="POST"
                                          action="{{route('ontologies.favourite', [ 'userId' => auth()->user()->id ,'ontologyId' => $ontology->id])}}">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-success"><i class="fa fa-fw fa-star-o"></i></button>
                                    </form>
                                </td>
                                <td>
                                    <form method="post"
                                          action="{{route('ontologies.destroy', $ontology->id)}}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit"><i  class="fa fa-fw fa-trash-o" ></i></button>
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
        {{ $ontologies->links() }}
    </ul>

@stop
