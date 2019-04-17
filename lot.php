<?php

require_once('data.php');       /*подключаем БД и данные запросов*/
require_once('functions.php');  /*подключаем функции*/

if(isset($_GET['id_lot'])){
    $id_lot = intval($_GET['id_lot']);
     print($id_lot);

 /*запрос на информацию о лоте по его id -- получаем массив $lot_info*/
    $sql = "SELECT name, description, img_url, cat_id, start_price, category FROM lots l JOIN cats c ON l.cat_id=c.id WHERE l.id_lot = '$id_lot'";
    $result = mysqli_query($link, $sql);
       if(!$result){
         $error = mysqli_error($link);
         print("Ошибка MySQL: ". $error);
       }
    $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
     foreach($row as $item){     
          $lot_info = $item;
     }
 
// показываем страницу с данными лота

    // блок нформации о лоте
    $lot_block = include_template('lot_content.php', ['id_lot'=> $id_lot, 'lot_info' => $lot_info]); 
    // название лота 
    $lot_title = $lot_info['name']; 
    // шаблон страницы лота
    $layout_lot = include_template('layout_lot.php', ['lot_block' => $lot_block, 'lot_info' => $lot_info, 'lot_title' => $lot_title]); 

    print($layout_lot);
}
 else{
  header('Location: pages/404.html');  /*"HTTP/1.1 404 Not Found"*/
  die(); 
}