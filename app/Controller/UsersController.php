<?php
namespace App\Controller;

use \Core\Auth\DBAuth;
use \App;

class UsersController extends AppController {
	protected $init = false;
	protected $errors = false;
	protected const HOME_PATH = 'index.php?p=';
	protected const USER_PATH = 'index.php?p=users.';

	public function login() {
		if(!empty($_POST)) { // Si on affiche le formulaire de login
			$auth = new DBAuth(App::getInstance()->getDb()); // se connecte à la table user

			if($auth->login($_POST['username'], $_POST['password'])) { // vérifie si les logs sont ok
				$this->errors = false;
				$this->init = true;

				$this->saveUserInSession();

				header('Location: ' . $_POST['pagePrec']);
			}
			else{
				$this->errors = true; // si pas ok on renvoie une erreur
				$this->init = false;
			}
		}

		$form = new \Core\HTML\BootstrapForm($_POST);

		$errors = $this->errors;
		$this->render('users.login', compact('form', 'errors'));
	}

	private function saveUserInSession() {
		$_SESSION['username'] = $_POST['username'];
		$_SESSION['logged'] = true;
	}

	public static function getLogButton(){
		if(self::getIsConnected()) // si connecté
			return $_SESSION['username'];
		else
			return 'Se connecter';
	}

	public static function getLink() {
		if(self::getIsConnected()) // si connecté
			return self::HOME_PATH . 'admin.posts.index';
		else
			return self::USER_PATH . 'login';
	}

	public static function getIsConnected() {
		if(isset($_SESSION['username']) AND $_SESSION['logged'] === true) // si connecté
			return true;
		else
			return false;
	}

	public static function getDisconnectLink(){
		return self::USER_PATH . 'disconnect';
	}

	public function disconnect() {
		session_destroy();

		App::getInstance()->alert()->setAlert(App::getInstance()->alert()::DISCONNECTED);
	}
}