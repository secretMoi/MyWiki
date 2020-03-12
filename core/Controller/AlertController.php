<?php


namespace Core\Controller;

class AlertController
{
	protected $alert; // code de l'alerte
	protected $message; // message à afficher
	protected $type; // type de sévèrosité
	protected $set = false; // si une alerte est définie

	public const DISCONNECTED = 0;
	public const FORBIDDEN    = 1;
	public const NOT_FOUND    = 2;
	public const POST_ADD     = 3;
	public const POST_EDIT    = 4;
	public const POST_DEL     = 5;
	public const POST_ERR     = 6;
	public const CAT_DEL      = 7;

	/**
	 * AlertController constructor.
	 */
	public function __construct()
	{
		if(isset($_GET['alert']))
			$this->setAlert($_GET['alert']);
	}

	/**
	 * @param $message
	 * @param $type
	 */
	protected function initAlert($message, $type){ // initialise les attributs d'une alerte
		$this->message = $message;
		$this->type = $type;
		$this->set = true;
	}

	/**
	 * @param $alert
	 */
	public function setAlert($alert) { // on demande d'ajouter une alerte
		$this->alert = $alert;

		switch ($this->alert) {
			case self::DISCONNECTED:
				$this->initAlert('Vous avez été déconnecté', 'danger');
				break;
			case self::FORBIDDEN:
				$this->initAlert('Vous ne disposez pas des droits requis pour accéder au contenu de cette page', 'danger');
				break;
			case self::NOT_FOUND:
				$this->initAlert('La page demandée est introuvable', 'danger');
				break;
			case self::POST_ADD:
				$this->initAlert('L\'article a bien été ajouté', 'success');
				break;
			case self::POST_EDIT:
				$this->initAlert('L\'article a bien été modifé', 'success');
				break;
			case self::POST_DEL:
				$this->initAlert('L\'article a bien été supprimé', 'danger');
				break;
			case self::POST_ERR:
				$this->initAlert('L\'article n\a pas pu être enregistré', 'danger');
				break;
			case self::CAT_DEL:
				$this->initAlert('La catégorie a bien été supprimée', 'danger');
				break;
		}

		if(!isset($_GET['alert']))
			header('Location: index.php?alert=' . $this->alert);
	}

	/**
	 * @return string|null
	 */
	public function show() { //  génère le code html d'une alerte
		if($this->set){
			$html = '<div class="alert alert-' . $this->type . '" role="alert">' . $this->message . '</div>';

			$this->set = false; // retire l'état d'alerte

			return $html;
		}
		else
			return null;
	}

	/**
	 * Permet de savoir si une alerte a été initialisée
	 * @return bool
	 */
	public function alertPresent(): bool {
		return $this->set;
	}
}