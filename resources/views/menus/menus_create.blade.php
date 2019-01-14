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
            <h3 class="box-title">Add a Menu</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form method="POST" action="{{route('menus.store')}}" role="form" token="{{ csrf_token() }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label>Title</label>
                    <input required value="{{old('title')}}" name="title" type="text" class="form-control"
                           placeholder="Enter ...">
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea value="{{old('description')}}" name="description" type="textarea"
                              class="form-control"></textarea>
                </div>
                <button class="btn btn-success btn-block" type="submit">Submit</button>
            </form>
        </div>
        <!-- /.box-body -->
    </div>
@stop
