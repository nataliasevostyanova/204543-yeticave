<?php
$link = mysqli_connect("localhost", "root", "", "Yeticave_pro");
mysqli_set_charset($link, "utf8");
if ($link == false) {
print("Ошибка подключения: " . mysqli_connect_error());
}
/*else {
print("Соединение установлено;");
}*/
