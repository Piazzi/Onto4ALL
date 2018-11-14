@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')

<aside class="control-sidebar control-sidebar-light control-sidebar-open">
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
                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            <input type="checkbox" data-controlsidebar="control-sidebar-open" class="pull-right"> Toggle Right Sidebar Slide
                        </label>
                        <p>Toggle between slide over content and push content effects</p>
                    </div>
                </li>
                <li>
                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            <input type="checkbox" data-sidebarskin="toggle" class="pull-right"> Toggle Right Sidebar Skin
                        </label>
                        <p>Toggle between dark and light skins for the right sidebar</p>
                    </div>
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
                @foreach($menus as $menu)
                <div class="box box-default collapsed-box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{$menu->title}}</h3>
                        <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                        </button>
                        </div>
                    </div>
                    <div class="box-body">
                    {{$menu->description}}
                    </div>
                </div>
                @endforeach
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

<!--
<div class="box loading-screen">
    <div class="box-header">
      <h3 class="box-title"><strong> Loading </strong></h3>
    </div>
    <div class="box-body">
      <strong> Please... Wait </strong>
    </div>
    <div class="overlay">
      <i class="fa fa-refresh fa-spin"></i>
    </div>
</div>
-->
<script>

    setTimeout(function(){
    $('.loading-screen').remove();
    }, 2500)

</script>

@stop

@section('content')
<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=5,IE=9" ><![endif]-->

<head>
    <title>Grapheditor</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" type="text/css" href="css/mxgraph/grapheditor.css">
	<script type="text/javascript">
		// Parses URL parameters. Supported parameters are:
		// - lang=xy: Specifies the language of the user interface.
		// - touch=1: Enables a touch-style user interface.
		// - storage=local: Enables HTML5 local storage.
		// - chrome=0: Chromeless mode.
		var urlParams = (function(url)
		{
			var result = new Object();
			var idx = url.lastIndexOf('?');

			if (idx > 0)
			{
				var params = url.substring(idx + 1).split('&');

				for (var i = 0; i < params.length; i++)
				{
					idx = params[i].indexOf('=');

					if (idx > 0)
					{
						result[params[i].substring(0, idx)] = params[i].substring(idx + 1);
					}
				}
			}

			return result;
		})(window.location.href);

		// Default resources are included in grapheditor resources
		mxLoadResources = false;
	</script>
	<script type="text/javascript" src="js/Init.js"></script>
	<script type="text/javascript" src="js/pako.min.js"></script>
	<script type="text/javascript" src="js/base64.js"></script>
	<script type="text/javascript" src="js/jscolor.js"></script>
	<script type="text/javascript" src="js/sanitizer.min.js"></script>
	<script type="text/javascript" src="js/mxClient.js"></script>
	<script type="text/javascript" src="js/EditorUi.js"></script>
	<script type="text/javascript" src="js/Editor.js"></script>
	<script type="text/javascript" src="js/Sidebar.js"></script>
	<script type="text/javascript" src="js/Graph.js"></script>
	<script type="text/javascript" src="js/Format.js"></script>
	<script type="text/javascript" src="js/Shapes.js"></script>
	<script type="text/javascript" src="js/Actions.js"></script>
	<script type="text/javascript" src="js/Menus.js"></script>
	<script type="text/javascript" src="js/Toolbar.js"></script>
	<script type="text/javascript" src="js/Dialogs.js"></script>
</head>
<body class="geEditor">
	<script type="text/javascript">
		// Extends EditorUi to update I/O action states based on availability of backend
		(function()
		{
			var editorUiInit = EditorUi.prototype.init;

			EditorUi.prototype.init = function()
			{
				editorUiInit.apply(this, arguments);
				this.actions.get('export').setEnabled(false);

				// Updates action states which require a backend
				if (!Editor.useLocalStorage)
				{
					mxUtils.post(OPEN_URL, '', mxUtils.bind(this, function(req)
					{
						var enabled = req.getStatus() != 404;
						this.actions.get('open').setEnabled(enabled || Graph.fileSupport);
						this.actions.get('import').setEnabled(enabled || Graph.fileSupport);
						this.actions.get('save').setEnabled(enabled);
						this.actions.get('saveAs').setEnabled(enabled);
						this.actions.get('export').setEnabled(enabled);
					}));
				}
			};

			// Adds required resources (disables loading of fallback properties, this can only
			// be used if we know that all keys are defined in the language specific file)
			mxResources.loadDefaultBundle = false;
			var bundle = mxResources.getDefaultBundle(RESOURCE_BASE, mxLanguage) ||
				mxResources.getSpecialBundle(RESOURCE_BASE, mxLanguage);

			// Fixes possible asynchronous requests
			mxUtils.getAll([bundle, STYLE_PATH + '/default.xml'], function(xhr)
			{
				// Adds bundle text to resources
				mxResources.parse(xhr[0].getText());

				// Configures the default graph theme
				var themes = new Object();
				themes[Graph.prototype.defaultThemeName] = xhr[1].getDocumentElement();

				// Main
				new EditorUi(new Editor(urlParams['chrome'] == '0', themes));
			}, function()
			{
				document.body.innerHTML = '<center style="margin-top:10%;">Error loading resource files. Please check browser console.</center>';
			});
		})();
    </script>
</body>

<!-- MODIFICAÇÕES PARA O SISTEMA -->

<script src="js/Relation.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>




<!-- DICAS -->

@component('tip')
    @slot('title')
        Dica
    @endslot
    Tem alguma dúvida? Acesse nosso <a href="http://localhost:8000/tutorial"> <strong> Tutorial </strong></a>
@endcomponent

@component('tip')
    @slot('title')
    Dica
    @endslot
    Selecione e Aperte <strong> CTRL + M </strong> para mostrar as propriedades da classe
@endcomponent

@component('tip')
    @slot('title')
        Dica
    @endslot
    Clique em uma célula para adicioná-la mais rápido ao diagrama
@endcomponent

@component('tip')
    @slot('title')
    Bem-vindo(a) ao Onto4ALL
    @endslot
    Me feche para ver mais dicas ou <strong><a>CLIQUE AQUI</a></strong> para esconder as dicas
@endcomponent

@slot('warning')
    @slot('title')
        aaa
    @endslot
    sasas
@endslot

<a id="notification-button" class="btn btn-app">
    <span class="badge bg-yellow">Clique Aqui</span>
    <i class="fa fa-bullhorn"></i> Dicas
</a>

<a id="sidebar-control"  class="btn btn-app">
    <span class="badge bg-green">Clique aqui</span>
    <i class="fa fa-fw fa-th-list"></i> Sidebar
</a>

<script>
    $("#sidebar-control").click(function () {
        $('aside').slideToggle();

    });

    $(".texto").click(function () {
        $(".tip").slideToggle();
    });

    $("#notification-button").click(function () {
        $(".tip").slideToggle();
        $(".menu").slideToggle();
    });

</script>


@stop
