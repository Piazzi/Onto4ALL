@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>
        Users Manager
        <small>Manage all users</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i>Home</a></li>
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

                    <h3 class="box-title">UsersDatabase </h3>
                    <form style="float: right;" method="post" action="{{route('user.search', ['search' => 'search'])}}">
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
                            <th></th>
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
                                <td>
                                    <form method="post" action="{{route('user.ontology.update', $user->id)}}">
                                        @csrf
                                        @method('put')
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-xs-1">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="ontology" value="bfo" @if(strpos($user->ontology, 'bfo') !== false) checked @endif type="checkbox">
                                                           BFO
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-xs-1">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="ontology" value="iof" @if(strpos($user->ontology, 'iof') !== false) checked @endif type="checkbox">
                                                            IOF
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-xs-1">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="ontology" value="iao" @if(strpos($user->ontology, 'iao') !== false) checked @endif type="checkbox">
                                                            IAO
                                                        </label>
                                                        <input value="" id="ontology" name="ontology" type="hidden">
                                                    </div>
                                                </div>
                                                <div style="float: right" class="col-xs-3">
                                                    <input id="save_value"  type="submit" class="btn btn-block btn-warning btn-sm">
                                                </div>
                                            </div>
                                        </div>
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
        {{ $users->links() }}
    </ul>
    <script src="js/MultipleCheckbox.js" type="text/javascript"></script>
@stop

@section('footer')
    .
@stop
