<?php 

/* функция - шаблонизатор*/

function include_template($tpl_name, $data) {
    $tpl_name = 'templates/' . $tpl_name;
    $result = '';

    if (!is_readable($tpl_name)) {
        return $result;
    }

    ob_start();
    extract($data);
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

?>