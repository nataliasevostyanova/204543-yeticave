<?php
session_start(); 
if (!isset($_SESSION['user_name'])) {
header("Location: pages/403.html");
exit();
}
require_once ('data.php');
require_once('functions.php');

    $add_lot = include_template('layout_addlot.php', ['cats' => $cats]); /*пустая форма*/

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
	 
	 $lot = $_POST;
		/*print('<pre> Что получили из формы:  ');
		var_dump($_POST);
		print('</pre>');*/
	/*поля, необходимые для заполнения*/
	$required = ['lot-name', 'category', 'message', 'lot-rate', 'lot-step', 'lot-date']; 
	/*заголовки для вывода ошибок пользователю*/
	$dict = ['lot-name' => 'Наименование', 'category' => 'Категория' , 'image' => 'Изображение', 'message' =>'Описание', 'lot-rate' => 'Начальная цена', 'lot-step' => 'Шаг ставки', 'lot-date' => 'Дата окончания торгов']; 
	/*массив ошибок*/
	$errors = [];
		/*проверка - заполнены ли поля*/
		foreach($required as $key){
		  if(empty($lot[$key])){
			$errors[$key] = 'Это поле нужно заполнить';
		  }
		}
		  /*проверка поля категории */
          	foreach($lot as $key => $value){
		if($key == 'category'){
		  if(!isset($value) || $value = 'Выберите категорию'){
			$error = $dict['category']. ' не выбрана';
			}
		  }
		  if($key == 'lot-rate'){
			if(!isset($value) || gettype($value) !== 'integer'){
			$error = $dict['lot-rate']. 'должна быть целым числом';
			}
		  }
		  if($key == 'lot-step'){
			if(!isset($value) || gettype($value) !== 'integer'){
			$error = $dict['lot-step']. 'должен быть целым числом';
			}
		  }
		  
		  } // end проверки полей

		 // Проверяем дату окончания лота: введенная дата должна быть не ранее следующего дня
		   $end_date = strtotime($lot['lot-date']);
		   $cur_date = strtotime("now");
		   $diff = $end_date - $cur_date;
		 if($diff <= 86400){
		   	 $errors['lot-date'] = $dict['lot-date'].' должна быть больше минимум на 1 день, чем текущая дата';
		   }
           /*$lot['lot-date'] =  ($lot['lot-date']);
           $fin_date = $lot['lot-date'] + strtotime('week');*/
           
          /* print('<pre> $end_date:  ');
		   var_dump($end_date);
		   print('</pre>');
		   print('<pre> $cur_date:  ');
		   var_dump($cur_date);
		   print('</pre>');*/
          }
		 // end проверки правильного заполнения полей
	//}//end foreach общей проверки полей

    // проверка данных о загружаемом файле изображения
	  if($_FILES['photo2']['name']) {
		$tmp_name = $_FILES['photo2']['tmp_name'];
		$path = $_FILES['photo2']['name'];

		$finfo = finfo_open(FILEINFO_MIME_TYPE);
		$file_type = finfo_file($finfo, $tmp_name);
          
          if($file_type !== "image/jpeg" && $file_type !== "image/png"){
		  $errors['image'] = 'Загрузите изображение в формате jpeg или png';
		  }
		  else{
		  move_uploaded_file($tmp_name, 'img/'.$path);
		  $lot['image'] = $path;
		  }
	  } 
	  else {
		$errors['image'] = 'Вы не загрузили изображение лота';
	  } 
		/*print('<pre> Ошибки заполнения полей формы:  ');
		var_dump($errors);
		print('</pre>');*/
	
	if(count($errors)){
	 // если есть ошибки заполнения формы, то показываем форму с ошибками
	$add_lot = include_template('layout_addlot.php', 
								['cats'   => $cats, 
								 'lot'    => $lot,
								 'dict'   => $dict,
								 'errors' => $errors]);
	}
    else {	
	// если ошибок нет, то показываем заполненную форму
	$add_lot = include_template('layout_addlot.php', 
								['cats' => $cats, 
								 'lot'  => $lot]);
					
		// готовим $lot['category'] для безопасного sql-запроса
		$lot_cat = mysqli_real_escape_string($link, $lot['category']);
		

		// получаем id категории нового лота - ту, которую выбрали в форме
	    $sql = "SELECT id FROM cats WHERE category = '$lot_cat'"; 
	    $result = mysqli_query($link, $sql);
	    $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
		foreach($row as $item){
			$cat_id = $item['id'];
		}
		//print('$cat_id:  ' .$cat_id);
		// готовим переменные для безопасного запроса на добавление информации о лоте в БД 
		
					$name = mysqli_real_escape_string($link, $lot['lot-name']);
					$description = mysqli_real_escape_string($link, $lot['message']);
					$cat_id = intval($cat_id);
					$image_url ='img/'.$path;
					$start_price = intval($lot['lot-rate']);
					$end_time = $lot['lot-date']; 
					$rate_step = intval($lot['lot-step']);
					$user_id = $_SESSION['id'];
				   // запрос на добавление лота  в БД - без подготовленных выражений
				   $sql = "INSERT INTO lots (name, description, cat_id, img_url, start_price, end_time, rate_step, user_id) VALUES ('$name', '$description', '$cat_id', '$image_url', '$start_price', '$end_time', '$rate_step', '$user_id')";
				   $result_add = mysqli_query($link, $sql);
				   
				   //проверяем результат запроса на добавление лота в БД
					   if(!$result_add){
					   	$error = mysqli_error($link);
					   	print('Ошибка MySQL: '.$error);
					   }
					   else{
					   	// получаем id добавленного лота
					   	$last_id = (mysqli_insert_id($link));
					   /*print("<pre>");
					    var_dump($last_id);
					    print("</pre>")*/;
					    // перенаправляем пользователя на страницу добавленного лота
					 header("Location: lot.php?id_lot=$last_id");
					    die();
					  
				      }
		
     }//конец else 'если ошибок нет'
 //}

print($add_lot);