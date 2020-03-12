<?php


namespace App\Controller;


use App;

class SearchController extends AppController
{
	protected $keyWords = [];
	protected $sql;

	/**
	 * SearchController constructor.
	 */
	public function __construct()
	{
		parent::__construct();

		$this->loadModel('Post');
	}

	public function result() {
		$this->keyWords = explode(" ", $_POST['keywords']);
		$this->generateSQL();

		$posts = $this->Post->searchByWords($this->sql);

		App::getInstance()->setTitle("Recherche - " . implode(" - ", $this->keyWords));

		$nbResult = count($posts);

		$this->render('posts.searchResult', compact('posts', 'nbResult'));
	}

	/**
	 * @param $content
	 * @return string les mots trouvés surlignés
	 */
	protected function findWords($content) {
		$content = App::getBBCode()->dbToBbcode($content);

		foreach ($this->keyWords as $key => $value) // convertit toutes les clés en minuscule
			$this->keyWords[$key] = strtolower($this->keyWords[$key]);

		$tabExploded = explode(' ', $content);
		// TODO optimiser en faisant strtolower() avant dans une copie de chaine au lieu de l'appeler pour chaque mot
		foreach ($tabExploded as $pos => $word) {
			foreach ($this->keyWords as $key) {
				if(stripos(strtolower($word), $key) !== false) {
					$tabExploded[$pos] = str_replace($key, '<span class="text-primary alert-secondary">'.$key.'</span>', $tabExploded[$pos]);
				}
			}
		}

		return implode(' ', $tabExploded);
	}

	protected function generateSQL() {
		$i = 0;

		foreach ($this->keyWords as $words) {
			if($i === 0) {
				$this->sql = " WHERE ";
				$i++;
			}
			else
				$this->sql .= " AND "; // demande tous les mots demandés, sinon OR pour juste avoir au moins un mot demandé

			$this->sql .= "contenu LIKE '%$words%' OR  articles.titre LIKE '%$words%'"; // les espaces permettent de rechercher par mot et pas par chaine
		}
	}
}