@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')


@stop

@section('content')
<a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>

<aside class="control-sidebar control-sidebar-dark control-sidebar-open">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li class="active"><a href="#control-sidebar-theme-demo-options-tab" data-toggle="tab"><i class="fa fa-wrench"></i></a></li><li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div id="table-wrapper">
            <div id="table-scroll">
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div><div id="control-sidebar-theme-demo-options-tab" class="tab-pane active"><div><h4 class="control-sidebar-heading">Layout Options</h4><div class="form-group"><label class="control-sidebar-subheading"><input type="checkbox" data-layout="fixed" class="pull-right"> Fixed layout</label><p>Activate the fixed layout. You can't use fixed and boxed layouts together</p></div><div class="form-group"><label class="control-sidebar-subheading"><input type="checkbox" data-layout="layout-boxed" class="pull-right"> Boxed Layout</label><p>Activate the boxed layout</p></div><div class="form-group"><label class="control-sidebar-subheading"><input type="checkbox" data-layout="sidebar-collapse" class="pull-right"> Toggle Sidebar</label><p>Toggle the left sidebar's state (open or collapse)</p></div><div class="form-group"><label class="control-sidebar-subheading"><input type="checkbox" data-enable="expandOnHover" class="pull-right"> Sidebar Expand on Hover</label><p>Let the sidebar mini expand on hover</p></div><div class="form-group"><label class="control-sidebar-subheading"><input type="checkbox" data-controlsidebar="control-sidebar-open" class="pull-right"> Toggle Right Sidebar Slide</label><p>Toggle between slide over content and push content effects</p></div><div class="form-group"><label class="control-sidebar-subheading"><input type="checkbox" data-sidebarskin="toggle" class="pull-right"> Toggle Right Sidebar Skin</label><p>Toggle between dark and light skins for the right sidebar</p></div><h4 class="control-sidebar-heading">Skins</h4><ul class="list-unstyled clearfix"><li style="float:left; width: 33.33333%; padding: 5px;"><a href="javascript:void(0)" data-skin="skin-blue" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover"><div><span style="display:block; width: 20%; float: left; height: 7px; background: #367fa9"></span><span class="bg-light-blue" style="display:block; width: 80%; float: left; height: 7px;"></span></div><div><span style="display:block; width: 20%; float: left; height: 20px; background: #222d32"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div></a><p class="text-center no-margin">Blue</p></li><li style="float:left; width: 33.33333%; padding: 5px;"><a href="javascript:void(0)" data-skin="skin-black" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover"><div style="box-shadow: 0 0 2px rgba(0,0,0,0.1)" class="clearfix"><span style="display:block; width: 20%; float: left; height: 7px; background: #fefefe"></span><span style="display:block; width: 80%; float: left; height: 7px; background: #fefefe"></span></div><div><span style="display:block; width: 20%; float: left; height: 20px; background: #222"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div></a><p class="text-center no-margin">Black</p></li><li style="float:left; width: 33.33333%; padding: 5px;"><a href="javascript:void(0)" data-skin="skin-purple" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover"><div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-purple-active"></span><span class="bg-purple" style="display:block; width: 80%; float: left; height: 7px;"></span></div><div><span style="display:block; width: 20%; float: left; height: 20px; background: #222d32"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div></a><p class="text-center no-margin">Purple</p></li><li style="float:left; width: 33.33333%; padding: 5px;"><a href="javascript:void(0)" data-skin="skin-green" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover"><div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-green-active"></span><span class="bg-green" style="display:block; width: 80%; float: left; height: 7px;"></span></div><div><span style="display:block; width: 20%; float: left; height: 20px; background: #222d32"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div></a><p class="text-center no-margin">Green</p></li><li style="float:left; width: 33.33333%; padding: 5px;"><a href="javascript:void(0)" data-skin="skin-red" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover"><div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-red-active"></span><span class="bg-red" style="display:block; width: 80%; float: left; height: 7px;"></span></div><div><span style="display:block; width: 20%; float: left; height: 20px; background: #222d32"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div></a><p class="text-center no-margin">Red</p></li><li style="float:left; width: 33.33333%; padding: 5px;"><a href="javascript:void(0)" data-skin="skin-yellow" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover"><div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-yellow-active"></span><span class="bg-yellow" style="display:block; width: 80%; float: left; height: 7px;"></span></div><div><span style="display:block; width: 20%; float: left; height: 20px; background: #222d32"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div></a><p class="text-center no-margin">Yellow</p></li><li style="float:left; width: 33.33333%; padding: 5px;"><a href="javascript:void(0)" data-skin="skin-blue-light" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover"><div><span style="display:block; width: 20%; float: left; height: 7px; background: #367fa9"></span><span class="bg-light-blue" style="display:block; width: 80%; float: left; height: 7px;"></span></div><div><span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div></a><p class="text-center no-margin" style="font-size: 12px">Blue Light</p></li><li style="float:left; width: 33.33333%; padding: 5px;"><a href="javascript:void(0)" data-skin="skin-black-light" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover"><div style="box-shadow: 0 0 2px rgba(0,0,0,0.1)" class="clearfix"><span style="display:block; width: 20%; float: left; height: 7px; background: #fefefe"></span><span style="display:block; width: 80%; float: left; height: 7px; background: #fefefe"></span></div><div><span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div></a><p class="text-center no-margin" style="font-size: 12px">Black Light</p></li><li style="float:left; width: 33.33333%; padding: 5px;"><a href="javascript:void(0)" data-skin="skin-purple-light" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover"><div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-purple-active"></span><span class="bg-purple" style="display:block; width: 80%; float: left; height: 7px;"></span></div><div><span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div></a><p class="text-center no-margin" style="font-size: 12px">Purple Light</p></li><li style="float:left; width: 33.33333%; padding: 5px;"><a href="javascript:void(0)" data-skin="skin-green-light" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover"><div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-green-active"></span><span class="bg-green" style="display:block; width: 80%; float: left; height: 7px;"></span></div><div><span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div></a><p class="text-center no-margin" style="font-size: 12px">Green Light</p></li><li style="float:left; width: 33.33333%; padding: 5px;"><a href="javascript:void(0)" data-skin="skin-red-light" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover"><div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-red-active"></span><span class="bg-red" style="display:block; width: 80%; float: left; height: 7px;"></span></div><div><span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div></a><p class="text-center no-margin" style="font-size: 12px">Red Light</p></li><li style="float:left; width: 33.33333%; padding: 5px;"><a href="javascript:void(0)" data-skin="skin-yellow-light" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover"><div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-yellow-active"></span><span class="bg-yellow" style="display:block; width: 80%; float: left; height: 7px;"></span></div><div><span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div></a><p class="text-center no-margin" style="font-size: 12px">Yellow Light</p></li></ul></div></div>
      <!-- /.tab-pane -->

      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked="">
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked="">
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked="">
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked="">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
    </div>
    </div>
  </aside>


  <div id="table-wrapper">
        <div id="table-scroll">
            <div id="table-scroll">
                <table>
                    <thead>
                        <tr>
                            <th><span class="text">A</span></th>
                            <th><span class="text">B</span></th>
                            <th><span class="text">C</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr> <td>1, 0</td> <td>2, 0</td> <td>3, 0</td> </tr>
                        <tr> <td>1, 1</td> <td>2, 1</td> <td>3, 1</td> </tr>
                        <tr> <td>1, 2</td> <td>2, 2</td> <td>3, 2</td> </tr>
                        <tr> <td>1, 3</td> <td>2, 3</td> <td>3, 3</td> </tr>
                        <tr> <td>1, 4</td> <td>2, 4</td> <td>3, 4</td> </tr>
                        <tr> <td>1, 5</td> <td>2, 5</td> <td>3, 5</td> </tr>
                        <tr> <td>1, 6</td> <td>2, 6</td> <td>3, 6</td> </tr>
                        <tr> <td>1, 7</td> <td>2, 7</td> <td>3, 7</td> </tr>
                        <tr> <td>1, 8</td> <td>2, 8</td> <td>3, 8</td> </tr>
                        <tr> <td>1, 9</td> <td>2, 9</td> <td>3, 9</td> </tr>
                        <tr> <td>1, 10</td> <td>2, 10</td> <td>3, 10</td> </tr>
                        <!-- etc... -->
                        <tr> <td>1, 99</td> <td>2, 99</td> <td>3, 99</td> </tr>
                    </tbody>
                </table>
        </div>
      </div>

      <style>
      #table-wrapper {
  position:relative;
}
#table-scroll {
  height:150px;
  overflow:auto;
  margin-top:20px;
}
#table-wrapper table {
  width:100%;

}
#table-wrapper table * {
  background:yellow;
  color:black;
}
#table-wrapper table thead th .text {
  position:absolute;
  top:-20px;
  z-index:2;
  height:20px;
  width:35%;
  border:1px solid red;
}
      </style>


<script>
    $("#notification-button").click(function () {
        $(".menu").slideToggle();

    });
</script>

@stop
