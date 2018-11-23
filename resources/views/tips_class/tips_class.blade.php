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
      <a href="{{route('tips_class.create')}}">  <button  type="button" class="btn btn-block btn-success">Add</button> </a>

        <div class="box-header">

          <h3 class="box-title">Tips Class Database </h3>

          <div class="box-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
              <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">
              <div class="input-group-btn">
                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
              </div>
            </div>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tbody><tr>
              <th>ID</th>
              <th>Superclass</th>
              <th>Subclass</th>
              <th>Synonyms</th>
              <th></th>
              <th></th>
              <th></th>
            </tr>
            @foreach ($tips_class as $tip_class)
            <tr>

                <td>{{$tip_class->id}}</td>
                <td>{{$tip_class->superclass}}</td>
                <td>{{$tip_class->subclass}}</td>
                <td>{{$tip_class->synonyms}}</td>
                <td><a href="{{route('tips_class.show', $tip_class->id)}}"> <button type="button" class="btn btn-block btn-info btn-sm">Info</button></a></td>
                <td><a href="{{route('tips_class.edit', $tip_class->id)}}"> <button type="button" class="btn btn-block btn-warning btn-sm">Edit</button></a></td>
                <td><form method="post" action="{{route('tips_class.destroy', $tip_class->id)}}">
                    @csrf
                    <input name="_method" type="hidden" value="DELETE">
                    <button type="submit" class="btn btn-block btn-danger btn-sm">Delete</button>
                    </form>
                </td>

            </tr>
            @endforeach
          </tbody></table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
  </div>

  <ul class="pagination pagination-sm no-margin ">
    {{ $tips_class->links() }}
  </ul>

@stop
