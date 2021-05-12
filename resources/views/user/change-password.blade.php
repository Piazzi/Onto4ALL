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
            <h3 class="box-title">{{__('Change password')}}</h3>
        </div>
        <form role="form" action="{{route('user.updatePassword', ['locale'=> app()->getLocale(), 'id'=>Auth::user()->id])}}" method="post">
            @csrf
            @method('PUT')
            <div class="box-body">
                <div class="form-group">
                    <label for="inputName" class="col-sm-1-4 col-form-label">{{__('New Password')}}</label>
                    <div class="col-sm-1-4">
                        <input type="password" class="form-control" name="password"
                               placeholder="Insert your new password here">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-1-4 col-form-label">{{__('Confirm your new Password')}}</label>
                    <div class="col-sm-1-4">
                        <input type="password" class="form-control" name="password_confirmation"
                               placeholder="Confirm your new password here">
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <div class="offset-sm-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">{{__('Update')}}</button>
                </div>
            </div>
        </form>
    </div>


@stop

@section('footer')
    .
@stop