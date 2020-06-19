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
            <h3 class="box-title">{{__('Edit Thesauru')}}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form method="post" action="{{route('thesaurus.update', ['locale' => app()->getLocale(), 'thesaurus' => $thesauru->id])}}" role="form">
                @csrf
                <input name="_method" type="hidden" value="PATCH">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{__('Name')}}</label>
                            <input required value="{{$thesauru->name}}" name="name" type="text" class="form-control"
                                   placeholder="">
                            <span class="badge bg-red">{{__('Dont forget to include the extension ".xml" on the end of the name')}}</span>
                            <span class="badge bg-red">{{__('Example')}}: <strong>Thesauru.xml</strong></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{__('Created By')}}</label>
                            <input disabled value="{{$thesauru->created_by}}" name="created_by" type="text"
                                   class="form-control">
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Publication Date</label>
                            <input value="{{$thesauru->publication_date}}" name="publication_date" type="date"
                                   class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Last Uploaded</label>
                            <input value="{{$thesauru->last_uploaded}}" name="last_uploaded" type="date" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea value="{{$thesauru->description}}" name="description" class="form-control" rows="3"
                              placeholder="Enter ...">{{$thesauru->description}}</textarea>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Domain</label>
                            <input value="{{$thesauru->domain}}" name="domain" type="text" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Profile Users</label>
                            <input  value="{{$thesauru->profile_users}}" name="profile_users" type="text" class="form-control">
                        </div>
                    </div>

                </div>



                <button class="btn btn-success btn-block thesauru-box" type="submit">Submit</button>
            </form>
        </div>
        <!-- /.box-body -->
    </div>
@stop

@section('footer')
    .
@stop