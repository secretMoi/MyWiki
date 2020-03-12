<h1>Administrer les catégories</h1>

<p>
    <div class="d-flex justify-content-between">
        <a href="?p=admin.posts.index" class="btn btn-secondary">Articles</a>

        <a href="?p=admin.categories.add" class="btn btn-success">Ajouter</a>
    </div>
</p>

<table class="table table-hover">
	<thead>
		<tr>
			<td>Titre</td>
            <td>Catégorie parente</td>
            <td>Nombre d'articles</td>
			<td class="d-flex justify-content-end">Actions</td>
		</tr>
	</thead>

	<tbdoy>
		<?php foreach($items as $category): ?>
        <?php $this->addObjCount($category->id) ?>
		<tr>
			<td><?= $category->titre ?></td>

            <td><?= $category->parentName ?></td>

            <td><?= $this->count ?></td>

			<td class="d-flex justify-content-end">
				<a class="btn btn-primary mr-md-2" href="?p=admin.categories.edit&id=<?= $category->id ?>">Editer</a>

				<form action="?p=admin.categories.delete" method="post" style="display: inline;">
					<input type="hidden" name="id" value="<?= $category->id ?>">
					<button type=submit class="btn btn-danger">Supprimer</button>
				</form>
				
			</td>
		</tr>

		<?php endforeach; ?>
	</tbdoy>
</table>

<?= $pagin->paginateBar('admin.categories.index'); ?>