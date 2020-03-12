<!doctype html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title><?= App::getInstance()->title; ?></title>

		<!-- Bootstrap core CSS -->
		<link href="<?= App::getInstance()->css; ?>" rel="stylesheet">

        <?= $jsTextarea; // si on a besoin du js et css bbcode ?>
	</head>

	<body>

		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
                    <a class="navbar-brand btn btn-light" href="index.php"><?= App::getInstance()->nomProjet; ?></a>
				</div>

                <div class="d-flex justify-content-end">
                    <div class="btn-toolbar">
                        <a href="<?= $this->getUser('link'); ?>"><button type="button" class="btn btn-outline-primary mr-1"><?= $this->getUser('logButton'); ?></button></a>
                        <?php if($this->getUser('isConnected')): ?>
                            <a href="<?= $this->getUser('disconnectLink'); ?>"><button type="button" class="btn btn-outline-danger ml-1 mr-1">Se déconnecter</button></a>
                        <?php endif; ?>

                        <a href="?p=history.list"><button type="button" class="btn btn-outline-primary mr-1">Historique</button></a>

                        <form class="form-inline ml-1" method="post" action="index.php?p=search.result">
                            <input class="form-control mr-md-2" type="text" placeholder="Rechercher..." aria-label="Rechercher..." name="keywords">
                            <input type="submit" class="btn btn-outline-light text-dark" value="Cherche">
                        </form>
                    </div>

                </div>
			</div>
		</nav>

		<div class="container-fluid">

			<div class="starter-template" style="padding-top: 50px;">
				<?= $content; ?>

                <div class="d-flex justify-content-end">
                    <a href="?p=BBCode.list"><button type="button" class="btn btn-outline-primary mt-mt-3 mb-md-4">BBCode</button></a>
                </div>
			</div>

		</div>

	</body>
</html>
