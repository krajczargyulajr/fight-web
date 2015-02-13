<?php

return array(
	'fetch' => PDO::FETCH_CLASS,
	'default' => 'mysql',
	'connections' => array(
		'mysql' => array(
			'driver'    => 'mysql',
			'host'      => 'localhost',
			'database'  => 'fightweb_bicske',
			'username'  => 'fightweb_bicske',
			'password'  => 'fightweb_bicske',
			'charset'   => 'utf8',
			'collation' => 'utf8_unicode_ci',
			'prefix'    => '',
		),
	),
	'migrations' => 'migrations'
);
