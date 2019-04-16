<?php 
require_once ('data.php');
require_once('functions.php');

    $add_lot = include_template('layout_addlot.php', ['cats' => $cats]); /*пустая форма*/


    if($_SERVER['REQUEST_METHOD'] === 'POST'){
			
    $lot = $_POST;
		print('<pre> Что получили из формы:  ');
		var_dump($_POST);
		print('</pre>');
	/*поля, необходимые для заполнения*/
	$required = ['lot-name', 'category', 'message', 'lot-rate', 'lot-step', 'lot-date']; 
	/*заголовки для вывода ошибок пользователю*/
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
		}//end foreach
            print('Что приходит в массиве $_FILES: ');
			var_dump($_FILES['image']['name']);
			var_dump($_FILES['image']['tmp_name']);
			    
			    // проверка данных о загружаемом файле изображения
			    if($_FILES['image']['name']) {
			        $tmp_name = $_FILES['image']['tmp_name'];
			        $path = $_FILES['image']['name'];

			        $finfo = finfo_open(FILEINFO_MIME_TYPE);
			        $file_type = finfo_file($finfo, $file_name);

			        if($file_type !== "image/jpeg" || "image/png"){
			        	$errors['image'] = 'Загрузите изображение в формате jpeg или png';
			        }
			        else{
			        	move_uploaded_file($tmp_name, 'img/'.$path);
			        	$lot['image'] = $path;
			        }
			    } 
			    else {
			    	print($_FILES['image']['error']);
			        $errors['image'] = 'Вы не загрузили изображение лота';
				} 
			    	
			    	print('<pre> Ошибки заполнения:  ');
					 var_dump($errors);
					print('</pre>');
							
				 if(count($errors)){
				    // если есть ошибки заполнения формы, то показываем форму с ошибками
					$add_lot = include_template('layout_addlot.php', ['cats' => $cats, 'lot' => $lot,'dict' => $dict,'errors' => $errors,]);
					}
				 else {	
			       // если ошибок нет, то показываем заполненную форму
			         $add_lot = include_template('layout_addlot.php', ['cats' => $cats, 'lot' => $lot]);
					
					// готовим $lot['category'] для безопасного sql-запроса
					$lot_cat = mysqli_real_escape_string($link, $lot['category']);
					print('Категория:   '.$lot_cat.'   ');

					// получаем id категории нового лота - ту, которую выбрали в форме
				    $sql = "SELECT id FROM cats WHERE category = '$lot_cat'"; 
				    $result = mysqli_query($link, $sql);
				    $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
					foreach($row as $item){
						$cat_id = $item['id'];
					}
					
					// готовим переменные для безопасного запроса на добавление информации о лоте в БД 
					$name = mysqli_real_escape_string($link, $lot['lot-name']);
					var_dump($name);
					$description = mysqli_real_escape_string($link, $lot['message']);
					var_dump($description);
					$cat_id;
					var_dump($cat_id);
					$image_url = $path;
					$start_price = intval($lot['lot-rate']);
					var_dump($start_price);
					$rate_step = intval($lot['lot-step']);
					var_dump($rate_step);
					$user_id = '5';

				   // запрос на добавление лота  в БД - без подготовленных выражений
				   $sql = "INSERT INTO lots (name, description, cat_id, img_url, start_price, rate_step, user_id) VALUES ('$name', '$description', '$image', $cat_id', '$start_price', '$rate_step', '$user_id')";
				   $result_add = mysqli_query($link, $sql);
				   
				   //проверяем результат запроса на добавление лота в БД
					   if(!$result_add){
					   	$error = mysqli_error($link);
					   	print('Ошибка MySQL: '.$error);
					   }
					   else{
					   	// получаем id добавленного лота
					   	$last_lotid = mysqli_insert_id($link);
					    print('id оследней записи  лота: '.$last_lotid);
					    // перенаправляем пользователя на страницу добавленного лота
					   	header('Location: lot.php?id_lot=. $last_lotid;');
					    die();
				       }
			     }//конец else 'если ошибок нет'
   
    print($add_lot); 
}

?>

