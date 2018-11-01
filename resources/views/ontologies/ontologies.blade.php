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

<div class="row">
    <div class="col-xs-12">
      <div class="box">
        <a href="/ontologies_store">  <button  type="button" class="btn btn-block btn-success">Add</button> </a>

        <div class="box-header">

          <h3 class="box-title">Ontologies Database </h3>

          <div class="box-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
              <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">
              <div class="input-group-btn">
                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
              </div>
            </div>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tbody><tr>
              <th>ID</th>
              <th>Name</th>
              <th>Publication Date</th>
              <th>Last Uploaded</th>
              <th>Description</th>
              <th>Link</th>
              <th>Created By</th>
              <th>Actions</th>
            </tr>
            @foreach ($ontologies as $ontology)
            <tr>

                <td>{{$ontology->id}}</td>
                <td><span class="label label-success">{{$ontology->name}}</span></td>
                <td>{{$ontology->publication_date}}</td>
                <td>{{$ontology->last_uploaded}}</td>
                <td>
                    @php
                       $Description = str_limit($ontology->description, 20);
                    @endphp
                    {{$Description}}
                </td>
                <td>
                    @php
                        $Link = str_limit($ontology->link, 15);
                    @endphp
                    <a href="{{$ontology->link}}">{{$Link}}</a>
                </td>
                <td>{{$ontology->created_by}}</td>
                <td><form method="GET" action="/ontologies/ontologies_show/{{$ontology->id}}"> <button type="submit" class="btn btn-block btn-info">Info</button></form></td>

            </tr>
            @endforeach
          </tbody></table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
  </div>

  <ul class="pagination pagination-sm no-margin ">
    {{ $ontologies->links() }}
  </ul>

@stop
