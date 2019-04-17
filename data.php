<?php
require_once('db_connect.php');

/*последние 6 лотов  - получаем массив $staff*/
$sql = "SELECT id_lot, creation_date, name, description, img_url, start_price, cat_id, category FROM lots l 
JOIN cats c
ON l.cat_id = c.id ORDER BY creation_date DESC
LIMIT 6";
$result = mysqli_query($link, $sql);
            if(!$result){
              $error = mysqli_error($link);
              print("Ошибка MySQL: ".$error);
            }

$row = mysqli_fetch_all($result, MYSQLI_ASSOC);
$staff = $row;

/*if(is_array($staff)){
  print("да, 'staff' массив;");
  print('<pre>');
  var_dump($staff);
  print('</pre>');
}
else{
  print("Нет, 'staff' не массив;");
}*/

/*запрос на информацию о категориях*/
$sql = "SELECT category FROM cats;";
$result = mysqli_query($link, $sql);
            if(!$result){
              $error = mysql_error($link);
              print("Ошибка MySQL: ". $error);
            }
 
$row = mysqli_fetch_all($result, MYSQLI_ASSOC);
 
foreach ($row as $item) 
{
$cats[] = $item['category'];
}