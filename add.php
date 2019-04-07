<?php 
require_once ('data.php');
require_once('functions.php');

$add_lot = include_template('layout_addlot.php', ['cats' => $cats]); /*пустая форма*/

if($_SERVER['REQUEST_METHOD'] === 'POST') {
			
				$lot = $_POST;
				/*print('<pre> Что получили из формы:  ');
			    var_dump($_POST);
			    print('</pre>');*/
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

				/*print('<pre> Ошибки заполнения:  ');
			    var_dump($errors);
			    print('</pre>');*/
						
				if(count($errors)){
						$add_lot = include_template('layout_addlot.php', ['cats' => $cats, 'lot' => $lot,'dict' => $dict,'errors' => $errors,]);/*показываем form--invalid и ошибки, если есть*/
					   }
				else {	

		                $add_lot = include_template('layout_addlot.php', ['cats' => $cats, 'lot' => $lot]);

				/*здесь д.б. запрос на добавление лота в БД и редирект на страницу лота*/
					  
					  /* 	$sql = 'SELECT id FROM cats WHERE category = $lot['category']';
					   	$result = mysqli_query($link, $sql);
				        $cat_id = $result;
				        			   	
					   	$sql = 'INSERT INTO lots (name, description, img_url, cat_id, start_price, rate_step, user_id) VALUES ($lot['lot_name'], $lot['discription'], $img_url, '$cat_id', $lot['lot-rate'], $lot['lot-step', '4']';*/
					   	
					   	/*$sql = 'SELECT id_lot FROM `lots` ORDER BY id_lot DESC LIMIT 1';
							   	$result = mysqli_query($link, $sql);
						        $id_lot = $result;
						 header('Location: http://localhost/204543-yeticave/lot.php?id_lot=$id_lot;');*/

				 }
}
			
//endif получен $_POST
/*else{
	$add_lot = include_template('add_lot.php', ['cats' => $cats? $classformname = "form form--add-lot container"]); пустая форма
}*/	 
print($add_lot); 
?>