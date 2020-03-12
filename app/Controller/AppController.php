<?php
namespace App\Controller;

use Core\Controller\Controller;
use \App;

class AppController extends Controller {
	protected $template = 'default';

	/**
	 * AppController constructor.
	 */
	public function __construct() { // définit le chemin de la vue
		$this->viewPath = ROOT . 'app/Views/';
	}

	/**
	 * @param $modelName
	 */
	protected function loadModel($modelName) { // permet de se connecter à la table spécifiée
		$this->$modelName = App::getInstance()->getTable($modelName);
	}

	public function getPaginate() {
		return new PaginationController();
	}

	public function getHistory() {
		return new HistoryController();
	}
}