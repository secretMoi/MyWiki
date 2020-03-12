<?php
namespace App\Controller;

use \App;

class PostsController extends AppController {
	public function __construct() {
		parent::__construct();

		$this->loadModel('Post'); // permet de manipuler la table post
		$this->loadModel('Category'); // permet de manipuler la table category
	}

	/**
	 * Affiche la liste des articles et les alertes
	 */
	public function index() {
		$posts = $this->Post->last(); // récupère tous les posts en partant des derniers
		$categories =  $this->Category->all(); // récupère toutes les catégories

		$alert = App::getInstance()->alert();

		$oldPosts = $posts;
		$pagin = $this->getPaginate();
		$posts = $pagin->paginate($oldPosts, $posts);
		//compact('posts', 'categories'); // donne ['posts' => $posts, 'categories' => $categories]
		$this->render('posts.index', compact('posts', 'categories', 'alert', 'pagin')); // prépare le rendu pour la vue en lui passant les articles et la liste des catégories
	}

	/**
	 * Affiche la liste des catégories
	 */
	public function category() {
		$categorie = $this->Category->find($_GET['id']); // trouve la catégorie en fonction de l'id
		if($categorie === false) // Si la catégorie n'existe pas
			App::getInstance()->alert()->setAlert(App::getInstance()->alert()::NOT_FOUND);


		$articles = $this->Post->lastByCategory($_GET['id']); // trouve les articles associés
		$categories = $this->Category->all(); // récupère les catégories

		$this->render('posts.category', compact('articles', 'categories', 'categorie'));
	}

	/**
	 * Génère la vue d'un article
	 */
	public function show() {
		$article = $this->Post->findWithCategory($_GET['id']); // affiche les articles appartenant à UNE catégorie

		if($article == false)
			App::getInstance()->alert()->setAlert(App::getInstance()->alert()::NOT_FOUND);

		// BBCode
		$article->contenu = App::getInstance()->getBBCode()->dbToBbcode($article->contenu);

		// Date
		$article->date = $this->getDate()->convertDate($article->date);
		if(isset($article->date_modif))
			$article->date_modif = $this->getDate()->convertDate($article->date_modif);

		App::getInstance()->setTitle($article->titre);

		$this->render('posts.show', compact('article'));
	}
}