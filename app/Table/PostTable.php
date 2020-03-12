<?php
namespace App\Table;

use Core\Table\Table;

class PostTable extends Table {
	protected $table = 'articles';

	/**
	* récupère les derniers articles
	* return array
	*/
	public function last() {
		return $this->query("
			SELECT $this->table.id, $this->table.titre, $this->table.resume, $this->table.contenu, categories.titre as categorie
			 FROM $this->table 
			 LEFT JOIN categories ON category_id = categories.id
			 ORDER BY $this->table.date DESC
			");
	}

	/**
	* récupère les derniers articles de la categorie demandée
	* return array
	*/
	public function lastByCategory($category_id) {
		return $this->query("
			SELECT $this->table.id, $this->table.titre, $this->table.resume, $this->table.contenu, categories.titre as categorie
			 FROM $this->table 
			 LEFT JOIN categories ON category_id = categories.id
			 WHERE $this->table.category_id = ?
			 ORDER BY $this->table.date DESC
			",
			[$category_id]
			);
	}

	/**
	* récupère un article en liant la catégorie associée
	* return \App\Entity\PostEntity
	*/
	public function findWithCategory($id) {
		return $this->query("
			SELECT $this->table.id, $this->table.titre, $this->table.resume, $this->table.contenu, $this->table.date, $this->table.date_modif, categories.titre as categorie
			 FROM $this->table 
			 LEFT JOIN categories ON category_id = categories.id
			 WHERE $this->table.id = ?
			",
			[$id], true
			);
	}

	/**
	 * @param $sql
	 * @return array|bool|false|mixed|\PDOStatement
	 */
	public function searchByWords($sql){
		return $this->query("
			SELECT $this->table.id, $this->table.titre, $this->table.contenu, categories.titre as categorie
			FROM $this->table
			LEFT JOIN categories ON category_id = categories.id
			{$sql}"
		);
	}

	public function savePostBeforeChanges($id) {
		return $this->query("
			SELECT id, contenu
			FROM $this->table
			WHERE id = ?",
			[$id]
		);
	}
}
