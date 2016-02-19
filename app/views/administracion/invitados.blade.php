@extends('administracion.layoutAd')

@section('head')
{{ HTML::style('sweetAlert/sweetalert.css') }}
@stop

@section('title')
  Invitados | Hemeroteca VHC
@stop

@section('body')
@stop

@section('content')
<div>
  <div class="row">
    <center><h2><i class="fa fa-star text-primary"></i> Invitados</h2></center>
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
    <h2><i class="fa fa-plus-circle text-primary"></i>
 Agregar Invitados</h2>

    <div class="form-horizontal" id="form" name="form" >
      <div class="form-group" id="groupActual">
        <label for="txtNombreS" class="col-md-3 control-label">*Nombre: </label>
        <div class="col-md-8">
          <input id="txtNombreI" name="txtFuente" type="text" class="form-control grisObscuro" pattern="[ñÑZáéíóúñÁÉÍÓÚ  \d\w\s@._-]+"  placeholder="*Nombre de la fuente de donde se obtendrá la noticia" required>
          <p class="text-danger formatoTexto14" id="spnNombre"> </p>
          <input type="hidden" name="token" id="token" value="<?php echo csrf_token(); ?>">
        </div>
      </div>

      <div class="form-group">
        <label for="txtCorreoI" class="col-md-3 control-label">* Correo:</label>
        <div class="col-md-8">
          <input type="text" class="form-control input-sm" id="txtCorreoI" placeholder="*Ingrese correo del invitado" maxlength="55">
        </div>
      </div>


      <button id="btnGuardarAg" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Guardar</button>
      <button id="btnCancelarAg"  class="btn btn-danger"><i class="fa fa-times-circle"></i> Cancelar</button>
    </div>

  </div>


</div>


<div class="row">
  <div class="col-md-12">

    <div class="hidden" id="tblServicios">


      <div class="row" >
        <div class="col-md-12" >
          <h2><span class="glyphicon glyphicon-edit text-primary"></span> Editar Invitados</h2>
          <div class="table-responsive" >
            <table class="table table-striped table-hover table-bordered">
              <thead>
                <tr>
                  <th class="col-md-1">Id</th>
                  <th class="col-md-2">Nombre del invitado</th>
                  <th class="col-md-2">Correo</th>
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


    <!-- Panel editar -->
   <div class="row">
      <div class="col-md-10">
        <div class="well transparenteClaro hidden" id="formEditarServ">

          <div class="form-horizontal">
            <fieldset>
              <input type="hidden" id="txtIdInvitado" value="">
              <div class="form-group">
                <label for="txtNombreE" class="col-md-4 control-label">Nombre del invitado:</label>
                <div class="col-md-7">
                  <input type="text" class="form-control input-sm" id="txtNombreE" placeholder="Ingrese nombre del servicio" maxlength="55">
                </div>
              </div>
              <div class="form-group">
                <label for="txtCorreoE" class="col-md-4 control-label">Correo invitado:</label>
                <div class="col-md-7">
                  <input type="text" class="form-control input-sm" id="txtCorreoE" placeholder="Ingrese nombre del servicio" maxlength="55">
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




    <div class="row hidden" id="pnlConsulta">
      <div class="col-md-10 col-md-offset-1">
        <h2><i class="fa fa-th-list text-primary"></i> Invitados en el sistema</h2>

        <div class="row">
              <div class="col-md-8">

              </div>
              <div class="col-md-2">
                <!--          <button id="btnEnviarA"  class="btn btn-info btn-block btn-md"><i class="fa fa-paper-plane"></i> Enviar por Correo</button>
              -->
              </div>
              <div class="col-md-2">
                     <a href="imprimirInvitados" id="btnImprimir" target="blanck">  <button   class="btn btn-info btn-block btn-md"><i class="fa fa-file-pdf-o"></i> Imprimir PDF</button>  </a>
              </div>
            </div>

          <div class="row">
            <div class="col-md-12">
              <div class="table-responsive" id="tblConsulta">
                <table class="table table-striped table-hover table-bordered">
                  <thead>
                    <tr>
                      <th class="col-md-1">No.</th>
                      <th class="col-md-3">Nombre del invitado</th>
                      <th class="col-md-3">Correo</th>
                      <th class="col-md-2 text-center">Activo</th>
                    </tr>
                  </thead>
                  <tbody id="tbodyConsulta"></tbody>
                </table>
              </div>
            </div>
          </div> <!-- /Tabla de servicios -->
        </div>
      </div>


      <div class="row" id="pnlInicio" >
          <div class="row">
            <br>
            <div class="col-md-12" align="center">
              <img src="/img/adm/104307698.jpg" class="imgI img-responsive" />
            </div>
          </div>
      </div>


    <input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">

  </div>  <!--/columna10 contenido-->
</div>




@stop

@section('js')
{{HTML::script('sweetAlert/sweetalert.min.js')}}
{{HTML::script('js/administracion/invitados.js')}}
@stop

@section('javascript')
  <script>
    $('#collapseMiembros').addClass('in');
    $('#liInvitados').addClass('activoBorde');
  </script>
@stop
