<?php

class Invitados extends Eloquent
{
  protected $table = 'invitados';
  protected $primaryKey = 'invId';
  public $timestamps = false;
  public $incrementing = true;
  protected $fillable = array(
    'invId',
    'invCorreo',
    'invNombre',
    'invActivo'
  );
}
