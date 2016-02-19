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

<center><h2><i class="fa fa-th-list text-primary"></i> Vista Simplificada de fuentes ingresadas</h2></center>
<br><br>
  <div class="col-md-3">
    Fecha:
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
  </div>
</div>
<br>
<div class="row" id="pnlPrevisualizar">
  <div class="col-md-12">

    <div class="form-horizontal" id="form" name="form" novalidate>


       <input type="hidden" name="_token" id="token" value="<?php echo csrf_token(); ?>">

      <div class="row">
        <div class="col-md-12">
          <div class="table-responsive" id="tblPreliminar">

            <table class="table table-striped table-hover table-bordered">
              <thead>
                <tr>
                  <th class="col-md-1">Fuente</th>
                  <th class="col-md-2 text-center">Título</th>
                  <th class="col-md-7 text-center">Noticia</th>
                  <th class="col-md-1 text-center">Responsable</th>
                  <th class="col-md-1 text-center">Hora ingreso</th>
                </tr>
              </thead>
              <tbody id="tbodyPreliminar"></tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
</div>
</div>

@stop

@section('js')
{{HTML::script('sweetAlert/sweetalert.min.js')}}
{{HTML::script('js/administracion/prevSimplificada.js')}}

@stop

@section('javascript')
  <script>
  $('#collapsePrevi').addClass('in');
  $('#liSimplificada').addClass('activoBorde');
  </script>
@stop
