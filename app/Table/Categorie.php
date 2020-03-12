<?php

namespace App\Table;

class Categorie extends Table {
	protected static $table = 'categories';

	public function getURL() { // génère l'url c'une catégorie
		return 'index.php?p=categorie&id=' . $this->id;
	}
}

?>