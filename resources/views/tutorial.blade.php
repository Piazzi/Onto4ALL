@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1> <strong> Summary <i class="fa fa-bookmark-o" aria-hidden="true"></i> </strong></h1>
    <nav class="navbar navbar-expand navbar-light bg-light">
        <ul class="nav navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="#identifier"> Ontology <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#identifier2">Nav 1</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Nav 2</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Nav 3</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Nav 4</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Nav 5</a>
            </li>
            <li class="nav-item">
              <a href="/mxgraph">  <button  class="btn btn-danger"> Start Drawing Now !</button> </a>
            </li>

        </ul>
    </nav>
@stop

@section('content')
    <h1-6 class="form-control">1 - <span class="badge badge-info"> What is a ontology ?</span></h1-6>
    <div class="list-group">
        <a href="#" class="list-group-item list-group-item-action active"> Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint incidunt quidem a nam ea, quos, adipisci magnam odio, quod magni aspernatur. Iusto illum eligendi ullam eum magni nisi aspernatur voluptate?</a>
        <a href="#" class="list-group-item list-group-item-action">Item</a>
        <a href="#" class="list-group-item list-group-item-action active"> Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint incidunt quidem a nam ea, quos, adipisci magnam odio, quod magni aspernatur. Iusto illum eligendi ullam eum magni nisi aspernatur voluptate?</a>
        <a id="identifier2" href="#" class="list-group-item list-group-item-action">NAV 1</a>
        <a href="#" class="list-group-item list-group-item-action active"> Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint incidunt quidem a nam ea, quos, adipisci magnam odio, quod magni aspernatur. Iusto illum eligendi ullam eum magni nisi aspernatur voluptate?</a>
    </div>
    <h1-6 class="form-control">1 - <span class="badge badge-info"> asas ?</span></h1-6>
    <div class="list-group">
        <a href="#" class="list-group-item list-group-item-action active"> Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint incidunt quidem a nam ea, quos, adipisci magnam odio, quod magni aspernatur. Iusto illum eligendi ullam eum magni nisi aspernatur voluptate?</a>
        <a href="#" class="list-group-item list-group-item-action">Item</a>
        <a href="#" class="list-group-item list-group-item-action active"> Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint incidunt quidem a nam ea, quos, adipisci magnam odio, quod magni aspernatur. Iusto illum eligendi ullam eum magni nisi aspernatur voluptate?</a>
        <a href="#" class="list-group-item list-group-item-action">Item</a>
        <a id="identifier" href="#" class="list-group-item list-group-item-action active"> Ontology </a>
    </div>
@stop
