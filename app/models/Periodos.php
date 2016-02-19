<?php

class Periodos extends Eloquent
{
  protected $table = 'periodos';
  protected $primaryKey = 'perId';
  public $timestamps = false;
  public $incrementing = true;
  protected $fillable = array(
    'perId',
    'perInicio',
    'perFin',
    'perNDias',
    'perActivo'
  );
}
