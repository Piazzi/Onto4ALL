@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')

<script src="js/teste.js"></script>
@stop

@section('content')
    <button id="target">Clique aqui</button>

  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.12.4.js"></script>
  <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<button id="opener">open the dialog</button>
<div id="dynamicList" class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-check"></i> Mensagem</h4>
        <strong>IHAA</strong>
    </div>

<script>


 $(function popup() {
                                $( "#dynamicList" ).dialog({ autoOpen: false });
                                $( "#opener" ).click(function() {
                                $( "#dynamicList" ).dialog( "open" );
                                });

    })


</script>

</body>
</html>


<!-- Construct the box with style you want. Here we are using box-danger -->
<!-- Then add the class direct-chat and choose the direct-chat-* contexual class -->
<!-- The contextual class should match the box, so we are using direct-chat-danger -->
<div class="box box-danger direct-chat direct-chat-danger">
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
        <div class="direct-chat-msg">
          <div class="direct-chat-info clearfix">
            <span class="direct-chat-name pull-left">Alexander Pierce</span>
            <span class="direct-chat-timestamp pull-right">23 Jan 2:00 pm</span>
          </div>
          <!-- /.direct-chat-info -->
          <img class="direct-chat-img" src="../dist/img/user1-128x128.jpg" alt="message user image">
          <!-- /.direct-chat-img -->
          <div class="direct-chat-text">
            Is this template really for free? That's unbelievable!
          </div>
          <!-- /.direct-chat-text -->
        </div>
        <!-- /.direct-chat-msg -->

        <!-- Message to the right -->
        <div class="direct-chat-msg right">
          <div class="direct-chat-info clearfix">
            <span class="direct-chat-name pull-right">Sarah Bullock</span>
            <span class="direct-chat-timestamp pull-left">23 Jan 2:05 pm</span>
          </div>
          <!-- /.direct-chat-info -->
          <img class="direct-chat-img" src="../dist/img/user3-128x128.jpg" alt="message user image">
          <!-- /.direct-chat-img -->
          <div class="direct-chat-text">
            You better believe it!
          </div>
          <!-- /.direct-chat-text -->
        </div>
        <!-- /.direct-chat-msg -->
      </div>
      <!--/.direct-chat-messages-->

      <!-- Contacts are loaded here -->
      <div class="direct-chat-contacts">
        <ul class="contacts-list">
          <li>
            <a href="#">
              <img class="contacts-list-img" src="../dist/img/user1-128x128.jpg" alt="Contact Avatar">
              <div class="contacts-list-info">
                <span class="contacts-list-name">
                  Count Dracula
                  <small class="contacts-list-date pull-right">2/28/2015</small>
                  </span>
                <span class="contacts-list-msg">How have you been? I was...</span>
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
        <input type="text" name="message" placeholder="Type Message ..." class="form-control">
        <span class="input-group-btn">
                  <button type="button" class="btn btn-danger btn-flat">Send</button>
                  </span>
      </div>
    </div>
    <!-- /.box-footer-->
  </div>
  <!--/.direct-chat -->


  <div id="modal" class="box box-success box-solid">
    <div class="box-header with-border">
      <h3 class="box-title">Removable</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
      </div>
      <!-- /.box-tools -->
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      The body of the box
    </div>
    <!-- /.box-body -->
  </div>

  <div id="modal2" class="box box-success box-solid">
    <div class="box-header with-border">
      <h3 class="box-title">Dicas</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
      </div>
      <!-- /.box-tools -->
    </div>
    <!-- /.box-header -->
    <div class="box-body">
     Selecione e Aperte CTRL + M para mostrar as propriedades da classe
    </div>
    <!-- /.box-body -->
</div>



@stop
