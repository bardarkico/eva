@extends('layoutInicio')

@section('head')
@stop

@section('title')
  Vázquez Hernández Contadores, S. C.
@stop

@section('css')
  {{ HTML::style('css/inicio.css') }}
  {{ HTML::style('sweetAlert/sweetalert.css') }}
@stop

@section('content')
<body class="fondo">
<div id="contenidoUsuario">

  <!-- Navigation -->
  <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
      <div class="navbar-header ">
          <img id="imgI"class="img-responsive" src="{{URL::asset('img/logoNombre.png')}}">
      </div>

      <ul class="nav navbar-nav navbar-right">
        <li>{{ HTML::link('/inicio2', Session::get('nombre')) }}</li>

        <li class="dropdown">
          <a style="cursor:pointer" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-clock-o"></i> Historial<b class="caret"></b></a>
          <ul class="dropdown-menu">
        <li>
              <a href="repSesPeriodo"><i class="fa fa-calendar-o"></i> Por período</a>
            </li>
            <li>
              <a href="repSesFuente"><i class="fa fa-newspaper-o"></i> Por fuente</a>
            </li>
          </ul>
         </li>

        <li class="dropdown">
          <a style="cursor:pointer" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-cog "></span> <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li>
              <a href="administracion/logout"><i class="fa fa-sign-out"></i> Cerrar sesión</a>
            </li>
          </ul>
         </li>


      </ul>

    </div>
  </nav>
<!-- Finaliza la parte superior -->
<br><br><br><br>

  <div class="container">

    <div class="row">
      <div class="col-md-12">
        <input type="hidden" name="idSesion" id="idSesion" value="<?php echo Session::get('id'); ?>">
        <br><br>
        <ul id="myTab" class="nav nav-tabs nav-justified">
            <li class="active"><a href="#service-one" data-toggle="tab"><i class="fa fa-pencil-square"></i> Ingresar información:</a>
            </li>
            <li class=""><a href="#service-two" data-toggle="tab"><i class="fa fa-newspaper-o"></i> Información ingresada:</a>
            </li>
        </ul>
        <div id="myTabContent" class="tab-content">
          <div class="tab-pane fade active in" id="service-one">
            <div class="well trasparenteClaroPlus" id="pnlMensaje">
              <div class="row" id="pnlAdmin">
                <div id="pnlDof">
                  <div class="panel panel-default" >
                    <div class="panel-heading">
                      <div class="row">
                        <div class="col-md-3">
                          <select class="negro" id="slctFuentes"></select>
                        </div>
                        <div class="col-md-9 text-right">
                          <div class="col-md-5">
                            <div class="row text-left">
                              <input type="checkbox" name="chkDof" id="chkDof" value=""> Sin Información relevante
                            </div>
                            <div class="row text-left">
                              <input type="checkbox" name="chkPublic" id="chkPublic" value=""> Sin publicación
                            </div>
                          </div>
                          <div class="col-md-6">
                            <button class="btn btn-primary" id="btnAgregarDof"><i class="fa fa-plus-circle"></i> Agregar Información </button>
                          </div>
<!--                           <div class="col-md-3">
                            <button class="btn btn-default" id="btnFinalizar"><i class="fa fa-folder"></i> Finalizar</button>
                          </div> -->
                        </div>
                      </div>
                    </div>

                    <div class="panel-body" id="bdyDof">
                      <br>
                      <div class="row">
                        <div class="col-md-2">
                          <i class="fa fa-bookmark text-primary"></i> <strong> Título de la noticia: </strong>
                        </div>
                        <div >
                          <input type="text" name="txtTDof" id="txtTDof" class="col-md-9">
                        </div>
                      </div>
                      <div class="row">
                          <div class="col-md-12">
                            <br>
                            <i class="fa fa-align-left text-primary"></i> <strong>Contenido de la noticia: </strong>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-md-12">
                            <textarea name="txtNDof" id="txtNDof" rows="10" cols="130" style="width:100%"></textarea>
                          </div>
                      </div>
                      <br>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="tab-pane fade" id="service-two">
            <div class="well trasparenteClaroPlus" id="pnlMensaje">
              <div class="row" id="pnlAdmin">
                <input type="hidden" name="token" id="token" value="<?php echo csrf_token(); ?>">
                  <div class="row" id="tblN">
                    <div class="col-md-12">

                      <button class="btn btn-default btn-primary" id="btnFinalizar"><i class="fa fa-folder"></i> Finalizar</button>
                      <span class="text-info">
                          <i class="fa fa-info-circle"></i> Al finalizar se enviará toda la información para el boletín y usted no prodrá editar la información
                      </span>
                      <br>
                      <br>
                      <table class="table table-striped table-hover table-bordered">
                        <thead>
                          <tr>
                            <th class="text-center fondoVerde">Fuente </th>
                            <th class="col-md-2 text-center fondoVerde">Título</th>
                            <th class="col-md-8 text-center fondoVerde">Contenido</th>
                            <th class="col-md-1 text-center fondoVerde">Eliminar</th>
                            <th class="col-md-1 text-center fondoVerde">Editar</th>
                          </tr>
                        </thead>
                        <tbody id="tbodyN"></tbody>
                      </table>
                    </div>
                  </div>
              </div>
            </div>
          </div>
        </div>

        <div class="panel panel-default hidden" id="pnlEditar">
        <center><h3><i class="fa fa-newspaper-o text-primary"></i> Editar información</h3></center>
          <div class="panel-heading">
                  <div class="row">
                    <div class="col-md-4">
                      <select class="negro" id="slctFuentesE"></select>
                    </div>
                    <div class="col-md-8 text-right">
                      <div class="col-md-6">
                        <input type="checkbox" name="chkDofE" id="chkDofE" value="1"> Sin Información relevante
                        <input type="checkbox" name="chkPublicE" id="chkPublicE" value="1"> Sin publicación
                      </div>
                      <div class="col-md-6">
                        <button class="btn btn-danger" id="btnCalcelarDofE"><i class="fa fa-times-circle"></i> Cancelar Edición </button>
                        <button class="btn btn-primary" id="btnEditar"><i class="fa fa-pencil-square-o"></i> Guardar Edición</button>
                      </div>
                    </div>
                  </div>
          </div>

          <div class="panel-body" id="bdyDofE">
                  <br>
                  <div class="row">
                    <div class="col-md-2">
                      <i class="fa fa-bookmark text-primary"></i> <strong> Título de la noticia: </strong>
                    </div>
                    <div >
                      <input type="text" name="txtTDofE" id="txtTDofE" class="col-md-9">
                    </div>
                  </div>
                  <div class="row">
                      <div class="col-md-12">
                        <i class="fa fa-align-left text-primary"></i> <strong> Contenido de la noticia: </strong>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-md-12">
                        <textarea name="txtNDofE" id="txtNDofE" rows="10" cols="130" style="width:100%"></textarea>
                      </div>
                  </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  {{ HTML::script('js/jquery.js') }}
  {{HTML::script('sweetAlert/sweetalert.min.js')}}
  {{HTML::script('js/jquery.tablesorter.min.js')}}
  {{HTML::script('js/jquery.highlight-5.js')}}

  {{HTML::script('js/ingresoNot.js')}}
</div>
</body>
@stop
