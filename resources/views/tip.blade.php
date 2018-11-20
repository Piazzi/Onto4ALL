<div id="tip" class="box box-success box-solid tip">
    <div class="box-header with-border">
    <i class="fa fa-fw fa-bullhorn"></i>
    <h3 class="box-title"><strong> {{$title}} </strong></h3>

      <div class="box-tools pull-right">
        <button id="closeBox" type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
      </div>
      <!-- /.box-tools -->
    </div>
    <!-- /.box-header -->
    <div class="box-body texto">
     {{$slot}}
    </div>
    <!-- /.box-body -->
</div>
