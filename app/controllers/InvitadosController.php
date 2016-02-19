<?php

class InvitadosController extends BaseController{

  public function ingresoInvitado(){ /**INGRESO **/
      if( !Sesion::isAdmin() )
      return Redirect::to('administracion/logout');

    $token = Input::get('token');

    if(isset($token)) {
      $data = array(
        'nombre' => Input::get('n'),
        'correo' => Input::get('c')
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

        $duplicado = Invitados::where('invCorreo',$data['correo'])
          ->where('invNombre',$data['nombre'])
          ->get()
          ->toArray();

          if ( count( $duplicado ) > 0 )
            return Response::json(array(
            'status' => 'Error',
            'message' => 'Ya existe un responsable con el mismo nombre y correo, verifique'
          ));
          else{
            $insert = Invitados::insert(array(
              'invNombre' => trim($data['nombre']),
              'invCorreo' => trim($data['correo']),
              'invActivo' => true
            ));

              if ( $insert ){
                $response = array(
                  'status' => 'OK',
                  'message' => 'Responsable agregado correctamente.');

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


  public function darBajaInvitado(){    /**DAR BAJA */
      if( !Sesion::isAdmin() )
      return Redirect::to('administracion/logout');

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
              $editar = Invitados::where('invId', $data['id'])
                ->update(array(
                  'invActivo' => false
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

  public function editarInvitado(){ /**EDITAR SERVICIO*****/
      if( !Sesion::isAdmin() )
      return Redirect::to('administracion/logout');

      $token = Input::get('token');

      if(isset($token)) {
        $data = array(
          'n' => Input::get('n'),
          'c' => Input::get('c'),
          'activo' => Input::get('activo'),
          'i' => Input::get('i')
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
              $editar = Invitados::where('invId', $data['i'])
                ->update(array(
                  'invNombre' => $data['n'],
                  'invCorreo' => $data['c'],
                  'invActivo' => $data['activo']
                ));

              if ( $editar )
                $response = array(
                  'status' => 'OK',
                  'message' => 'Invitado actualizado'
                  );
              else
                $response = array (
                  'status' => 'ERROR',
                  'message' => 'No se puede actualizar el invitado, intente de nuevo'
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
  public function getTodosInvitados(){
    if( !Sesion::isAdmin() )
      return Redirect::to('administracion/logout');

       $seleccionar = DB::select('SELECT invId, invNombre, invCorreo, invActivo FROM invitados;');
      if ( count( $seleccionar ) > 0 )
        $response = array(
          'status' => 'OK',
          'data' => $seleccionar,
          'message' => 'Resultados obtenidos'
        );
      else
        $response = array(
          'status' => 'ERROR',
          'message' => 'No se encontraron invitados registradas.'
        );

      return Response::json($response);
  }

  /****Selecciona un servicio*****/
  public function getInvitado(){
    if( !Sesion::isResponsable() ){
      if( !Sesion::isAdmin() )
      return Redirect::to('administracion/logout');
    }

      $data = Input::all();

      $seleccionar = DB::select('SELECT invId, invCorreo, invNombre,invActivo FROM invitados WHERE invId='.$data['i'].';');

      if ( count( $seleccionar ) > 0 )
        $response = array(
          'status' => 'OK',
          'data' => $seleccionar,
          'message' => 'Resultados obtenidos'
        );
      else
        $response = array(
          'status' => 'ERROR',
          'message' => 'No se encontraron invitados registradas.'
        );

      return Response::json($response);
  }

  public function enviarRecordatorio(){
      if( !Sesion::isAdmin() )
      return Redirect::to('administracion/logout');

      $data = Input::all();

    /*  $seleccionar = Responsables::where('resId',$data['i'])
        ->get()
        ->toArray();
*/
      $seleccionar = DB::select('SELECT resNombre, resCorreo FROM responsables WHERE resId='.$data['i'].';');

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
