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

    <div class="container">
    <form action="users/{{Auth::user()->id}}" token="{{ csrf_token() }}" method="PUT">
            <fieldset class="form-group row">
                <legend class="col-form-legend col-sm-1-12">Account Settings</legend>
                    <div class="col-sm-1-12">

                    </div>
            </fieldset>
            <div class="form-group row">
                <label for="inputName" class="col-sm-1-4 col-form-label">Password</label>
                <div class="col-sm-1-4">
                <input value="{{Auth::user()->password}}" type="password" class="form-control" name="password" id="inputPassword" placeholder="Insert your new password">
                </div>
            </div>
            <div class="form-group row">
                    <label for="inputName" class="col-sm-1-4 col-form-label">Username</label>
                    <div class="col-sm-1-4">
                    <input value="{{Auth::user()->name}}" type="text" class="form-control" name="name" id="inputUsername" placeholder="Insert your name here">
                    </div>
            </div>
            <div class="form-group row">
                    <label for="inputName" class="col-sm-1-4 col-form-label">Email</label>
                    <div class="col-sm-1-4">
                        <input value="{{Auth::user()->email}}" type="text" class="form-control" name="email" id="inputPassword" placeholder="Insert your email here">
                    </div>
            </div>
            <div class="form-group row">
                <div class="offset-sm-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">Send</button>
                </div>
            </div>
        </form>
    </div>

@stop
