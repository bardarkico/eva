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
  @include('seccionesVista.rRepresentante');  
@stop

@section('js')
{{HTML::script('sweetAlert/sweetalert.min.js')}}
{{HTML::script('js/administracion/repRepresentante.js')}}

{{HTML::script('datepicker/js/bootstrap-datepicker.js')}}

@stop

@section('javascript')
  <script>
  $('#collapseReportes').addClass('in');
  $('#liRepresentante').addClass('activoBorde');
  </script>
@stop
