<?
require_once('data.php');
require_once('functions.php');

$page_content = include_template('main.php',['staff' => $staff, 'cats' =>$cats]); /*page content*/
/*$foot_menu = include_template('footer_menu', ['cats' => $cats]); categories menu in footer*/

$layout = include_template('layout.php', ['content' => $page_content, 'cats' => $cats, $page_name = 'Yeticave - Главная']); 

print($layout);
?> 

