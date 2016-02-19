@extends('administracion.layoutAd')

@section('head')
{{ HTML::style('sweetAlert/sweetalert.css') }}
{{ HTML::style('datepicker/css/bootstrap-datepicker3.standalone.css') }}
@stop

@section('title')
  Reporte consultas | Hemeroteca VHC
@stop

@section('body')
@stop

@section('content')


<div class="row" id="pnlCambio">
  <div class="col-md-10 col-md-offset-1">
    <h3><i class="fa fa-key"></i> Capturas</h3>

    <div class="form-horizontal" id="form" name="form" novalidate>

      <div class="form-group" id="groupNueva2">
        <label for="slctSesion" class="col-md-3 control-label">*Usuario: </label>
        <div class="col-md-8">
          <select name="" id="slctUsuario" class="form-control input-sm">
          </select>
          <p class="text-danger formatoTexto14" id="spnNueva2"> </p>
        </div>
      </div>

      <div class="form-group" id="groupNueva2">
        <label for="slctSesion" class="col-md-3 control-label">*Fecha inicio: </label>
        <div class="col-md-8">

          <div class="input-group date" data-provide="datepicker">
            <input type="text" class="form-control" id="fechaInicio">
            <div class="input-group-addon">
              <i class="fa fa-calendar"></i>
            </div>
          </div>

        </div>
      </div>

      <div class="form-group" id="groupNueva2">
        <label for="slctSesion" class="col-md-3 control-label">*Fecha Fin: </label>
        <div class="col-md-8">

          <div class="input-group date" data-provide="datepicker">
            <input type="text" class="form-control" id="fechaFin">
            <div class="input-group-addon">
              <i class="fa fa-calendar"></i>
            </div>
          </div>

        </div>
      </div>

      <br>
      <button id="btnCapturas" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Mostrar Capturas</button>
      <button id="btnEditadas" class="btn btn-primary"><i class="fa fa-pencil-square-o"></i> Mostrar Editadas</button><br><br>
      <button id="btnCapturaEdit" class="btn btn-primary"><i class="fa fa-pencil-square"></i> Todo Captura-Edición</button>
      <button id="btnCancelar"  class="btn btn-danger"><i class="fa fa-times-circle"></i> Cancelar</button>
    </div>

  </div>
</div>


<!-- Tabla de servicios -->
<br>
<div class="row">
  <div class="col-md-12">
    <div class="table-responsive hidden" id="tblServicios">
      <h3>Acciones realizados:</h3>

      <div class="form-group" id="groupNueva2">
        <label for="txtEdicion" class="col-md-2 control-label text-right">Editadas: </label>
        <div class="col-md-3">
          <input type="text" class="form-control" id="txtEdicion" readonly>
        </div>

        <label for="txtCaptura" class="col-md-2 control-label text-right">Capturas: </label>
        <div class="col-md-3">
          <input type="text" class="form-control" id="txtCaptura" readonly>
        </div>
        <br><br>

        <label for="txtCE" class="col-md-2 control-label text-right">Capturas-Editadas: </label>
        <div class="col-md-3">
          <input type="text" class="form-control" id="txtCE" readonly>
        </div>

        <label for="txtTotal" class="col-md-2 control-label text-right " id="txtTotalL">Total: </label>
        <div class="col-md-3">
          <input type="text" class="form-control" id="txtTotal" readonly>
        </div>

      </div>
<br><br>
      <table class="table table-striped table-hover">
        <thead>
          <tr>
            <th>No.</th>
            <th class="col-md-1">Acción</th>
            <th class="col-md-2">Ingreso <br>Fecha - Hora</th>
            <th class="col-md-2">Edición <br>Fecha - Hora</th>
            <th class="col-md-1 text-center">Revista</th>
            <th class="col-md-1 text-center">No. revista</th>
            <th class="col-md-1 text-center">Año</th>
            <th class="col-md-1 text-center">Mes</th>
            <th class="col-md-1 text-center">Tipo</th>
            <th class="col-md-3 text-center">Titulo</th>
          </tr>
        </thead>
        <tbody id="tbodyServicios"></tbody>
      </table>
    </div>
  </div>
</div> <!-- /Tabla de servicios -->
<br>



@stop

@section('js')
{{HTML::script('sweetAlert/sweetalert.min.js')}}
{{HTML::script('datepicker/js/bootstrap-datepicker.js')}}
{{HTML::script('js/administracion/repCaptura.js')}}

@stop

@section('javascript')
  <script>
    $('#collapseReportes').addClass('in');
    $('#liCapturaReporte').addClass('activoBorde');
  </script>
@stop
