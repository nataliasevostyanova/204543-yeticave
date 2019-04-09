<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Полезные функции</title>
</head>
<body>
<?php
$link = mysqli_init();
mysqli_options($link, MYSQLI_OPT_INT_AND_FLOAT_NATIVE, 1);
mysqli_real_connect($link, "localhost", "root", "", "Yeticave_pro");
mysqli_set_charset($link, "utf8");
/*проверка соединения с БД*/

if ($link == false) {
print("Ошибка подключения: " . mysqli_connect_error());
}
else {
print("Соединение установлено;");
}

function db_get_prepare_stmt($link, $sql, $data = []) {
    $stmt = mysqli_prepare($link, $sql);

    if ($data) {
        $types = '';
        $stmt_data = [];

        foreach ($data as $value) {
            $type = null;

            if (is_int($value)) {
                $type = 'i';
            }
            else if (is_string($value)) {
                $type = 's';
            }
            else if (is_double($value)) {
                $type = 'd';
            }

            if ($type) {
                $types .= $type;
                $stmt_data[] = $value;
            }
        }

        $values = array_merge([$stmt, $types], $stmt_data);

        $func = 'mysqli_stmt_bind_param';
        $func(...$values);
    }

    return $stmt;
}
/** функция получения записей из БД 
 * возвращает данные запросы в виде ассоц.массива
 */
function db_fetch_data($link, $sql, $data = []) {

    $result = [];
    $stmt = db_get_prepare_stmt($link, $sql, $data);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);

    if($res) {
       $result = mysqli_fetch_all($res, MYSQLI_ASSOC);
    }
    return $result;
} 

/**функция добавления новой записи в БД
  *вносит данные в БД
  *возвращает id внесенной записи
*/
function db_insert_data($link, $sql, $data = []) {

    $stmt = db_get_prepare_stmt($link, $sql, $data);
    $result = mysqli_stmt_execute($stmt);

    if($result){
       $result = mysqli_insert_id($link);
    }
    return $result;
}


$sql = "INSERT INTO users (user_name, email, password, contact) VALUES (?, ?, ?, ?)";
$data = ['user_name' =>'Alison', 'email' =>'ali@ml.ru', 'password' =>'asd78_596', 'contact' =>'78121112233'];
$result = db_insert_data($link, $sql, $data);
    if($result){
    	$last_id = mysqli_insert_id($link);
    }
    print($last_id);
/*$sql = "SELECT id FROM users ORDER BY id DESC LIMIT 1";

$user_id = mysqli_query($link, $sql);
var_dump($user_id); */

?>
</body>
</html>