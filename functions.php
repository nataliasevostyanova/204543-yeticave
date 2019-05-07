<?php 

/* функция - шаблонизатор*/

function include_template($tpl_name, $staff) {
    $tpl_name = 'templates/' . $tpl_name;
    $result = '';

    if (!is_readable($tpl_name)) {
        return $result;
    }
    ob_start();
    extract($staff);

    require $tpl_name;

    $result = ob_get_clean();
    return $result;
}

/* функция формата цены */
 function formatPrice($start_price){

   $res = number_format($start_price, 0, ' ', ' ');
   $price_in_rubl = '&nbsp'.$res.'&nbsp'.'&#8381';
    return($price_in_rubl);
}

/*функция фильтрации данных*/
function filt_data($inpdata) {
    $text = strip_tags($inpdata);
    return $text;

}

/** функция для вычисления времени жизни лота
  * принимает значение даты в формате Y-m-d
  * возвращает число часов и минут 
  */
function endTime(){
   date_default_timezone_set('Europe/Moscow'); 
    
    print('end_time: '.$end_time);
    $end_date = date("d-m-Y H:i:s", strtotime($end_time));
    print('end_date: '.$end_date);
    $just_t = strtotime('now');
    $end_tu = strtotime($end_date);
    
    $diff_t = $end_tu - $just_t;
    $lost_tD = floor($diff_t/86400); // осталось целых суток
    $lost_tH =  floor(($diff_t - $lost_tD*86400)/3600);// осталось целых часов
    $lost_tM = floor(($diff_t - ($lost_tD*86400 + $lost_tH*3600))/60);// осталось целых минут   
    print ('Лот активен: '.$lost_tD.' дней '.$lost_tH.' час. '.$lost_tM.' мин.' );
    }

/** функция для перемещения файла изображения из временной папки в рабочую*/   

function remove_image($path, $tmp_name) {
    // Разберем путь файла на составляющие
    $path = pathinfo($path);

    // Назначаем изображению уникальное имя
    $uniq_path = 'img/' . uniqid() . '.' . $path['extension'];

    // Перемещаем изображение из временной директории
    move_uploaded_file($tmp_name, $uniq_path);

    // Вернем название нового файла, чтобы верно прописать в БД путь к изображению
    return $uniq_path;
}
    
/**
 * Проверяет, что переданная дата соответствует формату ДД.ММ.ГГГГ
 * @param string $date строка с датой
 * @return bool
 */
function check_date_format($date) {
    $result = false;
    $regexp = '/(\d{2})\.(\d{2})\.(\d{4})/m';
    if (preg_match($regexp, $date, $parts) && count($parts) == 4) {
        $result = checkdate($parts[2], $parts[1], $parts[3]);
    }
    return $result;
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


/* функция получения записей из БД 
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

    if($result) {
       $result = mysqli_insert_id($link);
    }
    return $result;
}
?>
