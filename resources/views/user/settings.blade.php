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
            <h3 class="box-title">{{__('Account Settings')}}</h3>
        </div>

        <div class="box-profile">
            <form id="form-delete-picture" action="{{ route('user.deletePicture', ['locale'=> app()->getLocale(), 'user' => Auth::user()->id]) }}" method="post">
                @csrf
                @method('delete')
            </form>
            <form id="form-update-picture" action="{{ route('user.updatePicture', ['locale'=> app()->getLocale(), 'user' => Auth::user()->id]) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                @method('put')
                <input type="file" name="avatar_url" id="profile" class="d-none">
                <img src="{{ asset('storage/img/profile/' . Auth::user()->avatar_url) }}" id="previewProfile"
                    alt="User profile picture" class="profile-user-img img-fluid img-circle">
                <div class="overlay">
                    <div class="row">
                        <a href="javascript:;" id="btnEditProfile" class="" title="Editar">
                            <i class="fa fa-pencil text-dark fa-2x"></i>
                        </a>
                        @if (Auth::user()->avatar_url != 'profile_default.png')
                            <a href="javascript:;" id="btnDeleteProfile" class="ml-4" title="Excluir">
                                <i class="fa fa-trash text-dark fa-2x"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>

        <form role="form" action="{{route('user.update', ['locale'=> app()->getLocale(), 'user' => Auth::user()->id])}}" method="post">
            @csrf
            @method('PATCH')
            <div class="box-body">
                <div class="form-group">
                    <label for="inputName" class="col-sm-1-4 col-form-label">{{__('Username')}}</label>
                    <div class="col-sm-1-4">
                        <input value="{{Auth::user()->name}}" type="text" class="form-control" name="name"
                               id="inputUsername" placeholder="Insert your name here">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail" class="col-sm-1-4 col-form-label">Email</label>
                    <div class="col-sm-1-4">
                        <input value="{{Auth::user()->email}}" type="text" class="form-control" name="email"
                               placeholder="Insert your email here">
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
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary collapsed-box">
                <div class="box-header with-border">
                    <h3 class="box-title">{{__('More Settings')}}</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body" style="display: none;">
                    <a href="{{route('user.editPassword', ['locale'=> app()->getLocale(), 'id'=> Auth::user()->id])}}">
                        <button type="button" class="btn btn-block btn-danger btn-sm">{{__('Change password')}}</button>
                    </a>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-6">
            <div class="box box-danger collapsed-box">
                <div class="box-header with-border">
                    <h3 class="box-title">{{__('Delete Account')}}</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body" style="display: none;">
                    <strong>{{__('If you do this you will lose all your saved ontologies')}}</strong>
                </div>
                <!-- /.box-body -->

                <div class="box box-footer">
                    <form role="form" method="post" action="{{route('user.destroy', ['locale'=> app()->getLocale(), 'user'=> Auth::user()->id])}}">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-block btn-danger btn-sm">{{__('Delete Account')}}</button>
                    </form>
                </div>
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>

@stop

@section('footer')
    .
@stop

@push('js')
    <script>

        function filePreview(input, previewProfile) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $(previewProfile).attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

        $("#type").attr("disabled", true);
        $("#btnEditProfile").click(function() {
            $("#profile").click();
        });
        $("#btnDeleteProfile").click(function() {
            $('#form-delete-picture').submit();
        });
        $("#profile").change(function() {
            filePreview(this, '#previewProfile');
            $('#form-update-picture').submit();
        });
    </script>
@endpush
