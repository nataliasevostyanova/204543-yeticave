<?php 
require_once ('data.php');
require_once('functions.php');

$add_lot = include_template('add_lot.php', ['cats' => $cats, $classformname = "form form--add-lot container"]); /*пустая форма*/

if($_SERVER['REQUEST_METHOD'] === 'POST') {
			
				$lot = $_POST;
				print('<pre>');
			    var_dump($_POST);
			    print('</pre>');
		/*поля, необходимые для заполнения*/
				$required = ['lot_name', 'category', 'description', 'lot-rate', 'lot-step', 'lot-date']; 
		/*заголовки для пользователя*/
				$dict = ['lot_name' => 'Наименование', 'category' => 'Категория' , 'description' =>'Описание', 'lot-rate' => 'Начальная цена', 'lot-step' => 'Шаг ставки', 'lot-date' => 'Дата окончания торгов']; 
		/*массив ошибок*/
				$errors = [];


		/*проверка - заполнены ли поля*/
			foreach($required as $key){
				if(empty($_POST[$key])){
					$errors[$key] = 'Это поле нужно заполнить';
				}
			}
				
			/*проверка типа полей массива */
			foreach($lot as $key => $value){
			
					if($key == 'lot_name'){
						if(!isset($lot['lot_name']) && gettype($value) !== string){
							$error = $dict['lot_name']. 'должно быть корректным';
						}
						else {$value =$lot['lot_name'];}
					}					
					if($key == 'category'){
						if(!isset($value)){
							$error = $dict['category']. 'не выбрана';
						}
						else {$value =$lot['category'];}
					}
					if($key == 'description'){
						if(!isset($value) && gettype($value) !== string){
							$error = $dict['description']. 'должно быть корректным';
						}
						else {$value =$lot['description'];}
					}

					if($key == 'lot-rate'){
						if(!isset($value) && gettype($value) !== integer){
							$error = $dict['lot-rate']. 'должна быть целым числом';
						}
						else {$value =$lot['lot-rate'];}
					}
					if($key == 'lot-step'){
						if(!isset($value) && gettype($value) !== integer){
							$error = $dict['lot-step']. 'должен быть целым числом';
						}
						else {$value =$lot['lot-step'];}
					}
					
					if($key == 'lot-step'){
						if(check_date_format($value)){
							$error = $dict['lot-date']. 'должны быть в формате дд.мм.гггг';
						}
						else {$value =$lot['lot-date'];}
					} // end проверки полей
				}//endforeach	
						
				if(count($errors)){
						$add_lot = include_template('add_lot.php', ['cats' => $cats, 'errors' => $errors, 'dict' => $dict, $classformname = "form--invalid"]);/*показываем form--invalid и ошибки, если есть*/
					   }
				else {	/*здесь запрос на добавления лота в БД и редирект на страницу лота*/

		                $add_lot = include_template('add_lot.php', ['cats' => $cats, 'lot' => $lot, $classformname = "form form--add-lot container"]);
					   	$sql = "SELECT id FROM cats WHERE category = $lot['category']";
					   	$result = mysqli_query($link, $sql);
				        $cat_id = $result;
				        			   	
					   	$sql = "INSERT INTO lots (name, description, img_url, cat_id, start_price, rate_step, user_id) VALUES ($lot['lot_name'], $lot['discription'], $img_url, '$cat_id', $lot['lot-rate'], $lot['lot-step', '4']";*/
					   	
					   	$sql = "SELECT id_lot FROM `lots` ORDER BY id_lot DESC LIMIT 1";
							   	$result = mysqli_query($link, $sql);
						        $id_lot = $result;
						 header('Location: http://localhost/204543-yeticave/lot.php?id_lot=$id_lot;');

				 }
}
			
//endif получен $_POST
else{
	$add_lot = include_template('add_lot.php', ['cats' => $cats, $classformname = "form form--add-lot container"]); /*пустая форма*/
}		 
print($add_lot); 
?>