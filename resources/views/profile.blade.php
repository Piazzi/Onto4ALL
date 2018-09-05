@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')

@stop

@section('content')

<div class="box box-solid box-warning">
    <div class="box-header with-border">
        <h3 class="box-title">How Many Ontology's you've made?</h3>
            <div class="box-tools pull-right">
                <!-- Buttons, labels, and many other things can be placed here! -->
                <!-- Here is a label for example -->
                <span class="label label-primary">Label</span>
            </div>
        <!-- /.box-tools -->
    </div>
    <!-- /.box-header -->
    <div class="box-body">
       <strong> 12 </strong>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
        Keep Going!
    </div>
    <!-- box-footer -->
</div>
    <!-- /.box -->


<div class="box box-solid box-info">
    <div class="box-header with-border">
        <h3 class="box-title">Your username</h3>
            <div class="box-tools pull-right">
                <!-- Buttons, labels, and many other things can be placed here! -->
                <!-- Here is a label for example -->
                <button class="btn btn-primary"> Change </button>
            </div>
        <!-- /.box-tools -->
    </div>
    <!-- /.box-header -->
    <div class="box-body">
       <strong> {{Auth::user()->name}} </strong>
    </div>
    <!-- /.box-body -->
</div>
    <!-- /.box -->
    <div class="box box-solid box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Your email</h3>
                <div class="box-tools pull-right">
                    <!-- Buttons, labels, and many other things can be placed here! -->
                    <!-- Here is a label for example -->
                    <button class="btn btn-primary"> Change </button>
                </div>
            <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">
           <strong> {{Auth::user()->email}} </strong>
        </div>
        <!-- /.box-body -->
    </div>
        <!-- /.box -->
@stop
