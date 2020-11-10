@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    
@stop

@section('content')

    <script type="text/javascript" src="{{asset('js/OpenOntology.js')}}"></script>

    <!-- MxGraph -->
    <script type="text/javascript" src="{{asset('grapheditor/js/Init.js')}}"></script>
    <script type="text/javascript" src="{{asset('grapheditor/deflate/pako.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('grapheditor/deflate/base64.js')}}"></script>

    <script type="text/javascript" src="{{asset('grapheditor/jscolor/jscolor.js')}}"></script>
    <script type="text/javascript" src="{{asset('grapheditor/sanitizer/sanitizer.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('grapheditor/js/mxClient.js')}}"></script>
    <script type="text/javascript" src="{{asset('grapheditor/js/EditorUi.js')}}"></script>
    <script type="text/javascript" src="{{asset('grapheditor/js/Editor.js')}}"></script>
    <script type="text/javascript" src="{{asset('grapheditor/js/SidebarO4A.js')}}"></script>
    <script type="text/javascript" src="{{asset('grapheditor/js/Graph.js')}}"></script>
    <script type="text/javascript" src="{{asset('grapheditor/js/Format.js')}}"></script>
    <script type="text/javascript" src="{{asset('grapheditor/js/Shapes.js')}}"></script>
    <script type="text/javascript" src="{{asset('grapheditor/js/Actions.js')}}"></script>
    <script type="text/javascript" src="{{asset('grapheditor/js/Menus.js')}}"></script>
    <script type="text/javascript" src="{{asset('grapheditor/js/Toolbar.js')}}"></script>
    <script type="text/javascript" src="{{asset('grapheditor/js/Dialogs.js')}}"></script>

    <!-- Search Script <script defer type="text/javascript" src="js/SearchTip.js"></script> -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js" integrity="sha384-NaWTHo/8YCBYJ59830LTz/P4aQZK1sS0SneOgAvhsIl3zBu8r9RevNg5lHCHAuQ/" crossorigin="anonymous"></script>


    <script type="text/javascript">
        // Extends EditorUi to update I/O action states based on availability of backend
        (function () {
            var editorUiInit = EditorUi.prototype.init;

            EditorUi.prototype.init = function () {
                editorUiInit.apply(this, arguments);
                this.actions.get('export').setEnabled(false);

                // Updates action states which require a backend
                if (!Editor.useLocalStorage) {
                    mxUtils.post(OPEN_URL, '', mxUtils.bind(this, function (req) {
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
            mxUtils.getAll([bundle, STYLE_PATH + '/default.xml'], function (xhr) {
                // Adds bundle text to resources
                mxResources.parse(xhr[0].getText());

                // Configures the default graph theme
                var themes = new Object();
                themes[Graph.prototype.defaultThemeName] = xhr[1].getDocumentElement();

                // Main
                new EditorUi(new Editor(urlParams['chrome'] == '0', themes));
            }, function () {
                document.body.innerHTML = '<center style="margin-top:10%;">Error loading resource files. Please check browser console.</center>';
            });
        })();
    </script>

    
    <!-- ONTO4ALL MODIFICATIONS -->


@stop

