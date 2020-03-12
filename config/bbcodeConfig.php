<?php
return array(
	'\[b\](.*?)\[\/b\]' => '<strong>$1</strong>',
	'\[i\](.*?)\[\/i\]' => '<em>$1</em>',
	'\[u\](.*?)\[\/u\]' => '<u>$1</u>',
	'\[img\](.*?)\[\/img\]' => '<img src="$1" />',
	'\[url=([^\]]*)\](.*)\[\/url\]' => '<a href="$1">$2</a>',
	'\[ul\]' => '<div class="list-group"><ul style="white-space: normal">', '\[\/ul\]' => '</ul></div>',
	'\[li\](.*?)\[\/li\]' => '<li class="list-group-item list-group-item-action">$1</li>',
	'\[hr\]' => '<hr class="my-4">',
	'\[h1\](.*?)\[\/h\]' => '<h1>$1</h1><hr class="my-4">',
	'\[h([2-6])\](.*?)\[\/h\]' => '<h$1>$2</h$1>',
	'\[cite\](.*?)\[\/cite]' => '<blockquote class="shadow p-4 mb-4 bg-white" style="white-space: pre-line;">$1</blockquote>',
	'\[color=(.*?)\](.*?)\[\/color]' => '<span class="text-$1">$2</span>',
	//'[(.*)^[<\/li\>\n$]]' => '<br />', // retour à la ligne sauf si c'est une </li>
	//'[[\<\/li\>]\n]' => '<br />',
	'\[alerte=(.*?)\](.*?)\[\/alerte]' => '<div class="alert alert-$1" role="alert">$2</div>',
);

