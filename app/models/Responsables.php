<?php

class Responsables extends Eloquent
{
  protected $table = 'responsables';
  protected $primaryKey = 'resId';
  public $timestamps = false;
  public $incrementing = true;
  protected $fillable = array(
    'resId',
    'resCorreo',
    'resNombre',
    'resActivo'
  );
}
