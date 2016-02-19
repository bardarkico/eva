<!DOCTYPE html>
<html lang="es">
  @include('seccionesVista.cabeceraPagina')
  <body>
    @section('body')
    @show

    @include('seccionesVista.barraNavegacionPagina')

    @yield('content')

    @include('seccionesVista.piePagina')

    @section('js')
    @show

    @section('javascript')
    @show

    <script charset="utf-8">
    //jQuery to collapse the navbar on scroll
    $(window).scroll(function() {
        if ($(".navbar").offset().top > 50) {
            $(".navbar-fixed-top").addClass("top-nav-collapse");
        } else {
            $(".navbar-fixed-top").removeClass("top-nav-collapse");
        }
    });
    </script>
  </body>

</html>
