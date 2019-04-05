<?php
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title><?=$title_mp?></title>
  <link href="css/normalize.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
</head>
<body>

<div class="page-wrapper">

  <header class="main-header">
    <div class="main-header__container container">
      <h1 class="visually-hidden">YetiCave</h1>
      <a class="main-header__logo">
        <img src="img/logo.svg" width="160" height="39" alt="Логотип компании YetiCave">
      </a>
      <form class="main-header__search" method="get" action="https://echo.htmlacademy.ru">
        <input type="search" name="search" placeholder="Поиск лота">
        <input class="main-header__search-btn" type="submit" name="find" value="Найти">
      </form>
      <a class="main-header__add-lot button" href="add-lot.html">Добавить лот</a>
      <nav class="user-menu">
        <div class="user-menu__logged">
          <p>Наталия</p>
          <a href="login.html">Выйти</a>
        </div>
      </nav>
    </div>
  </header>

  <main class="container">
    <?=$main_content;?>
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
