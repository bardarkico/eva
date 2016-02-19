@extends('layoutInicio')

@section('head')
@stop

@section('title')
  Vázquez Hernández Contadores, S. C.
@stop

@section('css')
  {{ HTML::style('css/inicio.css') }}
  {{ HTML::style('datepicker/css/bootstrap-datepicker3.standalone.css') }}
@stop

@section('content')
<body class="fondo">
  <div class="container">



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
            <!--     <li>{{ HTML::link('administracion/logout', 'Cerrar sesión') }}</li>
            <li class="divider"></li> -->
            <li>
              <!--  {{ HTML::link('administracion/logout', 'Por período') }} -->
              <a href="repSesPeriodo"><i class="fa fa-calendar-o"></i> Por período</a>
            </li>
            <li>
              <!-- {{ HTML::link('administracion/logout', 'Por fuente') }}   -->
              <a href="repSesFuente"><i class="fa fa-newspaper-o"></i> Por fuente</a>
            </li>
          </ul>
         </li>

        <li class="dropdown">
          <a style="cursor:pointer" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-cog "></span> <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <!--     <li>{{ HTML::link('administracion/logout', 'Cerrar sesión') }}</li>
            <li class="divider"></li> -->
            <li>
              <a href="administracion/logout"><i class="fa fa-sign-out"></i> Cerrar sesión</a>
            </li>
          </ul>
         </li>


      </ul>

    </div>
  </nav>

<br><br><br><br>


  @include('seccionesVista.rFuente');



</div>


{{HTML::script('js/jquery.js') }}
{{HTML::script('sweetAlert/sweetalert.min.js')}}
{{HTML::script('datepicker/js/bootstrap-datepicker.js')}}
{{HTML::script('js/administracion/repFuente.js') }}
</body>
@stop
