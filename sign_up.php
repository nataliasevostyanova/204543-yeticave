<?php 
  require_once('data.php');
  require_once('functions.php');

//загружаем пустую форму для регистрации  пользователя
  $add_user = include_template('layout_signup.php', ['cats' => $cats]); 

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

    // проверяем имя пользователя на уникальность
    if(!isset($user_data['name'])){
       print('Введите имя пользователя');
       $errors['name'] = 'Введите имя пользователя';
    	}
    	else{
    	// Если имя пользователя получено, подготовим его для запроса
    	$user_name = mysqli_real_escape_string($link, $user_data['name']); 
    	// запрос в БД: есть  ли уже в таблице users такое же имя пользователя
    	/*$sql = 'SELECT name FROM users WHERE name = ?';
    	$stmt = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($stmt, 's', $user_name);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $result = mysqli_fetch_row($result);*/

        $sql = 'SELECT name FROM users WHERE name = $user_name';
        $result = mysqli_query($link, $sql);

            if($result === $user_name){
            	print('Это имя уже занято');
            	$errors['name'] = 'Это имя уже занято';
            }
        }// end проверки unique user_name

    // проверяем формат полученного email: 
    if(!filter_var($user_data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Введите корректный e-mail';
    } 
    else {
        //если email похож на email, экранируем из введенного email спецсимволы
        $user_email = mysqli_real_escape_string($link, $user_data['email']);
        
        // готовим запрос: существует ли уже такой email в таблице users
        $sql = 'SELECT email FROM users WHERE email = ? ';
        $stmt = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($stmt, 's', $user_email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $result = mysqli_fetch_row($result);

        // проверяем результат запроса
        if($result) {
            $errors['email'] = 'Аккаунт с таким email-адресом уже существует';
        }
    }//end проверки email

    //проверяем результат загрузки изображения аватарки
	if($_FILES['photo2']['name']) {
	        $tmp_name = $_FILES['photo2']['tmp_name'];
	        $path = $_FILES['photo2']['name'];

	        $finfo = finfo_open(FILEINFO_MIME_TYPE);
	        $file_type = finfo_file($finfo, $file_name);

	        if($file_type !== "image/jpeg" && $file_type !== "image/png"){
	        	$errors['image'] = 'Загрузите изображение в формате jpeg или png';
	        }
	        else{
	        	move_uploaded_file($tmp_name, 'img/'.$path);
	        	$user_data['img_url'] = $path;
	        }
	} 
	else {
			print($_FILES['photo2']['error']);
			$errors['image'] = 'Вы не загрузили изображение лота';
	} //end проверки загрузки img 

// если есть ошибки при заполнении формы, показываем шаблон с ошибками
	if($errors){
		$add_user = include_template('layout_signup.php', ['cats' => $cats, 'user_data' => $user_data, 'errors' => $errors]);
		print('<pre> Ошибки заполнения формы регистрации:  ');
		var_dump($errors);
		print('</pre>');
	}
	// если ошибок нет, 
	else {
		// показываем заполненный правильно шаблон
		$add_user = include_template('layout_signup.php', ['cats' => $cats, 'user_data' => $user_data]);
		// готовим данные для запроса на добавление нового пользователя в таблицу users 
		$user_name;
		$user_email;
		$password = password_hash($user_data['password'], PASSWORD_DEFAULT); // хешируем пароль
        $user_contact = mysqli_real_escape_string($link, $user_data['message']); // экранируем спецсимволы в контактной информации
        $avatar_url = $user_data['img_url'];  
		

		$sql = 'INSERT INTO users (
        user_name,
        email,
        password,
        contact,
        avatar_url) 
        VALUES (?, ?, ?, ?, ?);';
    	$stmt = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($stmt, 'sssss', $user_name, $user_email, $password, $user_contact, $avatar_url);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        if($result) {
          // сообщаем пользователю об успешной регистрации
        	header("Location: page/success_reg.html");
        	die();
        }
 	}

}//end of if($_SERVER[..

print($add_user);