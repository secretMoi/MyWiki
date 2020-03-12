<?php
namespace Core\Auth;

use Core\Database\Database;

class DBAuth {
	private $db;

	public function __construct(Database $db) { // utilise injection de dépendances
		$this->db = $db;
	}

	public function getUserId() {
		if($this->logged())
			return $_SESSION['auth'];
		
		return false;
	}

	/**
	* return boolean
	**/
	public function login($username, $password) { // permet de se connecter
		$user = $this->db->prepare('
			SELECT * FROM users WHERE username = ?',
			[$username],
			null,
			true
		);

		if($user){ // si on a trouvé l'utilisateur
			if($user->password === sha1($password)){ // et les mdp correspondent
				$_SESSION['auth'] = $user->id; // on authentifie l'utilisateur
				return true;
			}
		}
		
		return false;
	}

	public function logged() {
		return isset($_SESSION['auth']);
	}
}
