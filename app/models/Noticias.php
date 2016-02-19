<?php

class Noticias extends Eloquent
{
  protected $table = 'noticias';
  protected $primaryKey = 'notId';
  public $timestamps = false;
  public $incrementing = true;
  protected $fillable = array(
    'notId',
    'notTitulo',
    'notContenido',
    'notFecha',
    'notFuente',
    'notFinalizar'
  );
}
