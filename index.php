<?
require_once('data.php');

 
require_once('functions.php');

/* ЗДЕСЬ ДОЛЖЕН БЫТЬ  $page_content */

$page_content = include_template('main.php', $staff, $cats);

$layout = include_template('layout.php', ['content' => $page_content, $page_name = 'Yeticave - Главная']); 
print($layout);
?> 

