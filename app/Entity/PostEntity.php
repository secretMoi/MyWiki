<?php
namespace App\Entity;
use App;
use Core\Entity\Entity;

class PostEntity extends Entity {
	public function getUrl() { // PHP trouvera cette fonction avec ->url grâce à la méthode magique dans la classe mère
		return 'index.php?p=posts.show&id=' . $this->id;
	}

	public function getResume(){
		return $this->resume;
	}

	public function getExtraitResult() { // génère un extrait de l'article pour la présentation
		$this->contenu = App::getBBCode()->dbToBbcode($this->contenu);

		$html = '<p>' . substr($this->contenu, 0, 500) . '...</p>';

		$html .= '<p><a href="' . $this->getURL() . '">Voir la suite</a></p>';

		return $html;
	}
}

?>