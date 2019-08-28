<div class="box box-danger box-solid danger " id="{{$id}}" style="display:none">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="icon fa fa-danger"></i> <strong> {{$title}} </strong></h3>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
        <!-- /.box-tools -->
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        {{$slot}}
    </div>
    <!-- /.box-body -->
</div>
