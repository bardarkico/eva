<?php

class Adm extends Eloquent
{
  protected $table = 'adm';
  protected $primaryKey = 'admId';
  public $timestamps = false;
  public $incrementing = true;
  protected $fillable = array(
    'admId',
    'admTipo',
    'admCorreo',
    'admPass'
  );
}
