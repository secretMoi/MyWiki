<?php


namespace App\Controller;


class BBCodeController extends AppController
{
	public function list() {
		$this->render('bbcode.examples');
	}
}