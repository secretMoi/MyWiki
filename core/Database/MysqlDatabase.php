<?php
namespace Core\Database;
use \PDO;

class MysqlDatabase extends Database {
	private $name;
	private $user;
	private $pass;
	private $host;
	private $pdo;

	public function __construct($name, $user = 'root', $pass = 'root', $host = 'localhost:3307') {
		$this->name = $name;
		$this->user = $user;
		$this->pass = $pass;
		$this->host = $host;
	}

	private function getPDO() { // retourne un objet PDO
		if($this->pdo == null) { // si pdo pas encore init
			$this->pdo = new PDO('mysql:dbname=blog;host=localhost:3307', 'root', 'root');
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // affiche les msg d'erreurs
		}

		return $this->pdo;
	}

	public function query($statement, $class = null, $one = false) { // exécute une req sql simple
		$req = $this->getPDO()->query($statement);

		if(
		strpos($statement, 'UPDATE') === 0 ||
		strpos($statement, 'INSERT') === 0 ||
		strpos($statement, 'DELETE') === 0
		) // si en première position de la chaine on trouve UPDATE OU ... on retourne res car pas besoin de retourner des données
			return $req;

		if($class === null) // si une classe est spécifiée
			$req->setFetchMode(PDO::FETCH_OBJ); // méthode d'association dans un objet
		else
			$req->setFetchMode(PDO::FETCH_CLASS, $class); // méthode d'association dans une classe
		
		if($one) // si on demande un seul résultat
			$datas = $req->fetch(); // récupère une ligne
		else
			$datas = $req->fetchAll(); // récupère tous les résultats de la bdd

		return $datas; // retourne l'objet ou la classe
	}

	public function prepare($statement, $attributes, $class = null, $one = false) {
		$req = $this->getPDO()->prepare($statement); // prépare la req
		$res = $req->execute($attributes); // l'exécute

		if(
		strpos($statement, 'UPDATE') === 0 ||
		strpos($statement, 'INSERT') === 0 ||
		strpos($statement, 'DELETE') === 0
		) // si en première position de la chaine on trouve UPDATE OU ... on retourne res car pas besoin de retourner des données
			return $res;

		if($class === null) // si une classe est spécifiée
			$req->setFetchMode(PDO::FETCH_OBJ); // méthode d'association dans un objet
		else
			$req->setFetchMode(PDO::FETCH_CLASS, $class); // méthode d'association dans une classe

		if($one) // si on demande un seul résultat
			$datas = $req->fetch(); // récupère une ligne
		else
			$datas = $req->fetchAll(); // récupère tout le résultat de la bdd

		return $datas;
	}

	public function lastInsertId() {
		return $this->getPdo()->lastInsertId();
	}
}