<?php
require_once('functions.php');
?>

    <section class="promo">
        <h2 class="promo__title">Нужен стафф для катки?</h2>
        <p class="promo__text">На нашем интернет-аукционе ты найдёшь самое эксклюзивное сноубордическое и горнолыжное снаряжение.</p>
        <ul class="promo__list">
             <!--список из массива категорий-->
         <?=include('header_menu.php');?>
        </ul>
    </section>

<!-- лоты объявлений массива $staff  start-->   
    <section class="lots">
        <div class="lots__header">
            <h2>Открытые лоты</h2>
        </div>
<!-- список лотов из массива с товарами-->     
     <ul class="lots__list">
 <?php 
    /*if(is_array($staff)){
      print('Да, это массив');
    }
    else {
      $var_tex = gettype($staff);
      print($var_tex);
    }*/        
      
     foreach($staff as $key => $item):?>
        <li class="lots__item lot">
           <div class="lot__image">
                <img src="<?=$item['img_url'];?>" width="350" height="260" alt="">
           </div>
                <div class="lot__info">
                    <span class="lot__category"><?=$item['category'];?></span>
                    <h3 class="lot__title"><a class="text-link" href="pages/lot.html"><?=filt_data($item['name']);?></a></h3>
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