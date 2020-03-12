<?php
namespace App\Entity;

use App;
use Core\Entity\Entity;

class CategoryEntity extends Entity {
	public function getUrl() {
		return 'index.php?p=posts.category&id=' . $this->id;
	}

	public function getParentName() {
		if($this->parent > 0){
			$catgoryTable = App::getInstance()->getTable('Category');
			return $catgoryTable->parent($this->parent)->titre;
		}

		return 'Aucune';
	}
}