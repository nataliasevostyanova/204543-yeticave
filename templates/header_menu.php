 
             <!--список из массива категорий-->
         <?php 
    $cats= ["Доски и лыжи", "Крепления", "Ботинки", "Одежда", "Инструменты", "Разное"];
        /*if(is_array($cats)){
        print('Да, это массив');
           }
        else {
            $var_tex = gettype($cats);
            print($var_tex);
          }*/
      
      $index = 0;
      $num = count($cats);

         while($index < $num): ?>
            <li class="promo__item promo__item--boards">
                <a class="promo__link" href="pages/all-lots.html">
                    <?php print($cats[$index]);?>
                </a>
                <?php $index++; ?></li>
         <?endwhile?>
        