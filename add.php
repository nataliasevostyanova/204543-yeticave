<?php 
require_once ('data.php');
require_once('functions.php');

    $add_lot = include_template('layout_addlot.php', ['cats' => $cats]); /*пустая форма*/

      if($_SERVER['REQUEST_METHOD'] === 'POST') {
			
    $lot = $_POST;
		print('<pre> Что получили из формы:  ');
		var_dump($_POST);
		print('</pre>');
		/*поля, необходимые для заполнения*/
	$required = ['lot-name', 'category', 'message', 'lot-rate', 'lot-step', 'lot-date']; 
		/*заголовки для пользователя*/
	$dict = ['lot-name' => 'Наименование', 'category' => 'Категория' , 'message' =>'Описание', 'lot-rate' => 'Начальная цена', 'lot-step' => 'Шаг ставки', 'lot-date' => 'Дата окончания торгов']; 
		/*массив ошибок*/
	$errors = [];
		/*проверка - заполнены ли поля*/
		foreach($required as $key){
		  if(empty($lot[$key])){
			$errors[$key] = 'Это поле нужно заполнить';
		  }
		 }

		/*проверка типа полей массива */
		foreach($lot as $key => $value){
		  if($key == 'category'){
			if(!isset($value) || $value = 'Выберите категорию'){
			$error = $dict['category']. ' не выбрана';
			}
		  }
		  if($key == 'lot-rate'){
			if(!isset($value) || gettype($value) !== integer){
			$error = $dict['lot-rate']. 'должна быть целым числом';
			}
		  }
		  if($key == 'lot-step'){
			if(!isset($value) || gettype($value) !== integer){
			$error = $dict['lot-step']. 'должен быть целым числом';
			}
		  }
		  if($key == 'lot-step'){
			if(check_date_format($value)){
			$error = $dict['lot-date']. 'должна быть в формате дд.мм.гггг';
			}
		  } // end проверки полей
		}//endforeach

				print('<pre> Ошибки заполнения:  ');
			    var_dump($errors);
			    print('</pre>');
				
				if(count($errors)){
						$add_lot = include_template('layout_addlot.php', ['cats' => $cats, 'lot' => $lot,'dict' => $dict,'errors' => $errors,]);/*показываем form--invalid и ошибки, если есть*/
					   }
				else {	

		                $add_lot = include_template('layout_addlot.php', ['cats' => $cats, 'lot' => $lot]);

				/*запрос на добавление лота в БД и редирект на страницу лота*/
	
	print('Категория:   '.$lot['category'].'   ');
	$lot_cat = mysqli_real_escape_string($link,$lot['category']);
	print('Категория:   '.$lot_cat.'   ');

    $sql = "SELECT id FROM cats WHERE category = '$lot_cat'"; 
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
	foreach($row as $item){
		$cat_id = $item['id'];
	}
	
	var_dump($cat_id);
	print('   id категории:  '.$cat_id.'  *');

	$name = mysqli_real_escape_string($link, $lot['lot-name']);
	var_dump($name);
	$description = mysqli_real_escape_string($link, $lot['message']);
	var_dump($description);
	$cat_id;
	var_dump($cat_id);
	$start_price = intval($lot['lot-rate']);
	var_dump($start_price);
	$rate_step = intval($lot['lot-step']);
	var_dump($rate_step);
	$user_id = '5';

   /*$sql = "INSERT INTO lots (name, description, cat_id, start_price, rate_step, user_id) VALUES (?, ?)";
   $stmt = mysqli_prepare($link, $sql);

   var_dump($stmt);
   mysqli_stmt_bind_param($stmt, 'ss', $name_lot, $lot_descri $lot_cat, $start_price, $rate_step, $user_id);
   mysqli_stmt_execute($stmt);*/

   $sql = "INSERT INTO lots (name, description, cat_id, start_price, rate_step, user_id) VALUES ('$name', '$description', '$cat_id', '$start_price', '$rate_step', '$user_id')";
   $result = mysqli_query($link, $sql);
   if(!$result){
   	$error = mysqli_error($link);
   	print('Ошибка MySQL: '.$error);
   }
   $last_lotid = mysqli_insert_id($link);
   print('id оследней записи  лота: '.$last_lotid);

	
					   	
	/*$sql = "SELECT id_lot FROM `lots` ORDER BY id_lot DESC LIMIT 1";
	$result = mysqli_query($link, $sql);
	$id_lot = $result;
	header('Location: http://localhost/204543-yeticave/lot.php?id_lot=$id_lot;');*/

   }
}
			
//end if получен $_POST

print($add_lot); 
?>