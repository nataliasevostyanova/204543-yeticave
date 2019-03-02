<?php

require_once('data.php');       /*подключаем БД и данные запросов*/
require_once('functions.php');  /*подключаем функции*/

if(isset($_GET['id_lot'])){
  $lot_id = $_GET['id_lot'];
  /*print('id_lot = '.$lot_id);*/
 
 /*запрос на информацию о лоте по его id -- получаем массив $l_inf*/
  
  $sql =  "SELECT name, description, img_url, cat_id, start_price, category FROM lots l JOIN cats c ON l.cat_id=c.id WHERE l.id_lot = $lot_id";

   $result = mysqli_query($link, $sql);
            if(!$result){
              $error = mysqli_error($link);
              print("Ошибка MySQL: ". $error);
            }
   $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
   foreach($row as $item)
  {
    $l_inf = $item;
  }
/*
   print('<pre>');
   var_dump($l_inf);
   print('</pre>');*/
}
  else{
  header( 'Location: pages/404.html' /*"HTTP/1.1 404 Not Found"*/); 

}


$lot_info = include_template('lot_info.php',['lot_id'=> $lot_id, 'l_inf' =>$l_inf]); /*lot information*/
$lot_title = $l_inf['name'];

$tpl_lot = include_template('tpl_lot.php', ['lot_info' => $lot_info, 'lot_title' => $lot_title]); 

print($tpl_lot);
?> 

