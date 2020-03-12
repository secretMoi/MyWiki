<?php
namespace Core\Table;

use Core\Database\MysqlDatabase;

class Table {
	protected $table;
	protected $db;

	public function __construct(MysqlDatabase $db) { // force une connexion à la bdd par param
		$this->db = $db;

		if(is_null($this->table)) {
			$parts = explode('\\', get_class($this)); // sépare en tableau
			$className = end($parts); // récupère le dernier élément d'un tableau
			$this->table = strtolower(str_replace('Table', '', $className)) . 's'; // converti en minuscule et supprime Table
		}
	}

	public function all() {
		return $this->query('SELECT * FROM ' . $this->table); // retourne tous les résultats d'une table donnée
	}

	public function find($id) {
		return $this->query("SELECT * FROM {$this->table} WHERE id = ?", [$id], true); // récupère une ligne ayant un id et une table spécifiée
	}

	public function update($id, $fields) {
		$sqlParts = [];
		$attributes = [];

		foreach ($fields as $key => $value) { // traite tous les champs à modifier
			$sqlParts[] = "$key = ?"; // génère clé = ?
			$attributes[] = $value; // génère les valeurs de clés
		}
		$attributes[] = $id; // rajoute le id

		$sqlPart = implode(', ', $sqlParts); // rassemble tous les champs du tableau en une ligne

		return $this->query("UPDATE {$this->table} SET $sqlPart WHERE id = ?", $attributes, true);
	}

	public function delete($id) {
		return $this->query("DELETE FROM {$this->table} WHERE id = ?", [$id], true);
	}

	public function create($fields) {
		$sqlParts = [];
		$attributes = [];

		foreach ($fields as $key => $value) { // traite tous les champs à modifier
			$sqlParts[] = "$key = ?"; // génère clé = ?
			$attributes[] = $value; // génère les valeurs de clés
		}

		$sqlPart = implode(', ', $sqlParts); // rassemble tous les champs du tableau en une ligne

		return $this->query("INSERT INTO {$this->table} SET $sqlPart", $attributes, true);
	}

	public function extract($key, $value) {
		$records = $this->all(); // récupère tous les enregistrements

		$return = [];

		foreach ($records as $v) {
			$return[$v->$key] = $v->$value;
		}

		return $return;
	}

	public function query($statement, $attributes = null, $one = false) {
		if($attributes){ // Si des attributs sont spécifiés, il faut les sécuriser avec prepare
			return $this->db->prepare(
				$statement,
				$attributes,
				str_replace('Table', 'Entity', get_class($this)),
				$one
			);
		}
		else { // si pas d'attribut, on exécute direct
			return $this->db->query(
				$statement,
				str_replace('Table', 'Entity', get_class($this)),
				$one
			);
		}
	}
}
?>