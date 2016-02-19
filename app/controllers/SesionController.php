<?php

class SesionController extends BaseController{

  public function ingresoSesion(){ /**INGRESO Servicio**/

      if( !Sesion::isAdmin() )
      return Redirect::to('administracion/logout');



    $token = Input::get('token');

    if(isset($token)) {
      $data = array(
        'nombre' => Input::get('nombre'),
        'correo' => Input::get('correo'),
        'contra' => Input::get('contra'),
        'tipo' => Input::get('tipo')
      );

     $validaciones = array('nombre' => array('required','regex:/^([0-9a-zA-ñÑZáéíóúñÁÉÍÓÚ\-\s\,\.\?\¿\¡\!])+$/')
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

        $duplicado = Adm::where('admNombre',$data['nombre'])
          ->where('admCorreo',$data['correo'])
          ->get()
          ->toArray();

          if ( count( $duplicado ) > 0 )
            return Response::json(array(
            'status' => 'Error',
            'message' => 'Ya existe una sesion con el mismo nombre y correo, verifique'
          ));
          else{
            $insert = Adm::insert(array(
              'admNombre' => trim($data['nombre']),
              'admPass'=> trim($data['contra']),
              'admCorreo'=> trim($data['correo']),
              'admTipo'=> trim($data['tipo'])
            ));

              if ( $insert ){
                $response = array(
                  'status' => 'OK',
                  'message' => 'Sesion agregada correctamente.');

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

        /*************/
  public function buscarSesion(){
    if( !Sesion::isCaptura() ){
      if( !Sesion::isAdmin() )
      return Redirect::to('administracion/logout');
    }

    $token = Input::get('token');

    if(isset($token)) {
      $data = array(
        'campoBuscar' => Input::get('buscar')
      );

     $validaciones = array('campoBuscar' => array('required', 'alpha_num')
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

        $busqueda = Adm::where('admNombre', 'like', '%'. $data['campoBuscar'] .'%')
          ->get(array(
            'admId',
            'admNombre',
            'admCorreo',
            'admTipo',
            'admActivo'
          ))
          ->toArray();

          if ( count( $busqueda ) > 0 )
            $response = array(
              'status' => 'OK',
              'data' => $busqueda,
              'message' => 'Resultados obtenidos'
            );
          else
            $response = array(
              'status' => 'ERROR',
              'message' => 'No se encontró ninguna revista con esa cadena de caracteres.'
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

/**DAR BAJA SERVICIO*/
  public function darBajaSesion(){
      if( !Sesion::isAdmin() )
      return Redirect::to('administracion/logout');


      $token = Input::get('token');

      if(isset($token)) {
        $data = array(
          'id' => Input::get('id')
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
              $editar = Adm::where('admId', $data['id'])
                ->update(array(
                  'admActivo' => false
                ));

              if ( $editar )
                $response = array(
                  'status' => 'OK',
                  'message' => 'Sesión actualizada'
                  );
              else
                $response = array (
                  'status' => 'ERROR',
                  'message' => 'No se puede actualizar la sesión, intente de nuevo'
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

  /**EDITAR SERVICIO*****/

  public function editarSesion(){

      if( !Sesion::isAdmin() )
      return Redirect::to('administracion/logout');


      $token = Input::get('token');

      if(isset($token)) {
        $data = array(
          'nombre'=> Input::get('nombre'),
          'id'=> Input::get('id'),
          'correo'=> Input::get('correo'),
          'contra'=> Input::get('contra'),
          'tipo'=> Input::get('tipo'),
          'activo'=> Input::get('activo')
        );

       $validaciones = array('nombre' => array('required', 'regex:/^([0-9a-zA-ñÑZáéíóúñÁÉÍÓÚ\-\s\,\.\?\¿\¡\!])+$/'),
                              'contra'=> array('required', 'size:8', 'regex:/^([0-9a-zA-Z@\.\-_])+$/'),
                              'correo'=> array('required', 'email','max:50'),
                             'activo' => array('required', 'boolean'),
                             'id' => array('required', 'alpha_num')
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

              $editar = Adm::where('admId', $data['id'])
                ->update(array(
                  'admNombre' => $data['nombre'],
                  'admPass' => $data['contra'],
                  'admCorreo' => $data['correo'],
                  'admActivo' => $data['activo'],
                  'admTipo' => $data['tipo']
                ));

              if ( $editar )
                $response = array(
                  'status' => 'OK',
                  'message' => 'Sesión actualizada'
                  );
              else
                $response = array (
                  'status' => 'ERROR',
                  'message' => 'No se puede actualizar la revista, intente de nuevo'
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

    /********************************/
  public function getCapturista(){

      $data = Input::all();

      $seleccionar = Adm::where('admTipo',2)
      ->get(array(
        'admId',
        'admNombre'
      ))
      ->toArray();

      if ( count( $seleccionar ) > 0 )
        $response = array(
          'status' => 'OK',
          'data' => $seleccionar,
          'message' => 'Resultados obtenidos'
        );
      else
        $response = array(
          'status' => 'ERROR',
          'message' => 'No se encontraron revistas registradas.'
        );

      return Response::json($response);
  }

  /***********************/
  public function getTodosSesion(){
      if( !Sesion::isAdmin() )
      return Redirect::to('administracion/logout');

      $seleccionar = Adm::get(array(
        'admId',
        'admNombre',
        'admCorreo',
        'admTipo',
        'admActivo'
      ))
      ->toArray();

      if ( count( $seleccionar ) > 0 )
        $response = array(
          'status' => 'OK',
          'data' => $seleccionar,
          'message' => 'Resultados obtenidos'
        );
      else
        $response = array(
          'status' => 'ERROR',
          'message' => 'No se encontraron sesiones registradas.'
        );

      return Response::json($response);
  }
  /****Selecciona un servicio*****/
  public function getSesion(){
    if( !Sesion::isCaptura() ){
      if( !Sesion::isAdmin() )
      return Redirect::to('administracion/logout');
    }

      $data = Input::all();

      $seleccionar = Adm::where('admId',$data['admId'])
        ->get()
        ->toArray();

      if ( count( $seleccionar ) > 0 )
        $response = array(
          'status' => 'OK',
          'data' => $seleccionar,
          'message' => 'Resultados obtenidos'
        );
      else
        $response = array(
          'status' => 'ERROR',
          'message' => 'No se encontraron revistas registradas.'
        );

      return Response::json($response);
  }
}
