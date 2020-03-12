<?php
if(isset($_GET['q'])) {
	$pdo = new PDO('mysql:dbname=blog;host=localhost:3307', 'root', 'root');
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // affiche les msg d'erreurs

	$q = $_GET['q'];
	$s = explode(" ", $q);

	$sql = "SELECT * FROM articles";

	$i = 0;
	foreach ($s as $mot) { // génère la req sql
		if($i == 0)
			$sql .= " WHERE ";
		else
			$sql .= " AND "; // demande tous les mots demandés, sinon OR pour juste avoir au moins un mot demandé

		$sql .= "contenu LIKE '% $mot %'"; // les espaces permettent de rechercher par mot et pas par chaine
		$i++;
	}
	$reponse = $pdo->query($sql);
	echo $reponse->rowCount(); // affiche nombre résultat
	while ($donnees = $reponse->fetch()) { // affiche les données

		$c = $donnees['contenu'];
		$i = 0;

		foreach ($s as $mot) { // parser contenu pour trouver les mots-clés demandés
			$c = str_ireplace(
				$mot,
				'<span style="background-color: #7abaff;">'.$mot.'</span>',
				$c
			); // remplace sans faire attention à la casse
		}
		?>
		<p>
			<?= $donnees['titre']; ?><br>
			<?= $c; ?><br>
		</p>
		<hr>
		<?php
	}
}
else
	echo 'recherche invalide';
?>