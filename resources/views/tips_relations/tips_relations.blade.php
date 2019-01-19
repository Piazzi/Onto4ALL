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
                <a href="{{route('tips_relations.create')}}">
                    <button type="button" class="btn btn-block btn-success">Add</button>
                </a>

                <div class="box-header">

                    <h3 class="box-title">Tips Relations Database </h3>

                    <form style="float: right;" method="post" action="{{route('tips_relations.search', ['search' => 'search'])}}">
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
                            <th>Example Of Usage</th>
                            <th>Imported From</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody id="table-search">
                        @foreach ($tips_relations as $tips_relation)
                            <tr>
                                <td>{{$tips_relation->id}}</td>
                                <td>{{$tips_relation->name}}</td>
                                <td>{{$tips_relation->domain}}</td>
                                <td>{{$tips_relation->range}}</td>
                                <td>{{$tips_relation->similar_relation}}</td>
                                <td>{{$tips_relation->cardinality}}</td>
                                <td>{{$tips_relation->example_of_usage}}</td>
                                <td><a>{{$tips_relation->imported_from}}</a></td>
                                <td><a href="{{route('tips_relations.show', $tips_relation->id)}}">
                                        <button type="button" class="btn btn-block btn-info btn-sm">Info</button>
                                    </a></td>
                                <td><a href="{{route('tips_relations.edit', $tips_relation->id)}}">
                                        <button type="button" class="btn btn-block btn-warning btn-sm">Edit</button>
                                    </a></td>
                                <td>
                                    <form method="post"
                                          action="{{route('tips_relations.destroy', $tips_relation->id)}}">
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
        {{ $tips_relations->links() }}
    </ul>

@stop
