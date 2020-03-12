<?php
$pdo = new PDO('mysql:dbname=blog;host=localhost:3307', 'root', 'root');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // affiche les msg d'erreurs



$sql = "SELECT titre FROM articles";
$reponse = $pdo->query($sql);

$nbArticles = $reponse->rowCount(); // affiche nombre résultat

echo $nbArticles . '<br>';

$perPage = 1; // nb d'articles par page
$nombrePages = ceil($nbArticles / $perPage); // calcule du nombre de pages

if(isset($_GET['p']) && $_GET['p'] > 0 && $_GET['p'] <= $nombrePages) // si la page est bien définie
	$currentPage = $_GET['p'];
else
	$currentPage = 1; // sinon on affiche la première page

$sql = "SELECT * FROM articles ORDER BY date DESC LIMIT " . (($currentPage - 1) * $perPage) . ", $perPage";
$reponse = $pdo->query($sql);

while($res = $reponse->fetch()) { // affiche les articles
	echo $res['titre'] . '<br>';
	echo $res['contenu'] . '<br><hr>';
}

for($i = 1; $i <= $nombrePages; $i++) // affiche la pagination
	echo '<a href="index.php?p='. $i .'">' .$i. '</a>  / ';