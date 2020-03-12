<div class="jumbotron">
    <h1 class="display-4">
        <?= $article->titre; ?>
    </h1>

    <p class="lead">
        <?= $article->resume; ?>
    </p>

    <hr class="my-4">

    <blockquote class="blockquote text-right">
        <p class="lead">
            <?= $article->categorie; ?>
        </p>
    </blockquote>

    <blockquote style="white-space: pre-line">
	    <?= $article->contenu; ?>
    </blockquote>
</div>

<div class="row">
    <div class="col-sm-10">Créé <?= $article->date; ?></div>
	<?php if(isset($article->date_modif)): ?>
        <div class="col-sm-2">
                <a href="?p=history.list&id=<?= $article->id; ?>">Modifié <?= $article->date_modif; ?></a>
        </div>
	<?php endif; ?>
</div>

<?php if($this->getUser('isConnected')): ?>
    <div class="float-left">
    <a href="?p=admin.posts.edit&id=<?= $article->id; ?>"><button type="button" class="btn btn-outline-success mt-mt-3 mb-md-4">Editer</button></a>
</div>
<?php endif; ?>