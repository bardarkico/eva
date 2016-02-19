<?php

return array(

  /*
  |--------------------------------------------------------------------------
  | Validation Language Lines
  |--------------------------------------------------------------------------
  |
  | The following language lines contain the default error messages used by
  | the validator class. Some of these rules have multiple versions such
  | as the size rules. Feel free to tweak each of these messages here.
  |
  */

  "accepted"             => "Debe de aceptar la Política de uso y privacidad del sitio web y el Aviso de privacidad para clientes.",
  "active_url"           => "El campo :attribute no es una URL válida.",
  "after"                => "El campo :attribute debe ser una fecha después de :date.",
  "alpha"                => "El campo :attribute sólo puede contener letras.",
  "alpha_dash"           => "El campo :attribute sólo puede contener letras, números y guiones.",
  "alpha_num"            => "El campo :attribute sólo puede contener letras y números.",
  "array"                => "El campo :attribute debe ser una matriz.",
  "before"               => "El campo :attribute debe ser una fecha anterior a :date.",
  "between"              => array(
    "numeric" => "El campo :attribute debe estar entre :min - :max.",
    "file"    => "El campo :attribute debe estar entre :min - :max kilobytes.",
    "string"  => "El campo :attribute debe estar entre :min - :max caracteres.",
    "array"   => "El campo :attribute debe tener entre :min y :max elementos.",
  ),
  "boolean"              => "El campo :attribute debe ser verdadera o falsa.",
  "confirmed"            => "El campo :attribute confirmación no coincide.",
  "date"                 => "El campo :attribute no es una fecha válida.",
  "date_format"          => "El campo :attribute no corresponde con el formato :format.",
  "different"            => "El campo :attribute y :other deben ser diferentes.",
  "digits"               => "El campo :attribute debe ser de :digits dígitos.",
  "digits_between"       => "El campo :attribute debe terner entre :min y :max dígitos.",
  "email"                => "El campo :attribute debe ser una dirección válida de correo electrónico.",
  "exists"               => "El campo :attribute seleccionado es inválido.",
  "image"                => "El campo :attribute debe ser una imagen.",
  "in"                   => "El campo :attribute seleccionado es inválido.",
  "integer"              => "El campo :attribute debe ser un entero.",
  "ip"                   => "El campo :attribute debe ser una dirección IP válida.",
  "max"                  => array(
    "numeric" => "The :attribute may not be greater than :max.",
    "file"    => "The :attribute may not be greater than :max kilobytes.",
    "string"  => "El campo :attribute no debe ser mayor que than :max caracteres.",
    "array"   => "The :attribute may not have more than :max items.",
  ),
  "mimes"                => "El campo :attribute debe ser un archivo de tipo :values.",
  "min"                  => array(
    "numeric" => "El campo :attribute debe tener al menos :min.",
    "file"    => "El campo :attribute debe ser mayor a :min kilobytes.",
    "string"  => "El campo :attribute debe ser mayor que :min caracteres.",
    "array"   => "El campo :attribute debe tener al menos :min elementos.",
  ),
  "not_in"               => "El campo :attribute seleccionado es invalido.",
  "numeric"              => "El campo :attribute debe ser un numero.",
  "regex"                => "El formato del campo :attribute es inválido, verifique los caracteres.",
  "required"             => "El campo :attribute es requerido",
  "required_if"          => "El campo :attribute es requerido cuando el campo :other es :value.",
  "required_with"        => "El campo :attribute es requerido cuando :values está presente.",
  "required_with_all"    => "El campo :attribute es requerido cuando :values está presente.",
  "required_without"     => "El campo :attribute es requerido cuando :values no está presente.",
  "required_without_all" => "El campo :attribute es requerido cuando ningún :values está presentes.",
  "same"                 => "El campo :attribute y :other debe coincidir.",
  "size"                 => array(
    "numeric" => "El campo :attribute debe ser :size.",
    "file"    => "El campo :attribute debe terner :size kilobytes.",
    "string"  => "El campo :attribute debe tener :size caracteres.",
    "array"   => "El campo :attribute debe contener :size elementos.",
  ),
  "unique"               => "El campo :attribute ya ha sido tomado.",
  "url"                  => "El formato de :attribute es inválido.",
  "timezone"             => "El campo :attribute debe ser una zona válida",

  /*
  |--------------------------------------------------------------------------
  | Custom Validation Language Lines
  |--------------------------------------------------------------------------
  |
  | Here you may specify custom validation messages for attributes using the
  | convention "attribute.rule" to name the lines. This makes it quick to
  | specify a specific custom language line for a given attribute rule.
  |
  */

  'custom' => array(
    'attribute-name' => array(
      'rule-name' => 'custom-message',
    ),
  ),

  /*
  |--------------------------------------------------------------------------
  | Custom Validation Attributes
  |--------------------------------------------------------------------------
  |
  | The following language lines are used to swap attribute place-holders
  | with something more reader friendly such as E-Mail Address instead
  | of "email". This simply helps us make messages a little cleaner.
  |
  */

  'attributes' => array(),

);
