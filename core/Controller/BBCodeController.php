<?php


namespace Core\Controller;


class BBCodeController
{
	public function dbToBbcode($texte)
	{
		if (!empty($texte)) {
			$texte = htmlspecialchars($texte, ENT_NOQUOTES, 'UTF-8'); // évite l'injection de code
			$conversion = require(ROOT . 'config/bbcodeConfig.php');

			foreach ($conversion as $key => $value) {
				$texte = preg_replace('#' . $key . '#sSmu', $value, $texte);
			}

			//nl2br($texte); // convertit les sauts de ligne
		}

		return $texte;
	}
}