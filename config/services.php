<?php

use Phalcon\Logger\Adapter\File as Logger;

$di['session'] = function () use ( $config ) {
	$session = new \Phalcon\Session\Adapter\Redis( array(
		'uniqueId' => $config->session->unique_id,
		'path'     => $config->session->path,
		'name'     => $config->session->name
	) );
	$session->start();

	return $session;
};

$di['security'] = function () {
	$security = new Phalcon\Security();
	$security->setWorkFactor( 13 );
	$security->setDefaultHash( Phalcon\Security::CRYPT_BLOWFISH_Y );


	return $security;
};

$di['redis'] = function () use ( $config ) {
	$redis = new \Redis();
	$redis->connect(
		$config->redis->host,
		$config->redis->port
	);

	return $redis;
};

$di['url'] = function () use ( $config, $di ) {
	$url = new \Phalcon\Mvc\Url();

	return $url;
};

$di['voltService'] = function ( $view, $di ) use ( $config ) {
	$volt = new \Phalcon\Mvc\View\Engine\Volt( $view, $di );
	if ( ! is_dir( $config->view->cache->dir ) ) {
		mkdir( $config->view->cache->dir );
	}
	$volt->setOptions( array(
		"compiledPath"      => $config->view->cache->dir,
		"compiledExtension" => ".compiled",
		"compileAlways"     => true
	) );

	return $volt;
};

$di['logger'] = function () {
	$file   = __DIR__ . "/../logs/" . date( "Y-m-d" ) . ".log";
	$logger = new Logger( $file, array( 'mode' => 'w+' ) );

	return $logger;
};

$di['cache'] = function () use ( $di, $config ) {
	$frontend = new \Phalcon\Cache\Frontend\Igbinary( array(
		'lifetime' => 3600 * 24
	) );
	$cache    = new \Phalcon\Cache\Backend\Redis( $frontend, array(
		'redis'  => $di['redis'],
		'prefix' => $config->application->name . ':'
	) );

	return $cache;
};