<?php  
require_once ('data.php');
require_once('functions.php');

?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title><?=$page_title?></title>
  <link href="css/normalize.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
</head>
<body>

<div class="page-wrapper">

  <header class="main-header">
    <div class="main-header__container container">
      <h1 class="visually-hidden">YetiCave</h1>
      <a class="main-header__logo" href="index.php">
        <img src="img/logo.png" width="160" height="39" alt="Логотип компании YetiCave">
      </a>
      <form class="main-header__search" method="get" action="search.php">
        <input type="search" name="search" placeholder="Поиск лота">
        <input class="main-header__search-btn" type="submit" name="find" value="Найти">
      </form>
      <a class="main-header__add-lot button" href="add.php">Добавить лот</a>
      <nav class="user-menu">
        <ul class="user-menu__list">
          <li class="user-menu__item">
            <a href="sign_up.php">Регистрация</a>
          </li>
          <li class="user-menu__item">
            <a href="login.php">Вход</a>
          </li>
        </ul>
      </nav>
    </div>
  </header>

  <main>
    <nav class="nav">
       <ul class="nav__list container">
       <?php require_once('cat_menu.php'); ?>
      </ul>
    </nav>
    <div class="container">
      <section class="lots">
        <h2>Результаты поиска по запросу «<span><?=$search_h2;?></span>»</h2>
        <ul class="lots__list">
     <!--start блок для вывода инфы о лоте -->
          <?php foreach($lot as $lot): ?>
          <li class="lots__item lot">
            <div class="lot__image">
              <img src="<?=$lot['img_url'];?>" width="350" height="260" alt="<?=htmlspecialchars($lot['category']);?>">
            </div>
            <div class="lot__info">
              <span class="lot__category"><?=htmlspecialchars($lot['category']);?></span>
              <h3 class="lot__title"><a class="text-link" href="lot.php?id=<?=$lot['id_lot'];?>"><?=strip_tags($lot['name']);?></a></h3>
              <div class="lot__state">
                <div class="lot__rate">
                  <span class="lot__amount">Стартовая цена</span>
                  <span class="lot__cost"><?=formatPrice($lot['start_price']);?><b class="rub">р</b></span>
                </div>
                <div class="lot__timer timer">
                  <?=endTime();?>
                </div>
              </div>
            </div>
          </li>
          <?endforeach?>
    <!--end блок для вывода инфы о лоте -->
          
        </ul>
      </section>
      <ul class="pagination-list">
        <li class="pagination-item pagination-item-prev"><a>Назад</a></li>
        <li class="pagination-item pagination-item-active"><a>1</a></li>
        <li class="pagination-item"><a href="#">2</a></li>
        <li class="pagination-item"><a href="#">3</a></li>
        <li class="pagination-item"><a href="#">4</a></li>
        <li class="pagination-item pagination-item-next"><a href="#">Вперед</a></li>
      </ul>
    </div>
  </main>

</div>

<footer class="main-footer">
  <!-- bottom menu -->
    <nav class="nav">
      <ul class="nav__list container">
      <?php require_once('cat_menu.php'); ?>
      </ul>
    </nav>
    <div class="main-footer__bottom container">
      <?php require_once('footer_bottom.php'); ?>
    </div>
</footer>

</body>
</html>
