<?php

require_once('data.php');
require_once('functions.php');

$h_m = render_template('header_menu', $cats);/*categories menu in header */
$page_content = include_template('main.php', $staff); /*page content*/
 
$f_m = render_template('footer_menu.php', $cats); /* categories menu in footer*/

$layout = include_template('layout.php', ['content' => $page_content, 'head_m' => $h_m, 'footer_m' => $f_m, $page_name = 'Yeticave - Главная']); 

print($layout);
?> 

