@extends('administracion.layoutAd')

@section('head')
{{ HTML::style('sweetAlert/sweetalert.css') }}
@stop

@section('title')
  Editar Equipos | Hemeroteca VHC
@stop

@section('body')
@stop

@section('content')
<div>
  <div class="row">
    <center><h2> <i class="fa fa-users text-primary"></i> Equipos</h2></center>
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
  <div class="col-md-10 ">
    <center><h2><i class="fa fa-plus-circle text-primary"></i> Agregar Nuevo Integrantes</h2></center>

    <form class="form-horizontal" id="form" name="form" novalidate>

      <div class="form-group" id="groupActual">
        <label for="slctRepresentante" class="col-md-3 control-label">*Iniciales del representante: </label>
        <div class="col-md-8">
          <select name="" id="slctRepresentante" class="form-control input-sm">
          </select>
        </div>
      </div>
      <br>
      <center><h2><i class="fa fa-sticky-note text-primary"></i> Datos del integrante:</h2></center>

      <div class="form-group" id="groupActual">
        <label for="txtNombreAgS" class="col-md-3 control-label">*Nombre: </label>
        <div class="col-md-8">
          <input id="txtNombreAg" name="txtNombreAg" type="text" class="form-control grisObscuro" pattern="[ñÑZáéíóúñÁÉÍÓÚ  \d\w\s@._-]+"  placeholder="*Nombre">
          <p class="text-danger formatoTexto14" id="spnNombre"> </p>
          <input type="hidden" name="token" id="token" value="<?php echo csrf_token(); ?>">
        </div>
      </div>

      <div class="form-group">
        <label for="txtIniciales" class="col-md-3 control-label">*Iniciales:</label>
        <div class="col-md-8">
            <input type="text" class="form-control input-sm" id="txtIniciales" placeholder="Ingrese iniciales" maxlength="55">
        </div>
      </div>

      <div class="form-group" id="groupNueva">
         <label for="txtCorreoAg" class="col-md-3 control-label">*Correo electrónico: </label>
         <div class="col-md-8">
           <input id="txtCorreoAg" name="txtCorreoAg" type="mail" class="form-control grisObscuro"  placeholder="*Correo del responsable:" required>
           <p class="text-danger formatoTexto14" id="spnCorreo" name="spnCorreo"> </p>
         </div>
       </div>

      <br>
      <button id="btnGuardarAg" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Guardar</button>
      <button id="btnCancelarAg"  class="btn btn-danger"><i class="fa fa-times-circle"></i> Cancelar</button>
    </form>

  </div>
</div>


<div class="row">
  <div class="col-md-12">


      <div class="row">
        <div class="col-md-12">
          <div class="table-responsive hidden" id="tblServicios">
            <h2><span class="glyphicon glyphicon-edit text-primary"></span> Editar Integrantes</h2>
          <!--    <h3>Sesiones en el sistema:</h3> -->
            <table class="table table-striped table-hover table-bordered">
              <thead>
                <tr>
                  <th class="col-md-1">Id</th>
                  <th class="col-md-2">Representante</th>
                  <th class="col-md-1">Integrante</th>
                  <th class="col-md-2">Nombre</th>
                  <th class="col-md-2">Correo del integrante</th>
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
    <br>

    <!-- Panel editar -->
   <div class="row">
      <div class="col-md-10">
        <div class="well transparenteClaro hidden" id="formEditarServ">

          <div class="form-horizontal">
            <fieldset>
              <legend><span class="glyphicon glyphicon-edit text-primary"></span> Representante</legend>
              <input type="hidden" id="txtIdFuente" value="">

              <div class="form-group" id="groupActual">
                <label for="slctRepresentante2" class="col-md-4 control-label">*Representante: </label>
                <div class="col-md-7">
                  <select name="" id="slctRepresentante2" class="form-control input-sm">
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label for="txtNombreC" class="col-md-4 control-label">Nombre:</label>
                <div class="col-md-7">
                  <input type="text" class="form-control input-sm" id="txtNombreC" placeholder="Ingrese nombre del servicio" maxlength="55">
                </div>
              </div>

                <div class="form-group">
                <label for="txtNombre" class="col-md-4 control-label">Iniciales:</label>
                <div class="col-md-7">
                  <input type="text" class="form-control input-sm" id="txtNombre" placeholder="Ingrese nombre del servicio" maxlength="55">
                </div>
              </div>

              <div class="form-group">
                <label for="txtCorreo" class="col-md-4 control-label">Correo:</label>
                <div class="col-md-7">
                  <input type="text" class="form-control input-sm" id="txtCorreo" placeholder="Ingrese nombre del servicio" maxlength="55">
                </div>
              </div>


              <div class="form-group">
							  <label for="txtActivo" class="col-md-4 control-label">Activo:</label>
							  <div class="col-md-7">
								  <select name="" id="txtActivo" class="form-control input-sm">
									  <option value="1">Sí</option>
									  <option value="0">No</option>
								  </select>
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

    <input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">

  </div>  <!--/columna10 contenido-->
</div>

<div class="row">
  <div class="col-md-12 hidden" id="pnlConsulta">
    <h2><i class="fa fa-th-list text-primary"></i> Integrantes en el sistema:</h2>
    <div class="row ">
      <div class="col-md-8">

      </div>
      <div class="col-md-2">
        <button id="btnEnviar"  class="btn btn-info btn-block btn-md"><i class="fa fa-paper-plane"></i> Enviar por Correo</button>
      </div>
      <div class="col-md-2">
         <a href="imprimirEquipos" id="btnImprimir" target="blanck">  <button   class="btn btn-info btn-block btn-md"><i class="fa fa-file-pdf-o"></i> Imprimir PDF</button>  </a>
      </div>
    </div>
    <div class="table-responsive" >
<br>
      <table class="table table-striped table-hover table-bordered">
        <thead>
          <tr>
            <th class="col-md-1">Id</th>
            <th class="col-md-2">Representante</th>
            <th class="col-md-2">Integrante</th>
            <th class="col-md-2">Nombre</th>
            <th class="col-md-2">Correo del integrante</th>
            <th class="col-md-1 text-center">Estado</th>
          </tr>
        </thead>
        <tbody id="tbodyConsulta"></tbody>
      </table>
    </div>
  </div>
</div> <!-- /Tabla de servicios -->


<div class="row" id="pnlInicio" >
    <div class="row">
      <br>
      <div class="col-md-12" align="center">
        <img src="/img/adm/101764646.jpg" class="imgI img-responsive" />
      </div>
    </div>
</div>

@stop

@section('js')
{{HTML::script('sweetAlert/sweetalert.min.js')}}
{{HTML::script('js/administracion/inEditar.js')}}
@stop

@section('javascript')
  <script>
    $('#collapseMiembros').addClass('in');
    $('#liEditarEqu').addClass('activoBorde');
  </script>
@stop
