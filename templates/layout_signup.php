<?php  
require_once ('data.php');
require_once('functions.php');

?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>Регистрация</title>
  <link href="../css/normalize.min.css" rel="stylesheet">
  <link href="../css/style.css" rel="stylesheet">
</head>
<body>

<div class="page-wrapper">

  <header class="main-header">
    <div class="main-header__container container">
      <h1 class="visually-hidden">YetiCave</h1>
      <a class="main-header__logo" href="index.html">
        <img src="img/logo.svg" width="160" height="39" alt="Логотип компании YetiCave">
      </a>
      <form class="main-header__search" method="get" action="https://echo.htmlacademy.ru">
        <input type="search" name="search" placeholder="Поиск лота">
        <input class="main-header__search-btn" type="submit" name="find" value="Найти">
      </form>
      <a class="main-header__add-lot button" href="add-lot.html">Добавить лот</a>
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
    <nav class="nav">
      <ul class="nav__list container">
       <?php require_once('cat_menu.php'); ?>
      </ul>
    </nav>
    <form class="form container" action="sign_up.php" method="post" enctype="multipart/form-data"> <!-- form--invalid -->
      <h2>Регистрация нового аккаунта</h2>
      <div class="form__item <?=isset($errors)? 'form__item--invalid' : "";?>"> <!-- form__item--invalid -->
    //e-mail name="email"
        <label for="email">E-mail*</label>
        <input id="email" type="text" name="email" placeholder="Введите e-mail" required>
        <span class="form__error">Введите e-mail</span>
      </div>
    // пароль  name="password"
      <div class="form__item">
        <label for="password">Пароль*</label>
        <input id="password" type="text" name="password" placeholder="Введите пароль" required>
        <span class="form__error">Введите пароль</span>
      </div>
    // имя пользователя name="name"
      <div class="form__item">
        <label for="name">Имя*</label>
        <input id="name" type="text" name="name" placeholder="Введите имя" required>
        <span class="form__error">Введите имя</span>
      </div>
    // контактные данные name="message"
      <div class="form__item">
        <label for="message">Контактные данные*</label>
        <textarea id="message" name="message" placeholder="Напишите как с вами связаться" required></textarea>
        <span class="form__error">Напишите как с вами связаться</span>
      </div>
    // добавление аватарки name="photo2"
      <div class="form__item form__item--file form__item--last">
        <label>Аватар</label>
        <div class="preview">
          <button class="preview__remove" type="button">x</button>
          <div class="preview__img">
            <img src="img/avatar.jpg" width="113" height="113" alt="Ваш аватар">
          </div>
        </div>
        <div class="form__input-file">
          <input class="visually-hidden" type="file" name="photo2" id="photo2" value="">
          <label for="photo2">
            <span>+ Добавить</span>
          </label>
        </div>х
      </div>
    // сообщение об ошибка
      <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
      <button type="submit" class="button">Зарегистрироваться</button>
      <a class="text-link" href="#">Уже есть аккаунт</a>
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