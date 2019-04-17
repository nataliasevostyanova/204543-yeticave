<?php
require_once('data.php');
require_once('functions.php');
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?=$page_name;?></title>
    <link href="css/normalize.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
<div class="page-wrapper">
<header class="main-header">
    <div class="main-header__container container">
<!-- Блок с лого, поиском и вводом лота start-->
        <h1 class="visually-hidden">YetiCave</h1>
        <a class="main-header__logo">
            <img src="img/logo.svg" width="160" height="39" alt="Логотип компании YetiCave">
        </a>
        <form class="main-header__search" method="get" action="https://echo.htmlacademy.ru">
            <input type="search" name="search" placeholder="Поиск лота">
            <input class="main-header__search-btn" type="submit" name="find" value="Найти">
        </form>
        <a class="main-header__add-lot button" href="pages/add-lot.html">Добавить лот</a>

<!-- блок входа и регистрации start -->
        <nav class="user-menu">
        <?if($is_auth === 1):?>
            <div class="user-menu__logged">
                <p><?php print($user_name) ?></p>
            </div>
        <?else:?>
            <ul class="user-menu__list">
                <li class="user-menu__item">
                  <a href="#">Регистрация</a>
                </li>
                <li class="user-menu__item">
                  <a href="#">Вход</a>
                </li>
            </ul>
        <?endif?>
        </nav>
<!-- блок входа и регистрации end -->
    </div>
</header>

<!-- блок main + лоты товаров  start -->
<main>
  <!-- вставка контента страницы-->       
  <?=$content;?> 
</main>
</div>

<!-- FOOTER-->
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