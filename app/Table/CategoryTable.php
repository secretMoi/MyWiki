<?php
namespace App\Table;

use Core\Table\Table;

class CategoryTable extends Table {
	protected $table = "categories";

	public function count($id) {
		return $this->query("
		SELECT COUNT(id) as count FROM articles WHERE category_id = ?
		",
		[$id],
			true);
	}

	public function parent($parent_id) {
		return $this->query("
		SELECT titre FROM categories WHERE id = ?
		",
			[$parent_id],
			true);
	}
}
