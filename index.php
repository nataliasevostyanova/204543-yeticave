<?
require_once('data.php');
require_once('functions.php');

$page_content = include_template('main.php',['staff' => $staff, 'cats' => $cats]); /*page content*/


$layout = include_template('layout.php', ['content' => $page_content, 'cats' => $cats, $page_name = 'Yeticave - Главная']); 

print($layout);
?> 

