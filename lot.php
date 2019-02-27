
<?php

require_once('data.php');       /*подключаем БД и данные запросов*/
require_once('functions.php');  /*подключаем функции*/

if(isset($_GET['id'])){
  $lot_id = $_GET['id'];
}
else{
  $lot_id = print('unknown lot');
}


/*запрос на информацию лоте по его id*/
$sql = "SELECT * FROM lots WHERE id = $lot_id;";
$result = mysqli_query($link, $sql);
            if(!result){
              $error = mysql_error($link);
              print("Ошибка MySQL: ". $error);
            }
print($records_count = mysqli_num_rows($result).';');
  
$row = mysqli_fetch_all($result);
$l_inf = $row;
          /*проверка массива*/
          /*if(is_array($l_inf)){
            print("да, 'l_inf' массив;");
          }
          else{
            print("Нет, 'l_inf' не массив;");
          }*/

$lot_info = include_template('lot_info.php',['l_inf' =>$l_inf]); /*lot information*/


$tpl_lot = include_template('tpl_lot.php', ['$lot_title' => $l_inf['name']]); 

print($tpl_lot);
?> 

