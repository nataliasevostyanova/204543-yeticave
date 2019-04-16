<?php

/*$link = mysqli_init();
mysqli_options($link, MYSQLI_OPT_INT_AND_FLOAT_NATIVE, 1);
mysqli_real_connect($link, "localhost", "root", "", "Yeticave_pro");
mysqli_set_charset($link, "utf8");*/


$link = mysqli_connect("localhost", "root", "", "Yeticave_pro");
mysqli_set_charset($link, "utf8");

/*проверка соединения с БД*/
/*if ($link == false) {
print("Ошибка подключения: " . mysqli_connect_error());
}
else {
print("Соединение установлено;");
}*/

?>