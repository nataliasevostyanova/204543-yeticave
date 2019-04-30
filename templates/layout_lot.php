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
      <a class="main-header__logo" href="index.php">
        <img src="img/logo.png" width="160" height="39" alt="Логотип компании YetiCave">
      </a>
 <!-- форма поиска -->
      <form class="main-header__search" method="get" action="seach.php">
        <input type="search" name="search" placeholder="Поиск лота">
        <input class="main-header__search-btn" type="submit" name="find" value="Найти">
      </form> 
      <a class="main-header__add-lot button" href="<?=isset($_SESSION['user_name']) ? 'add.php' : "" ?>">Добавить лот</a>
      <?php if($_SESSION['user_name']):?>
       <nav class="user-menu">
        <div class="user-menu__logged">
            <p><?=strip_tags($_SESSION['user_name']);?></p>
            <a href="my_lots.php">Мои ставки</a>
            <a href="logout.php">Выход</a>
        </div>
        <?php else: ?>
         <ul class="user-menu__list">
            <li class="user-menu__item">
                <a href="<?=isset($_SESSION['user_name']) ? "" : 'sign_up.php'?>">Регистрация</a>
            </li>
            <li class="user-menu__item">
                <a href="<?=isset($_SESSION['user_name']) ? "" : 'login.php'?>">Вход</a>
            </li>
        </ul>
        <?php endif; ?>
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






