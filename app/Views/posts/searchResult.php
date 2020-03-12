<div class="d-flex justify-content-end">
    <button type="button" class="btn btn-primary">
        Nombre de résultats <span class="badge badge-light"><?= $nbResult; ?></span>
    </button>
</div>

<div class="row">
	<div class="col-sm-8">
		<?php foreach($posts as $post): ?>

			<h2><a href="<?= $post->url ?>"><?= $this->findWords($post->titre) ?></a></h2>
			<p><em><?= $post->categorie ?></em></p>

			<p>
				<?= $this->findWords($post->contenu) ?>
			</p>

		<?php endforeach; ?>

	</div>
</div>