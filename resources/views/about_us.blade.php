@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')

@stop

@section('content')

    <div class="box box-primary">
        <div class="box-header ui-sortable-handle" style="cursor: move;">
            <i class="ion ion-clipboard"></i>

            <h3 class="box-title">Methodology</h3>

            <div class="box-tools pull-right">
                <a href="#"><i class="fa fa-question-circle"></i></a>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
            <ul class="todo-list ui-sortable">
                <li>
                    <!-- drag handle -->
                    <span class="handle ui-sortable-handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                    <!-- checkbox -->
                    <input type="checkbox" value="">
                    <!-- todo text -->
                    <span class="text"><a  href="#" data-toggle="modal" data-target="#methodology1" aria-expanded="false">Especificação da ontologia</a></span>
                    <!-- Emphasis label -->
                    <!-- General tools such as edit or delete-->
                    <div class="tools">
                        <a href="#" data-toggle="modal" data-target="#methodology1" aria-expanded="false"><i class="fa fa-info fa-2x"></i> Info </a>
                    </div>
                </li>
                <li>
            <span class="handle ui-sortable-handle">
                <i class="fa fa-ellipsis-v"></i>
                <i class="fa fa-ellipsis-v"></i>
            </span>
                    <input type="checkbox" value="">
                    <span class="text">Aquisição e extração de conhecimento</span>
                    <div class="tools">
                        <a href="#"><i class="fa fa-info fa-2x"></i> Info </a>
                    </div>
                </li>
                <li>
            <span class="handle ui-sortable-handle">
                <i class="fa fa-ellipsis-v"></i>
                <i class="fa fa-ellipsis-v"></i>
            </span>
                    <input type="checkbox" value="">
                    <span class="text">Conceitualização</span>
                    <div class="tools">
                        <a href="#"><i class="fa fa-info fa-2x"></i> Info </a>
                    </div>
                </li>
                <li>
            <span class="handle ui-sortable-handle">
                <i class="fa fa-ellipsis-v"></i>
                <i class="fa fa-ellipsis-v"></i>
            </span>
                    <input type="checkbox" value="">
                    <span class="text">Fundamentação ontológica</span>
                    <div class="tools">
                        <a href="#"><i class="fa fa-info fa-2x"></i> Info </a>
                    </div>
                </li>
                <li class="">
            <span class="handle ui-sortable-handle">
                <i class="fa fa-ellipsis-v"></i>
                <i class="fa fa-ellipsis-v"></i>
            </span>
                    <input type="checkbox" value="">
                    <span class="text">Formalização da ontologia</span>
                    <div class="tools">
                        <a href="#"><i class="fa fa-info fa-2x"></i> Info </a>
                    </div>
                </li>
                <li>
            <span class="handle ui-sortable-handle">
                <i class="fa fa-ellipsis-v"></i>
                <i class="fa fa-ellipsis-v"></i>
            </span>
                    <input type="checkbox" value="">
                    <span class="text">Avaliação da ontologia</span>
                    <div class="tools">
                        <a href="#"><i class="fa fa-info fa-2x"></i> Info </a>
                    </div>
                </li>
                <li>
            <span class="handle ui-sortable-handle">
                <i class="fa fa-ellipsis-v"></i>
                <i class="fa fa-ellipsis-v"></i>
            </span>
                    <input type="checkbox" value="">
                    <span class="text">Documentação da ontologia</span>
                    <div class="tools">
                        <a href="#"><i class="fa fa-info fa-2x"></i> Info </a>
                    </div>
                </li>
                <li>
            <span class="handle ui-sortable-handle">
                <i class="fa fa-ellipsis-v"></i>
                <i class="fa fa-ellipsis-v"></i>
            </span>
                    <input type="checkbox" value="">
                    <span class="text">Disponibilização da ontologia</span>
                    <div  class="tools">
                        <a href="#"><i class="fa fa-info fa-2x"></i> Info </a>
                    </div>
                </li>
            </ul>


        <!-- /.box-body -->
        <div class="box-footer clearfix no-border">
            <h4>Your progress: </h4>
            <div class="progress progress active">
                <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="0"
                     aria-valuemin="0" aria-valuemax="100" style="width: 0">
                    <span id="progress-text" class="">0% Complete</span>
                </div>
            </div>
        </div>
    </div>





    <script type="text/javascript">
        $(document).ready(function () {
            let percentage = $(".progress-bar").width() / $('.progress-bar').parent().width()*100;
            console.log(percentage);
            $('input[type="checkbox"]').click(function () {
                if ($(this).prop("checked")) {
                    $(this).closest('li').attr('class', 'done');
                    percentage = percentage + 12.5;
                    $('.progress-bar').width(percentage+'%').attr('aria-valuenow',percentage);
                } else {
                    $(this).closest('li').attr('class', '');
                    percentage = percentage -12.5;
                    $('.progress-bar').width(percentage+'%').attr('aria-valuenow',percentage);

                }
                $('#progress-text').text(percentage + "% complete");

            });

        });
    </script>

@stop
