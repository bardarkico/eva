<?php

class Integrantes extends Eloquent
{
  protected $table = 'integrantes';
  protected $primaryKey = 'intId';
  public $timestamps = false;
  public $incrementing = true;
  protected $fillable = array(
    'intId',
    'intNombre',
    'intCorreo',
    'intActivo',
    'intNombreCompleto',
    'intResponsable'
  );
}
