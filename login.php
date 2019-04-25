<?php
session_start();
require_once('data.php');
require_once('functions.php');
  
  //загружаем пустую форму для регистрации  пользователя
  $auth_page = include_template('layout_login.php', ['cats' => $cats]); 

if($_SERVER['REQUEST_METHOD'] === 'POST'){
	// данные пользователя, полученные при заполненени формы входа пишем в массив $login
   print('<pre> Что получили из формы:  ');
	 var_dump($_POST);
	 print('</pre>');
	 $login = $_POST;
    // массив с сообщениями об ошибках проверки
    $errors = [];
    // массив с именами обязательных полей
    $required_auth = ['email', 'password'];

    // проверка - заполнены ли поля required
    foreach($required_auth as $key) {
        if(empty($login[$key])) {
            $errors[$key] = 'Это поле нужно заполнить';
        }
    }
   // Проверка данных пользователя при входе 
    //Валидация email
    if(!filter_var($login['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Введен некорректный e-mail';
        //print($errors['email']);
    } 
    //Если email введен и в правильном формате, проверим, есть ли он в базе:
    else { 
        $email = mysqli_real_escape_string($link, $login['email']);
        // готовим запрос: существует ли уже такой email в таблице users 
        //и заодно запросим имя пользователя user_name
        $sql = 'SELECT * FROM users WHERE email = ? ';
        $stmt = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($stmt, 's', $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $result = mysqli_fetch_all($result, MYSQLI_ASSOC);

        foreach ($result as $key => $value){
		$res[] = $result;
		}
 		 print('<pre> Что получили из запроса к табл. users:  ');
		 var_dump($res);
		 print('</pre>');

        if(!$res) {
          $errors['email'] = 'Аккаунт с таким email не зарегистрирован.';
          //print($errors['email']);
        }
        else {
        // если email найден в БД, записываем имя пользователя и проверяем пароль
          $user_name = $res['user_name'];
         // var_dump($res['user_name']);
         
          //хешируем пароль, полученный из формы входа 
          /*$pass_hash = password_hash($login['password'], PASSWORD_DEFAULT);
                 /*print('<pre> хеш пароля из базы: ');
                 var_dump($pass_hash);
				 print('</pre>');*/
         
          //сравниваем пароль, введенный в форму входа, с хешем пароля, полученным  из users
			if(!password_verify($login['password'], $res['password'])){
	        $errors['password'] = 'Вы ввели неверный пароль';
	 			/* print('<pre> Ошибки входа:  ');
				 var_dump($errors);
				 print('</pre>');*/
	      //показываем страницу входа с ошибками заполнения 
	        $auth_page = include_template('layout_login.php', ['cats' => $cats,'errors' => $errors]);	
	            }	          
	      //если хеши введенного пароля и пароля из базы совпали
	        else {
	           	//записываем в $_SESSION имя и email пользователя
	            
	         	/*$_SESSION['user_name'] = $user_name;
	            $_SESSION['email'] = $login['email'];
	             header('Location: pages/success_reg.html');*/
	            print('Успешный вход!');	           
               }
       } 
   }    
}// end if($_SERVER['REQUEST_...*/
print($auth_page);
