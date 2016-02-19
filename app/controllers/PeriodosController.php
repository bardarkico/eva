<?php

class PeriodosController extends BaseController{

  public function ingresoPeriodo(){
      if( !Sesion::isAdmin() )
      return Redirect::to('administracion/logout');

    $token = Input::get('token');

    if(isset($token)) {
      $data = array(
        'fInicio' => Input::get('fi'),
        'fFin' => Input::get('ff')
      );

     $validaciones = array('fInicio' => array('required','date'),
                          'fFin' => array('required','date')
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

          $duplicado=DB::select('SELECT perId FROM periodos WHERE perInicio='.$data['fInicio'].' AND perFin='.$data['fFin'].';');

          if ( count( $duplicado ) > 0 )
            return Response::json(array(
            'status' => 'Error',
            'message' => 'Ya existe un período con las mismas fechas, verifique'
          ));
          else{
            $insert = Periodos::insert(array(
              'perInicio' => trim($data['fInicio']),
              'perFin' => trim($data['fFin']),
              'perActivo' => true
            ));

              if ( $insert ){
                $response = array(
                  'status' => 'OK',
                  'message' => 'Período agregado correctamente.');

              }
              else
                $response = array(
                  'status' => 'ERROR',
                  'message' => 'No se pudo realizar el periíodo, intente de nuevo'
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


  public function darBajaPeriodo(){
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
              $editar = Periodos::where('perId', $data['id'])
                ->update(array(
                  'perActivo' => false
                ));

              if ( $editar )
                $response = array(
                  'status' => 'OK',
                  'message' => 'Período dado de baja'
                  );
              else
                $response = array (
                  'status' => 'ERROR',
                  'message' => 'No se puede actualizar el período, intente de nuevo'
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

  public function editarPeriodo(){
    if( !Sesion::isResponsable() ){
      if( !Sesion::isAdmin() )
      return Redirect::to('administracion/logout');
    }

      $token = Input::get('token');

      if(isset($token)) {
        $data = array(
          'fechaFin' => Input::get('ff'),
          'fechaInicio' => Input::get('fi'),
          'i' => Input::get('i'),
          'a' => Input::get('a')
        );

        $validaciones = array('fechaInicio' => array('required','date'),
                             'fechaFin' => array('required','date')
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
              $editar = Periodos::where('perId', $data['i'])
                ->update(array(
                  'perInicio' => $data['fechaInicio'],
                  'perFin' => $data['fechaFin'],
                  'perActivo' => $data['a']
                ));

              if ( $editar )
                $response = array(
                  'status' => 'OK',
                  'message' => 'Período Actualizado'
                  );
              else
                $response = array (
                  'status' => 'ERROR',
                  'message' => 'No se puede actualizar el período, intente de nuevo'
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
  public function getTodosPeriodos(){
    if( !Sesion::isResponsable() ){
      if( !Sesion::isAdmin() )
      return Redirect::to('administracion/logout');
    }

      /*$seleccionar = Periodos::get()
        ->toArray();
        */
        $seleccionar =DB::select('SELECT * FROM periodos ORDER BY perInicio DESC');

      if ( count( $seleccionar ) > 0 )
        $response = array(
          'status' => 'OK',
          'data' => $seleccionar,
          'message' => 'Resultados obtenidos'
        );
      else
        $response = array(
          'status' => 'ERROR',
          'message' => 'No se encontraron períodos registrados.'
        );

      return Response::json($response);
  }

  /****Selecciona un servicio*****/
  public function seleccionarPeriodo(){
    if( !Sesion::isResponsable() ){
      if( !Sesion::isAdmin() )
      return Redirect::to('administracion/logout');
    }

      $data = Input::all();

    /*  $seleccionar = Responsables::where('resId',$data['i'])
        ->get()
        ->toArray();*/
      $seleccionar=DB::select('SELECT perId, perInicio, perFin, perActivo FROM periodos WHERE perId='.$data['i'].';');

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

  public function getPeriodoActivo(){
    if( !Sesion::isResponsable() ){
      if( !Sesion::isAdmin() )
      return Redirect::to('administracion/logout');
    }

      $data = Input::all();

      $seleccionar=DB::select('SELECT perId, perInicio, perFin, perActivo FROM periodos WHERE perActivo=TRUE ORDER BY perInicio DESC;');

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
