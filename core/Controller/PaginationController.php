<?php


namespace Core\Controller;

class PaginationController
{
	protected $perPage = 4;
	protected $count;

	/**
	 * tronque le contenu pour obtenir les résultats demandés
	 * @param $oldContent ancien contenu complet
	 * @param $content nouveau contenu tronqué à retourner
	 * @param int $perPage nombre d'éléments par page
	 * @return array $content
	 */
	public function paginate($oldContent, $content, $perPage = 0)
	{
		if($perPage === 0) // si on a pas définit de page on prend la val par défaut
			$perPage = $this->perPage;
		else
			$this->perPage = $perPage;

		$count = 0;
		$this->count = count($content); // on compte le nombre d'éléments totaux pour paginateBar()

		$currentPage = $this->calculateCurrentPage();
		$intervalPage = ($currentPage - 1) * $perPage; // on calcule l'intervalle par page

		$content = []; // on vide le tableau pour réécrire dedans

		foreach ($oldContent as $key => $value){
			if($key >= $intervalPage && $key < ($intervalPage + $perPage)){ // si on est dans l'intervalle des articles à afficher
				$content[$count] = $value;
				$count++;
			}
		}

		return $content;
	}

	/**
	 * retourne le nb d'éléments par page
	 * @return int
	 */
	public function getPerPage(){
		return $this->perPage;
	}

	/**
	 * si la page courante est bien valide
	 * @return int âge courante
	 */
	protected function calculateCurrentPage() {
		$currentPage = intval($_GET['pagination']); // on prend la page courante
		if(
			!isset($_GET['pagination']) OR
			!is_numeric($_GET['pagination']) OR
			$_GET['pagination'] < 0 OR
			(($_GET['pagination'] - 1) * $this->perPage) >= $this->count
		) // si elle n'est pas définie on suppose que c'est la page 1
			$currentPage = 1;

		return $currentPage;
	}
}