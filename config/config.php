<?php

return new \Phalcon\Config( array(
	'application' => array(
		'name' => 'Learning Phalcon'
	),
	'root_dir'    => __DIR__ . '/../',
	'redis'       => array(
		'host' => '127.0.0.1',
		'port' => 6379,
	),
	'session'     => array(
		'unique_id' => 'phalconbook',
		'name'      => 'phalconbook',
		'path'      => 'tcp://127.0.0.1:6379?weight=1'
	),
	'view'        => array(
		'cache' => array(
			'dir' => __DIR__ . '/../cache/volt/'
		)
	),
) );
