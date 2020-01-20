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

    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Add a Ontology</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form method="POST" action="{{route('ontologies.store')}}" role="form" {{ csrf_token() }}>
                {{ csrf_field() }}
                <div class="form-group">
                    <label>Name</label>
                    <input required value="{{old('name')}}" name="name" type="text" class="form-control"
                           placeholder="Enter ...">
                </div>
                <div class="form-group">
                    <label>Publication Date</label>
                    <input required value="{{old('publication_date')}}" name="publication_date" type="date"
                           class="form-control">
                </div>
                <div class="form-group">
                    <label>Last Uploaded</label>
                    <input required value="{{old('last_uploaded')}}" name="last_uploaded" type="date"
                           class="form-control">
                </div>

                <div class="form-group">
                    <label>Description</label>
                    <textarea required value="{{old('description')}}" name="description" class="form-control" rows="3"
                              placeholder="Enter ..."></textarea>
                </div>
                <div class="form-group">
                    <label>Link</label>
                    <input required value="{{old('link')}}" name="link" type="text" class="form-control"
                           placeholder="Enter ...">
                </div>

                <div class="form-group">
                    <label>Created By</label>
                    <input disabled name="created_by" type="text" class="form-control" value="{{Auth::user()->email}}">
                </div>

                <button class="btn btn-success btn-block" type="submit">Submit</button>
            </form>
        </div>
        <!-- /.box-body -->
    </div>
@stop

@section('footer')
    !
@stop