<?php

    /*
	|--------------------------------------------------------------------------
	| Database Connections
	|--------------------------------------------------------------------------
	|
	| Here are each of the database connections setup for the application.
	|
	*/

	$connections = [

		'csv' => [
			'driver'   => 'csv',
			'file' => ROOT .'/storage/',
			'prefix'   => '',
		],

		'mysql' => [
			'driver'    => 'mysql',
			'host'      => 'localhost',
			'database'  => 'tmpr',
			'username'  => 'root',
			'password'  => '',
			'charset'   => 'utf8',
			'collation' => 'utf8_unicode_ci'
		]

	];

	$production_db = "csv";



?>