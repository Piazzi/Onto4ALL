@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
<div class="callout callout-success">
        <h4>Your Profile</h4>
        <p>
           Here you can find information about your profile and account.
        </p>
</div>
@stop

@section('content')

<div class="info-box">
        <!-- Apply any bg-* class to to the icon to color it -->
        <span class="info-box-icon bg-green"><i class="fa fa-flag-o"></i></span>
        <div class="info-box-content">
          <span class="info-box-text"><strong> Ontologies made </strong></span>
          <span class="info-box-number">3</span>
        </div>
        <!-- /.info-box-content -->
</div>
<!-- /.info-box -->


<div class="box box-solid box-success">
    <div class="box-header with-border">
        <h3 class="box-title">Your username</h3>
            <div class="box-tools pull-right">
                <!-- Buttons, labels, and many other things can be placed here! -->
                <!-- Here is a label for example -->
                <a href="/admin/settings">
                    <button class="btn btn-danger"> Change </button>
                </a>
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
    <div class="box box-solid box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Your email</h3>
                <div class="box-tools pull-right">
                    <!-- Buttons, labels, and many other things can be placed here! -->
                    <!-- Here is a label for example -->
                    <a href="/admin/settings">
                        <button class="btn btn-danger"> Change </button>
                    </a>
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
