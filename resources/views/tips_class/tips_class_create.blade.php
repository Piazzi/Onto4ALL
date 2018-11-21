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
          <h3 class="box-title">Add a Tip Class</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
        <form  method="POST" action="{{route('tips_class.store')}}" role="form" token="{{ csrf_token() }}">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Super Class</label>
                        <input required value="{{old('superclass')}}" name="superclass" type="text" class="form-control" placeholder="">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Sub Class</label>
                        <input required value="{{old('subclass')}}" name="subclass" type="text" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Synonyms</label>
                        <input required value="{{old('synonyms')}}" name="synonyms" type="textarea" class="form-control"  >
                    </div>
                </div>
            </div>
            <button class="btn btn-success btn-block" type="submit">Submit</button>
        </form>
        </div>
        <!-- /.box-body -->
</div>
@stop
