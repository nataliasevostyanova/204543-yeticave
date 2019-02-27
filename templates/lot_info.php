<?php

require_once('data.php');
require_once('functions.php');
?>

<?php 

if(isset($l_inf)){
  $lot_name = $l_inf['name'];
  $lot_imgurl = $l_inf['img_url'];
  $lot_category = $l_inf['category'];
  $lot_description = $l_inf['description'];
  $lot_start_price = $l_inf['start_price'];
  }
else {
  print('No data for lot');
  }
?>

<h2><?=filt_data($lot_name);?></h2> <!--имя лота-->
      <div class="lot-item__content">
        <div class="lot-item__left">
          <div class="lot-item__image">
            <img src="<?=$lot_imgurl;?>" width="730" height="548" alt="">
          </div>
          <p class="lot-item__category">Категория: <span><?=$lot_category;?></span></p>
          <p class="lot-item__description"><?=filt_data($lot_description);?></p>
        </div>
        <div class="lot-item__right">
          <div class="lot-item__state">
            <div class="lot-item__timer timer">
             <?=endTime();?>
            </div>
            <div class="lot-item__cost-state">
              <div class="lot-item__rate">
                <span class="lot-item__amount">Текущая цена</span>
 
                <span class="lot-item__cost"><?=formatPrice(filt_data($lot_start_price));?></span>
              </div>
              <div class="lot-item__min-cost">
                Мин. ставка <span>12 000 р</span>
              </div>
            </div>
              <!-- форма для создания ставки -->
          </div>
              <!-- история ставок -->
        </div>
      </div>
