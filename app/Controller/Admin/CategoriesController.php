<?php
namespace App\Controller\Admin;

use App;
use Core\HTML\BootstrapForm;
//todo simplifier le count
class CategoriesController extends AppController {
	public function __construct() {
		parent::__construct();
		$this->loadModel('Category'); // charge le modèle gérant category
	}

	public function index() { // affiche la liste des catégories
		$items = $this->Category->all(); // récupère toutes les catégories

		// Pagination
		$oldPosts = $items;
		$pagin = $this->getPaginate();
		$items = $pagin->paginate($oldPosts, $items, 10);

		$this->render('admin.categories.index', compact('items', 'pagin')); // les envoie à l'affichage
	}

	public function add() { // ajoute une catégorie
		if(!empty($_POST)) { // Si on a demandé de modifier le contenu
			$this->Category->create([
				'titre' => $_POST['titre'],
				'parent' => $_POST['parent']
			]);
			
			return $this->index();
		}

		$category = $this->Category->find($_GET['id']);
		$form = new BootstrapForm($category);

		$categories_aucun = [0 => 'Aucun'];
		$categories = $this->Category->extract('id', 'titre');
		$categories = $categories_aucun + $categories;

		$this->render('admin.categories.edit', compact('form', 'categories'));
	}

	public function edit() { // modifie une catégorie
		if(!empty($_POST)) { // Si on a demandé de modifier le contenu
			$this->Category->update($_GET['id'], [
				'titre' => $_POST['titre'],
				'parent' => $_POST['parent']
			]);

			return $this->index();
		}

		$category = $this->Category->find($_GET['id']);
		$form = new BootstrapForm($category);

		$categories_aucun = [0 => 'Aucun'];
		$categories = $this->Category->extract('id', 'titre');
		$categories = $categories_aucun + $categories;

		$this->render('admin.categories.edit', compact('form', 'categories'));
	}

	public function delete() {
		if(!empty($_POST)) { // Si on a demandé de modifier le contenu
			$this->Category->delete($_POST['id']);

			App::getInstance()->alert()->setAlert(App::getInstance()->alert()::CAT_DEL);
		}
	}

	protected function addObjCount($id) {
		$count = $this->Category->count($id)->count; // ajoute l'attribut count à l'objet
		$this->{"count"} = $count;
	}
}