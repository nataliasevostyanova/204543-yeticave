<?php
require_once('data.php'); 
require_once('functions.php');
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title><?=$lot_title;?></title>
  <link href="css/normalize.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
</head>
<body>

<div class="page-wrapper">

  <header class="main-header">
    <div class="main-header__container container">
      <h1 class="visually-hidden">YetiCave</h1>
      <a class="main-header__logo" href="index.html">
        <img src="img/logo.svg" width="160" height="39" alt="Логотип компании YetiCave">
      </a>
 <!-- форма поиска + Добавить лот-->
      <form class="main-header__search" method="get" action="https://echo.htmlacademy.ru">
        <input type="search" name="search" placeholder="Поиск лота">
        <input class="main-header__search-btn" type="submit" name="find" value="Найти">
      </form> 
      <a class="main-header__add-lot button" href="add-lot.html">Добавить лот</a>
<!-- вход/регистрация -->
      <nav class="user-menu">
        <ul class="user-menu__list">
          <li class="user-menu__item">
            <a href="sign-up.html">Регистрация</a>
          </li>
          <li class="user-menu__item">
            <a href="login.html">Вход</a>
          </li>
        </ul>
      </nav>
    </div>
  </header>

  <main>
<!-- header menu -->
    <nav class="nav">
      <ul class="nav__list container">
        <li class="nav__item">
          <a href="all-lots.html">Доски и лыжи</a>
        </li>
        <li class="nav__item">
          <a href="all-lots.html">Крепления</a>
        </li>
        <li class="nav__item">
          <a href="all-lots.html">Ботинки</a>
        </li>
        <li class="nav__item">
          <a href="all-lots.html">Одежда</a>
        </li>
        <li class="nav__item">
          <a href="all-lots.html">Инструменты</a>
        </li>
        <li class="nav__item">
          <a href="all-lots.html">Разное</a>
        </li>
      </ul>
    </nav>
<!-- контейнер лота -->
      <section class="lot-item container">
    <?=$lot_info;?> <!-- вставка информации о лоте -->
      </section> 
  </main>

</div>

<footer class="main-footer">
  <!-- bottom menu -->
    <nav class="nav">
      <ul class="nav__list container">
      <?php               
      $index = 0;
      $num = count($cats);

         while($index < $num): ?>
            <li class="promo__item promo__item--boards">
                <a class="promo__link" href="pages/all-lots.html">
                  <?=$cats[$index];?>
                </a>
                <?php $index++; ?></li>
         <?endwhile?>

      </ul>
    </nav>
    <div class="main-footer__bottom container">
      <?php require_once('footer_bottom.php'); ?>
    </div>
</footer>

</body>
</html>






