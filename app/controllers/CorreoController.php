
<?php

class CorreoController extends BaseController {

  static function getDia($dia0){
    $dia="";
    switch ($dia0) {
      case '1':
        $dia="Lunes";
        break;
      case '2':
        $dia="Martes";
        break;
      case '3':
        $dia="Miercoles";
        break;
      case '4':
        $dia="Jueves";
        break;
      case '5':
        $dia="Viernes";
        break;
      case '6':
        $dia="Sabado";
        break;
      case '7':
        $dia="Domingo";
        break;
    }
    return $dia;
  }
  static function getMes($mes0){
    $mes="";
    switch ($mes0) {
      case '1':
        $mes="enero";
        break;
      case '2':
        $mes="febrero";
        break;
      case '3':
        $mes="marzo";
        break;
      case '4':
        $mes="abril";
        break;
      case '5':
        $mes="mayo";
        break;
      case '6':
        $mes="junio";
        break;
      case '7':
        $mes="julio";
        break;
      case '8':
        $mes="agosto";
        break;
      case '9':
        $mes="septiembre";
        break;
      case '10':
        $mes="octubre";
        break;
      case '11':
        $mes="noviembre";
        break;
      case '12':
        $mes="diciembre";
        break;
    }
    return $mes;

  }

  public function enviarRecordatorio(){
      if( !Sesion::isAdmin() )
      return Redirect::to('administracion/logout');

      $data = Input::all();

      $seleccionar = Responsables::where('resId',$data['i'])
        ->get()
        ->toArray();

      $resUs = $seleccionar[0];
          $dataCorreo = array(
             'nombre'        => $resUs['resNombre'],
             'correo'        => $resUs['resCorreo']
           );


      $integrantes = Integrantes::where('intResponsable',$data['i'])
      ->get(array(
          'intCorreo'
           ))
          ->toArray();


       if ( count( $integrantes ) > 0 ){

          /*  foreach ($seleccionar as $valor) {
              $toEmail[]= $valor['resCorreo'];
            }
            foreach ($integrantes as $valor) {
              $toEmail[]= $valor['intCorreo'];
            }*/
            $toEmail="edgar.santiago@contadoresvh.com";
            ///*****************
              Mail::send('emails.recordatorio', $dataCorreo, function($message) use($toEmail){
                  $message->to($toEmail);
                  $message->subject('RECORDATORIO DE REGISTRO DE NOTICIA');
                });



       }
        else{ /*Si no tiene integrantes*/
          $toEmail = $dataCorreo['correo'];
                    Mail::send('emails.recordatorio', $dataCorreo, function($message) use($toEmail){
                        $message->to($toEmail);
                        $message->subject('RECORDATORIO DE REGISTRO DE NOTICIA.');
                      });
                    }


      if ( count( $seleccionar ) > 0 )
        $response = array(
          'status' => 'OK',
          'data' => $toEmail,
          'message' => 'Resultados obtenidos'
        );
      else
        $response = array(
          'status' => 'ERROR',
          'message' => 'No se encontraron fuentes registradas.'
        );

      return Response::json($response);

  }

  public function enviarAsignacionesA(){  /*************/
    if( !Sesion::isAdmin() )
    return Redirect::to('administracion/logout');

    $data = array(
      'idPeriodo' => Input::get('i')
    );
    $seleccionar = AsignacionesController::consultaGetAsignacionesActual();

    if ( count( $seleccionar ) > 0 ){

      /*
          $correoInt = Integrantes::where('intActivo',TRUE)
          ->get(array(
              'intCorreo'
               ))
              ->toArray();

          $correoRes = Responsables::where('resActivo',TRUE)
            ->get(array(
                'resCorreo'
                 ))
            ->toArray();




              foreach ($correoInt as $valor) {
                $toEmail[]= $valor['intCorreo'];
              }
              foreach ($correoRes as $valor) {
                $toEmail[]= $valor['resCorreo'];
              }

      */
      $body='';
      $i=1;
      foreach ($seleccionar as $valor) {
        $fuente= $valor['fueNombre'];
        $representante= $valor['resNombre'];
        $body=$body.'<tr>';
        $body=$body.'<td>'.$i.'</td>';
        $body=$body.'<td style="text-align: center">'.$fuente.'</td>';
        $body=$body.'<td style="text-align: center">'.$representante.'</td>';
        $body=$body.'</tr>';
        $i++;

        $periodo="";
        $periodo = $periodo.$valor['perInicio']." a ";
        $periodo = $periodo.$valor['perFin'];
      }

      $titulo="Asignación Actual";

       $dataCorreo = array(
          'titulo'   => $titulo,
          'periodo' => $periodo,
          'body' => $body
        );

      $toEmail = "edgar.santiago@contadoresvh.com";
                Mail::send('emails.envioAsignacionesMail', $dataCorreo, function($message) use($toEmail){
                    $message->to($toEmail);
                    $message->subject('ASIGNACIONES DE FUENTES DE INFORMACIÓN.');
                  });

      $response = array(
                'status' => 'OK',
                'message' => 'Se enviaron correos.'
      );
    }

    else
      $response = array(
        'status' => 'ERROR',
        'message' => 'No se pudo enviar correo.'
      );

    return Response::json($response);
  }


  public function enviarAsignaciones(){ /************/
    if( !Sesion::isAdmin() )
    return Redirect::to('administracion/logout');

    $data = array(
      'idPeriodo' => Input::get('i')
    );
    $seleccionar = AsignacionesController::consultaGetAsignaciones($data['idPeriodo']);

    if ( count( $seleccionar ) > 0 ){

      /*
          $correoInt = Integrantes::where('intActivo',TRUE)
          ->get(array(
              'intCorreo'
               ))
              ->toArray();

          $correoRes = Responsables::where('resActivo',TRUE)
            ->get(array(
                'resCorreo'
                 ))
            ->toArray();




              foreach ($correoInt as $valor) {
                $toEmail[]= $valor['intCorreo'];
              }
              foreach ($correoRes as $valor) {
                $toEmail[]= $valor['resCorreo'];
              }

      */
      $body='';
      $i=1;
      foreach ($seleccionar as $valor) {
        $fuente= $valor['fueNombre'];
        $representante= $valor['resNombre'];
        $body=$body.'<tr>';
        $body=$body.'<td>'.$i.'</td>';
        $body=$body.'<td style="text-align: center">'.$fuente.'</td>';
        $body=$body.'<td style="text-align: center">'.$representante.'</td>';
        $body=$body.'</tr>';
        $i++;
      }

       $dataCorreo = array(
          'fuente'        => "sdas",
          'body' => $body
        );

      $toEmail = "edgar.santiago@contadoresvh.com";
                Mail::send('emails.envioAsignacionesMail', $dataCorreo, function($message) use($toEmail){
                    $message->to($toEmail);
                    $message->subject('ASIGNACIONES DE FUENTES.');
                  });

      $response = array(
                'status' => 'OK',
                'message' => 'Se enviaron correos.'
      );
    }

    else
      $response = array(
        'status' => 'ERROR',
        'message' => 'No se pudo enviar correo.'
      );

    return Response::json($response);
  }


  public function enviarEquipos(){  /***********/
    if( !Sesion::isAdmin() )
    return Redirect::to('administracion/logout');


    $seleccionar= IntegrantesController::consultaGetTodosIntegrantes();

    if ( count( $seleccionar ) > 0 ){

      /*
          $correoInt = Integrantes::where('intActivo',TRUE)
          ->get(array(
              'intCorreo'
               ))
              ->toArray();

          $correoRes = Responsables::where('resActivo',TRUE)
            ->get(array(
                'resCorreo'
                 ))
            ->toArray();




              foreach ($correoInt as $valor) {
                $toEmail[]= $valor['intCorreo'];
              }
              foreach ($correoRes as $valor) {
                $toEmail[]= $valor['resCorreo'];
              }

      */
      $body='';
      $head='';
      $titulo='Integrantes de Equipos';
      $i=1;

      $head=$head.'<td width="3%" >';
      $head=$head.'<div align="center"></div></td>';
      $head=$head.'<td width="10%" ><div align="center"> <h5><strong>Representante</strong> </h5> </div> </td>';
      $head=$head.'<td width="30%" colspan=2> <div align="center"> <h5><strong>Nombre</strong> </h5>  </div> </td>';
      $head=$head.'<td width="30%"> <div align="center"> <h5><strong>Correo</strong> </h5> </div> </td> </tr>';


      foreach ($seleccionar as $valor) {
        $resNombre= $valor['resNombre'];
        $intNombre= $valor['intNombre'];
        $intNombreC= $valor['intNombreCompleto'];
        $intCorreo= $valor['intCorreo'];

        $body=$body.'<tr>';
        $body=$body.'<td>'.$i.'</td>';
        $body=$body.'<td style="text-align: center">'.$resNombre.'</td>';
        $body=$body.'<td style="text-align: center">'.$intNombre.'</td>';
        $body=$body.'<td style="text-align: center">'.$intNombreC.'</td>';
        $body=$body.'<td style="text-align: center">'.$intCorreo.'</td>';
        $body=$body.'</tr>';
        $i++;
      }

       $dataCorreo = array(
          'body' => $body,
          'head' => $head,
          'titulo'=> $titulo
        );

      $toEmail = "edgar.santiago@contadoresvh.com";
                Mail::send('emails.envioEquiposMail', $dataCorreo, function($message) use($toEmail){
                    $message->to($toEmail);
                    $message->subject('EQUIPOS.');
                  });

      $response = array(
                'status' => 'OK',
                'message' => 'Correo enviado.'
      );
    }

    else
      $response = array(
        'status' => 'ERROR',
        'message' => 'No se pudo enviar correo.'
      );

    return Response::json($response);
  }


  public function enviarAhora(){
    $format = "Y-m-d";
    $timestamp = time();
    $fecha =  date($format, $timestamp);
    $fechaInicio = $fecha." 00:00:00";
    $fechaFin = $fecha." 23:59:59";

    $formatEnv = "Y-m-d";
    $fechaEnv =  date($formatEnv, $timestamp);
    $body="";

    $diaSemForm="N";
    $mesForm="n";
    $diaForm="j";
    $anioForm="Y";
    $diaSemEnvio=date($diaSemForm, $timestamp);
    $mesEnvio=date($mesForm, $timestamp);
    $diaEnvio=date($diaForm, $timestamp);
    $anioEnvio=date($anioForm, $timestamp);


    $diaSemana=CorreoController::getDia($diaSemEnvio);
    $mes=CorreoController::getMes($mesEnvio);

    $seleccionar = NoticiasController::consultaNoticiasEnvio($fechaInicio, $fechaFin);

    $fueNombreAnterior="";
    foreach ($seleccionar as $valor) {
      $fueNombre= $valor['fueNombre'];
      $notTitulo= $valor['notTitulo'];
      $notContenido= $valor['notContenido'];

      $fuenteIgual = strcmp ( $fueNombre , $fueNombreAnterior );

      if ($fuenteIgual == 0) {
        $mostrarFuente = "";
      }
      else {
        $mostrarFuente = $fueNombre;
      }
      $fueNombreAnterior=$fueNombre;

      $body=$body.'<br>';
      $body=$body.'<div>';
      $body=$body.'<h2 style="text-align: center; color:#1565c0;"> <u>'.$mostrarFuente.'</u></h2>';
      $body=$body.'<h4 style="text-align: left; color:#1565c0;">'.$notTitulo.'</h4>';
      $body=$body.'<p style="text-align: justify;" >'.$notContenido.'</p>';
      $body=$body.'</div>';

    }




    $dataCorreo = array(
       'fechaEnv' => $fechaEnv,
       'body' => $body,
       'diaSem' => $diaSemana,
       'dia' => $diaEnvio,
       'mes' => $mes,
       'anio' => $anioEnvio
     );

     $asunto = 'VHC_Noticias_'.$fechaEnv;
    $toEmail = "edgar.santiago@contadoresvh.com";
              Mail::send('emails.envioNoticiasMail', $dataCorreo, function($message) use($toEmail, $asunto){
                  $message->to($toEmail);
                  $message->subject($asunto);
                });


  /*  $correoInt = Integrantes::where('intActivo',TRUE)
    ->get(array(
        'intCorreo'
         ))
        ->toArray();

    $correoRes = Responsables::where('resActivo',TRUE)
      ->get(array(
          'resCorreo'
           ))
      ->toArray();

      $correoInv = Invitados::where('invActivo',TRUE)
        ->get(array(
            'invCorreo'
             ))
        ->toArray();


        foreach ($correoInt as $valor) {
          $toEmail[]= $valor['intCorreo'];
        }
        foreach ($correoRes as $valor) {
          $toEmail[]= $valor['resCorreo'];
        }
        foreach ($correoInv as $valor) {
          $toEmail[]= $valor['invCorreo'];
        }*/



    if ( count( $seleccionar ) > 0 )
      $response = array(
        'status' => 'OK',
        'data' => $toEmail,
        'message' => 'Se enviaron correos correctamente.'
      );
    else
      $response = array(
        'status' => 'ERROR',
        'message' => 'No se pudo enviar correo.'
      );

    return Response::json($response);
  }



}
