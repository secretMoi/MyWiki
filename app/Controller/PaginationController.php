<?php


namespace App\Controller;
// todo dernière et première page
class PaginationController extends \Core\Controller\PaginationController
{
	protected $pageURL;
	protected $currentPage;
	
	protected const PREV_NEXT = 0;
	protected const MULTI     = 1;
	
	/**
	 * dessine la bar de pagination
	 * @return string
	 */
	public function paginateBar($page = null) {

		$numberPages = ceil($this->count / $this->perPage); // calcule le nombre de page
		$this->currentPage = $this->calculateCurrentPage();
		$previousPage = $this->currentPage - 1;
		$nextPage = $this->currentPage + 1;

		if($previousPage < 1) // gère les pages précédent et suivant
			$previousPage = $numberPages;
		if($nextPage > $numberPages)
			$nextPage = 1;

		$this->handlePageURL($page);

		$html = '
			<nav aria-label="Pagination">
				<ul class="pagination justify-content-center">';

		$html .= $this->handleLink($previousPage, "Précédent");

		if($this->currentPage > 3) // pour n'afficher que 2 pages avant max
			$i = $this->currentPage - 2;
		else
			$i = 1;

		for(; $i <= $this->currentPage + 2; $i++) {
			if($i <= $numberPages) { // pour ne pas afficher des pages en trop qui n'existent pas
				$html .= $this->handleLink($i, $i);
			}
		}

		$html .= $this->handleLink($nextPage, "Suivant");
		$html .= '</ul></nav>';

		return $html;
	}

	/**
	 * retourne l'url de la page
	 * @param $pageURL url de la page
	 */
	protected function handlePageURL($pageURL) {
		if($pageURL != null)
			$this->pageURL = "index.php?p=$pageURL&pagination=";
		else
			$this->pageURL = 'index.php?pagination=';
	}

	protected function handleLink($page, $texte) {
		$active = null;

		// si la page est un chiffre et que c'est la page courante
		if($page == intval($texte) && $this->currentPage == $page)
			$active = "active";

		return '
			<li class="page-item ' . $active .'">
				<a class="page-link" href="' . $this->pageURL . $page .'">' . $texte . '</a>
			</li>';
	}
}