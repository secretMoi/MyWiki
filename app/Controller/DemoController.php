<?php
namespace App\Controller;


// Pattern Fluent
class DemoController extends AppController {
	public function index() {
		require ROOT . 'Query.php';

		echo \Query::select('id', 'titre', 'contenu')
			->from('articles', 'Post')
			->where('Post.category_id')
			->where('Post.date > NOW()');
	}
}