<?
require_once('data.php');
require_once('functions.php');

$page_content = include_template('main.php', $staff); /*page content*/
/*$foot_menu = render_template('footer_cats_menu', $cats);/* /* categories menu in footer*/

$layout = include_template('layout.php', ['content' => $page_content, $page_name = 'Yeticave - Главная']); 

print($layout);
?> 

