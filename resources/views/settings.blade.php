@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')

@stop

@section('content')

    <div class="container">
    <form action="user/{user}" token="{{ csrf_token() }}" method="PUT">
            <fieldset class="form-group row">
                <legend class="col-form-legend col-sm-1-12">Account Settings</legend>
                    <div class="col-sm-1-12">

                    </div>
            </fieldset>
            <div class="form-group row">
                <label for="inputName" class="col-sm-1-4 col-form-label">Password</label>
                <div class="col-sm-1-4">
                    <input type="password" class="form-control" name="password" id="inputPassword" placeholder="Insert your new password">
                </div>
            </div>
            <div class="form-group row">
                    <label for="inputName" class="col-sm-1-4 col-form-label">Username</label>
                    <div class="col-sm-1-4">
                    <input value=""type="text" class="form-control" name="name" id="inputUsername" placeholder="">
                    </div>
            </div>
            <div class="form-group row">
                    <label for="inputName" class="col-sm-1-4 col-form-label">Email</label>
                    <div class="col-sm-1-4">
                        <input type="text" class="form-control" name="email" id="inputPassword" placeholder="">
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
