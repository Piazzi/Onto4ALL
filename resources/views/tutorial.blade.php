@extends('adminlte::page')

<style>
.credits-section{padding:20px}
.credits-section img{padding-top:20px;padding-bottom:5px}
.credits-section td{padding-right:20px;}
.credits-table{text-align: center;}
.ufjf-logo{text-align:center; padding-top:150px}
</style>

@section('title', 'AdminLTE')

@section('content_header')
    <h1>
        Tutorial
        <small>{{__('Learn how to use the editor')}}</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home', app()->getLocale())}}"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">Tutorial</li>
    </ol>

@stop

@section('content')
    <div class="box box-solid">
        <div class="box-header with-border">
            <i class="fa fa-text-width"></i>

            <h3 class="box-title">{{__('Summary')}}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <ol>
                <a href="#intro">
                    <li>{{__('What is the Onto4ALL Editor?')}}</li>
                </a>
                <a href="#conceitos-basicos"><li>{{__('Basic Concepts')}}</li></a>
                <ol>
                    <a href="#class"><li>{{__('Class')}}</li></a>
                    <a href="#relations"><li>{{__('Relation')}}</li></a>
                    <a href="#properties"><li>{{__('Propriedades')}}</li></a>
                    <a href="#colors"><li>{{__('Colors')}}</li></a>
                    <a href="#import"><li>{{__('Import')}}</li></a>
                </ol>
                </li>

                <a href="#interface-do-editor"><li>{{__('Editor Interface')}}</li></a>
                <ol>
                    <a href="#diagram"><li>{{__('Diagram')}}</li></a>
                    <a href="#rules"><li>{{__('Tips Tab')}}</li></a>
                    <a href="#warnings-console"><li>{{__('Warnings Console')}}</li></a>
                    <a href="#methodology"><li>{{__('Methodology Tab')}}</li></a>
                </ol>
                </li>

                <a href="#ontology-management"><li>{{__('Ontology Manager')}}</li></a>
                <ol>
                    <a href="#ontologies"><li>{{__('My Ontologies')}}</li></a>
                    <a href="#favorite-ontologies"><li>{{__('Favourite Ontologies')}}</li></a>
                    <a href="#actions"><li>{{__('Actions')}}</li></a>
                </ol>
                </li>
                <!--<a href="#profile"><li></li></a>-->
                <a href="#examples"><li>{{__('Examples')}}</li></a>
                <a href="#shortcuts"><li>{{__('Keyboard shortcuts')}} </li></a>
                <a href="#stack"><li>{{__('Tools used')}}</li></a>
                <a href="#credits"><li>{{__('Credits')}}</li></a>
            </ol>
        </div>
        <!-- /.box-body -->
    </div>

    <div id="intro" class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">{{__('What is the Onto4ALL Editor?')}}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <dl>
                <dd>
                    {{__('Is a free graphical editor capable of creating, editing and exporting ontologies being guided by an warnings console, an ontological building rules tab and an extensive palette of ontological classes and relationships.')}}
                </dd>
                <dd>
                    {{__('Export your ontology to OWL, XML or SVG')}}
                </dd>
            </dl>
        </div>
        <!-- /.box-body -->
    </div>

    <h2 id="conceitos-basicos">{{__('Basic Concepts')}}</h2>
    <div id="class" class="box box-solid">
        <div class="box-header with-border">
            <i class="fa fa-text-width"></i>

            <h3 class="box-title">{{__('Class')}}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <dl>
                <dd>{{__('In Onto4All, the class is defined by the circle contained within the ontology palette.')}}</dd>
                <div class="row">
                    <div class="col-md-6">
                        <img alt="class image" src="{{asset('css/images/class.png')}}">
                    </div>
                    <div class="col-md-6">
                        <ul>
                            <li>{{__('It represents the class of an ontology itself.')}}</li>
                            <li>{{__('It is possible to name it by double clicking inside it')}}
                                <br>
                                <span class="label-danger">{{__('Attention: If you want to export your ontology to OWL and import it in another editor we recommend you not to put spaces in the names of classes and relations, just use upper and lower case letters, underlines, and numbers from 0 to 9 to avoid any import errors. If you are only using our editor for building your ontology you can ignore this warning')}}</span></li>
                            <p>
                                {{__('Examples')}}:
                                <span class="label-success" style="background-color:#00c0ef !important">{{__('PepperoniPizza, AutomaticCar, Pepperoni_Pizza, Automatic_Car')}}</span>
                            </p>
                            <li>{{__('You can expand its size by hovering your mouse over the circle and pulling its edge.')}} </li>
                            <li>{{__('It is possible to change the colors (the interior and the border).')}} </li>
                            <li>{{__('It is possible to link it to other classes using the')}} <a href="#relations">{{__('Relations')}}</a>.</li>
                            <li>{{__('You can access its properties by selecting the class and pressing')}}<strong>CTRL+M</strong>{{__('or by clicking on it with the right mouse button and selecting the option')}}<strong>{{__('Edit Properties')}}</strong>{{__('If you hover your mouse over the class it will also show their properties.')}}</li>
                            <li>{{__('It is possible to throw it into the diagram just by clicking on its symbol in the ontology palette')}}</li>
                            <li>{{__('Clicking with the right mouse button over a class will bring up a menu with several options')}}</li>
                        </ul>
                    </div>
                </div>
            </dl>
        </div>
        <!-- /.box-body -->
    </div>

    <div id="relations" class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">{{__('Relation')}}</h3>
        </div>
        <div class="box-body">
            <dd>{{__('In ontologies, relationships between classes specify how they are related to other classes of ontology.')}} </dd>
            <dd>{{__('Much of the practicality of ontologies comes from its ability to describe relationships.')}} </dd>
                <div class="row">
                    <div class="col-md-6">
                        <ul>
                            <li>{{__('In Onto4All, there are several types of relationships, which are found in the ontology palette, to the left of the main screen.')}}</li>
                            <li>{{__('One of the main types of relationships are:')}} <i>is_a</i>, <i>part_of</i>, <i>has_part</i>, <i>contains</i>, <i>instance_of</i> </li>
                            <li>{{__('It is possible to create a new relationship between two classes and name it manually by double clicking on any relationship and writing the new name, we recommend using the relationship')}}<i>new_relation</i> {{__('for this.')}} </li>
                            <li>{{__('For a relationship to work in the editor you need to connect it in two classes. If you do not connect correctly, the')}} <a href="#warnings-console">{{__('Warnings Console')}}</a> {{__('')}}</li>
                            <li>{{__('It is possible to invert the direction of a relationship by clicking on it with the right mouse button and selecting')}} <strong>{{__('Reverse')}}</strong></li>
                            <li>{{__('You can select other options from the list by right clicking on it, such as editing properties, deleting, duplicating or copying it.')}}</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <img alt="class image" src="{{asset('css/images/relations.png')}}">
                    </div>
                </div>
        </div>
    </div>

    <div id="properties" class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">{{__('Properties')}}</h3>
        </div>
        <div class="box-body">
            <dd>{{__('In Onto4All, each element of the ontology palette has properties, which can be viewed and edited.')}}</dd>
                <div class="row">
                    <div class="col-md-6">
                        <ul>
                            <li>{{__('To edit the properties of an element, right-click on it and select Edit Properties. You can also access the edit menu for properties of a selected element with the shortcut')}} <strong>Ctlr+M</strong></li>
                            <li>{{__('You can add a new property to an element by scrolling down the properties menu and selecting Add Property.')}}</li>
                            <li>{{__('The first property in the property menu, the ID, corresponds to a unique identifier for each element present in the diagram.')}}</li>
                            <li>{{__('Properties can be used to detail aspects of that element or to annotate, such as properties')}} <i>exampleOfUsage</i>, <i>comments</i>.</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <img alt="class image" src="{{asset('css/images/properties.png')}}">
                    </div>
                </div>
        </div>
    </div>

    <div id="colors" class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">{{__('Colors')}}</h3>
        </div>
        <div class="box-body">
            <dd>{{__('The Onto4ALL tool allows the user to easily customize the colors of the diagram elements.')}}</dd>
                <div class="row">
                    <div class="col-md-6">
                        <ul>
                            <li>{{__('To change the color of a selected element, click on the paint bucket icon to open the color selection menu.')}}</li>
                            <li>{{__('In the color selection menu, select a color through the interface or by entering the hexadecimal code of the desired color.')}}</li>
                            <li>{{__('It is also possible to change the color of the contour lines or the elements themselves')}} <a href="#relations">{{__('Relations')}}</a>, {{__('')}}</li>
                            <li>{{__('In very large ontologies, colors can facilitate the grouping of elements according to given characteristics, to better organize the diagram.')}}</li>
                            <li>{{__('You can customize an element and make it the default for the next elements to be inserted in the diagram. For example, suppose that we want all classes in our ontology to be red with a yellow outline and shadow. To make this class the default, right-click on it and select Set as default style. Or select the class and press CTRL+SHIFT+D')}}</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <img alt="class image" src="{{asset('css/images/colors.png')}}">
                    </div>
                </div>
        </div>
    </div>

    
    <div id="import" class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">{{__('Import')}}</h3>
        </div>
        <div class="box-body">
            <dd>{{__('You can also import ontologies that are already saved on your computer to Onto4All !.')}}</dd>
                <div class="row">
                    <div class="col-md-6">
                        <ul>
                            <li>{{__('Clicking')}} <i>{{__('Import')}}</i>{{__(', no menu')}} <i>{{__('File')}}</i>{{__('')}}</li>
                            <li><span class="label-danger">{{__('When you import a OWL file made by other editors (such as protege), make sure the syntax is correct, otherwise it will cause bugs in the Onto4ALL')}}</span></li>
                            <li><span class="label-info">{{__('Note: .OWL and .OWX files will be automatically converted to .XML and the ontology will be displayed in the editor')}}</span></li>
                            <li><span class="label-warning">{{__('Warning: For .XML files, you can only import .XML files exported by this editor.')}}</span></li>
                            <li>{{__('Once the ontology is loaded, it is possible to edit and save it to your computer again and in the ontology manager.')}}</li>
                            <li>{{__('After editing an imported ontology, it is possible to export it also in the other supported formats (OWL and SVG).')}}</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <img alt="class image" src="{{asset('css/images/importing-ontology.png')}}">
                    </div>
                </div>
        </div>
    </div>

    <h2 id="interface-do-editor">{{__('Editor Interface')}}</h2>

    <div id="diagrama" class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">{{__('Diagram')}}</h3>
        </div>
        <div class="box-body">
            <dd>{{__('When you log in to Onto4All, you will be redirected to the main page: the ontology construction diagram.')}}</dd>
                <div class="row">
                    <div class="col-md-6">
                        <ul>
                            <li>{{__('By clicking the button')}} <strong>{{__('Show/Hide sidebar')}}</strong>{{__(', a tab for additional diagram configurations will be displayed, such as the thickness of the background lines (grid), colors and screen orientation (portrait or landscape).')}}</li>
                            <img class="img-responsive img-max-width" src="{{asset('css/images/diagram-options.png')}}">
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <li>{{__('This tab will also show you several options if you select any element on the diagram')}}</li>
                        <img class="img-responsive img-max-width" src="{{asset('css/images/diagram-options-element.png')}}">
                    </div>
                    <br>
                    <div class="col-md-12">
                        <li>{{__('In the diagram settings bar, just below the navigation bar, there are several tools available, such as viewing options, zoom and insert images.')}}</li>
                        <li><span class="label-info">{{__('If you hover your mouse over each icon it will show you its functionality')}}</span></li>
                        <img class="img-responsive img-max-width" src="{{asset('css/images/interface.PNG')}}">
                    </div>

                </div>
        </div>
    </div>

    <div id="rules" class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">{{__('Tips Tab')}}</h3>
        </div>
        <div class="box-body">
            <dd>{{__('On the right side of the diagram, there is a toolbar, which contains notes that help the user to manipulate the tools of Onto4All.')}}</dd>
                <div class="row">
                    <div class="col-md-6">
                        <ul>
                            <li>{{__('Initially, the user has access to classes and relations BFO, IAO, IOF')}} </li>
                            
                            <li>{{__('Through the search field in the tip bar, it is possible to find rules related to a specific element, by typing its name.')}}</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <img alt="class image" src="{{asset('css/images/rule1.png')}}">
                    </div>
                </div>
        </div>
    </div>

    
    <div id="warnings-console" class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">{{__('Warnings Console')}}</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                        <p>{{__('The warnings console is the way our editor tells you good modeling practices you should implement when building a ontology.This console will show you warnings that will help you build a better ontology.')}}
                            <a target="_blank" href="{{route('warningIndex', app()->getLocale())}}">{{__('Click here')}}</a>
                            {{__('to see all the warnings our console track. We will be updating this console with more warnings in the future,')}}
                            <a href="{{route('help', app()->getLocale())}}">{{__('contact us')}}</a>
                            {{__('if you had any problem with this feature.')}}
                        </p>
                    <img class="img-max-width"  src="{{asset('css/images/warningConsole.png')}}">
                    <p>
                        {{__('Here you can see that the pizza ontology have several warnings that need to be solved.')}}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div id="methodology" class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">{{__('Methodology')}}</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <p>
                        {{__('OntoForInfoScience is a detailed methodology for construction of ontologies that details each step of the ontology development cycle. The goal of such methodology is to enable experts in Knowledge Organization to overcome the technical jargon difficulties, as well as logical and philosophical issues that involve the ontology development (Mendonça, 2016).The methodology OntoForInfoScience consists of nine phases:')}}
                    </p>
                    <p>
                        <strong>
                            {{__('We strongly recommend that you use this methodology when building your ontologies.')}}
                        </strong>
                    </p>
                    <p>
                        {{__('You can check the progress of your ontology by clicking on the boxes for each completed step.')}}
                    </p>
                    <ul>
                        <li>
                            1) {{__('Specification of the ontology')}}
                        </li>
                        <li>
                            2) {{__('Acquisition and extraction of knowledge')}}
                        </li>
                        <li>
                            3) {{__('Conceptualization')}}
                        </li>
                        <li>
                            4) {{__('Ontological grounding')}}
                        </li>
                        <li>
                            5) {{__('Formalization of the ontology')}}
                        </li>
                        <li>
                            6) {{__('Evaluation of the ontology')}}
                        </li>
                        <li>
                            7) {{__('Documentation')}}
                        </li>
                        <li>
                            8) {{__('Publication of the ontology')}}
                        </li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <img class="img-max-width"  src="{{asset('css/images/methodology-tab.PNG')}}">
                </div>
            </div>
        </div>
    </div>

    <h2 id="ontology-management">{{__('Ontology Manager')}}</h2>

    <div id="ontologies" class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">{{__('My Ontologies')}}</h3>
        </div>
        <div class="box-body">
            <dd>{{__('The ontology page can be accessed through the navigation bar at the top of the page, by clicking on')}} <strong>{{__('My Ontologies')}}</strong>.</dd>
                <div class="row">
                    <div class="col-md-12">
                        <ul>
                            <li>{{__('This page will display your 10 most recent ontologies')}}.</li>
                            <li>{{__('When you click on the details icon of an ontology, you will be redirected to a page where more detailed information of that ontology will be displayed, such as the scope of the ontology, its degree of formality, its purpose, etc.')}}</li>
                        </ul>
                    </div>
                    <div class="col-md-12">
                        <img alt="class image" src="{{asset('css/images/your-ontologies.png')}}">
                    </div>
                </div>
        </div>
    </div>

    <div id="favorite-ontologies" class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">{{__('Favourite Ontologies')}}</h3>
        </div>
        <div class="box-body">
            <dd>{{__('Also on the ontologies page, there is the Favorite Ontologies section.')}}</dd>
                <div class="row">
                    <div class="col-md-6">
                        <ul>
                            <li>{{__('In the list of ontologies, when clicking on the')}} <strong>{{__('favourite')}}</strong> {{__('(star), you will bookmark your ontology. You can bookmark up to 5 ontologies.')}}</li>
                            <li>{{__('Favorite ontologies will be in evidence, being easier to find on the ontologies page. And they will not be deleted if you exceed the limit of 10 ontologies')}}</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <img alt="class image" src="{{asset('css/images/favorite-ontologies.png')}}">
                    </div>
                </div>
        </div>
    </div>

    <div id="actions" class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">{{__('Actions')}}</h3>
        </div>
        <div class="box-body">
            <dd>{{__('In both sections on the ontology page')}} (<a href="#ontologies">{{__('My Ontologies')}}</a> , <a href="favorite-ontologies">{{__('Favourite Ontologies')}}</a>),
            {{__('there are several icons that represent possible actions in relation to ontology.')}}</dd>
                <div class="row">
                    <div class="col-md-6">
                        <ul>
                            <li>{{__('The first two icons are for downloading the ontology: the first in XML format and the second in OWL format.')}}</li>
                            <li>{{__('The second icon, already mentioned, redirects to the individual page of the ontology')}}.</li>
                            <li>{{__('The star icon, already shown, makes the ontology go to the favorite ontology section')}}.</li>
                            <li>{{__('The edit icon, represented by the pencil, allows the user to edit the ontology information. Attention! This icon represents the function of editing only basic information and details of the purpose and use of the ontology, and not of the ontology itself. To edit the structure of the ontology in question, use the diagram!')}}</li>
                            <li>{{__('The last icon, in red, excludes the ontology.')}}</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <img alt="class image" src="{{asset('css/images/icons.png')}}">
                    </div>
                </div>
        </div>
    </div>

    <!--
    <h2 id="#">Perfil</h2>

    <div id="profile" class="box box-solid">
        <div class="box-body">
            <dd>Através da barra de navegação, pode-se chegar à página de perfil do usuário.</dd>
                <div class="row">
                    <div class="col-md-6">
                        <ul>
                            <li>Nesta página são exibidas as informações pessoais do perfil, como foto de perfil, nome e email.</li>
                            <li>É possível editar essas informações clicando em <strong>Account settings</strong>.</li>
                            <li>Ainda em <strong>Account settings</strong>, é possível alterar a senha do perfil e também deletar o perfil.</li>
                            <li><strong>Atenção!</strong> Ao deletar seu perfil, você perderá todas suas ontologias! Recomendamos fazer download de suas ontologias
                            antes de excluir seu perfil.</li>
                            <li>Nesta página também são mostradas as ontologias favoritadas e as ontologias recentemente editadas.</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <img alt="class image" src="/css/images/profile-info.png">
                    </div>
                </div>
        </div>
    </div>
    -->
    <h2 id="examples">{{__('Examples')}}</h2>

    <div id="example1" class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">{{__('Example')}} #1</h3>
        </div>
        <div class="box-body">
            <dd>{{__('In this example, we have a pizza ontology, which lists different flavors and pizza toppings.')}}</dd>
                <div class="row">
                    <div class="col-md-12">
                        <ul>
                            <li>{{__('In this case, we have a root class called Thing, which gives rise to the two main ones: Pizza and Topping.')}}</li>
                            <li>{{__('We paint the classes in order to organize the related concepts')}}.</li>
                            <li>{{__('We use existing relationships (is_a) and we also name new relationships (hasTopping).')}}</li>
                            <li>{{__('In this example, we used the curved edges feature to make the diagram cleaner')}}.</li>
                        </ul>
                    </div>


                    <div class="col-md-6">
                        <img alt="class image" src="{{asset('css/images/pizza-ontology.svg')}}">
                    </div>
                </div>
        </div>
    </div>

    <div id="example2" class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">{{__('Example')}} #2</h3>
        </div>
        <div class="box-body">
            <dd>{{__('In this other example, we have an ontology that represents the Simpsons family.')}}</dd>
                <div class="row">
                    <div class="col-md-12">
                        <ul>
                            <li>{{__('In this example, we dont have a root class, but the Simpsons family class is the main class of ontology.')}}</li>
                            <li>{{__('We left the Simpsons Family class larger than the others and in the center, making the ontology more intuitive.')}}</li>
                            <li>{{__('Once again, we painted the classes in order to organize the concepts and created new relationships that express the formulated concepts.')}}</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <img alt="class image" src="{{asset('css/images/simpsonsontology.svg')}}">
                    </div>
                </div>
        </div>
    </div>

    <h2 id="shortcuts">{{__('Keyboard shortcuts')}}</h2>

    <div class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">{{__('Keyboard shortcuts')}}</h3>
        </div>
        <div class="box-body">
            <dd>{{__('In Onto4All, there are some keyboard shortcuts that can speed up the execution of some simple tasks.')}}</dd>
                <div class="row">
                    <div class="col-md-6">
                        <ul>
                            <li> <strong>CTRL + M</strong> {{__('displays the properties of the selected element in the diagram.')}}</li>
                            <li> <strong>CTRL + S</strong> {{__('saves and downloads the ontology, in XML format.')}}</li>
                            <li> <strong>CTRL + Z</strong> {{__('undoes the users last action on the diagram.')}}</li>
                            <li> <strong>CTRL + Y</strong> {{__('redoes the users last action on the diagram.')}}</li>
                            <li> <strong>CTRL +, CTRL - </strong>{{__(', control the zoom level on the screen.')}} <strong>CTRL + H</strong> {{__('you can zoom back to the default (100%).')}}</li>
                            <li>{{__('To know all the editors shortcuts, look at the right side of the menus, there will be the indication of each shortcut. Hovering over icons will also show your shortcut.')}}</li>

                        </ul>
                    </div>
                    <div class="col-md-6">
                        <img alt="class image" src="{{asset('css/images/shortcuts.png')}}">
                    </div>
                </div>
        </div>
    </div>

    <h2 id="stack">{{__('Tools used')}}</h2>

    <div class="box box-solid">
        <div class="box-body">
            <dd>{{__('In the development of Onto4All, several technologies and tools were used.')}}</dd>
            <div class="row">
                <div class="col-lg-4 col-md-6 text-center">
                    <div class="mt-5">
                        <img alt="laravel" src="{{asset('css/images/Landing-Page/laravel.png')}}">

                    </div>
                </div>
                <div class="col-lg-4 col-md-6 text-center">
                    <div class="mt-5">
                        <img alt="mxgraph" src="{{asset('css/images/Landing-Page/mxgraph.png')}}">
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 text-center">
                    <div class="mt-5">
                        <img alt="jquery" src="{{asset('css/images/Landing-Page/jquery.png')}}">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <h2 id="credits">{{__('Credits')}}</h2>

    <div class="box box-solid">
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <dd>{{__('Onto4All was developed by')}} <a href="https://github.com/Piazzi/">Lucas Piazzi</a>{{__(', as part of a Scientific Initiation project linked to the Computer Science Department of the Federal University of Juiz de Fora (UFJF), also composed of')}}
                        <a href="professorfabriciomendonca.com.br/">Dr Fabrício Martins Mendonça</a>{{__('(Project Advisor)')}},
                        <a href="https://github.com/carvalhotiago">Tiago Carvalho</a>,<a href="https://github.com/pedroalves4">Pedro Henrique Alves</a>.
                    <div class="credits-section">
                        <table class="credits-table">
                            <tr>
                                <td><img alt="Fabrício Mendonça" src="{{asset('css/images/Landing-Page/Foto (1).png')}}"></td>
                                <td><img alt="Lucas Piazzi" src="{{asset('css/images/Landing-Page/Foto (2).png')}}"></td>
                                <td><img alt="Maurício Almeida" src="{{asset('css/images/Landing-Page/Foto (3).png')}}"></td>
                                <td><img alt="Eduardo Felipe" src="{{asset('css/images/Landing-Page/Foto (4).png')}}"></td>
                            </tr>
                            <tr>
                                <td>Fabrício<br>Mendonça</td>
                                <td>Lucas<br>Piazzi</td>
                                <td>Maurício<br>Almeida</td>
                                <td>Eduardo<br>Feipe</td>
                            </tr>
                            <tr>
                                <td><img alt="Jeanne Emygdio" src="{{asset('css/images/Landing-Page/Foto (5).png')}}"></td>
                                <td><img alt="Larissa Fazza" src="{{asset('css/images/Landing-Page/Foto (6).png')}}"></td>
                                <td><img alt="Guilherme Noronha" src="{{asset('css/images/Landing-Page/Foto (7).png')}}"></td>
                                <td><img alt="Vinicius Corbelli" src="{{asset('css/images/Landing-Page/Foto (8).png')}}"></td>
                            </tr>
                            <tr>
                                <td>Jeanne<br>Emygdio</td>
                                <td>Larissa<br>Fazza</td>
                                <td>Guilherme<br>Noronha</td>
                                <td>Vinicius<br>Corbelli</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="col-md-6 ufjf-logo">
                    <img alt="ufjf" src="{{asset('css/images/Landing-Page/ufjf.png')}}">
                </div>
            </div>

        </div>
    </div>
    
    
@stop

@section('footer')
.
@stop