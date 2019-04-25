<?php
session_start();
require_once('data.php');       /*подключаем БД и данные запросов*/
require_once('functions.php');  /*подключаем функции*/

if(isset($_GET['id_lot'])){
  $lot_id = $_GET['id_lot'];
  /*print('id_lot = '.$lot_id);*/
 
 /*запрос на информацию о лоте по его id -- получаем массив $lot_info*/
  
  $sql =  "SELECT name, description, img_url, cat_id, start_price, category FROM lots l JOIN cats c ON l.cat_id=c.id WHERE l.id_lot = $lot_id";

   $result = mysqli_query($link, $sql);
            if(!$result){
              $error = mysqli_error($link);
              print("Ошибка MySQL: ". $error);
            }
   $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
   foreach($row as $item)
  {
    $lot_inf = $item;
  }
/*
   print('<pre>');
   var_dump($lot_inf);
   print('</pre>');*/
}
  else{
  header( 'Location: pages/404.html' /*"HTTP/1.1 404 Not Found"*/); 

}


$lot_inform = include_template('lot_content.php',['lot_id'=> $lot_id, 'lot_inf' =>$lot_inf]); /*lot information*/
$lot_title = $lot_inf['name']; /* название лота */

$layout_lot = include_template('layout_lot.php', ['lot_info' => $lot_inform, 'lot_title' => $lot_title]); 

print($layout_lot);
?> 

