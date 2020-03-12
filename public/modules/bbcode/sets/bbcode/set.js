var mySettings = {
	onTab:    		{keepDefault:false, replaceWith:'    '},
	markupSet:  [ 	
		{name:'Gras', key:'B', openWith:'[b]', closeWith:'[/b]' },
		{name:'Italique', key:'I', openWith:'[i]', closeWith:'[/i]'  },
		{name:'Souligné', key:'S', openWith:'[u]', closeWith:'[/u]' },
		{separator:'---------------' },
		{name:'Image', key:'P', replaceWith:'[img][![URL de l\'image:!:http://]!][/img]'},
		{name:'Lien', key:'L', openWith:'[url=[![Lien:!:http://]!]]', closeWith:'[/url]', placeHolder:'Lien'},
		{separator:'---------------' },
		{name:'Couleur', openWith:'[color=[![muted - primary - success - info - warning - danger - secondary - white - dark - body - light]!]]', closeWith:'[/color]', dropMenu: [
				{name:'Yellow', openWith:'[color=yellow]', closeWith:'[/color]', className:"col1-1" },
				{name:'Orange', openWith:'[color=orange]', closeWith:'[/color]', className:"col1-2" },
				{name:'Red', openWith:'[color=red]', closeWith:'[/color]', className:"col1-3" },
				{name:'Blue', openWith:'[color=blue]', closeWith:'[/color]', className:"col2-1" },
				{name:'Purple', openWith:'[color=purple]', closeWith:'[/color]', className:"col2-2" },
				{name:'Green', openWith:'[color=green]', closeWith:'[/color]', className:"col2-3" },
				{name:'White', openWith:'[color=white]', closeWith:'[/color]', className:"col3-1" },
				{name:'Gray', openWith:'[color=gray]', closeWith:'[/color]', className:"col3-2" },
				{name:'Black', openWith:'[color=black]', closeWith:'[/color]', className:"col3-3" }
			]},
		{name:'Taille du texte', key:'S', openWith:'[h[![Taille du texte (1 - 2 - 3)]!]]', closeWith:'[/h]'},
		{separator:'---------------' },
		{name:'Liste', openWith:'    [li]', closeWith:'[/li]', multiline:true, openBlockWith:'[ul]\n', closeBlockWith:'\n[/ul]'},
		{name:'Elément liste', key:'L', openWith:'    [li]', closeWith:'[/li]' },
		{separator:'---------------' },
		{name:'Citation', openWith:'[cite]', closeWith:'[/cite]\n'},
		{name:'Alerte', openWith:'[alerte=[![primary - secondary - success - danger - warning - info - light - dark]!]]', closeWith:'[/alerte]\n'},
		{name:'Separation', replaceWith:'[hr]'}

	]
}
