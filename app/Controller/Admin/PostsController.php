<?php
namespace App\Controller\Admin;

use App;
use \Core\HTML\BootstrapForm;

class PostsController extends AppController {
	protected $alert;

	public function __construct() {
		parent::__construct();

		$this->loadModel('Post'); // charge la table post
		$this->loadModel('History');
	}

	public function index() {
		$posts = $this->Post->all(); // récupère la liste de tous les articles

		$alert = $this->alert;

		// Date
		$posts = $this->convertDate($posts);

		// Pagination
		$oldPosts = $posts;
		$pagin = $this->getPaginate();
		$posts = $pagin->paginate($oldPosts, $posts, 10);

		$this->render('admin.posts.index', compact('posts',  'alert', 'pagin')); // les transmet à la vue
	}

	public function add() {
		if(!empty($_POST)) { // Si on a demandé de modifier le contenu
			$this->checkInputForm('add');

			$result = $this->Post->create([
				'titre' => $_POST['titre'],
				'resume' => $_POST['resume'],
				'contenu' => $_POST['contenu'],
				'date' => $this->getDate()->getDateSQL(),
				'category_id' => $_POST['category_id']
			]);
			
			if($result) // si l'insertion à la bdd s'est bien effectuée
				App::getInstance()->alert()->setAlert(App::getInstance()->alert()::POST_ADD);
		}

		$this->loadForm($_POST);
	}

	public function edit() {
		if(!empty($_POST)) { // Si on a demandé de modifier le contenu
			$this->checkInputForm('edit');

			$date = $this->getDate()->getDateSQL();
			$lastArticle = $this->Post->savePostBeforeChanges($_GET['id']); // charge l'article

			$histo = $this->getHistory();
			$histo->add($lastArticle, $date); // l'ajoute à l'historique avant modification

			$result = $this->Post->update(
				$_GET['id'], [
				'titre' => $_POST['titre'],
				'resume' => $_POST['resume'],
				'contenu' => $_POST['contenu'],
				'date_modif' => $date,
				'category_id' => $_POST['category_id']
			]);

			if($result)
				App::getInstance()->alert()->setAlert(App::getInstance()->alert()::POST_EDIT);
			else
				App::getInstance()->alert()->setAlert(App::getInstance()->alert()::POST_ERR);
		}

		$post = $this->Post->find($_GET['id']); // edit le post en fonction de l'id fournit par l'url

		$this->loadForm($post);
	}

	public function delete() {
		if(!empty($_POST)) { // Si on a demandé de modifier le contenu
			$this->Post->delete($_POST['id']); // supprime l'article ayant l'id correspondant

			App::getInstance()->alert()->setAlert(App::getInstance()->alert()::POST_DEL);
		}
	}

	protected function loadForm($post) {
		$this->loadModel('Category');
		$categories = $this->Category->extract('id', 'titre');

		$form = new BootstrapForm($post);
		$jsTextarea =  require(ROOT . 'app/Views/templates/bbcodeHead.php');

		$this->render('admin.posts.edit', compact('categories', 'form', 'jsTextarea'));
	}

	protected function setAlert($message, $type = 'success'){
		$this->alert = \App::getInstance()->getAlert($message, $type);
	}

	protected function getError($field){
		if(isset($_GET[$field]))
			return 'class="table-danger"';

		return null;
	}

	protected function checkInputForm($method){
		$errors = NULL;

		if($_POST['titre'] == NULL)
			$errors .= '&titre=wrong';
		if($_POST['resume'] == NULL)
			$errors .= '&resume=wrong';
		if($_POST['contenu'] == NULL)
			$errors .= '&contenu=wrong';
		if($_POST['category_id'] == NULL)
			$errors .= '&categorie=wrong';

		if($errors != NULL)
			header("Location: ?p=admin.posts.$method&id=" . $_GET['id'] . $errors);
	}

	protected function convertDate($articles) {
		foreach ($articles as $article) {
			$article->date = $this->getDate()->convertDate($article->date, true);

			if(isset($article->date_modif))
				$article->date_modif = $this->getDate()->convertDate($article->date_modif, true);
		}

		return $articles;
	}
}