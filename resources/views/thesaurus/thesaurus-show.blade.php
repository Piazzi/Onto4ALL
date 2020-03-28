@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')

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

    <div  style="border-top-color: #8c3030" class="box box-success">
        <div  class="box-header with-border">
            <h3 class="box-title">Thesauru Details</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Name</label>
                            <input disabled required value="{{$thesauru->name}}" name="name" type="text" class="form-control"
                                   placeholder="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Created By</label>
                            <input disabled value="{{$thesauru->created_by}}" name="created_by" type="text"
                                   class="form-control">
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Publication Date</label>
                            <input disabled  value="{{$thesauru->publication_date}}" name="publication_date" type="date"
                                   class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Last Uploaded</label>
                            <input disabled  value="{{$thesauru->last_uploaded}}" name="last_uploaded" type="date" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea disabled  value="{{$thesauru->description}}" name="description" class="form-control" rows="3"
                              placeholder="Enter ...">{{$thesauru->description}}</textarea>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Domain</label>
                            <input disabled  value="{{$thesauru->domain}}" name="domain" type="text" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Profile Users</label>
                            <input  disabled  value="{{$thesauru->profile_users}}" name="profile_users" type="text" class="form-control">
                        </div>
                    </div>

                </div>


                <a href="/thesaurus"><button class="btn btn-success btn-block thesauru-box" type="button">Go back</button></a>

        </div>
        <!-- /.box-body -->
    </div>
@stop

@section('footer')
    .
@stop