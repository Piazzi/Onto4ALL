@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>
       {{__('Thesaurus Manager')}}
        <small>{{__('Manage all your thesaurus')}}</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home', app()->getLocale())}}"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">       {{__('Thesaurus Manager')}}        </li>
    </ol>
    @if (session()->has('Success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Alert!</h4>
            <strong>{{ session('Success') }}</strong>
        </div>
    @endif

    @if (session()->has('Error'))
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-ban"></i> Alert!</h4>
            <strong>{{ session('Error') }}</strong>
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


    <div  style="border-top-color: #8c3030 !important;" class="box box-success">
        <div class="box-header with-border ">
            <h3 class="box-title"><i style="color: #8c3030" class="fa fa-fw fa-book "></i> {{__('Your thesaurus:')}} </h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
            </div>
            <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body" style="">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header with-border">

                            <h3 class="box-title">{{__('Your last 10 thesaurus will be saved here')}} </h3>

                            <div class="box-tools">

                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>{{__('Name')}}</th>
                                    <th>{{__('Created At')}}</th>
                                    <th>{{__('Updated At')}}</th>
                                    <th>{{__('XML File')}}</th>
                                    <th>{{__('Details')}}</th>
                                    <th>{{__('Update')}}</th>
                                    <th>{{__('Delete')}}</th>
                                </tr>
                                </thead>
                                <tbody id="table-search">
                                @foreach ($thesaurus as $thesauru)
                                    <tr>

                                        <td><span class="label thesauru-box">{{$thesauru->name}}</span></td>
                                        <td>{{date("d-m-Y | H:i", strtotime($thesauru->created_at))}}</td>
                                        <td>{{date("d-m-Y | H:i", strtotime($thesauru->updated_at))}}</td>
                                        <td>
                                            <a href="{{route('thesaurus.download', [ 'userId' => auth()->user()->id ,'thesauruId' => $thesauru->id])}}">
                                                <button style="color: white" class="btn thesauru-box"><i class="fa fa-fw fa-download"></i>
                                                </button>
                                            </a>
                                        </td>
                                        <td><a href="{{route('thesaurus.show', ['locale' => app()->getLocale(), 'thesauru' => $thesauru->id])}}">
                                                <button style="color: white" class="btn thesauru-box"><i class="fa fa-fw fa-plus"></i>
                                                </button>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{route('thesaurus.edit',['locale' => app()->getLocale(), 'thesauru' => $thesauru->id])}}">
                                                <button style="color: white" class="btn thesauru-box"><i class="fa fa-fw fa-edit"></i>
                                                </button>
                                            </a>
                                        </td>
                                        <td>
                                            <form method="post"
                                                  action="{{route('thesaurus.destroy', ['locale' => app()->getLocale(), 'thesauru' => $thesauru->id])}}">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger" type="submit"><i
                                                            class="fa fa-fw fa-trash-o"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>
        </div>
    </div>
    <ul class="pagination pagination-sm no-margin ">
        {{ $thesaurus->links() }}
    </ul>
    <!-- Filter -->
    <script type="text/javascript" src="{{asset('js/SearchBar.js')}}"></script>

@stop

@section('footer')
    .
@stop