<?php

?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>Добавление лота</title>
  <link href="css/normalize.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
</head>
<body>

<div class="page-wrapper">

  <header class="main-header">
  <div class="main-header__container container">
    <h1  class="visually-hidden">YetiCave</h1>
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
    <!-- menu -->
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
<!-- начало формы-->
 <?php $classformname = isset($errors) ? "form--invalid" : "form--add-lot container";?>
 <form class="<?=$classformname;?>" action="add.php" method="post" enctype="multipart/form-data"> <!-- form--invalid -->
    <h2>Добавление лота</h2>
    <div class="form__container-two">
<!--наименование --> 

        <?php $classname = isset($errors['lot-name']) ? "form__item--invalid" : "";
              $value = isset($lot['lot-name']) ? $lot['lot-name'] : "";?>
        
        <div class="form__item <?=$classname;?>"> 
          <label for="lot-name">Наименование</label>
          <input id="lot-name" type="text" name="lot-name" placeholder="Введите наименование лота" value="<?=$value;?>" required>
          <span class="form__error">Введите наименование лота</span> 
        </div>
<!--категория -->
        
        <?php $classname = isset($errors['category']) ?  "form__item--invalid" : "";
              $value = isset($lot['category']) ? $lot['category'] : "Выберите категорию"; ?>
        
        <div class="form__item <?=$classname;?>">
          <label for="category">Категория</label>
          <select id="category" name="category" required>
                <option><?=$value;?></option>
                <option selected disabled>Выберите категорию</option>
                    <?php 
                      $index = 0;
                      $num = count($cats);
                      while($index < $num):?>
                        <option> <?php print($cats[$index]);?></option>
                        <?$index++;?>
                      <?endwhile?>
            </select>
          <span class="form__error">Нужно выбрать категорию</span>
        </div>
    </div>
<!--описание --> 
    <?php $classname = isset($errors['message']) ? "form__item--invalid" : "";
          $value = isset($lot['message']) ? $lot['message'] : "";?>

      <div class="form__item form__item--wide<?=$classname;?>">
       
          <label for="message">Описание</label>
          <textarea class="<?=$classname;?>"  id="message" name="message" placeholder="Напишите описание лота" required><?=$value;?></textarea>
          <span class="form__error">Напишите описание лота</span>
      </div>
<!-- Добавление изображения лота-->
     <div class="form__item form__item--file"> <!-- form__item--uploaded -->
        <label>Изображение</label>
        <div class="preview"> 
          <button class="preview__remove" name="preview_button" type="button">x</button>
          <div class="preview__img">
            <img src="img/avatar.jpg" width="113" height="113" alt="Изображение лота">
          </div>
        </div>
        <div class="form__input-file">
          <input  class="visually-hidden" name ="photo2" type="file" id="photo2" value=""> 
          <label for="photo2">
            <span>+ Добавить</span>
          </label>
        </div> 
    
      <div class="form__container-three"> 
<!--начальная цена -->
        <?php $classname = isset($errors['lot-rate']) ? "form__item--invalid" : "";
              $value = isset($lot['lot-rate']) ? $lot['lot-rate'] : " необходимо ввести ставку";?>
        <div class="form__item form__item--small <?=$classname;?>">
              <label for="lot-rate">Начальная цена</label>
              <input class="<?=$classname;?> id="lot-rate" type="number" name="lot-rate" placeholder="0" value=<?=$value;?> required>
              <span class="form__error">Введите начальную цену</span>
        </div>
<!--шаг ставки -->
        <?php $classname = isset($errors['lot-step']) ? "form__item--invalid" : "";
                 $value = isset($lot['lot-step']) ? $lot['lot-step'] : "";?>

        <div class="form__item form__item--small <?=$classname;?>"> 
           
            <label for="lot-step">Шаг ставки</label>
            <input  id="lot-step" type="number" name="lot-step" placeholder="0" value=<?=$value;?> required>
            <span class="form__error">Введите шаг ставки</span>
        </div>
    <!--дата окончания торгов-->
         <?php $classname = isset($errors['lot-date']) ? "form--invalid" : "";
              $value = isset($lot['lot-date']) ? $lot['lot-date'] : "";?>

        <div class="form__item form--invalid<?=$classname;?>">
          
            <label for="lot-date">Дата окончания торгов</label>
            <input class="form__input-date" id="lot-date" type="date"name="lot-date" value=<?=$value;?> required>
            <span class="<?=$classname;?> form__error">Введите дату завершения торгов</span>
        </div>
      </div>
      <span class="form error form__error--bottom ">Пожалуйста, исправьте ошибки в форме.</span>

<!--submit-->
     <button type="submit" name="send" class="button">Добавить лот</button>
    </form>
  </div>
<!-- конец формы-->
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