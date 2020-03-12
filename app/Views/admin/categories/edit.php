<form method="post">
	<?= $form->input('titre', 'Titre de la catégorie'); ?>
	<?= $form->select('parent', 'Catégorie parente', $categories); ?>
	<button class="btn btn-primary">Sauvegarder</button>
</form>