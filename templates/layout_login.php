<?php 
require_once ('data.php');
require_once('functions.php');
?>


<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>Вход</title>
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
      <form class="main-header__search" method="get" action="https://echo.htmlacademy.ru">
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
    <nav class="nav">
      <ul class="nav__list container">
        <?php require_once('cat_menu.php'); ?>
      </ul>
      </ul>
    </nav>
  <!-- форма регистрации -->
    <form class="form container <?=$errors ? 'form--invalid' : "" ?>" action="login.php" method="post"> <!-- form--invalid -->
      <h2>Вход</h2>
      <!-- email -->
      <div class="form__item <?=$errors['email'] ? 'form__item--invalid' : "" ?>" > <!-- form__item--invalid -->
        <label for="email">E-mail*</label>
        <input id="email" type="text" name="email" placeholder="Введите e-mail" value="<?=$email;?>"required>
        <?php if(isset($errors['email'])): ?>
        <span class="form__error"><?=$errors['email'];?></span>
        <?php endif; ?>
      </div>
       <!-- пароль -->
      <div class="form__item form__item--last <?=$errors['password'] ? 'form__item--invalid' : "" ?>">
        <label for="password">Пароль*</label>
        <input id="password" type="text" name="password" placeholder="Введите пароль" value ="<?= $value = isset($login['password']) ? '**********' : "";?>" required>
        <?php if(isset($errors['password'])): ?>
        <span class="form__error"><?=$errors['password'];?></span>
        <?php endif; ?>
      </div>
      <button type="submit" class="button">Войти</button>
    </form>
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