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

    /*print('<pre> Про изображение:  ');
	var_dump($_FILES);
	print('</pre>');*/
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
			        	$user_data['avatar_url'] = 'img/'.$path;
			        }
			      }
	
	else {
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
		$user_name = mysqli_real_escape_string($link, $user_data['name']); // экранируем спецсимволы в user_name
		$user_email;
		$password = password_hash($user_data['password'], PASSWORD_DEFAULT); // хешируем пароль
        $user_contact = mysqli_real_escape_string($link, $user_data['message']); // экранируем спецсимволы в контактной информации
        $avatar_url = $user_data['avatar_url'];  
		

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
        
        
        if(!$result){
		$error = mysqli_error($link);
		print('Ошибка MySQL: '.$error);
		}
		else{ 
        // сообщаем пользователю об успешной регистрации  ---> переделать показ шаблона страницы с сообщение
        /* $add_user = include_template('anons_content.php',[$page_title = 'Успешная регистрация', $header2 = 'Аккаунт зарегистрирован!', $anons_text = 'Ваша регистрация прошла успешно.']);   ПЕРЕДЕЛАТЬ*/
         

        }
 	}

}//end of if($_SERVER[..

print($add_user);