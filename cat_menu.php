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