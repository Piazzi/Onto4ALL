@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')

@stop

@section('content')
<div class="lockscreen-wrapper">
    <div class="lockscreen-logo">
        <i class="fa fa-lock fa-2x"></i> <a href="../../index2.html"><b>ONTO4</b>ALL</a>
    </div>


    <!-- /.lockscreen-item -->
    <div class="help-block text-center">
        {{auth()->user()->name}}, you don't have the rights to access this content
    </div>
    <div class="text-center">
        <a href="{{route('home', app()->getLocale())}}">Let's go back</a>
    </div>
    <div class="lockscreen-footer text-center">
        Copyright © 2018-2020 <b><a href="" class="text-black">Onto4ALL</a></b><br>
        All rights reserved
    </div>
</div>
@stop