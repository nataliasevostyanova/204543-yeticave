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

function endTime(){
      date_default_timezone_set('Europe/Moscow');
      $just_t = date('U');
      $end_tu = strtotime("tomorrow midnight");
      
      $diff_t = $end_tu -$just_t;
      $lost_tH = $diff_t/3600;
      $lost_tHH = floor($lost_tH);
      $lost_tM = floor(($diff_t%3600)/60);
      
      /*print ($lost_tHH.' час. '.$lost_tM.' мин.' );*/
    return ($lost_tHH.' час. '.$lost_tM.' мин.');
    }
      ?>

