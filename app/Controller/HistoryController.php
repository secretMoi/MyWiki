<?php


namespace App\Controller;

// todo recherche par date ou intervalle de date

class HistoryController extends AppController
{
	public function __construct() {
		parent::__construct();

		$this->loadModel('History'); // permet de manipuler la table category
		$this->loadModel('Post');
	}

	public function add($articleTab, $date) {
		$article = $articleTab[0];

		$this->History->create([
			'id_article' => intval($article->id),
			'date' => $date,
			'ancien_contenu' => $article->contenu
		]);
	}

	public function list() {
		if(isset($_GET['id'])) // si on demande les modifs d'un article particulier
			$historys = $this->History->last(intval($_GET['id']));
		else
			$historys = $this->History->last();

		if($historys == false && isset($_GET['id']))
			\App::getInstance()->alert()->setAlert(\App::getInstance()->alert()::NOT_FOUND);

		$oldPosts = $historys;
		$pagin = $this->getPaginate();
		$historys = $pagin->paginate($oldPosts, $historys, 10);

		$this->render('history.list', compact('historys', 'pagin')); // les transmet à la vue
	}

	public function show(){
		$history = $this->History->findArticle(intval($_GET['id'])); // affiche les articles appartenant à UNE catégorie
		$article = $this->Post->findWithCategory($history->idArticle);

		$article->contenu = $history->contenu;
		$article->date = $this->getDate()->convertDate($article->date);
		$article->date_modif = $this->getDate()->convertDate($history->date);

		if($history == false)
			\App::getInstance()->alert()->setAlert(App::getInstance()->alert()::NOT_FOUND);

		$article->contenu = \App::getInstance()->getBBCode()->dbToBbcode($history->contenu);

		\App::getInstance()->setTitle('Historique - ' . $article->titre);

		$this->render('posts.show', compact('article'));
	}


}