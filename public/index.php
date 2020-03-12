<?php
define ('ROOT', dirname(__DIR__) . '/');
require ROOT . 'app/App.php';

App::load(); // autoloader

if(isset($_GET['p']) && !(App::getInstance()->alert()->alertPresent())) // si une page est demandée
	$page = $_GET['p'];
else // sinon on affiche la page d'accueil
	$page = 'posts.index';

$page = explode('.', $page); // on sépare l'url grâce aux .

if($page[0] == 'admin'){
	$controller = '\App\Controller\Admin\\' . ucfirst($page[1]) . 'Controller'; // génère le nom et le namespace du controleur à appeler
	$action = $page[2];
}
else{
	$controller = '\App\Controller\\' . ucfirst($page[0]) . 'Controller'; // génère le nom et le namespace du controleur à appeler
	$action = $page[1]; // la page à afficher correspond au 2e élément
}

if(class_exists($controller))
	$controller = new $controller(); // instancie le controleur
	if(method_exists ($controller, $action))
		$controller->$action(); // appelle la méthode affichant la page
else
	App::getInstance()->alert()->setAlert(App::getInstance()->alert()::NOT_FOUND);

