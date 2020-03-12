<?php


namespace App\Entity;


use Core\Entity\Entity;

class HistoryEntity extends Entity
{
	public function getDate() {
		$originalDate = $this->date;
		$newDate = date("d/m/y à H:i:s", strtotime($originalDate));
		return $newDate;
	}

	public function getId() {
		return $this->id;
	}

	public function getIdArticle() {
		return $this->idArticle;
	}

	public function getTitre() {
		return $this->titre;
	}

	public function getContenu()  {
		return $this->contenu;
	}
}