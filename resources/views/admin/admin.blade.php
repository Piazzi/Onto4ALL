@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>
        Users Manager
        <small>Manage all users</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home', app()->getLocale())}}"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">Users Manager</li>
    </ol>
    @if (session()->has('Success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Alert!</h4>
            <strong>{{ session('Success') }}</strong>
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
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-success">

                <div class="box-header with-border">

                    <h3 class="box-title">Users Database </h3>
                    <form style="float: right;" method="post" action="{{route('user.search', ['search' => 'search', 'locale' => app()->getLocale()])}}">
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
                            <th>Email</th>
                            <th>Ontology</th>
                            <th>Category</th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody id="table-search">
                        @foreach ($users as $user)
                            <tr>

                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->ontology}}</td>
                                <td>{{$user->categoria}}</td>
                                <td></td>
                                <td>
                                    <a href="{{route('users.edit',$user->id)}}">
                                        <button class="btn btn-success"><i class="fa fa-fw fa-edit"></i>
                                        </button>
                                    </a>
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
        {{ $users->links() }}
    </ul>
@stop

@section('footer')
    .
@stop
