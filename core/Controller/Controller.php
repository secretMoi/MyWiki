<?php
namespace Core\Controller;
use \App;

class Controller {
	protected $viewPath;
	protected $template;

	protected function render($view, $variables = []) { // gère le rendu
		ob_start();

		extract($variables); // donne accès aux variables $posts et $categories
		require($this->viewPath . str_replace('.', '/', $view) . '.php'); // accède à la vue correspondante au controleur
		$content = ob_get_clean();

		require($this->viewPath . 'templates/' . $this->template . '.php'); // demande le template pour afficher le contenu généré
	}

	public function getUser($method) {
		$method = 'get' . ucfirst($method);

		return App\Controller\UsersController::$method();
	}

	public function getDate() {
		return new DateController();
	}
}