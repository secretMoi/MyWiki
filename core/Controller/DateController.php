<?php


namespace core\Controller;


class DateController
{
	protected $dayFr = array(
		'Dimanche',
		'Lundi',
		'Mardi',
		'Mercredi',
		'Jeudi',
		'Vendredi',
		'Samedi'
	);

	public function getDateSQL($dateSql = null){
		if($dateSql != null)
			return date("d/m/y à H:i:s", $dateSql);
		else
			return date('Y-m-d H:i:s');
	}

	public function convertDate($date, $maj = false) {
		$dateSql = strtotime($date);

		$dayEn = date('w', $dateSql);

		if($maj)
			$prefix = "Le ";
		else
			$prefix = "le ";

		return $prefix . $this->dayFr[$dayEn] . " " . $this->getDateSQL($dateSql);
	}
}