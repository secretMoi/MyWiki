<h1>Liste des commandes bbcode</h1>

<table class="table table-hover">
	<thead class="thead-light">
	<tr>
		<td>Description</td>
		<td>BBCode</td>
		<td>Rendu</td>
	</tr>
	</thead>

	<tbdoy>
		<tr>
			<td>Texte en gras</td>
			<td>[b]Texte en gras[/b]</td>
			<td><b>Texte en gras</b></td>
		</tr>

		<tr>
			<td>Texte en italique</td>
			<td>[i]Texte en italique[/i]</td>
			<td><em>Texte en italique</em></td>
		</tr>

		<tr>
			<td>Texte en souligné</td>
			<td>[u]Texte en souligné[/u]</td>
			<td><u>Texte en souligné</u></td>
		</tr>

		<tr>
			<td>Insérer une image</td>
			<td>[img]URL de l'image[/img]</td>
			<td>Photo</td>
		</tr>

		<tr>
			<td>Insérer un lien</td>
			<td>[url=lien]Texte du lien[/a]</td>
			<td><a href="#">Texte du lien</a></td>
		</tr>

		<tr>
			<td>Insérer une liste</td>
			<td>
				[ul]<br />
					<pre><?= "\t"; ?>[li]Liste1[/li]</pre>
				<pre><?= "\t"; ?>[li]Liste2[/li]</pre>
				[/ul]<br />
			</td>
			<td>
				<div class="list-group">
					<ul>
						<li class="list-group-item list-group-item-action">
							Liste1
						</li>
						<li class="list-group-item list-group-item-action">
							Liste2
						</li>
					</ul>
				</div>
			</td>
		</tr>

		<tr>
			<td>Insérer une séparation</td>
			<td>[hr]</td>
			<td><hr class="my-4"></td>
		</tr>

		<tr>
			<td>Insérer un titre</td>
			<td>
				[h1]Titre[/h]<br /><br />
				[h2]Titre[/h]<br /><br />
				[h3]Titre[/h]<br /><br />
				[h4]Titre[/h]<br /><br />
				[h5]Titre[/h]<br /><br />
				[h6]Titre[/h]<br />
			</td>
			<td>
				<h1>Titre</h1>
				<h2>Titre</h2>
				<h3>Titre</h3>
				<h4>Titre</h4>
				<h5>Titre</h5>
				<h6>Titre</h6>
			</td>
		</tr>

		<tr>
			<td>Citer</td>
			<td>[cite]Texte[/cite]</td>
			<td>
				<div class="shadow-lg p-4 mb-4 bg-white">Texte</div>
			</td>
		</tr>

		<tr>
			<td>Couleur texte</td>
			<td>
				[color=muted]Texte[/color]<br />
				[color=primary]Texte[/color]<br />
				[color=success]Texte[/color]<br />
				[color=info]Texte[/color]<br />
				[color=warning]Texte[/color]<br />
				[color=danger]Texte[/color]<br />
				[color=secondary]Texte[/color]<br />
				[color=white]Texte[/color]<br />
				[color=dark]Texte[/color]<br />
				[color=body]Texte[/color]<br />
				[color=light]Texte[/color]
			</td>
			<td>
				<span class="text-muted">Texte</span><br />
				<span class="text-primary">Texte</span><br />
				<span class="text-success">Texte</span><br />
				<span class="text-info">Texte</span><br />
				<span class="text-warning">Texte</span><br />
				<span class="text-danger">Texte</span><br />
				<span class="text-secondary">Texte</span><br />
				<span class="text-white">Texte</span><br />
				<span class="text-dark">Texte</span><br />
				<span class="text-body">Texte</span><br />
				<span class="text-light">Texte</span><br />

			</td>
		</tr>

		<tr>
			<td>Alerte</td>
			<td>
				[alerte=primary]Alerte[/alerte]<br /><br />
				[alerte=success]Alerte[/alerte]<br /><br />
				[alerte=info]Alerte[/alerte]<br /><br />
				[alerte=warning]Alerte[/alerte]<br /><br />
				[alerte=danger]Alerte[/alerte]<br /><br />
				[alerte=secondary]Alerte[/alerte]<br /><br />
				[alerte=dark]Alerte[/alerte]<br /><br />
				[alerte=light]Alerte[/alerte]
			</td>
			<td>
				<span class="alert alert-primary">Alerte</span><br /><br />
				<span class="alert alert-success">Alerte</span><br /><br />
				<span class="alert alert-info">Alerte</span><br /><br />
				<span class="alert alert-warning">Alerte</span><br /><br />
				<span class="alert alert-danger">Alerte</span><br /><br />
				<span class="alert alert-secondary">Alerte</span><br /><br />
				<span class="alert alert-dark">Alerte</span><br /><br />
				<span class="alert alert-light">Alerte</span><br /><br />

			</td>
		</tr>
	</tbdoy>
</table>
