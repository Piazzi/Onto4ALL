@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>
        Warnings Index
        <small>Here you can find all warnings tracked by our Editor at the moment.</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">Error Index</li>
    </ol>
@stop

@section('content')

    <div class="box box-warning">
        <div class="box-header">
            <h3 class="box-title">Warnings</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body no-padding">
            <table class="table table-striped">
                <tbody><tr>
                    <th style="width: 10px">Id</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th style="width: 40px">Type</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Equal Class Names</td>
                    <td>Occurs when you have two classes with the same name, except the default 'Name' class</td>
                    <td>Inconsistency</td>
                </tr>

                <tr>
                    <td>2</td>
                    <td>Equal Relation Between Classes</td>
                    <td>Occurs when you have 2 equal relations pointing to the same classes.</td>
                    <td>Imprecision</td>
                </tr>

                <tr>
                    <td>3</td>
                    <td>instance_of Relation Between Classes</td>
                    <td>Occurs when you have 2 classes connected by a instance_of relation. You cant have a instance_of relation between two classes. It must be between one class and one instance</td>
                    <td></td>
                </tr>

                <tr>
                    <td>4</td>
                    <td>Wrong Relation</td>
                    <td>Occurs when a instance and a class have a relation different than 'instance_of' between them. You can only have a instance_of relation between a class and a instance</td>
                    <td></td>
                </tr>

                <tr>
                    <td>5</td>
                    <td>inverseOf Invalid Name</td>
                    <td>Occurs when the Inverse Of property have the same name of the relation</td>
                    <td></td>
                </tr>

                <tr>
                    <td>6</td>
                    <td>Missing Class Properties</td>
                    <td>Occurs when you start to fill the class properties but don't fulfill all the required fields</td>
                    <td></td>
                </tr>

                <tr>
                    <td>7</td>
                    <td>Missing Relation Properties</td>
                    <td>Occurs when you start to fill the relation properties but don't fulfill all the required fields</td>
                    <td></td>
                </tr>

                <tr>
                    <td>8</td>
                    <td>Multiple Inheritance</td>
                    <td>Occurs when a class have multiple inheritance. A class can't be the domain of more than one is_a relation</td>
                    <td></td>
                </tr>

                <tr>
                    <td>9</td>
                    <td>Relation Not Connected</td>
                    <td>Occurs when one of your relations is not fully connected to a class or instance</td>
                </tr>
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>

@stop

@section('footer')
.
@stop