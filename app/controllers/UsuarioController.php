<?php

class UsuarioController extends BaseController
{

  public function login(){
    $datos = Input::all();

    if ( !array_key_exists('usuario', $datos) || $datos['usuario'] === "" ){
      Session::flush();
      return Redirect::to('/?e=01');
    }
    if ( !array_key_exists('pass', $datos) || $datos['pass'] === "" ){
      Session::flush();
      return Redirect::to('/?e=01');
    }

    /* Reglas de validación */
    $rules = array(
        'usuario' => array('required', 'email','max:50'),
        'pass'    => array('required',  'regex:/^([0-9a-zA-Z@\.\-_])+$/')
      );
    $validator = Validator::make($datos, $rules);
      if( $validator->fails() ){
        Session::flush();
        return Redirect::to('/?e=10VAlidacion');
      }


    $admVH = 0;                                               //INTERNO
    $admVH = Responsables::where('resCorreo', $datos['usuario'])
      ->get(array(
          'resNombre',
          'resId'
          ))
      ->toArray();
    if (count( $admVH ) > 0 ){
        $resAdm = $admVH[0];
        $passAdm = $resAdm['resNombre'];
        if ( $datos['pass']== $passAdm ){
          Session::put('tipo', '010');
          Session::put('id', $resAdm['resId']);
          Session::put('nombre', $resAdm['resNombre']);
          return Redirect::to('/inicio2');
          }
      else{
            Session::flush();
            return Redirect::to('/?e=11ADM');
          }
    }


/*

        $admVH = 0;                                               //ADM
        $admVH = Adm::where('admCorreo', $datos['usuario'])
          ->where('admTipo', 1)          ->get(array(
              'admPass',
              'admId'
              ))
          ->toArray();
        if (count( $admVH ) > 0 ){
            $resAdm = $admVH[0];
            $passAdm = $resAdm['admPass'];
            if ( $datos['pass']== $passAdm ){
              Session::put('tipo', '001');
              Session::put('id', $resAdm['admId']);
              Session::put('nombre', "Administrador");
              return Redirect::to('/administracion');
              }
          else{
                Session::flush();
                return Redirect::to('/?e=11ADM');
              }
        }*/

      return Redirect::to('/?e=100');
  }


  public function loginA(){
    $datos = Input::all();

    if ( !array_key_exists('usuario', $datos) || $datos['usuario'] === "" ){
      Session::flush();
      return Redirect::to('/?e=01');
    }
    if ( !array_key_exists('pass', $datos) || $datos['pass'] === "" ){
      Session::flush();
      return Redirect::to('/?e=01');
    }

    /* Reglas de validación */
    $rules = array(
        'usuario' => array('required', 'email','max:50'),
        'pass'    => array('required',  'regex:/^([0-9a-zA-Z@\.\-_])+$/')
      );
    $validator = Validator::make($datos, $rules);
      if( $validator->fails() ){
        Session::flush();
        return Redirect::to('/?e=10VAlidacion');
      }


        $admVH = 0;                                               //ADM
        $admVH = Adm::where('admCorreo', $datos['usuario'])
          ->where('admTipo', 1)          ->get(array(
              'admPass',
              'admId'
              ))
          ->toArray();
        if (count( $admVH ) > 0 ){
            $resAdm = $admVH[0];
            $passAdm = $resAdm['admPass'];
            if ( $datos['pass']== $passAdm ){
              Session::put('tipo', '001');
              Session::put('id', $resAdm['admId']);
              Session::put('nombre', "Administrador");
              return Redirect::to('/administracion');
              }
          else{
                Session::flush();
                return Redirect::to('/?e=11ADM');
              }
        }

      return Redirect::to('/?e=100');
  }


  public function logout(){
    Session::flush();
    Cache::flush();
    /*Cookie::forget('sce_session');*/
    return Redirect::to('/', 302)
      ->header('cache-control', 'no-store, no-cache, must-revalidate')
      ->header('pragma', 'no-cache');
  }
}
