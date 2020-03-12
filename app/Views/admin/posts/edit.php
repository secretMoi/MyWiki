<div class="row">
    <div class="col-sm-12">
        <form method="post">
        <table class="table table-hover table-borderless">
            <tbody>

                <tr <?= $this->getError('titre') ?>>
                    <td>
						<?= $form->input('titre', 'Titre de l\'article'); ?>
                    </td>
                </tr>

                <tr <?= $this->getError('resume') ?>>
                    <td>
						<?= $form->input('resume', 'Résumé de l\'article'); ?>
                    </td>
                </tr>

                <tr <?= $this->getError('contenu') ?>>
                    <td>
						<?= $form->input('contenu', 'Contenu', ['type' => 'textarea']); ?>
                    </td>
                </tr>

                <tr <?= $this->getError('categorie') ?>>
                    <td>
						<?= $form->select('category_id', 'Catégorie', $categories); ?>
                    </td>
                </tr>

                <tr>
                    <td>
                        <a class="btn btn-danger mr-md-2" href="?p=admin.posts.index">Annuler</a>
                        <button type="submit" class="btn btn-primary">Sauvegarder</button>
                    </td>
                </tr>

            </tbody>
        </table>
        </form>
    </div>
</div>