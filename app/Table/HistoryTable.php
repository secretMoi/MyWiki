<?php


namespace App\Table;


use Core\Table\Table;

class HistoryTable extends Table
{
	protected $table = 'historique';

	public function last($id = null) {
		if($id === null){
			return $this->query("
			SELECT $this->table.id, $this->table.id_article as idArticle, $this->table.date, articles.titre as titre
			 FROM $this->table 
			 LEFT JOIN articles ON id_article = articles.id
			 ORDER BY $this->table.date DESC
			");
		}
		else {
			return $this->query("
			SELECT $this->table.id, $this->table.id_article as idArticle, $this->table.date, articles.titre as titre
			 FROM $this->table 
			 LEFT JOIN articles ON id_article = articles.id
			 WHERE $this->table.id_article = ?
			 ORDER BY $this->table.date DESC
			",
				[$id]
			);
		}
	}

	public function findArticle($id) {
		return $this->query("
			SELECT $this->table.id_article as idArticle, $this->table.date, articles.titre as titre, $this->table.ancien_contenu as contenu
			 FROM $this->table 
			 LEFT JOIN articles ON id_article = articles.id
			 WHERE $this->table.id = ?
			 ORDER BY $this->table.date DESC
			 ",
			[$id],
			true);
	}

	/*public function findByIdArticle($id) {
		return $this->query("
			SELECT $this->table.id_article as idArticle, $this->table.date, articles.titre as titre
			 FROM historique 
			 LEFT JOIN articles ON id_article = articles.id
			 ORDER BY $this->table.date DESC
			");
	}*/

}