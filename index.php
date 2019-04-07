<?php
require_once ('data.php');
require_once('functions.php');


$main_content = include_template('main_content.php', ['cats' => $cats, 'staff' => $staff]);

$layout_content = include_template('layout_main.php', ['cats' => $cats, 'main_content' => $main_content, $title_main => 'Yeticave - Главная']);

print($layout_content);

?>