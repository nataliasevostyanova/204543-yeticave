<?php
require_once('data.php');
require_once('add.phpfunctions.php') 

$anons_page = include_template('anons_content.php'[
	$page_title, 
	$header2,
	$anons_text
]);
print($anons_page);
