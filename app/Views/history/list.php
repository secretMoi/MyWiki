<h1>Historique des modifications</h1>

<table class="table table-hover">
	<thead>
	<tr>
		<td>Date de modification</td>
		<td>Titre</td>
        <td class="d-flex justify-content-end">Liste de ses modifcations</td>
	</tr>
	</thead>

	<tbdoy>
		<?php foreach($historys as $history): ?>
			<tr>
				<td><?= $this->getDate()->convertDate($history->date, true); ?></td>

				<td>
                    <h4><a href="?p=history.show&id=<?= $history->id; ?>"><?= $history->titre; ?></a></h4>
				</td>

                <td class="d-flex justify-content-end">
                    <a class="btn btn-primary" href="?p=history.list&id=<?= $history->idArticle; ?>">Liste</a>
                </td>
			</tr>

		<?php endforeach; ?>
	</tbdoy>
</table>

<?= $pagin->paginateBar('history.list'); ?>