<?php

class IntegrantesController extends BaseController{

  public function ingresoIntegrante(){ /**INGRESO **/
      if( !Sesion::isAdmin() )
      return Redirect::to('administracion/logout');

    $token = Input::get('token');

    if(isset($token)) {
      $data = array(
        'nombre' => Input::get('n'),
        'correo' => Input::get('c'),
        'nCompleto' => Input::get('nc'),
        'responsable' => Input::get('r')
      );

     $validaciones = array('nombre' => array('required','regex:/^([0-9a-zA-ñÑZáéíóúñÁÉÍÓÚ\-\s\,\.\?\¿\¡\!])+$/')
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

        $duplicado = Integrantes::where('intCorreo',$data['correo'])
          ->where('intNombre',$data['nombre'])
          ->get()
          ->toArray();

          if ( count( $duplicado ) > 0 )
            return Response::json(array(
            'status' => 'Error',
            'message' => 'Ya existe un integrante con el mismo nombre y correo, verifique'
          ));
          else{
            $insert = Integrantes::insert(array(
              'intNombre' => trim($data['nombre']),
              'intCorreo' => trim($data['correo']),
              'intNombreCompleto'=> trim($data['nCompleto']),
              'intresponsable' => trim($data['responsable']),
              'intActivo' => true
            ));

              if ( $insert ){
                $response = array(
                  'status' => 'OK',
                  'message' => 'Integrante agregado correctamente.');

              }
              else
                $response = array(
                  'status' => 'ERROR',
                  'message' => 'No se pudo realizar el responsable, intente de nuevo'
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


  public function darBajaIntegrante(){    /**DAR BAJA INTEGRANTE*/
    if( !Sesion::isResponsable() ){
      if( !Sesion::isAdmin() )
      return Redirect::to('administracion/logout');
    }

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
              $editar = Integrantes::where('intId', $data['id'])
                ->update(array(
                  'intActivo' => false
                ));

              if ( $editar )
                $response = array(
                  'status' => 'OK',
                  'message' => 'Fuente actualizado'
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

  public function editarIntegrante(){ /**EDITAR*****/
    if( !Sesion::isResponsable() ){
      if( !Sesion::isAdmin() )
      return Redirect::to('administracion/logout');
    }

      $token = Input::get('token');

      if(isset($token)) {
        $data = array(
          'n' => Input::get('n'),
          'c' => Input::get('c'),
          'nc'=> Input::get('nc'),
          'activo' => Input::get('activo'),
          'i' => Input::get('i'),
          'r' => Input::get('r')
        );

       $validaciones = array('n' => array('required', 'regex:/^([0-9a-zA-ñÑZáéíóúñÁÉÍÓÚ\-\s\,\.\?\¿\¡\!])+$/'),
                             'activo'     => array('required', 'boolean')
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
              $editar = Integrantes::where('intId', $data['i'])
                ->update(array(
                  'intNombre' => $data['n'],
                  'intCorreo' => $data['c'],
                  'intNombreCompleto' => $data['nc'],
                  'intActivo' => $data['activo'],
                  'intResponsable' => $data['r']
                ));

              if ( $editar )
                $response = array(
                  'status' => 'OK',
                  'message' => 'Integrante de equipo actualizado.'
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
  public function getTodosIntegrantes(){
    if( !Sesion::isResponsable() ){
      if( !Sesion::isAdmin() )
      return Redirect::to('administracion/logout');
    }

      $seleccionar= IntegrantesController::consultaGetTodosIntegrantes();

      if ( count( $seleccionar ) > 0 )
        $response = array(
          'status' => 'OK',
          'data' => $seleccionar,
          'message' => 'Resultados obtenidos'
        );
      else
        $response = array(
          'status' => 'ERROR',
          'message' => 'No se encontraron integrantes registradas.'
        );

      return Response::json($response);
  }
  /*******************************/
  static public function consultaGetTodosIntegrantes(){

    $seleccionar=Integrantes::
    leftJoin('responsables', 'integrantes.intResponsable', '=', 'responsables.resId')
    ->orderBy('resId')
    ->get(array(
          'intId',
          'intNombre',
          'intNombreCompleto',
          'intCorreo',
          'intActivo',
          'resNombre'
            ))
          ->toArray();


    return $seleccionar;
  }

  /****Selecciona *****/
  public function getIntegrante(){
    if( !Sesion::isResponsable() ){
      if( !Sesion::isAdmin() )
      return Redirect::to('administracion/logout');
    }

      $data = Input::all();

    $seleccionar =DB::select ('SELECT intId, intNombre, intCorreo, intActivo, intNombreCompleto, intResponsable FROM integrantes WHERE intId='.$data['i'].';');

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


}
