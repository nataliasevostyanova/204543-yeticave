<?php 
session_start();
require_once('data.php');
require_once('functions.php');

if(isset($_GET['search'])){
   $search_word = $_GET['search'];
   //var_dump($search_word);
}
else {
	print('Поисковый запрос не получен');
}

 if(!strlen($search_word)){
  //если поле запроса пустое (состоит из пробелов), показываем страницу с ошибкой
    $search_page = include_template('anons_content.php', [$page_title = 'Ошибка 404', $h2 => 'Ошибка поиска', $anons_text = 'Вы ввели пустой запрос']);
  }
  //если форма запроса не пустая, то 
  else {
  	$search_h2 =  $search_word; 
  // готовим полученное из формы поиска слово к запросу
   $search_word = mysqli_real_escape_string($link, $search_word);
  //собственно запрос на поиск в таблице lots
   $sql = 'SELECT id_lot, creation_date, name, description, img_url, cat_id, start_price, rate_step, user_id, act_price, category FROM lots JOIN cats ON lots.cat_id = cats.id WHERE MATCH(name, description) AGAINST(? IN BOOLEAN MODE)';
   $stmt = mysqli_prepare($link, $sql);
   mysqli_stmt_bind_param($stmt, 's', $search_word);
   mysqli_stmt_execute($stmt);
   $result = mysqli_stmt_get_result($stmt);
   /*$result = mysqli_query($link,$sql);*/
   $lot = mysqli_fetch_all($result, MYSQLI_ASSOC);
   }
                /* print('<pre> Найденные лоты:  ');
				 var_dump($lot);
				 print('</pre>');*/
   

    // если в результате поиска найдены лоты, то
  if(count($lot)){
  	$cur_page = $_GET['page'] ?? 1;
  	$page_items = 3;
    $pages_total = ciel(count($lot)/$page_items);
    $offset = ($cur_page - 1)*$page_items; 

    $pages = range(1, $pages_total);  

    // показываем страницу с найденными лотами
  $search_page = include_template('layout_search.php', ['cats' => $cats, 'search_h2' => $search_h2, 'lot' => $lot]);
  }
  else {
  // если поиск не дал результатов, то показываем ошибку поиска
  $search_page = include_template('anons_content.php',[$page_title = 'Ошибка 404', $h2 = 'Ошибка поиска', $anons_text = 'По вашему запросу ничего не найдено']);
  }
 print($search_page);
