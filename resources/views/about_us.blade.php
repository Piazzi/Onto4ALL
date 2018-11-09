@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')


@stop

@section('content')




<!-- Construct the box with style you want. Here we are using box-danger -->
<!-- Then add the class direct-chat and choose the direct-chat-* contexual class -->
<!-- The contextual class should match the box, so we are using direct-chat-danger -->
<div class="box box-danger direct-chat direct-chat-danger menu">
    <div class="box-header with-border">
      <h3 class="box-title">Direct Chat</h3>
      <div class="box-tools pull-right">
        <span data-toggle="tooltip" title="3 New Messages" class="badge bg-red">3</span>
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
                    <div class="callout callout-info">
                        <h4>I am an info callout!</h4>

                        <p>Follow the steps to continue to payment.</p>
                    </div>
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

  <a id="notification-button"class="btn btn-app">
    <span class="badge bg-yellow">Clique Aqui</span>
    <i class="fa fa-bullhorn"></i> Dicas
</a>

<script>
    $("#notification-button").click(function () {
        $(".menu").slideToggle();

    });
</script>

@stop
