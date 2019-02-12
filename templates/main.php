<!-- содержимое тега main-->
    <section class="promo">
        <h2 class="promo__title">Нужен стафф для катки?</h2>
        <p class="promo__text">На нашем интернет-аукционе ты найдёшь самое эксклюзивное сноубордическое и горнолыжное снаряжение.</p>
        <ul class="promo__list">
             <!--заполните этот список из массива категорий-->
         <?php 
     $cats = ["Доски и лыжи", "Крепления", "Ботинки", "Одежда", "Инструменты", "Разное"];
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
        </ul>
    </section>

<!-- лоты объявлений массива $staff  start-->   
    <section class="lots">
        <div class="lots__header">
            <h2>Открытые лоты</h2>
        </div>
        <ul class="lots__list">

<!-- список лотов из массива с товарами-->
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
                   <img src="<?=$item['url_img'];?>" width="350" height="260" alt="">
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
                            12:23
                        </div>
                    </div>
                </div>
            </li>
            <?endforeach;?> 
            
        </ul>
    </section>