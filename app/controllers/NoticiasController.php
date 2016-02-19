<?php

class NoticiasController extends BaseController{


  public function ingresoNoticia(){ /**INGRESO **/

    $token = Input::get('token');

    if(isset($token)) {
      $data = array(
        'titulos' => Input::get('t'),
        'contenidos' => Input::get('c'),
        'fuentes' => Input::get('f'),
        'responsable' => Input::get('i')
      );

     $validaciones = array('titulos' => array('required','regex:/^([0-9a-zA-ñÑZáéíóúñÁÉÍÓÚ\-\"\”\“\s\,\$\.\%\?\¿\/\¡\!])+$/')
     );

     $validator = Validator::make($data, $validaciones);

     if ($validator->fails()){
        $respuesta;
        $mensajes = $validator->messages();
        foreach ($mensajes->all() as $mensaje){
            $respuesta = $mensaje;
        }

          $response = array(
            'status' => 'ERRORV',
            'message' => $respuesta
          );
      }
      else{

        $format = "Y-m-d H:i:s";
        $timestamp = time();
        $fecha =  date($format, $timestamp);

            $insert = Noticias::insert(array(
              'notTitulo' => trim($data['titulos']),
              'notContenido' => trim($data['contenidos']),
              'notFuente' => trim($data['fuentes']),
              'notFecha'=> $fecha,
              'notResponsables'=> $data['responsable'],
              'notFinalizar'=> 0,

            ));

              if ( $insert ){
                $response = array(
                  'status' => 'OK',
                  'message' => 'Noticia agregado correctamente.');

              }
              else
                $response = array(
                  'status' => 'ERROR',
                  'message' => 'No se pudo realizar el responsable, intente de nuevo'
                );


      }
    }

    else{
      $response = array(
        'status' => 'ERROR',
        'message' => 'Vuelva a intentar en un momento'
      );
    }



    return Response::json( $response );
  }

  public function getNoticiasIngreso(){ /**EDITAR SERVICIO*****/

      $token = Input::get('token');

      if(isset($token)) {
        $data = array(
          'fuente' => Input::get('f')
        );

       $validaciones = array('fuente' => array('required', 'regex:/^([0-9a-zA-ñÑZáéíóúñÁÉÍÓÚ\-\s\,\.\?\¿\¡\!])+$/')

       );

       $validator = Validator::make($data , $validaciones);

       if ($validator->fails()){
          $respuesta;
          $mensajes = $validator->messages();
          foreach ($mensajes->all() as $mensaje){
              $respuesta = $mensaje;
          }

            $response = array(
              'status' => 'ERROR',
              'message' => $respuesta
            );
        }
        else{

          $format = "Y-m-d";
          $timestamp = time();
          $fecha =  date($format, $timestamp);
          $fechaInicio = $fecha." 00:00:00";
          $fechaFin = $fecha." 23:59:59";

          $seleccionar = DB::select('SELECT notId, notTitulo, notContenido FROM noticias WHERE notFecha>= "'.$fechaInicio.'" AND notFecha <= "'.$fechaFin.'" AND notFuente = '.$data['fuente'].';');
              if ( $seleccionar )
                $response = array(
                  'data' => $seleccionar,
                  'status' => 'OK',
                  'message' => 'ok'
                  );
              else
                $response = array (
                  'status' => 'ERROR',
                  'message' => 'No se puede obtener la información, intente de nuevo'
                  );
            }
      }

      else{
        $response = array(
          'status' => 'ERROR',
          'message' => 'Vuelva a intentar en un momento'
        );
      }
      return Response::json( $response );
  }


  public function getNoticiasSesion(){ /**EDITAR SERVICIO*****/

      $token = Input::get('token');

      if(isset($token)) {
        $data = array(
          'idResponsable' => Input::get('i')
        );

       $validaciones = array('idResponsable' => array('required', 'regex:/^([0-9a-zA-ñÑZáéíóúñÁÉÍÓÚ\-\s\,\.\?\¿\¡\!])+$/')

       );

       $validator = Validator::make($data , $validaciones);

       if ($validator->fails()){
          $respuesta;
          $mensajes = $validator->messages();
          foreach ($mensajes->all() as $mensaje){
              $respuesta = $mensaje;
          }

            $response = array(
              'status' => 'ERROR',
              'message' => $respuesta
            );
        }
        else{

          $format = "Y-m-d";
          $timestamp = time();
          $fecha =  date($format, $timestamp);
          $fechaInicio = $fecha." 00:00:00";
          $fechaFin = $fecha." 23:59:59";

          //$seleccionar = DB::select('SELECT f.fueNombre, n.notId, n.notTitulo, n.notContenido, a.asiId FROM noticias n, fuentes f, asignaciones a WHERE a.asiResponsables='.$data['idResponsable'].' AND a.asiFuentes=f.fueId AND n.notFuente=f.fueId AND notFecha>= "'.$fechaInicio.'" AND notFecha<="'.$fechaFin.'" ORDER BY f.fueId;');
          $seleccionar = DB::select('SELECT f.fueNombre, n.notId, n.notTitulo, n.notContenido, r.resNombre FROM noticias n, fuentes f, responsables r WHERE  n.notFinalizar=FALSE AND n.notFuente = f.fueId AND n.notResponsables = '.$data['idResponsable'].'  AND n.notFecha >= "'.$fechaInicio.'" AND n.notFecha <= "'.$fechaFin.'" GROUP BY n.notId ORDER BY f.fueId;');
              if ( $seleccionar )
                $response = array(
                  'data' => $seleccionar,
                  'status' => 'OK',
                  'message' => 'ok'
                  );
              else
                $response = array (
                  'status' => 'ERROR',
                  'message' => 'No se puede obtener la información, intente de nuevo'
                  );
            }
      }

      else{
        $response = array(
          'status' => 'ERROR',
          'message' => 'Vuelva a intentar en un momento'
        );
      }
      return Response::json( $response );
  }

  /***********************/

  public function getNoticia(){
    $token = Input::get('token');

    if(isset($token)) {
      $data = array(
        'idNoticia' => Input::get('i')
      );

     $validaciones = array('idNoticia' => array('required', 'regex:/^([0-9a-zA-ñÑZáéíóúñÁÉÍÓÚ\-\s\,\.\?\¿\¡\!])+$/')

     );

     $validator = Validator::make($data , $validaciones);

     if ($validator->fails()){
        $respuesta;
        $mensajes = $validator->messages();
        foreach ($mensajes->all() as $mensaje){
            $respuesta = $mensaje;
        }

          $response = array(
            'status' => 'ERROR',
            'message' => $respuesta
          );
      }
      else{


        $seleccionar = DB::select('SELECT n.notTitulo, n.notContenido, n.notFuente FROM noticias n WHERE n.notId='.$data['idNoticia'].';');
            if ( $seleccionar )
              $response = array(
                'data' => $seleccionar,
                'status' => 'OK',
                'message' => 'ok'
                );
            else
              $response = array (
                'status' => 'ERROR',
                'message' => 'No se puede obtener la información, intente de nuevo'
                );
          }
    }

    else{
      $response = array(
        'status' => 'ERROR',
        'message' => 'Vuelva a intentar en un momento'
      );
    }
    return Response::json( $response );
  }


   public function elimiarNoticia(){
    $token = Input::get('token');

    if(isset($token)) {
      $data = array(
        'id' => Input::get('i')
      );

     $validaciones = array('id' => array('required', 'alpha_num')
     );

     $validator = Validator::make($data , $validaciones);

     if ($validator->fails()){
        $respuesta;
        $mensajes = $validator->messages();
        foreach ($mensajes->all() as $mensaje){
            $respuesta = $mensaje;
        }

          $response = array(
            'status' => 'ERROR',
            'message' => $respuesta
          );
      }
      else{

            $eliminar = DB::table('noticias')->where('notId', '=', $data['id'])->delete();

            if ( $eliminar )
              $response = array(
                'status' => 'OK',
                'message' => 'Noticia eliminada'
                );
            else
              $response = array (
                'status' => 'ERROR',
                'message' => 'No se puede eliminar la noticia, intente de nuevo'
                );
          }
    }

    else{
      $response = array(
        'status' => 'ERROR',
        'message' => 'Vuelva a intentar en un momento'
      );
    }
    return Response::json( $response );
  }


  public function editarNot(){ /**INGRESO Servicio**/

    $token = Input::get('token');

    if(isset($token)) {
      $data = array(
        't' => Input::get('t'),
        'c' => Input::get('c'),
        'f' => Input::get('f'),
        'id'=> Input::get('i')
      );

     $validaciones = array('t' => array('required','regex:/^([0-9a-zA-ñÑZáéíóúñÁÉÍÓÚ\-\s\,\.\?\¿\¡\!])+$/'),
                           'c' => array('regex:/^([0-9a-zA-ñÑZáéíóúñÁÉÍÓÚ\-\s\,\.\?\¿\¡\!])+$/'),
                           'f' => array('required', 'alpha_num'),
                           'id' => array('required', 'alpha_num')
     );

     $validator = Validator::make($data, $validaciones);

     if ($validator->fails()){
        $respuesta;
        $mensajes = $validator->messages();
        foreach ($mensajes->all() as $mensaje){
            $respuesta = $mensaje;
        }

          $response = array(
            'status' => 'ERRORV',
            'message' => $respuesta
          );
      }
      else{

        $format = "Y-m-d H:i:s";
        $timestamp = time();
        $fecha =  date($format, $timestamp);

        $editar = Noticias::where('notId', $data['id'])
        ->update(array(
          'notTitulo'   => $data['t'],
          'notContenido'=> $data['c'],
          'notFecha' => $fecha,
          'notFuente'=> $data['f']
        ));

              if ( $editar ){
                $response = array(
                  'status' => 'OK',
                  'message' => 'Noticia editada correctamente.');

              }
              else
                $response = array(
                  'status' => 'ERROR',
                  'message' => 'No se pudo editar la noticia, intente de nuevo'
                );
      }
    }

    else{
      $response = array(
        'status' => 'ERROR',
        'message' => 'Vuelva a intentar en un momento'
      );
    }
    return Response::json( $response );
  }


  public function getNoticiasPrev(){
      if( !Sesion::isAdmin() )
      return Redirect::to('administracion/logout');

      /*$seleccionar = Fuentes::get()
        ->toArray();
*/
      $format = "Y-m-d";
      $timestamp = time();
      $fecha =  date($format, $timestamp);
      $fechaInicio = $fecha." 00:00:00";
      $fechaFin = $fecha." 23:59:59";

    //  $seleccionar=DB::select('SELECT f.fueNombre, n.notTitulo, n.notContenido, r.resNombre, n.notId FROM noticias n, fuentes f, responsables r WHERE n.notFuente = f.fueId AND n.notResponsables = r.resId  AND n.notFecha >= "'.$fechaInicio.'" AND n.notFecha <= "'.$fechaFin.'" GROUP BY notId ORDER BY f.fueid;');
      $seleccionar=NoticiasController::consultaNoticiasPrev($fechaInicio, $fechaFin);

      if ( count( $seleccionar ) > 0 )
        $response = array(
          'status' => 'OK',
          'data' => $seleccionar,
          'message' => 'Resultados obtenidos'
        );
      else
        $response = array(
          'status' => 'ERROR',
          'message' => 'No se encontraron noticias registradas.'
        );

      return Response::json($response);
  }
/************************************************************************/
  static public function consultaNoticiasPrev($fechaInicio, $fechaFin){
    $seleccionar=DB::select('SELECT f.fueNombre, n.notTitulo, n.notContenido, r.resNombre, n.notId FROM noticias n, fuentes f, responsables r WHERE n.notFuente = f.fueId AND n.notResponsables = r.resId  AND n.notFecha >= "'.$fechaInicio.'" AND n.notFecha <= "'.$fechaFin.'" AND notFinalizar=1 GROUP BY notId ORDER BY f.fueid;');
    return $seleccionar;
  }

  static public function consultaNoticiasEnvio($fechaInicio, $fechaFin){
    //$seleccionar=DB::select('SELECT f.fueNombre, n.notTitulo, n.notContenido, r.resNombre, n.notId FROM noticias n, fuentes f, responsables r WHERE n.notFuente = f.fueId AND n.notResponsables = r.resId  AND n.notFecha >= "'.$fechaInicio.'" AND n.notFecha <= "'.$fechaFin.'" GROUP BY notId ORDER BY f.fueid;');
    $seleccionar=Noticias::
    leftJoin('fuentes', 'noticias.notFuente', '=', 'fuentes.fueId')
    ->where('notFecha','>=',$fechaInicio)
    ->where('notFecha','<=',$fechaFin)
    ->groupBy('notId')
    ->orderBy('fueid')
    ->get(array(
          'fueNombre',
          'notTitulo',
          'notContenido'
            ))
    ->toArray();


    return $seleccionar;
  }



  public function getPrevSimplificada(){
      if( !Sesion::isAdmin() )
      return Redirect::to('administracion/logout');

      $format = "Y-m-d";
      $timestamp = time();
      $fecha =  date($format, $timestamp);
      $fechaInicio = $fecha." 00:00:00";
      $fechaFin = $fecha." 23:59:59";

      $seleccionar=NoticiasController::consultaGetPrevSimplificada($fechaInicio, $fechaFin);

      if ( count( $seleccionar ) > 0 )
        $response = array(
          'status' => 'OK',
          'data' => $seleccionar,
          'message' => 'Resultados obtenidos'
        );
      else
        $response = array(
          'status' => 'ERROR',
          'message' => 'No se encontraron noticias registradas.'
        );

      return Response::json($response);
  }
  /************************************************************************/
  static public function consultaGetPrevSimplificada($fechaInicio, $fechaFin){
    $seleccionar=DB::select('SELECT f.fueNombre, n.notTitulo, SUBSTR(n.notContenido,1,200) AS notContenido, n.notFecha, r.resNombre, n.notId FROM noticias n, fuentes f, responsables r WHERE n.notFuente = f.fueId AND n.notResponsables = r.resId  AND n.notFecha >= "'.$fechaInicio.'" AND n.notFecha <= "'.$fechaFin.'" AND notFinalizar=1 GROUP BY notId ORDER BY f.fueid;');
    return $seleccionar;
  }



  public function getNoticiasIngresadas(){
      if( !Sesion::isAdmin() )
      return Redirect::to('administracion/logout');


      $format = "Y-m-d";
      $timestamp = time();
      $fecha =  date($format, $timestamp);
      $fechaInicio = $fecha." 00:00:00";
      $fechaFin = $fecha." 23:59:59";

    //  $ser=DB::select('SELECT f.fueNombre, r.resNombre, f.fueId FROM noticias n, fuentes f, responsables r WHERE n.notFuente = f.fueId AND n.notResponsables = r.resId  AND n.notFecha >= "'.$fechaInicio.'" AND n.notFecha <= "'.$fechaFin.'" GROUP BY f.fueid ORDER BY f.fueid;');
    $seleccionar=NoticiasController::consultaNoticiasIngresadas($fechaInicio, $fechaFin);

      if ( count( $seleccionar ) > 0 )
        $response = array(
          'status' => 'OK',
          'data' => $seleccionar,
          'message' => 'Resultados obtenidos'
        );
      else
        $response = array(
          'status' => 'ERROR',
          'message' => 'No se encontraron noticias registradas.'
        );

      return Response::json($response);
  }
  /************/
  static  public function  consultaNoticiasIngresadas($fechaInicio, $fechaFin){
    $seleccionar=DB::select('SELECT f.fueNombre, r.resNombre, f.fueId FROM noticias n, fuentes f, responsables r WHERE n.notFuente = f.fueId AND n.notResponsables = r.resId  AND n.notFecha >= "'.$fechaInicio.'" AND n.notFecha <= "'.$fechaFin.'"AND notFinalizar=1 GROUP BY f.fueid ORDER BY f.fueid;');
    return $seleccionar;
  }
  /************/

  function repFuente(){
    $token = Input::get('token');

    if(isset($token)) {
      $data = array(
        'id' => Input::get('i'),
        'id2' => Input::get('i2'),
        'id3' => Input::get('i3'),
        'id4' => Input::get('i4'),
        'id5' => Input::get('i5'),
        'id6' => Input::get('i6')
      );

     $validaciones = array('id' => array('required')
   );

     $validator = Validator::make($data, $validaciones);

     if ($validator->fails()){
        $respuesta;
        $mensajes = $validator->messages();
        foreach ($mensajes->all() as $mensaje){
            $respuesta = $mensaje;
        }

          $response = array(
            'status' => 'ERRORV',
            'message' => $respuesta
          );
      }
      else{
      //$seleccionar=DB::select('SELECT n.notId, f.fueNombre, r.resNombre, n.notFecha, n.notTitulo, n.notContenido FROM noticias n, fuentes f, responsables r WHERE f.fueId = '.$data['id'].' AND f.fueId=n.notFuente AND n.notResponsables = r.resId;');
      $seleccionar=NoticiasController::consultaRepFuente($data['id'],$data['id2'],$data['id3'],$data['id4'],$data['id5'],$data['id6']);

        if ( count( $seleccionar ) > 0 )
          $response = array(
            'status' => 'OK',
            'data' => $seleccionar,
            'message' => 'Resultados obtenidos'
          );
        else
          $response = array(
            'status' => 'ERROR',
            'message' => 'No se encontraron noticias registradas.'
          );
      }
    }

    else{
      $response = array(
        'status' => 'ERROR',
        'message' => 'Vuelva a intentar en un momento'
      );
    }
    return Response::json( $response );
  }

  static  public function  consultaRepFuente($id, $id2,$id3,$id4,$id5,$id6){
    $querySelect='SELECT f.fueNombre, n.notTitulo, n.notContenido, n.notFecha, r.resNombre FROM noticias n LEFT JOIN fuentes f ON notFuente=fueId LEFT JOIN responsables r ON resId=notResponsables';
    $queryWhere=' WHERE f.fueId='.$id.' OR f.fueId='.$id2.' OR f.fueId='.$id3.' OR f.fueId='.$id4.' OR f.fueId='.$id5.' OR f.fueId='.$id6;
    $queryBy=' GROUP BY n.notId ORDER BY f.fueId ASC, notFecha DESC;';
    $seleccionar=DB::select($querySelect.$queryWhere.$queryBy);

    return $seleccionar;
  }
  /************/
  function repFuentePer(){
    $token = Input::get('token');

    if(isset($token)) {
      $data = array(
        'id' => Input::get('i'),
        'id2' => Input::get('i2'),
        'id3' => Input::get('i3'),
        'id4' => Input::get('i4'),
        'id5' => Input::get('i5'),
        'id6' => Input::get('i6'),
        'fI' => Input::get('fi'),
        'fF' => Input::get('ff')
      );

     $validaciones = array('id' => array('required')
        );

     $validator = Validator::make($data, $validaciones);

     if ($validator->fails()){
        $respuesta;
        $mensajes = $validator->messages();
        foreach ($mensajes->all() as $mensaje){
            $respuesta = $mensaje;
        }

          $response = array(
            'status' => 'ERRORV',
            'message' => $respuesta
          );
      }
      else{
        $fechaInicio= $data['fI']." 00:00:00";
        $fechaFin= $data['fF']." 23:59:59";
        $seleccionar=NoticiasController::consultaRepFuentePer($data['id'],$data['id2'],$data['id3'],$data['id4'],$data['id5'],$data['id6'], $fechaInicio, $fechaFin);
        //$seleccionar=DB::select('SELECT n.notId, f.fueNombre, r.resNombre, n.notFecha, n.notTitulo, n.notContenido FROM noticias n, fuentes f, responsables r WHERE f.fueId = '.$data['id'].' AND f.fueId=n.notFuente AND n.notResponsables = r.resId AND n.notFecha >="'.$fechaInicio.'" AND n.notFecha <="'.$fechaFin.'";');


        if ( count( $seleccionar ) > 0 )
          $response = array(
            'status' => 'OK',
            'data' => $seleccionar,
            'message' => 'Resultados obtenidos'
          );
        else
          $response = array(
            'status' => 'ERROR',
            'message' => 'No se encontraron noticias registradas para la fuente en dicho período.'
          );
      }
    }

    else{
      $response = array(
        'status' => 'ERROR',
        'message' => 'Vuelva a intentar en un momento'
      );
    }
    return Response::json( $response );
  }

  static  public function  consultaRepFuentePer($id, $id2,$id3,$id4,$id5,$id6,$fi,$ff){
    //$seleccionar=DB::select('SELECT n.notId, f.fueNombre, r.resNombre, n.notFecha, n.notTitulo, n.notContenido FROM noticias n, fuentes f, responsables r WHERE f.fueId = '.$id.' AND f.fueId=n.notFuente AND n.notResponsables = r.resId AND n.notFecha >="'.$fi.'" AND n.notFecha <="'.$ff.'";');
    $querySelect='SELECT n.notId, f.fueNombre, r.resNombre, n.notFecha, n.notTitulo, n.notContenido FROM noticias n LEFT JOIN fuentes f ON notFuente=fueId LEFT JOIN responsables r ON resId=notResponsables';
    $queryWhere=' WHERE n.notFecha >="'.$fi.'" AND n.notFecha <="'.$ff.'" AND( f.fueId='.$id.' OR f.fueId='.$id2.' OR f.fueId='.$id3.' OR f.fueId='.$id4.' OR f.fueId='.$id5.' OR f.fueId='.$id6.')';
    $queryBy=' GROUP BY n.notId ORDER BY f.fueId ASC, notFecha DESC;';
    $seleccionar=DB::select($querySelect.$queryWhere.$queryBy);
    return $seleccionar;
  }
/*****************/
function repRepre(){
  $token = Input::get('token');

  if(isset($token)) {
    $data = array(
      'id' => Input::get('i')
    );

   $validaciones = array('id' => array('required')
      );

   $validator = Validator::make($data, $validaciones);

   if ($validator->fails()){
      $respuesta;
      $mensajes = $validator->messages();
      foreach ($mensajes->all() as $mensaje){
          $respuesta = $mensaje;
      }

        $response = array(
          'status' => 'ERRORV',
          'message' => $respuesta
        );
    }
    else{

    $seleccionar=NoticiasController::consultaRepRepre($data['id']);

      if ( count( $seleccionar ) > 0 )
        $response = array(
          'status' => 'OK',
          'data' => $seleccionar,
          'message' => 'Resultados obtenidos'
        );
      else
        $response = array(
          'status' => 'ERROR',
          'message' => 'No se encontraron noticias registradas.'
        );
    }
  }

  else{
    $response = array(
      'status' => 'ERROR',
      'message' => 'Vuelva a intentar en un momento'
    );
  }
  return Response::json( $response );
}

static  public function  consultaRepRepre($id){
  $seleccionar=DB::select('SELECT n.notId, f.fueNombre, r.resNombre, n.notFecha, n.notTitulo, n.notContenido FROM noticias n, fuentes f, responsables r WHERE r.resId = '.$id.' AND f.fueId=n.notFuente AND n.notResponsables = r.resId;');
  return $seleccionar;
}
/**************/
function repReprePer(){
  $token = Input::get('token');

  if(isset($token)) {
    $data = array(
      'id' => Input::get('i'),
      'fI' => Input::get('fi'),
      'fF' => Input::get('ff')
    );

   $validaciones = array('id' => array('required')
      );

   $validator = Validator::make($data, $validaciones);

   if ($validator->fails()){
      $respuesta;
      $mensajes = $validator->messages();
      foreach ($mensajes->all() as $mensaje){
          $respuesta = $mensaje;
      }

        $response = array(
          'status' => 'ERRORV',
          'message' => $respuesta
        );
    }
    else{
      $fechaInicio= $data['fI']." 00:00:00";
      $fechaFin= $data['fF']." 23:59:59";
      $seleccionar=NoticiasController::consultaReprePer($data['id'],  $fechaInicio, $fechaFin);



      if ( count( $seleccionar ) > 0 )
        $response = array(
          'status' => 'OK',
          'data' => $seleccionar,
          'message' => 'Resultados obtenidos'
        );
      else
        $response = array(
          'status' => 'ERROR',
          'message' => 'No se encontraron noticias registradas para el representante en dicho período.'
        );
    }
  }

  else{
    $response = array(
      'status' => 'ERROR',
      'message' => 'Vuelva a intentar en un momento'
    );
  }
  return Response::json( $response );
}

static  public function  consultaReprePer($id,$fi,$ff){
  $seleccionar=DB::select('SELECT f.fueNombre, r.resNombre, n.notFecha, n.notTitulo, n.notContenido FROM noticias n, fuentes f, responsables r WHERE n.notFuente = f.fueId AND n.notResponsables = r.resId  AND n.notFecha >= "'.$fi.'" AND n.notFecha <= "'.$ff.'" AND r.resId='.$id.' GROUP BY n.notId ORDER BY f.fueId, n.notFecha;');

  return $seleccionar;
}


/**************************/
  function repPeriodo(){
    $token = Input::get('token');

    if(isset($token)) {
      $data = array(
        'fInicio' => Input::get('fi'),
        'fFin' => Input::get('ff')
      );

     $validaciones = array('fInicio' => array('date'),
                           'fFin' => array('date')
     );

     $validator = Validator::make($data, $validaciones);

     if ($validator->fails()){
        $respuesta;
        $mensajes = $validator->messages();
        foreach ($mensajes->all() as $mensaje){
            $respuesta = $mensaje;
        }

          $response = array(
            'status' => 'ERRORV',
            'message' => $respuesta
          );
      }
      else{
        $fechaInicio = $data['fInicio']." 00:00:00";
        $fechaFin = $data['fFin']." 23:59:59";

        $seleccionar=DB::select('SELECT f.fueNombre, r.resNombre, n.notFecha, n.notTitulo, n.notContenido FROM noticias n, fuentes f, responsables r WHERE n.notFuente = f.fueId AND n.notResponsables = r.resId  AND n.notFecha >= "'.$fechaInicio.'" AND n.notFecha <= "'.$fechaFin.'" GROUP BY n.notId ORDER BY f.fueId, n.notFecha;');

        if ( count( $seleccionar ) > 0 )
          $response = array(
            'status' => 'OK',
            'data' => $seleccionar,
            'message' => 'Resultados obtenidos'
          );
        else
          $response = array(
            'status' => 'ERROR',
            'message' => 'No se encontraron noticias registradas.'
          );
      }
    }

    else{
      $response = array(
        'status' => 'ERROR',
        'message' => 'Vuelva a intentar en un momento'
      );
    }
    return Response::json( $response );
  }

  public function getPeriodoResponsable(){
    if( !Sesion::isAdmin() )
    return Redirect::to('administracion/logout');

    $format = "Y-m-d";
    $timestamp = time();
    $fechaHoy =  date($format, $timestamp);

    $seleccionar=DB::select('SELECT f.fueNombre, r.resNombre, r.resId, f.fueId FROM fuentes f, responsables r, periodos p, asignaciones a WHERE p.perInicio <= "'.$fechaHoy.'" AND p.perFin >= '.$fechaHoy.' AND p.perId = a.asiPeriodos AND a.asiResponsables = r.resId  AND a.asiFuentes = f.fueId GROUP BY f.fueid ORDER BY f.fueid;');

    if ( count( $seleccionar ) > 0 )
      $response = array(
        'status' => 'OK',
        'data' => $seleccionar,
        'message' => 'Resultados obtenidos'
      );
    else
      $response = array(
        'status' => 'ERROR',
        'message' => 'No se encontraron noticias registradas.'
      );

    return Response::json($response);
  }

  public function finalizarNot(){
    $token = Input::get('token');

    if(isset($token)) {
      $data = array(
        'id' => Input::get('iN')
      );

     $validaciones = array('id' => array('required', 'alpha_num')
     );

     $validator = Validator::make($data, $validaciones);

     if ($validator->fails()){
        $respuesta;
        $mensajes = $validator->messages();
        foreach ($mensajes->all() as $mensaje){
            $respuesta = $mensaje;
        }

          $response = array(
            'status' => 'ERRORV',
            'message' => $respuesta
          );
      }
      else{

    /*    $format = "Y-m-d H:i:s";
        $timestamp = time();
        $fecha =  date($format, $timestamp);
*/
        $editar = Noticias::where('notId', $data['id'])
        ->update(array(
          'notFinalizar' => 1
        ));

              if ( $editar ){
                $response = array(
                  'status' => 'OK',
                  'message' => 'Noticia editada correctamente.');

              }
              else
                $response = array(
                  'status' => 'ERRORBD',
                  'message' => 'No se pudo finalizar el ingreso, intente de nuevo'
                );
      }
    }

    else{
      $response = array(
        'status' => 'ERROR',
        'message' => 'Vuelva a intentar en un momento'
      );
    }
    return Response::json( $response );
  }

}
