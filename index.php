<?php
session_start();
require_once ('data.php');
require_once('functions.php');

$main_content = include_template('main_content.php', ['user_name' => $user_name, 'cats' => $cats, 'staff' => $staff]);
$layout_content = include_template('layout_main.php', ['cats' => $cats, 'main_content' => $main_content, $page_title => 'Yeticave - Главная']);

print($layout_content);
