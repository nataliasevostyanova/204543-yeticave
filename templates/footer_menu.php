

       <ul class="nav__list container">
          
            <?php
       $cats= ["Доски и лыжи", "Крепления", "Ботинки", "Одежда", "Инструменты", "Разное"];
            $index = 0;
            $num = count($cats);

            while($index < $num): ?>
                <li class="nav__item">
                    <a href="pages/all-lots.html"><?php print($cats[$index]);?>
                    </a>
                <?php $index++; ?>
            <?php endwhile; ?>
                </li>
        </ul> 