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

@stop
