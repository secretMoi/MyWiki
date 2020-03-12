<?php if(isset($alert)) echo $alert->show(); ?>

<div class="row">
	<div class="col-sm-10">

        <table class="table table-hover table-borderless">
            <tbody>


<?php foreach($posts as $post): ?>
                <tr>
                    <td>
                        <h2><a href="<?= $post->url; ?>"><?= $post->titre; ?></a></h2>
                        <p><em><?= $post->categorie; ?></em></p>

                        <p>
                            <?= $post->resume; ?>
                        </p>
                    </td>
                </tr>
<?php endforeach; ?>
            </tbody>
        </table>

    </div>

	<div class="col-sm-2">
		<?php foreach($categories as $categorie): ?>

			<li><a href="<?= $categorie->url; ?>"><?= $categorie->titre; ?></a></li>

		<?php endforeach; ?>
	</div>
</div>

<?= $pagin->paginateBar(); ?>