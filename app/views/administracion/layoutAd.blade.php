<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta http-equiv="cache-control" content="max-age=0" />
  <meta http-equiv="cache-control" content="no-cache" />
  <meta http-equiv="cache-control" content="must-revalidate" />
  <meta name="author" content="eSantiago" />
  <meta http-equiv="expires" content="0" />
  <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
  <meta http-equiv="pragma" content="no-cache" />
  @section('head')
  @show
  <link rel="icon" type="image/png" href="{{ URL::asset('img/favicon.png'); }}"/>

  <title>
    @section('title')
    @show
  </title>

  {{ HTML::style('css/bootstrap.min.css') }}
  {{ HTML::style('fonts/font-awesome/css/font-awesome.min.css') }}

  {{ HTML::style('css/publicos/sesionA.css') }}
  @section('css')
  @show

  {{ HTML::script('js/jquery.js') }}
  {{ HTML::script('js/bootstrap.min.js')}}

</head>

  <body>
    @section('body')
    @show

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header ">
            <img id="imgI"class="img-responsive" src="{{URL::asset('img/logoNombre.png')}}">
            <input type="hidden" name="idSesion" id="idSesion" value="<?php echo Session::get('id'); ?>">
        </div>

        <ul class="nav navbar-nav navbar-right">
          <li>{{ HTML::link('/administracion', Session::get('nombre')) }}</li>
          <li class="dropdown">
            <a style="cursor:pointer" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-cog "></span> <b class="caret"></b></a>
            <ul class="dropdown-menu">
            <!--    <li>{{ HTML::link('administracion/cambioCA', 'Cambiar contraseña') }}</li> -->
            <!--    <li class="divider"></li> -->
              <li>{{ HTML::link('administracion/logout', 'Cerrar sesión') }}</li>
            </ul>
           </li>
        </ul>

      </div>
    </nav>

      <body>
        <div  id="contenidoUsuario" class="paddingMenu"> <!-- fondo -->
          <div>
          <!--      <div class="row">
              <div class="col-lg-12">
                  <h1 class="page-header tamTitulo grisObscuro texto3D"><span class="glyphicon glyphicon-user"></span> {{Session::get('nombre')}}</h1>

              </div>
            </div>
          -->
          <br><br>
            <div class="row"> <!-- Renglon Principal -->

              <aside class="col-md-2 col-lg-2">
                @include('seccionesVista.administradorMenu')

              </aside>

              <div class="col-md-10 col-lg-10">
                @yield('content') <!-- AQUI SE MUESTRA EL CONTENIDO  -->
              </div>


          </div> <!-- /Renglon Principal -->
          </div>  <!-- /Container -->
        </div>
      </body>

      <!-- Footer -->
      <footer id="piePrincipal"  class="text-center">
        <div class="footer-above">
          <div class="container">
            <div class="row">
              <div class="footer-col col-md-6">
                <h3></h3>
              </div>
              <div class="footer-col col-md-6">
                <h3></h3>

              </div>
            </div>
          </div>
        </div>
      </footer>

      <script>
        //jQuery to collapse the navbar on scroll
        $(window).scroll(function() {
            if ($(".navbar").offset().top > 50) {
                $(".navbar-fixed-top").addClass("top-nav-collapse");
            } else {
                $(".navbar-fixed-top").removeClass("top-nav-collapse");
            }
        });
      </script>
      @section('js')
      @show

  @section('javascript')
  @show
  </body>
</html>
