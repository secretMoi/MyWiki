<h1><?= $categorie->titre; ?></h1>

<div class="row">
	<div class="col-sm-8">
<?php foreach($articles as $post): ?>

		<h2><a href="<?= $post->url; ?>"><?= $post->titre; ?></a></h2>
		<p><em><?= $post->categorie; ?></em></p>

		<p>
			<?= $post->resume; ?>
		</p>

<?php endforeach; ?>

	</div>

	<div class="col-sm-4">
		<?php foreach($categories as $categorie): ?>

			<li><a href="<?= $categorie->url; ?>"><?= $categorie->titre; ?></a></li>

		<?php endforeach; ?>
	</div>
</div>