@extends('administracion.layoutAd')

@section('head')
{{ HTML::style('sweetAlert/sweetalert.css') }}
{{ HTML::style('datepicker/css/bootstrap-datepicker3.standalone.css') }}
@stop

@section('title')
  Período Agregar | Hemeroteca VHC
@stop

@section('body')
@stop

@section('content')

<div>
  <div class="row">
    <center><h2><i class="fa fa-calendar-o text-primary"></i> Períodos</h2></center>
    <br><br>
    <div class="col-md-4">
      <button id="btnConsulta" class="btn btn-block btn-md botonNoactivo"><i class="fa fa-th-list"></i> Consultar</button>
    </div>
    <div class="col-md-4">
      <button id="btnEditarM"  class="btn btn-block btn-md botonNoactivo"><i class="fa fa-pencil-square-o"></i> Editar</button>
    </div>
    <div class="col-md-4">
      <button id="btnAgregar"  class="btn btn-block btn-md botonNoactivo"><i class="fa fa-plus-circle"></i> Agregar</button>
    </div>
  </div>
</div>

<div class="row hidden" id="pnlConsulta">
  <div class="col-md-12">

    <div class="table-responsive" id="tblConsulta">
      <h3>Períodos en el sistema:</h3>
      <table class="table table-striped table-hover table-bordered">
        <thead>
          <tr>
            <th class="col-md-1">No.</th>
            <th class="col-md-2">Inicio</th>
            <th class="col-md-2">Fin</th>
            <th class="col-md-1 text-center">Estado</th>
          </tr>
        </thead>
        <tbody id="tbodyConsulta"></tbody>
      </table>
    </div>

  </div>
</div>

<div class="row hidden" id="pnlAgregar">
  <div class="col-md-10 col-md-offset-1">
    <h3>Agregar Nuevo Período</h3>

    <div class="form-horizontal" id="form" name="form" novalidate>

      <div class="form-group" id="groupNueva">
         <label for="txtDiasAgregar" class="col-md-3 control-label">*Período en días: </label>
         <div class="col-md-8">
           <select class="" name="" id="txtDiasAgregar">
             <option value=6>Semanal</option>
             <option value=13>Quincenal</option>
             <option value=30>Mensual</option>
             <option value=100>Otro</option>
           </select>
         </div>
       </div>
       <input type="hidden" name="_token" id="token" value="<?php echo csrf_token(); ?>">


      <div class="form-group" id="groupNueva2">
        <label for="txtFechaInicio" class="col-md-3 control-label">*Fecha inicio: </label>
        <div class="col-md-8">

          <div class="input-group date" data-provide="datepicker">
            <input type="text" class="form-control" id="txtFechaInicio">
            <div class="input-group-addon">
              <i class="fa fa-calendar"></i>
            </div>
          </div>

        </div>
      </div>

         <div class="form-group" id="p">
          <label for="txtFechaFin" class="col-md-3 control-label">Fecha Fin: </label>
          <div class="col-md-8">
        <!--      <input id="txtFechaFin" name="txtFechaFin" type="mail" class="form-control grisObscuro"  placeholder="" disabled>
      -->
            <div class="input-group date" data-provide="datepicker">
              <input type="text" class="form-control" id="txtFechaFin" >
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
            </div>


          </div>
        </div>


      <br>
      <button id="btnGuardar" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Guardar</button>
      <button id="btnCancelar"  class="btn btn-danger"><i class="fa fa-times-circle"></i> Cancelar</button>

    </div>

    <br><br>



  </div>
</div>


<div class="row hidden" id="tblServicios">
  <div class="col-md-12">
    <div class="table-responsive" id="tblPeriodos">
      <h3>Períodos en el sistema:</h3>
      <table class="table table-striped table-hover table-bordered">
        <thead>
          <tr>
            <th class="col-md-1">No.</th>
            <th class="col-md-2">Inicio</th>
            <th class="col-md-2">Fin</th>
            <th class="col-md-1 text-center">Estado</th>
            <th class="col-md-1 text-center">Modificar</th>
            <th class="col-md-1 text-center">Dar de baja</th>
          </tr>
        </thead>
        <tbody id="tbodyPeriodos"></tbody>
      </table>
    </div>
  </div>
</div>


<div class="row hidden" id="pnlEditar">

<div class="form-horizontal" id="form" name="form"  novalidate>

  <div class="form-group" id="groupNueva2">
    <label for="txtFechaInicioE" class="col-md-3 control-label">*Fecha inicio: </label>
    <div class="col-md-8">

      <div class="input-group date" data-provide="datepicker">
        <input type="text" class="form-control" id="txtFechaInicioE">
        <div class="input-group-addon">
          <i class="fa fa-calendar"></i>
        </div>
      </div>

    </div>
  </div>


  <div class="form-group" id="groupNueva2">
    <label for="txtFechaInicio" class="col-md-3 control-label">*Fecha fin: </label>
    <div class="col-md-8">

      <div class="input-group date" data-provide="datepicker">
        <input type="text" class="form-control" id="txtFechaFinE">
        <div class="input-group-addon">
          <i class="fa fa-calendar"></i>
        </div>
      </div>

    </div>
  </div>

  <div class="form-group">
    <label for="txtActivo" class="col-md-3 control-label">Activo:</label>
    <div class="col-md-8">
      <select name="" id="txtActivo" class="form-control input-sm">
        <option value="1">Sí</option>
        <option value="0">No</option>
      </select>
    </div>
  </div>


  <br>
  <input type="hidden" name="idPeriodo" id="idPeriodo">
  <button id="btnEditar" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Guardar</button>
  <button id="btnCancelarE"  class="btn btn-danger"><i class="fa fa-times-circle"></i> Cancelar</button>

</div>

</div>

<div class="row" id="pnlInicio" >
    <div class="row">
      <br>
      <div class="col-md-12" align="center">
        <img src="/img/cuentas/491522031.jpg" class="imgI img-responsive" />
      </div>
    </div>
</div>


@stop

@section('js')
{{HTML::script('sweetAlert/sweetalert.min.js')}}
{{HTML::script('js/administracion/perAgregar.js')}}
{{HTML::script('datepicker/js/bootstrap-datepicker.js')}}
@stop

@section('javascript')
  <script>
    $('#collapseAsignacion').addClass('in');
    $('#liPeAgregar').addClass('activoBorde');
  </script>
@stop
