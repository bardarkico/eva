@extends('administracion.layoutAd')

@section('title')
Administrador | Vázquez Hernández Contadores, S. C.
@stop
@section('css')
  {{ HTML::style('fonts/font-awesome/css/font-awesome.min.css') }}
@stop

@section('content')
<!--
   <div class="row">
    <h2 class="text-primary"><i class="fa fa-book"></i>
      &nbsp;Sesiones
    </h2><br>
    <div class="col-md-12">
      <div class="row">

        <div class="col-md-3 text-center">
          <a href="{{ URL::to('administracion/sesAgregar') }}" class="grisObscuro enlaceSimple">
            <i class="fa fa-plus-circle fa-4x"></i>
            <h4>Agregar</h4>
          </a>
        </div>

        <div class="col-md-3 text-center">
          <a href="{{ URL::to('administracion/sesEditar') }}" class="grisObscuro enlaceSimple">
            <i class="fa fa-pencil-square-o fa-4x"></i>
            <h4>Editar</h4>
          </a>
        </div>

    </div>
  </div>
  </div>
<br><br><br>

  <div class="row">
    <h2 class="text-primary"><span class="glyphicon glyphicon-file"></span>
      &nbsp;Reportes
    </h2><br>
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-3 text-center">
          <a href="{{ URL::to('administracion/repCaptura') }}" class="grisObscuro enlaceSimple">
            <i class="fa fa-plus-circle fa-4x"></i>
            <h4>Capturas</h4>
          </a>
        </div>


      </div>
  </div>
</div>
-->
@stop

@section('js')

@stop
