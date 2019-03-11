<?php
require_once('functions.php');
?>

<section class="promo">
  <h2 class="promo__title">Нужен стафф для катки?</h2>
  <p class="promo__text">На нашем интернет-аукционе ты найдёшь самое эксклюзивное сноубордическое и горнолыжное снаряжение.</p>
  
  <ul class="promo__list"> <!-- список из массива категорий - верхнее меню -->
    <?php               
      $index = 0;
      $num = count($cats);

         while($index < $num): ?>
            <li class="promo__item promo__item--boards">
                <a class="promo__link" href="pages/all-lots.html">
                  <?=print($cats[$index]);?>
                </a>
                <?php $index++; ?></li>
         <?endwhile?>
   </ul>
 </section>


<!-- лоты объявлений массива $staff  start-->   
 <section class="lots">
    <div class="lots__header">
            <h2>Открытые лоты</h2>

    </div>
    <ul class="lots__list"> <!-- список лотов из массива $staff-->
   <?php 
      foreach($staff as $key => $item):?>
        <li class="lots__item lot">
           <div class="lot__image">
              <img src="<?=$item['img_url'];?>" width="350" height="260" alt="<?=filt_data($item['name'])?>">
           </div>
           <div class="lot__info">
                  <span class="lot__category"><?=$item['category'];?></span>
                  <h3 class="lot__title"><a class="text-link" href="http://localhost/204543-yeticave/lot.php?id_lot=<?=$item['id_lot'];?>"><?=filt_data($item['name']);?></a></h3>
                  <div class="lot__state">
                      <div class="lot__rate">
                          <span class="lot__amount">Стартовая цена</span>
                          <span class="lot__cost"><?=formatPrice(filt_data($item['start_price']));?>
                       </div>
                      <div class="lot__timer timer">
                         <?=endTime();?>
                     </div>
                  </div>
          </div>
      </li>
        <?endforeach;?> 
  </ul>
</section>


