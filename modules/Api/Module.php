<?php

namespace App\Frontend;


use Phalcon\Mvc\ModuleDefinitionInterface;

class Module implements ModuleDefinitionInterface {

	/**
	 * Registers an autoloader related to the module
	 *
	 * @param \Phalcon\DiInterface $di
	 */
	public function registerAutoloaders( \Phalcon\DiInterface $di = null ) {
	}

	/**
	 * Registers services related to the module
	 *
	 * @param \Phalcon\DiInterface $di
	 */
	public function registerServices( \Phalcon\DiInterface $di ) {
		$config       = include __DIR__ . "/Config/config.php";
		$di['config'] = $config;

		include __DIR__ . "/Config/services.php";
	}
}