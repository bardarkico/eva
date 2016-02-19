@extends('administracion.layoutAd')

@section('head')
{{ HTML::style('sweetAlert/sweetalert.css') }}
{{ HTML::style('datepicker/css/bootstrap-datepicker3.standalone.css') }}
@stop

@section('title')
  Editar Sesión | Hemeroteca VHC
@stop

@section('body')
@stop

@section('content')
<div>
  <div class="row">
    <center><h2><i class="fa fa-newspaper-o text-primary"></i> Cuestionarios</h2></center>
    <br><br>
    <div class="col-md-4">
      <button id="btnConsulta" class="btn btn-block btn-md botonNoactivo"><i class="fa fa-th-list"></i> Consultar</button>
    </div>
    <div class="col-md-4">
      <button id="btnEditar"  class="btn btn-block btn-md botonNoactivo"><i class="fa fa-pencil-square-o"></i> Editar</button>
    </div>
    <div class="col-md-4">
      <button id="btnAgregar"  class="btn btn-block btn-md botonNoactivo"><i class="fa fa-plus-circle"></i> Agregar</button>
    </div>
  </div>
</div>

<div class="row hidden" id="pnlAgregar">

  <div class="col-md-10">
    <h2><i class="fa fa-plus-circle text-primary"></i>Agregar Cuestionario</h2>

    <form class="form-horizontal" id="form" name="form" novalidate>
      <div class="form-group" id="groupNueva2">
        <label for="txtFechaInicio" class="col-md-3 control-label">*Fecha de aplicación: </label>
        <div class="col-md-5">
          <div class="input-group date" data-provide="datepicker">
            <input type="text" class="form-control" id="txtFechaApl">
            <div class="input-group-addon">
              <i class="fa fa-calendar"></i>
            </div>
          </div>
        </div>
      </div>

      <div class="form-group">
        <label for="txtNombreS" class="col-md-3 control-label">*Tema: </label>
        <div class="col-md-8">
          <input id="txtTema" name="txtTema" type="text" class="form-control grisObscuro" pattern="[ñÑZáéíóúñÁÉÍÓÚ  \d\w\s@._-]+"  placeholder="*Nombre de la fuente de donde se obtendrá la noticia" required>
          <p class="text-danger formatoTexto14" id="spnNombre"> </p>
          <input type="hidden" name="token" id="token" value="<?php echo csrf_token(); ?>">
        </div>
      </div>

      <div class="form-group">
        <label for="txtNombre" class="col-md-3 control-label">*Nombre: </label>
        <div class="col-md-8">
          <input id="txtNombre" name="txtNombre" type="text" class="form-control grisObscuro" pattern="[ñÑZáéíóúñÁÉÍÓÚ  \d\w\s@._-]+"  placeholder="*Nombre de la fuente de donde se obtendrá la noticia" required>
          <p class="text-danger formatoTexto14" id="spnNombre"> </p>
          <input type="hidden" name="token" id="token" value="<?php echo csrf_token(); ?>">
        </div>
      </div>


      <button id="btnGuardarAg" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Guardar</button>
      <button id="btnCancelarAg"  class="btn btn-danger"><i class="fa fa-times-circle"></i> Cancelar</button>
    </form>

  </div>

</div>


<div class="row">
  <div class="col-md-12">

    <div class="hidden" id="tblServicios">


      <div class="row" >
        <div class="col-md-12" >
          <h2><span class="glyphicon glyphicon-edit text-primary"></span> Editar Fuentes</h2>
          <div class="table-responsive" >
            <h3>Fuentes en el sistema:</h3>
            <table class="table table-striped table-hover table-bordered">
              <thead>
                <tr>
                  <th class="col-md-1">Id</th>
                  <th class="col-md-2">Nombre de fuente</th>
                  <th class="col-md-1 text-center">Estado</th>
                  <th class="col-md-1 text-center">Modificar</th>
                  <th class="col-md-1 text-center">Dar de baja</th>
                </tr>
              </thead>
              <tbody id="tbodyServicios"></tbody>
            </table>
          </div>
        </div>
      </div> <!-- /Tabla de servicios -->
    </div>
    <br>

    <!-- Panel editar -->
   <div class="row">
      <div class="col-md-10">
        <div class="well transparenteClaro hidden" id="formEditarServ">

          <div class="form-horizontal">
            <fieldset>
              <legend><span class="glyphicon glyphicon-edit text-primary"></span> Editar Cuestionario</legend>
              <input type="hidden" id="txtIdFuente" value="">
              <div class="form-group">
                <label for="txtNombreFuente" class="col-md-4 control-label">Fecha de Aplicación:</label>
                <div class="col-md-7">
                  <input type="text" class="form-control input-sm" id="txtFechaA" placeholder="Ingrese nombre del servicio" maxlength="55">
                </div>
              </div>

              <div class="form-group">
                <label for="txtNombreFuente" class="col-md-4 control-label">Tema del Cuestionario:</label>
                <div class="col-md-7">
                  <input type="text" class="form-control input-sm" id="txtTemaE" placeholder="Ingrese nombre del servicio" maxlength="55">
                </div>
              </div>

              <div class="form-group">
                <label for="txtNombreFuente" class="col-md-4 control-label">Nombre del Cuestionario:</label>
                <div class="col-md-7">
                  <input type="text" class="form-control input-sm" id="txtNombreE" placeholder="Ingrese nombre del servicio" maxlength="55">
                </div>
              </div>

              <div class="form-group">
                <div class="col-md-9 col-md-offset-3">
                  <button class="btn btn-primary" id="btnGuardar"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar cambios</button>
                  <button class="btn btn-danger " id="btnCancelar"><span class="glyphicon glyphicon-remove-sign"></span> Cancelar</button>
                </div>
              </div>
            </fieldset>
          </div>
        </div>
      </div>
    </div>




    <div class="row hidden" id="pnlConsulta">
      <div class="col-md-10 col-md-offset-1">

          <div class="row">
            <div class="col-md-12">
              <h2><i class="fa fa-th-list text-primary"></i> Cuestionarios del sistema</h2>

              <div class="row">
                <div class="col-md-6">

                </div>
                <div class="col-md-2">
                  <!--          <button id="btnEnviarA"  class="btn btn-info btn-block btn-md"><i class="fa fa-paper-plane"></i> Enviar por Correo</button>
                -->
                </div>
                <div class="col-md-2">
                       <a href="imprimirFuentes" id="btnImprimir" target="blanck">  <button   class="btn btn-info btn-block btn-md"><i class="fa fa-file-pdf-o"></i> Imprimir PDF</button>  </a>
                </div>
              </div>

              <div class="table-responsive" id="tblConculta">
                <table class="table table-striped table-hover table-bordered">
                  <thead>
                    <tr>
                      <th class="col-md-1">Fecha de aplicaicón</th>
                      <th class="col-md-3">Nombre del cuestionario</th>
                      <th class="col-md-2 text-center">Tema</th>
                    </tr>
                  </thead>
                  <tbody id="tbodyConsulta"></tbody>
                </table>
              </div>
            </div>
          </div> <!-- /Tabla de servicios -->
        </div>
      </div>


      <div class="row" id="pnlInicio">
        <div class="col-md-12" align="center">
        <!--   <h2><i class="fa fa-th-list text-primary"></i> Fuentes de información</h2> -->
        <img src="/img/adm/474193693.jpg" class="imgI img-responsive" />
          </div>
        </div>






    <input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">

  </div>  <!--/columna10 contenido-->
</div>



@stop

@section('js')
{{HTML::script('sweetAlert/sweetalert.min.js')}}
{{HTML::script('js/administracion/cueEditar.js')}}

{{HTML::script('datepicker/js/bootstrap-datepicker.js')}}
@stop

@section('javascript')
  <script>
    $('#collapseSesiones').addClass('in');
    $('#liEditarSesion').addClass('activoBorde');
  </script>
@stop
