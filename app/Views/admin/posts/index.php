<?php if(isset($alert)) echo $alert->show(); ?>

<h1>Administrer les articles</h1>

<p>
    <div class="d-flex justify-content-between">
        <a href="?p=admin.categories.index" class="btn btn-secondary">Catégories</a>

        <div><a href="?p=admin.posts.add" class="btn btn-success">Ajouter</a></div>
    </div>
</p>

<table class="table table-hover">
	<thead>
		<tr>
			<td>Titre</td>
            <td>Création</td>
            <td>Modification</td>
			<td class="d-flex justify-content-end">Actions</td>
		</tr>
	</thead>

	<tbdoy>
		<?php foreach($posts as $post): ?>

		<tr>
            <td><a href="?p=posts.show&id=<?= $post->id ?>"><?= $post->titre; ?></a></td>

            <td><?= $post->date; ?></td>

            <td><?= $post->date_modif; ?></td>

			<td class="d-flex justify-content-end">
				<a class="btn btn-primary mr-md-2" href="?p=admin.posts.edit&id=<?= $post->id; ?>">Editer</a>

				<form action="?p=admin.posts.delete" method="post" style="display: inline;">
					<input type="hidden" name="id" value="<?= $post->id; ?>">
					<button type=submit class="btn btn-danger">Supprimer</button>
				</form>
				
			</td>
		</tr>

		<?php endforeach; ?>
	</tbdoy>
</table>

<?= $pagin->paginateBar('admin.posts.index'); ?>