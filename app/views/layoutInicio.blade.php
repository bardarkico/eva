<!DOCTYPE html>
<html lang="es">
  @include('seccionesVista.cabeceraPaginaInicio')

    @yield('content')

    {{ HTML::script('js/bootstrap.min.js')}}
    {{HTML::script('js/inicio.js')}}

</html>
