@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')

@stop

@section('content')

<div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Your menu</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">


            <div class="form-group">
                <label>Title</label>
            <input disabled value="{{$menu->title}}"  type="text" class="form-control" >
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea disabled value="{{$menu->description}}"  type="textarea" class="form-control"  >{{$menu->description}}</textarea>
            </div>
            <a href="/menus"><button class="btn btn-success btn-block" type="button">Go back</button></a>

        </div>
        <!-- /.box-body -->
</div>
@stop
