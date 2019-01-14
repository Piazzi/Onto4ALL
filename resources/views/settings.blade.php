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

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Account Settings</h3>
        </div>
        <form role="form" action="users/{{Auth::user()->id}}" token="{{ csrf_token() }}" method="PUT">
            {{ csrf_field() }}
            <div class="box-body">
                <div class="form-group">
                    <label for="inputPassword" class="col-sm-1-4 col-form-label">Password</label>
                    <div class="col-sm-1-4">
                        <input value="{{Auth::user()->password}}" type="password" class="form-control" name="password"
                               id="inputPassword" placeholder="Insert your new password">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-1-4 col-form-label">Username</label>
                    <div class="col-sm-1-4">
                        <input value="{{Auth::user()->name}}" type="text" class="form-control" name="name"
                               id="inputUsername" placeholder="Insert your name here">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail" class="col-sm-1-4 col-form-label">Email</label>
                    <div class="col-sm-1-4">
                        <input value="{{Auth::user()->email}}" type="text" class="form-control" name="email"
                               id="inputPassword" placeholder="Insert your email here">
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <div class="offset-sm-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">Send</button>
                </div>
            </div>
        </form>
    </div>

@stop
