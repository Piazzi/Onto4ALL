@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <div class="box box-solid">
        <div class="box-header with-border">
            <i class="fa fa-text-width"></i>

            <h3 class="box-title">Sumário</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <ol>
                <a href="#intro">
                    <li>O que é o ONTO FOR ALL?</li>
                </a>
                <a href="#class"><li>Conceitos básicos</li></a>
                    <ol>
                        <a href="#class"><li>Classe</li></a>
                        <a href="#relations"><li>Relação</li></a>
                        <li>Ligação</li>
                        <a href="#properties"><li>Propriedades</li></a>
                        <li>Cardinalidade</li>
                        <li>Cores</li>
                        <li>Salvar</li>
                        <li>Download</li>
                        <li>Exportar</li>
                    </ol>
                </li>

                <li>Interface do Editor
                    <ol>
                        <li>Diagrama</li>
                        <li>Barra de Dicas</li>
                        <li>Histórico de Ontologias</li>
                        <li>Paleta de Ontologia</li>
                        <li>Outras paletas</li>
                    </ol>
                </li>
                <li>Gerenciamento de Ontologias
                    <ol>
                        <li>Ontologias</li>
                        <li>Ontologias favoritas</li>
                        <li>Ações</li>
                    </ol>
                </li>
                <li>Exemplos</li>
                <li>Atalhos</li>
                <li>Ferramentas Utilizadas</li>
                <li>Créditos</li>
            </ol>
        </div>
        <!-- /.box-body -->
    </div>
@stop

@section('content')
    <div id="intro" class="box box-solid">
        <div class="box-header with-border">
            <i class="fa fa-text-width"></i>

            <h3 class="box-title">O que é o ONTO4ALL?</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <dl>
                <dd>Onto4All é um editor gráfico capaz de criar, editar e exportar ontologias sendo orientado por uma
                    aba de regras de construção ontológica e por uma paleta extensa de classes e relações ontológicas.

                </dd>
                <dd>
                    Os formatos de exportação são: OWL,XML, SVG.
                </dd>
            </dl>
        </div>
        <!-- /.box-body -->

    </div>
    <div id="class" class="box box-solid">
        <div class="box-header with-border">
            <i class="fa fa-text-width"></i>

            <h3 class="box-title">Classe</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <dl>
                <dd>No Onto4All a classe é definida pelo circulo contido dentro da paleta de ontologias.</dd>
                <div class="row">
                    <div class="col-md-6">
                        <img alt="class image" src="/css/images/class.png">
                    </div>
                    <div class="col-md-6">
                        <ul>
                            <li>Ela representa a própria classe de uma ontologia.</li>
                            <li>É possível nomea-la ao se clicar duas vezes em seu interior <span class="label-danger">Atenção: Você não deve colocar espaços no seu nome, apenas use Letras maiúsculas e minúsculas e número de 0 a 9</span></li>
                            <p> Exemplos: <span class="label-success">PizzaDeCalabresa, CarroAutomatico, usuario</span> </p>
                            <li>É possível expandir seu tamanho passando o mouse por cima do círculo e puxando sua borda. </li>
                            <li>É possível trocar as cores (do interior e da borda). </li>
                            <li>É possível liga-la a outras classes usando as <a href="#relations">relações</a>.</li>
                            <li>É possível acessar suas propriedades selecionando a classe e pressionando <strong>CTRL+M</strong> ou clicando nela com o botão direito do mouse e selecionando a opção <strong>Edit Properties</strong></li>
                            <li>É possível joga-la para dentro do diagrama apenas clicando no seu simbolo na paleta de ontologias</li>
                            <li>Clicando com o botão direito do mouse em cima de uma classe irá fazer aparecer um menu com diversas opções</li>
                        </ul>
                    </div>
                </div>
            </dl>
        </div>
        <!-- /.box-body -->
    </div>

    <div id="relations" class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">Relação</h3>
        </div>
        <div class="box-body">
            <dd>Em ontologias, relações entre classes especificam como elas estão relacionados com as demais classes da ontologia. </dd>
            <dd>Grande parte da praticidade de ontologias vem da sua capacidade de descrever relações. </dd>
                <div class="row">
                    <div class="col-md-6">
                        <ul>
                            <li>No Onto4All, existem diversos tipos de relações, que se encontram na paleta de ontologias, à esquerda da tela principal.</li>
                            <li>Um dos principais tipos de relações são: <i>is_a</i>, <i>part_of</i>, <i>has_part</i>, <i>contains</i> e <i>instance_of</i> </li>
                            <li>É possível criar uma nova relação entre duas classes e nomeá-la manualmente, clicando em <i>new_relation</i>. </li>
                            <li>Relações costumam ter um sentido, isto é, apontar de uma classe para outra.</li>
                            <li>É possível inverter o sentido de uma relação, clicando nela com o botão direito do mouse e selecionando <strong>Reverse</strong></li>
                            <li>É possível selecionar outras opções da relação clicando nela com o botão direito, como deletá-la, duplicá-la ou copiá-la.</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <img alt="class image" src="/css/images/relations.png">
                    </div>
                </div>
        </div>
    </div>

    <div id="properties" class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">Propriedades</h3>
        </div>
        <div class="box-body">
            <dd>No Onto4All, cada elemento da paleta de ontologias possui propriedades, que podem ser visualizadas e editadas.</dd>
                <div class="row">
                    <div class="col-md-6">
                        <ul>
                            <li>Para editar as propriedades de um elemento, clique nele com o botão direito do mouse e selecione "Edit Properties".</li>
                            <li>Também pode-se acessar o menu de edição de propriedades de um elemento selecionado com o atalho <strong>Ctlr+M</strong></li>
                            <li>É possível adicionar uma nova propriedade a um elemento, descendo a barra de rolagem do menu de propriedades e selecionando "Add Property".</li>
                            <li>A primeira propriedade do menu de propriedade, o ID, corresponde a um identificador único de cada elemento presente no diagrama.</li>
                            <li>As propriedades podem ser usadas para detalhar aspectos daquele elemento ou para fazer anotações, como as propriedades <i>exampleOfUsage</i> e <i>comments</i>.</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <img alt="class image" src="/css/images/properties.png">
                    </div>
                </div>
        </div>
    </div>
@stop
