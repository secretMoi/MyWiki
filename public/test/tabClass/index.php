<?php
$_POST['name'] = 'Jean';
require ('Collection.php');
$notes = new \Test\TabClass\Collection([
	['name' => 'jean', 'note' => 20],
	['name' => 'marc', 'note' => 10],
	['name' => 'emil', 'note' => 15]
]);

var_dump($notes->max('note'));
var_dump($notes->extract('note')->max());

var_dump($notes->get('0')->get('name'));
var_dump($notes->get('0.name'));
//echo $notes->get('name');