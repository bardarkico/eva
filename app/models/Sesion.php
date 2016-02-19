<?php

class Sesion
{
  public static function isAdmin(){
    if ( Session::has('tipo') && Session::get('tipo') == '001' )
      return true;
    else
      return false;
  }

  public static function isResponsable(){
    if ( Session::has('tipo') && Session::get('tipo') == '010' )
      return true;
    else
      return false;
  }

  public
   static function isExterno(){
    if ( Session::has('tipo') && Session::get('tipo') == '011' )
      return true;
    else
      return false;
  }

  public static function isInterno(){
    if ( Session::has('tipo') && Session::get('tipo') == '100' )
      return true;
    else
      return false;
  }
}
