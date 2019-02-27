
<?php

require_once('data.php');       /*подключаем БД и данные запросов*/
require_once('functions.php');  /*подключаем функции*/

if(isset($_GET['id'])){
  $lot_id = $_GET['id'];
  
}
else{
   print('unknown lot');
}

/*запрос на информацию о лоте по его id -- получаем массив $l_inf*/
$sql =  "SELECT name, description, img_url, cat_id, start_price, category FROM lots l JOIN cats c ON l.cat_id=c.id WHERE l.id=$lot_id";

$result = mysqli_query($link, $sql);
            if(!result){
              $error = mysql_error($link);
              print("Ошибка MySQL: ". $error);
            }
print($records_count = mysqli_num_rows($result).';');
  
$row = mysqli_fetch_all($result);
$l_inf = $row;
          /*проверка массива*/
          if(is_array($l_inf)){
            print("да, 'l_inf' массив;");
          }
          else{
            print("Нет, 'l_inf' не массив;");
          }
    /*смотрим, что получили в массиве по запросу*/      
    /*var_dump($l_inf);*/


$lot_info = include_template('lot_info.php',['l_inf' =>$l_inf]); /*lot information*/
$lot_title = $l_inf['name'];

$tpl_lot = include_template('tpl_lot.php', ['lot_info' => $lot_info, 'lot_title' => $lot_title]); 

print($tpl_lot);
?> 

