<?php
namespace Core\HTML;

class Form {
	private $data;

	public $surround = 'p';

	public function __construct($data = array()) {
		$this->data = $data;
	}

	protected function surround($html) {
		return "<{$this->surround}>
					$html
				</${$this->surround}>";
	}

	protected function getValue($index) {
		if(is_object($this->data)) // si les données sont sous forme d'objet
			return $this->data->$index;

		return isset($this->data[$index]) ? $this->data[$index] : null;
	}

	public function input($name, $label, $options = []) {
		// si le type est défini on l'utilise sinon c'est texte
		$type = isset($options['type']) ? $options['type'] : 'text';
		
		return $this->surround('
			<input type="'. $type .'" value="'. trim($this->getValue($name)) .'" name="'. $name .'">
			');
	}

	public function submit() {
		return $this->surround('<button type="submit">Envoyer</button>');
	}
}

?>