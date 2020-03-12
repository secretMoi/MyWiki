<?php

namespace Core;

class Autoloader {
	static function register() {
		// __CLASS__ contient le nom de la classe courante
		spl_autoload_register(array(__CLASS__, 'autoload'));
	}

	static function autoload($className) {
		if(strpos($className, __NAMESPACE__ . '\\') === 0) { // N'autoloader que ce qui est dans le namespace Tutoriel, propre namespace
			$className = str_replace(__NAMESPACE__ . '\\', '', $className); // supprime le namespace pour trouver la classe
			$className = str_replace('\\', '/', $className);

			require __DIR__ . '/' . $className . '.php'; // DIR = dossier parent
		}
		
	}
}