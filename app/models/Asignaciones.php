<?php

class Asignaciones extends Eloquent
{
  protected $table = 'asignaciones';
  protected $primaryKey = 'asiId';
  public $timestamps = false;
  public $incrementing = true;
  protected $fillable = array(
    'asiId',
    'asiFuentes',
    'asiResponsables'
  );
}
