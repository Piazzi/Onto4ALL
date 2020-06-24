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
            <h3 class="box-title">Edit User</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form method="post" action="{{route('user.update', ['userId'=> $user->id, 'locale' => app()->getLocale()])}}" role="form">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Ontology Access</label>
                    <div class="row">
                        <div class="col-xs-1">
                            <div class="checkbox">
                                <label>
                                    <input name="ontology" value="bfo" @if(strpos($user->ontology, 'bfo') !== false) checked @endif type="checkbox">
                                    BFO
                                </label>
                            </div>
                        </div>
                        <div class="col-xs-1">
                            <div class="checkbox">
                                <label>
                                    <input name="ontology" value="iof" @if(strpos($user->ontology, 'iof') !== false) checked @endif type="checkbox">
                                    IOF
                                </label>
                            </div>
                        </div>
                        <div class="col-xs-1">
                            <div class="checkbox">
                                <label>
                                    <input name="ontology" value="iao" @if(strpos($user->ontology, 'iao') !== false) checked @endif type="checkbox">
                                    IAO
                                </label>
                                <input value="" id="ontology" name="ontology" type="hidden">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Category</label>
                    <select name="categoria" class="form-control">
                        <option @if(strpos($user->categoria, 'modelador') !== false)selected @endif value="modelador">Modelador</option>
                        <option @if(strpos($user->categoria, 'administrador') !== false)selected @endif value="administrador">Administrador</option>
                    </select>
                </div>

                <input id="save_value"  type="submit" class="btn btn-block btn-success btn-sm">
            </form>
        </div>
        <!-- /.box-body -->
    </div>
    <script type="text/javascript" src="{{asset('js/MultipleCheckbox.js')}}"></script>
@stop

@section('footer')
    .
@stop

