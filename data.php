<?php
require_once('db_connect.php');

$sql = "SELECT creation_date, name, description, img_url, start_price, cat_id, category FROM lots l 
JOIN cats c
ON l.cat_id = c.id ORDER BY creation_date DESC
LIMIT 6";
$result = mysqli_query($link, $sql);
            if(!result){
              $error = mysql_error($link);
              print("Ошибка MySQL: ". $error);
            }
print($records_count = mysqli_num_rows($result).';');
  
$row = mysqli_fetch_all($result, MYSQLI_ASSOC);


$staff = $row;

if(is_array($staff)){
  print("да, 'staff' массив;");
}
else{
  print("Нет, 'staff' не массив;");
}


/*запрос на информацию о категориях*/
$sql = "SELECT category FROM cats;";
$result = mysqli_query($link, $sql);
            if(!result){
              $error = mysql_error($link);
              print("Ошибка MySQL: ". $error);
            }
print($records_count = mysqli_num_rows($result).';');
  
$row = mysqli_fetch_all($result);


$cats = $row;

if(is_array($cats)){
  print("да, 'cats' массив;");
}
else{
  print("Нет, 'cats' не массив;");
}

$is_auth = rand(0, 1);
$user_name = 'Наташа'; // укажите здесь ваше имя



?>
