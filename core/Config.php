<?php

namespace Core;

class Config {

	private $settings = [];
	private static $instance;

	public static function getInstance($file) { // Singleton pour 1 seule instance comme statique mais plus simple à hériter et construire
		if(is_null(self::$instance)) // si l'instance n'est pas encore définie
			self::$instance = new Config($file); // on la définit

		return self::$instance; // on retourne l'instance demandée
	}

	public function __construct($file) {
		// charge le fichier de configuration
		$this->settings = require($file);
	}

	public function get($key) { // retourne une valeur de la configuration
		if(!isset($this->settings[$key])) // si on ne trouve la pas la valeur demandée
			return null;

		return $this->settings[$key];
	}

}
?>