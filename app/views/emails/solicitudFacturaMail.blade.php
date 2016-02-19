<html>
  <head>
    <title></title>
  </head>

  <body>
    <p><h3><strong>Solicitud de factura por el siguiente Cliente:</strong></h3></p>
      <p><strong>Nombre:</strong> {{$nombreP}}</p>
      <p><strong>RFC:</strong> {{$rfc}}</p>
      <p><strong>Tipo persona:</strong> {{$tipoPersona}}</p>
      <p><strong>Actividad:</strong> {{$actividad}}</p>
      <p><strong>Teléfono:</strong> {{$telefono}}</p>
      <p><strong>Correo electrónico:</strong> {{$correo}}</p>
      <br>
      <p><strong>Domicilio fiscal</strong>
        <p><strong>Código Postal:</strong> {{$perCodigoP}}</p>
        <p><strong>Calle:</strong> {{$perDCalle}}</p>
        <p><strong>Número:</strong> {{$perDNumero}}</p>
        <p><strong>Colonia:</strong> {{$perDColonia}}</p>
        <p><strong>Municipio:</strong> {{$perDMunicipio}}</p>
        <p><strong>Entidad Federativa:</strong> {{$perDEstado}}</p>
        <p><strong>Nacionalidad:</strong> {{$nacionalidad}}</p>

      <br>
      <p><strong>Folio Contrato:</strong> {{$idContrato}}</p>
      <p><strong>Servicio contratado:</strong> {{$serNombre}}</p>
      <p><strong>Tipo de Consulta:</strong> {{$tConsulta}}</p>      
      <p><strong>Número de consultas:</strong> {{$nConsulta}}</p>
      <p><strong>Precio:</strong> {{$precioContrato}}.00</p>
      <p><strong>Fecha en que realizo el contrato: </strong> {{$diaContrato}}  {{$mesContrato}}  {{$anioContrato}}</p>
      <br><br>
      <p><strong>Fecha, hora en que el cliente realizo la solicitud de factura:</strong> {{$fechaSol}}.00</p>
  </body>
</html>
