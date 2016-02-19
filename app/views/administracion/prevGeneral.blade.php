@extends('administracion.layoutAd')

@section('head')
{{ HTML::style('sweetAlert/sweetalert.css') }}

@stop

@section('title')
  Período Agregar | Hemeroteca VHC
@stop

@section('body')
@stop

@section('content')

  <div class="row">
  <center><h2><i class="fa fa-bars text-primary"></i> Fuentes ingresadas y no ingresadas</h2></center>
  <br><br>
      <div class="row">
        <div class="col-md-3 text-center">
          Fecha:          <br>
              <input type="text" id="textFecha" name="name" disabled>
        </div>
        <div class="col-md-2 text-center" >
           Hora:<div id="reloj" class="contFecha">
           </div>
        </div>
        <div class="col-md-2 text-center">
          Tiempo restante: <div id="restante" class="contFecha"></div>
        </div>

        <div class="col-md-5 text-right">
          <strong>Hora de envio: </strong>
          HH
          <input type="text" id="txtHora" max="24:00:00" min="00:00:00" size="3" maxlength="2">
          mm
          <input type="text" id="txtMinuto" max="24:00:00" min="00:00:00" size="3" maxlength="2">

          <button class="btn btn-primary" id="btnActualizarH"><i class="fa fa-clock-o"></i> Actualizar Hora envio </button>
          <br><br>
          <button class="btn btn-success" id="btnEnviar"><i class="fa fa-paper-plane"></i> Enviar Ahora </button>

        </div>
      </div>

      <h3><i class="fa fa-check-square text-primary"></i> Fuentes ingresadas:</h3>
      <div class="table-responsive" id="tblIngresados">

        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th class="col-md-1">No.</th>
              <th class="col-md-2">Fuente</th>
              <th class="col-md-2">Representante</th>
            </tr>
          </thead>
          <tbody id="tbodyIngresados"></tbody>
        </table>
      </div>


  </div>
  <br><br>

  <div class="row">
    <div class="col-md-12">
      <div class="table-responsive" id="tblFaltantes">
        <h3>
            <i class="fa fa-times-circle text-danger"></i> Fuentes no ingresadas:</h3>
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th class="col-md-1">No.</th>
              <th class="col-md-2">Fuente</th>
              <th class="col-md-2">Representante</th>
            </tr>
          </thead>
          <tbody id="tbodyFaltantes"></tbody>
        </table>
      </div>

    </div>
  </div>


<input type="hidden" name="_token" id="token" value="<?php echo csrf_token(); ?>">

@stop

@section('js')
{{HTML::script('sweetAlert/sweetalert.min.js')}}
{{HTML::script('js/administracion/provGeneral.js')}}

@stop

@section('javascript')
  <script>
  $('#collapsePrevi').addClass('in');
  $('#liGeneral').addClass('activoBorde');
  </script>
@stop
