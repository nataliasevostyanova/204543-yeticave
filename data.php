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

/*if(is_array($staff)){
  print("да, 'staff' массив;");
}
else{
  print("Нет, 'staff' не массив;");
}*/

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
          /*проверка массива*/
          /*if(is_array($cats)){
            print("да, 'cats' массив;");
          }
          else{
            print("Нет, 'cats' не массив;");
          }*/






$is_auth = rand(0, 1);
$user_name = 'Наташа'; // укажите здесь ваше имя
$cats = ["Доски и лыжи", "Крепления", "Ботинки", "Одежда", "Инструменты", "Разное"];
$staff = [
  0 =>  ['name' => '2014 Rossignol District Snowboard',
      'category' => 'Доски и лыжи',
      'start_price' => '10999',
      'url_img'=> 'img/lot-1.jpg'
     ],
  1 => ['name' => 'DC Ply Mens 2016/2017 Snowboard',
      'category' => 'Доски и лыжи',
      'start_price' => '159999',
      'url_img'=> 'img/lot-2.jpg'
     ],
  2 => ['name' => 'Крепления Union Contact Pro 2015 года размер L/XL',
      'category' => 'Крепления',
      'start_price' => '8000',
      'url_img'=> 'img/lot-3.jpg'
     ],
  3 =>['name' => 'Ботинки для сноуборда DC Mutiny Charocal',
      'category' => 'Ботинки',
      'start_price' => '10999',
      'url_img'=> 'img/lot-4.jpg'
     ],
  4 =>['name' => 'Куртка для сноуборда DC Mutiny Charocal',
      'category' => 'Одежда',
      'start_price' => '7500',
      'url_img'=> 'img/lot-5.jpg'
     ], 
  5 =>['name' => 'Маска Oakley Canopy',
      'category' => 'Разное',
      'start_price' => '5400',
      'url_img'=> 'img/lot-6.jpg'
     ] 
];
?>
