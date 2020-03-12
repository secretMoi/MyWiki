<?php

namespace Core\HTML;

class BootstrapForm extends Form{
	protected function surround($html) {
		return "<div class=\"form-group\">
					$html
				</div>";
	}

	public function hidden($name, $value) {
		$input = '<input type="hidden" name="'. $name .'" value="'. $value .'">';

		return $input;
	}

	public function input($name, $label, $options = []) {
		// si le type est défini on l'utilise sinon c'est texte
		$type = isset($options['type']) ? $options['type'] : 'text';
		$label = '<label>' . $label . '</label>';

		if($type === 'textarea')
			$input = '<textarea
				name="'. $name .'"
				class="form-control" style="min-width: 100%; min-height: 400px;">'.trim($this->getValue($name)) .'</textarea>';
		else
			$input = '<input type="'. $type .'"
				class="form-control"
				value="'. $this->getValue($name) .'"
				name="'. $name .'">';

		return $this->surround($label . $input);
	}

	public function select($name, $label, $options) {
		$label = '<label>' . $label . '</label>';
		$input = '<select class="form-control" name="'. $name .'">';

		foreach ($options as $k => $v) { // récupère les options
			$attributes = '';

			if($k == $this->getValue($name))
				$attributes = ' selected';

			$input .= "<option value='$k'$attributes>$v</option>";
		}

		$input .= '</select>';

		return $this->surround($label . $input);
	}

	public function submit() {
		return $this->surround('<button type="submit" class="btn btn-primary">Envoyer</button>');
	}
}

?>