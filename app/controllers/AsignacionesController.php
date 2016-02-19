<?php

class AsignacionesController extends BaseController{

  public function ingresoAsignacion(){ /**INGRESO Servicio**/
      if( !Sesion::isAdmin() )
      return Redirect::to('administracion/logout');

    $token = Input::get('token');

    if(isset($token)) {
      $data = array(
        'fuente' => Input::get('f'),
        'representante' => Input::get('r'),
        'periodo' => Input::get('p')
      );

     $validaciones = array('fuente' => array('required','regex:/^([0-9a-zA-ñÑZáéíóúñÁÉÍÓÚ\-\s\,\.\?\¿\¡\!])+$/')
     );

     $validator = Validator::make($data , $validaciones);

     if ($validator->fails()){
        $respuesta;
        $mensajes = $validator->messages();
        foreach ($mensajes->all() as $mensaje){
            $respuesta = $mensaje;
        }

          $response = array(
            'status' => 'ERROR F',
            'message' => $respuesta
          );
      }
      else{

        $duplicado = Asignaciones::where('asiFuentes',$data['fuente'])
          ->where('asiResponsables',$data['representante'])
          ->where('asiPeriodos',$data['periodo'])
          ->get()
          ->toArray();

          if ( count( $duplicado ) > 0 )
            return Response::json(array(
            'status' => 'Error',
            'message' => 'Ya existe una fuente con el mismo nombre, verifique'
          ));
          else{
            $insert = Asignaciones::insert(array(
              'asiFuentes' => trim($data['fuente']),
              'asiResponsables' => trim($data['representante']),
              'asiPeriodos' => trim($data['periodo'])
            ));

              if ( $insert ){
                $response = array(
                  'status' => 'OK',
                  'message' => 'Asignación correcta.');

              }
              else
                $response = array(
                  'status' => 'ERROR',
                  'message' => 'No se pudo realizar el registro, intente de nuevo'
                );
          }

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
  public function editarAsignacion(){
    if( !Sesion::isResponsable() ){
      if( !Sesion::isAdmin() )
      return Redirect::to('administracion/logout');
    }

      $token = Input::get('token');

      if(isset($token)) {
        $data = array(
          'idFuente' => Input::get('f'),
          'idRespresentante' => Input::get('r'),
          'idAsignacion' => Input::get('a')
        );

       $validaciones = array('idFuente' => array('required', 'regex:/^([0-9a-zA-ñÑZáéíóúñÁÉÍÓÚ\-\s\,\.\?\¿\¡\!])+$/')

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
              $editar = Asignaciones::where('asiId', $data['idAsignacion'])
                ->update(array(
                  'asiFuentes' => $data['idFuente'],
                  'asiResponsables' => $data['idRespresentante']
                ));

              if ( $editar )
                $response = array(
                  'status' => 'OK',
                  'message' => 'Fuente actualizada'
                  );
              else
                $response = array (
                  'status' => 'ERROR',
                  'message' => 'No se puede actualizar la fuente, intente de nuevo'
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
  public function getTodosAsignaciones(){
    if( !Sesion::isResponsable() ){
      if( !Sesion::isAdmin() )
      return Redirect::to('administracion/logout');
    }

    $seleccionar = DB::select('SELECT a.asiId, f.fueNombre, r.resNombre FROM fuentes f, responsables r, asignaciones a WHERE a.asiResponsables = r.resId AND a.asiFuentes=fueId GROUP BY f.fueId;');

      if ( count( $seleccionar ) > 0 )
        $response = array(
          'status' => 'OK',
          'data' => $seleccionar,
          'message' => 'Resultados obtenidos'
        );
      else
        $response = array(
          'status' => 'ERROR',
          'message' => 'No se encontraron fuentes registradas.'
        );

      return Response::json($response);
  }

  public function getAsignaciones(){
    if( !Sesion::isResponsable() ){
      if( !Sesion::isAdmin() )
      return Redirect::to('administracion/logout');
    }

    $data = array(
      'idPeriodo' => Input::get('i')
    );

//    $seleccionar = DB::select('SELECT a.asiId, f.fueNombre, r.resNombre FROM fuentes f, responsables r, asignaciones a WHERE a.asiPeriodos='.$data['idPeriodo'].' AND a.asiResponsables = r.resId AND a.asiFuentes=fueId GROUP BY f.fueId;');
    $seleccionar = AsignacionesController::consultaGetAsignaciones($data['idPeriodo']);

      if ( count( $seleccionar ) > 0 )
        $response = array(
          'status' => 'OK',
          'data' => $seleccionar,
          'message' => 'Resultados obtenidos'
        );
      else
        $response = array(
          'status' => 'ERROR',
          'message' => 'No se encontraron asignaciones para el período seleccionado.'
        );

      return Response::json($response);
  }
    /*************/
  static public function consultaGetAsignaciones($idPeriodo){
  //  $seleccionar = DB::select('SELECT a.asiId, f.fueNombre, r.resNombre FROM fuentes f, responsables r, asignaciones a WHERE a.asiPeriodos='.$idPeriodo.' AND a.asiResponsables = r.resId AND a.asiFuentes=fueId GROUP BY f.fueId;');
  $seleccionar=Asignaciones::where('asiPeriodos',$idPeriodo)

  ->leftJoin('responsables', 'asignaciones.asiResponsables', '=', 'responsables.resId')
  ->leftJoin('fuentes', 'asignaciones.asiFuentes', '=', 'fuentes.fueId')
  ->groupBy('fueId')
  ->get(array(
        'asiId',
        'fueNombre',
        'resNombre'
          ))
        ->toArray();

    return $seleccionar;
  }

  public function getAsignacion(){
    if( !Sesion::isResponsable() ){
      if( !Sesion::isAdmin() )
      return Redirect::to('administracion/logout');
    }

    $data = array(
      'id' => Input::get('i')
    );

    $seleccionar = DB::select('SELECT a.asiId, f.fueNombre, f.fueId, a.asiResponsables FROM fuentes f, asignaciones a WHERE a.asiId = '.$data['id'].' AND a.asiFuentes=f.fueId GROUP BY a.asiId;');

      if ( count( $seleccionar ) > 0 )
        $response = array(
          'status' => 'OK',
          'data' => $seleccionar,
          'message' => 'Resultados obtenidos'
        );
      else
        $response = array(
          'status' => 'ERROR',
          'message' => 'No se encontraron fuentes registradas.'
        );

      return Response::json($response);
  }


  public function getAsignacionActual(){
    if( !Sesion::isResponsable() ){
      if( !Sesion::isAdmin() )
      return Redirect::to('administracion/logout');
    }

  $seleccionar = AsignacionesController::consultaGetAsignacionesActual();

      if ( count( $seleccionar ) > 0 )
        $response = array(
          'status' => 'OK',
          'data' => $seleccionar,
          'message' => 'Resultados obtenidos'
        );
      else
        $response = array(
          'status' => 'ERROR',
          'message' => 'No se encontraron fuentes registradas.'
        );

      return Response::json($response);
  }

/***************************************/
  static public function consultaGetAsignacionesActual(){

    $format = "Y-m-d";
    $timestamp = time();
    $fechaA =  date($format, $timestamp);


  $seleccionar=Asignaciones::where('perInicio','<=',$fechaA)
  ->where('perFin','>=',$fechaA)
  ->leftJoin('responsables', 'asignaciones.asiResponsables', '=', 'responsables.resId')
  ->leftJoin('fuentes', 'asignaciones.asiFuentes', '=', 'fuentes.fueId')
  ->leftJoin('periodos', 'asignaciones.asiPeriodos', '=', 'periodos.perId')

//  ->groupBy('fueId')
  ->get(array(
        'fueId',
        'asiId',
        'fueNombre',
        'resNombre',
        'perInicio',
        'perFin'
          ))
        ->toArray();

    return $seleccionar;
  }
}
