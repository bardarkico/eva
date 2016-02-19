<?php

return array(

	'driver' => 'smtp',

	'host' => 'smtp.1and1.com',

	'port' => 587,

//	'from' => array('address' => 'vhc@contadoresvh.com', 'name' => 'Vázquez Hernández Contadores, S.C.'),
'from' => array('address' => 'difusion@contadoresvh.com', 'name' => 'Sistema de Noticias VHC'),
	'encryption' => 'tls',

//	'username' => 'vhc@contadoresvh.com',
	'username' => 'difusion@contadoresvh.com',

//	'password' => 'wi6ow740',
	'password' => 'q81x164b',

	/*
	|--------------------------------------------------------------------------
	| Sendmail System Path
	|--------------------------------------------------------------------------
	|
	| When using the "sendmail" driver to send e-mails, we will need to know
	| the path to where Sendmail lives on this server. A default path has
	| been provided here, which will work well on most of your systems.
	|
	*/

	'sendmail' => '/usr/sbin/sendmail -bs',

	/*
	|--------------------------------------------------------------------------
	| Mail "Pretend"
	|--------------------------------------------------------------------------
	|
	| When this option is enabled, e-mail will not actually be sent over the
	| web and will instead be written to your application's logs files so
	| you may inspect the message. This is great for local development.
	|
	*/

	'pretend' => false,

);
