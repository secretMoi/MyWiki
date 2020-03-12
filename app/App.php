<?php
use Core\Database\MysqlDatabase;
use Core\Config;
// todo exemple de code openclassrooms pour la coloration
// todo parser les mots anglais, avant les parenthèses, entre guillemets
// todo controler les champs entrés lors de l'ajout/modif d'un article et les surligner en rouge si pas bien saisis
class App {
	public $nomProjet = "Wiki";
	public $title = "Wiki";
	public $css = "css/style.css";
	private $dbInstance; // instance de la bdd
	protected $alert;
	private static $instance; // instance de App comme singleton

	private function __construct() {

}

	public static function getInstance() { // Singleton pour 1 seule instance comme statique mais plus simple à hériter et construire
		if(is_null(self::$instance)) // si l'instance n'est pas encore définie
			self::$instance = new App(); // on la définit

		return self::$instance; // on retourne l'instance
	}

	public static function load() { // charge les sessions et autoloaders
		session_start();

		require ROOT . 'app/Autoloader.php';
		App\Autoloader::register();

		require ROOT . 'core/Autoloader.php';
		Core\Autoloader::register();

		self::getInstance()->alert = new \Core\Controller\AlertController();
	}

	public function getTable($name) { // Factory des classes gérant les Tables
		$className = '\\App\\Table\\' .ucfirst($name. 'Table'); // trouve le nom de la classe : injecte le namespace et le nom de la classe

		return new $className($this->getDb()); // donne accès à la table grâce au passsage en param de la bdd
	}

	public function getDb() { // Factory qui permet de réaliser des connexions à la bdd
		$config = Config::getInstance(ROOT . 'config/config.php'); // charge la configuration de la bdd se trouvant dans config.php

		if(is_null($this->dbInstance)) // si on a pas encore init la connexion on le fait
			$this->dbInstance = new MysqlDatabase(
				$config->get('db_name'),
				$config->get('db_user'),
				$config->get('db_pass'),
				$config->get('db_host')
			);

		return $this->dbInstance; // retourne la connexion à la bdd
	}

	public function getBBCode() {
		return new \Core\Controller\BBCodeController();
	}

	public function alert(){
		return $this->alert;
	}

	public function setTitle($title) {
		$this->title = $this->nomProjet . ' - ' . $title;
	}
}
