<?php


namespace App\Entity;


use Core\Entity\Entity;

class AlertEntity extends Entity
{
	public function getType(){
		return $this->type;
	}

	public function getMessage(){
		return $this->message;
	}
}