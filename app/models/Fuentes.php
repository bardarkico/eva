<?php

class Fuentes extends Eloquent
{
  protected $table = 'fuentes';
  protected $primaryKey = 'fueId';
  public $timestamps = false;
  public $incrementing = true;
  protected $fillable = array(
    'fueId',
    'fueNombre',
    'fueActivo'
  );
}
