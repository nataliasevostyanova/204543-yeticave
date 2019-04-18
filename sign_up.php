<?php 
  require_once('data.php');
  require_once('functions.php');

if($_SERVER['REQUEST_METHOD'] === 'POST'){
	// массив данных пользователя, полученных при регистрации из формы
    $user_data = $_POST;

    print('<pre> Что получили из формы:  ');
	var_dump($_POST);
	print('</pre>');

    // массив с сообщениями об ошибках проверки
    $errors = [];
    // массив с именами обязательных полей
    $required_reg = ['email', 'password', 'name', 'message'];

    // проверка - заполнены ли поля required
    foreach($required_reg as $key) {
        if(empty($user_data[$key])) {
            $errors[$key] = 'Это поле нужно заполнить';
        }
    }

// валидация заполненных полей
    // проверяем формат полученного email: 
    if(!filter_var($user_data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Введите корректный e-mail';
    } 
    else {
        //если email похож на email, экранируем из введенного email спецсимволы
        $user_data['email'] = mysqli_real_escape_string($con, $user_data['email']);
        
        // готовим запрос существует ли уже такой email в таблице users
        $sql = 'SELECT email FROM users WHERE email = ?;'
        $stmt = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($stmt, 's', $user_data['email']);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $result = mysqli_fetch_row($result);

        // проверяем результат запроса
        if($result) {
            $errors['email'] = 'Аккаунт с таким email-адресом уже существует';
        }
    }

       //проверяем результат загрузки изображения аватарки
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


}//end of if($_SERVER[..

	

