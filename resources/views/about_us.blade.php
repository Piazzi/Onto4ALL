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
        <div class="tab-content">
          <!-- Home tab content -->
          <div class="tab-pane" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading">Recent Activity</h3>
            <ul class="control-sidebar-menu">
              <li>

              </li>
              <li>

              </li>
              <li>

              </li>
              <li>

              </li>
            </ul>
            <!-- /.control-sidebar-menu -->
          </div>
          <!-- /.tab-pane -->
                <div id="control-sidebar-theme-demo-options-tab" class="tab-pane active">
                        <div class="box box-default collapsed-box box-solid">
                                <div class="box-header with-border">
                                  <h3 class="box-title">Expandable</h3>

                                  <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                    </button>
                                  </div>
                                  <!-- /.box-tools -->
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                  The body of the box
                                </div>
                                <!-- /.box-body -->
                              </div>
                              <div class="box box-default collapsed-box box-solid">
                                    <div class="box-header with-border">
                                      <h3 class="box-title">Expandable</h3>

                                      <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                        </button>
                                      </div>
                                      <!-- /.box-tools -->
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                      The body of the box
                                    </div>
                                    <!-- /.box-body -->
                                  </div>
                                  <div class="box box-default collapsed-box box-solid">
                                        <div class="box-header with-border">
                                          <h3 class="box-title">Expandable</h3>

                                          <div class="box-tools pull-right">
                                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                            </button>
                                          </div>
                                          <!-- /.box-tools -->
                                        </div>
                                        <!-- /.box-header -->
                                        <div class="box-body">
                                          The body of the box
                                        </div>
                                        <!-- /.box-body -->
                                      </div>
                                      <!-- Construct the box with style you want. Here we are using box-danger -->
<!-- Then add the class direct-chat and choose the direct-chat-* contexual class -->
<!-- The contextual class should match the box, so we are using direct-chat-danger -->

<div class="box box-success direct-chat direct-chat-success menu">
        <div class="box-header with-border">
        <h3 class="box-title"></h3>
          <div class="box-tools pull-right">
            <span data-toggle="tooltip" title="Need help?" class="badge bg-green">Need help?</span>
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <!-- In box-tools add this button if you intend to use the contacts pane -->
            <button class="btn btn-box-tool" data-toggle="tooltip" title="Contacts" data-widget="chat-pane-toggle"><i class="fa fa-comments"></i></button>
            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <!-- Conversations are loaded here -->

          <div class="direct-chat-messages">
            <!-- Message. Default to the left -->



          </div>
          <!--/.direct-chat-messages-->

          <!-- Contacts are loaded here -->
          <div class="direct-chat-contacts">
            <ul class="contacts-list">
              <li>
                <a href="#">
                  <div class="contacts-list-info">
                    <span class="contacts-list-name">
                        <div class="callout callout-info">
                            <h4>I am an info callout!</h4>
                            <p>Follow the steps to continue to payment.</p>
                        </div>
                  </div>
                  <!-- /.contacts-list-info -->
                </a>
              </li>
              <!-- End Contact Item -->
            </ul>
            <!-- /.contatcts-list -->
          </div>
          <!-- /.direct-chat-pane -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <div class="input-group">

          </div>
        </div>
        <!-- /.box-footer-->
      </div>
      <!--/.direct-chat -->


      </div>
<!-- Construct the box with style you want. Here we are using box-danger -->
<!-- Then add the class direct-chat and choose the direct-chat-* contexual class -->
<!-- The contextual class should match the box, so we are using direct-chat-danger -->

<div class="box box-success direct-chat direct-chat-success menu">
        <div class="box-header with-border">
        <h3 class="box-title"></h3>
          <div class="box-tools pull-right">
            <span data-toggle="tooltip" title="Need help?" class="badge bg-green">Need help?</span>
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <!-- In box-tools add this button if you intend to use the contacts pane -->
            <button class="btn btn-box-tool" data-toggle="tooltip" title="Contacts" data-widget="chat-pane-toggle"><i class="fa fa-comments"></i></button>
            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <!-- Conversations are loaded here -->

          <div class="direct-chat-messages">
            <!-- Message. Default to the left -->



          </div>
          <!--/.direct-chat-messages-->

          <!-- Contacts are loaded here -->
          <div class="direct-chat-contacts">
            <ul class="contacts-list">
              <li>
                <a href="#">
                  <div class="contacts-list-info">
                    <span class="contacts-list-name">
                        <div class="callout callout-info">
                            <h4>I am an info callout!</h4>
                            <p>Follow the steps to continue to payment.</p>
                        </div>
                  </div>
                  <!-- /.contacts-list-info -->
                </a>
              </li>
              <!-- End Contact Item -->
            </ul>
            <!-- /.contatcts-list -->
          </div>
          <!-- /.direct-chat-pane -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <div class="input-group">

          </div>
        </div>
        <!-- /.box-footer-->
      </div>
      <!--/.direct-chat -->


      </div>



                </div>
          <!-- Settings tab content -->
          <div class="tab-pane" id="control-sidebar-settings-tab">

              <h3 class="control-sidebar-heading">General Settings</h3>


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
      </aside>


<!-- Construct the box with style you want. Here we are using box-danger -->
<!-- Then add the class direct-chat and choose the direct-chat-* contexual class -->
<!-- The contextual class should match the box, so we are using direct-chat-danger -->

<div class="box box-success direct-chat direct-chat-success menu">
    <div class="box-header with-border">
    <h3 class="box-title"></h3>
      <div class="box-tools pull-right">
        <span data-toggle="tooltip" title="Need help?" class="badge bg-green">Need help?</span>
        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <!-- In box-tools add this button if you intend to use the contacts pane -->
        <button class="btn btn-box-tool" data-toggle="tooltip" title="Contacts" data-widget="chat-pane-toggle"><i class="fa fa-comments"></i></button>
        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
      </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <!-- Conversations are loaded here -->

      <div class="direct-chat-messages">
        <!-- Message. Default to the left -->



      </div>
      <!--/.direct-chat-messages-->

      <!-- Contacts are loaded here -->
      <div class="direct-chat-contacts">
        <ul class="contacts-list">
          <li>
            <a href="#">
              <div class="contacts-list-info">
                <span class="contacts-list-name">
                    <div class="callout callout-info">
                        <h4>I am an info callout!</h4>
                        <p>Follow the steps to continue to payment.</p>
                    </div>
              </div>
              <!-- /.contacts-list-info -->
            </a>
          </li>
          <!-- End Contact Item -->
        </ul>
        <!-- /.contatcts-list -->
      </div>
      <!-- /.direct-chat-pane -->
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
      <div class="input-group">

      </div>
    </div>
    <!-- /.box-footer-->
  </div>
  <!--/.direct-chat -->


  </div>

<script>
    $("#notification-button").click(function () {
        $(".menu").slideToggle();

    });
</script>

@stop
