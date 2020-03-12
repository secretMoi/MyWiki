<?php
namespace App\Controller\Admin;

use \App;
use \Core\Auth\DBAuth;

class AppController extends \App\Controller\AppController {
	public function __construct() {
		parent::__construct();

		// Auth
		$app = App::getInstance();
		$auth = new DBAuth($app->getDb()); // se connecte à la bdd

		if(!$auth->logged()) // vérifie si on est loggé
			$app->alert()->setAlert($app->alert()::FORBIDDEN);
	}
}