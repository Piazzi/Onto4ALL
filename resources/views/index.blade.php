@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
<!--tips menu-->
<aside class="control-sidebar control-sidebar-light control-sidebar-open">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
          <li class="active"><a href="#control-sidebar-theme-demo-options-tab" data-toggle="tab"><i class="fa fa-fw fa-archive"></i></a></li>
          <li>
                <div id="searchBar" class="input-group input-group-sm" style="width: 150px;">
                    <input value="" id="search-tip-input" type="text" class="form-control pull-right" placeholder="Search tips">
                    <div class="input-group-btn">
                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                    </div>
                </div>
          </li>
        </ul>
        <!-- Tab panes -->
            <div id="menu-wrapper">
                <div class="tab-content">
                    <div id="menu-scroll">
                    <!-- Home tab content -->
                        <!-- /.tab-pane -->
                        <div id="control-sidebar-theme-demo-options-tab table-search" class="tab-pane active table-search">
                            @foreach($tips_relations as $tips_relation)
                            <div id="tipSearch" class="box box-primary collapsed-box box-solid">
                                <div class="box-header with-border">
                                    <h3 class="box-title">{{$tips_relation->name}}</h3>
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <dl>
                                        <dt>Description</dt>
                                        <dd>{{$tips_relation->description}}</dd>
                                        <dt>Domain</dt>
                                        <dd>{{$tips_relation->domain}}</dd>
                                        <dt>Range</dt>
                                        <dd>{{$tips_relation->range}}</dd>
                                        <dt>Example Of Usage</dt>
                                        <dd>{{$tips_relation->example_of_usage}}</dd>
                                        <dt>Imported From</dt>
                                        <dd><a href="{{$tips_relation->imported_from}}">{{$tips_relation->imported_from}}</a></dd>
                                    </dl>
                                </div>
                            </div>
                            @endforeach
                            @foreach ($tips_class as $tip_class)
                            <div id="tipSearch" class="box box-success collapsed-box box-solid">
                                <div class="box-header with-border">
                                    <h3 class="box-title">{{$tip_class->name}}</h3>
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <dl>
                                        <dt>Description</dt>
                                        <dd>{{$tip_class->description}}</dd>
                                        <dt>SuperClass</dt>
                                        <dd>{{$tip_class->superclass}}</dd>
                                        <dt>Synomyms</dt>
                                        <dd>{{$tip_class->synonyms}}</dd>
                                        <dt>Example Of Usage</dt>
                                        <dd>{{$tip_class->example_of_usage}}</dd>
                                        <dt>Imported From</dt>
                                        <dd><a href="{{$tip_class->imported_from}}">{{$tips_relation->imported_from}}</a></dd>
                                    </dl>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    <!-- Settings tab content -->
                    </div>
                </div>
            </div>
</aside>
<!-- /.tips menu -->

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
<script defer type="text/javascript" src="js/SearchTip.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>


<!-- DICAS -->

@component('warning')
    @slot('title')
        <strong>Importante</strong>
    @endslot
        Aperte <strong>CTRL + S </strong> para baixar sua ontologia!
@endcomponent

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
    Bem-vindo ao Onto4ALL
    @endslot
    Me feche para ver mais dicas ou <strong><a>CLIQUE AQUI</a></strong> para esconder as dicas
@endcomponent

@slot('warning')
    @slot('title')
        aaa
    @endslot
    sasas
@endslot

<!-- /.DICAS -->

<a id="notification-button" class="btn btn-app">
    <span class="badge bg-yellow">Clique Aqui</span>
    <i class="fa fa-bullhorn"></i> Dicas
</a>

<a id="sidebar-control"  class="btn btn-app">
    <span class="badge bg-green">Clique aqui</span>
    <i style="margin-left: 20px;" class="fa fa-fw fa-arrows-v"></i> Sidebar
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
        $("#warning").slideToggle();
    });

    setTimeout(function(){
    $('.loading-screen').remove();
    }, 2500)

    /*
    $(".ExportButton").click(function(e) {
        let xml = mxUtils.getXml(this.editor.getGraphXml());
        console.log(xml);

        if(window.navigator && window.navigator.msSaveBlob)
        {
            e.preventDefault();
            navigator.msSaveBlob(new Blob([xml], {type:'application/xml'}), "teste.xml")
        }
        else
        {
            $(this).attr("href","data:application/xml,"+ encodeURIComponent(xml));
        }
    })
    */
</script>


@stop
