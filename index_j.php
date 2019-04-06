<?php
require_once ('data_db.php');
require_once('functions_01.php');


$main_content = include_template('main_content.php', ['cats' => $cats, 'staff' => $staff]);

$layout_content = include_template('layout_J.php', ['cats' => $cats, 'main_content' => $main_content, $title_main => 'Yeticave - Главная']);

print($layout_content);

?>