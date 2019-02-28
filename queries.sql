USE Yeticave_pro;

INSERT INTO cats (category) VALUES ('Доски и лыжи');
INSERT INTO cats (category) VALUES ('Крепления'); 
INSERT INTO cats (category) VALUES ('Ботинки');
INSERT INTO cats (category) VALUES ('Одежда');
INSERT INTO cats (category) VALUES ('Инструменты');
INSERT INTO cats (category) VALUES ('Разное');

INSERT INTO users (user_name, email, password, contact, avatar_url) VALUES ('Михаил','mike348@examle.com','4574','+72345678901','img/avatars/mike_thebest.img')
INSERT INTO users (user_name, email, password, contact, avatar_url) VALUES ('Андрей','trav@academy.net','0964','+74251457892','img/avatars/fhg.jpg');
INSERT INTO users (user_name, email, password, contact, avatar_url) VALUES ('Svetik','svet@academy.net','adac098','+762378945612','img/avatars/pretty.jpg')

/*внесение информации таблицу лотов*/
INSERT INTO lots (name, description, image_url,cat_id, start_price, rate_step, user_id) VALUES ('2014 Rossignol District Snowboard','At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident','img/lot-1.jpg','1','10999','100','1')
INSERT INTO lots (name, description, image_url,cat_id, start_price, rate_step, user_id) VALUES ('DC Ply Mens 2016/2017 Snowboard','Легкий маневренный сноуборд, готовый дать жару в любом парке, растопив снег мощным щелчком и четкими дугами. Стекловолокно Bi-Ax, уложенное в двух направлениях, наделяет этот снаряд отличной гибкостью и отзывчивостью.','img/lot-2.jpg','1','159999','100','2')
INSERT INTO lots (name, description, image_url,cat_id, start_price, rate_step, user_id) VALUES ('Крепления Union Contact Pro 2015 года размер L/XL','Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae.','img/lot-3.jpg','2','8000','100','2');
INSERT INTO lots (name, description, image_url,cat_id, start_price, rate_step, user_id) VALUES ('Ботинки для сноуборда DC Mutiny Charocal','On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire.','img/lot-4.jpg','3','10999','100','1');
INSERT INTO lots (name,description, image_url,cat_id, start_price, rate_step, user_id) VALUES ('Куртка для сноуборда DC Mutiny Charocal','In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed.','img/lot-5.jpg','4','7500','100','3');
INSERT INTO lots (name, description, image_url,cat_id, start_price, rate_step, user_id)VALUES ('Маска Oakley Canopy','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system.','img/lot-6.jpg','6','5400','100','1');

/*ставки для объявлений*/
INSERT INTO rates (user_id,lot_id, r_summ) VALUES (,'1','5','7700');
INSERT INTO rates (user_id,lot_id, r_summ) VALUES ('2','5','7900')
INSERT INTO rates (user_id,lot_id, r_summ) VALUES ('1','1','11199');
INSERT INTO rates (user_id,lot_id, r_summ) VALUES ('2','1','11599');
INSERT INTO rates (user_id,lot_id, r_summ) VALUES ('1','2','160399');
INSERT INTO rates (user_id,lot_id, r_summ) VALUES ('2','2','160199');
INSERT INTO rates (user_id,lot_id, r_summ) VALUES ('1','3','8100');
INSERT INTO rates (user_id,lot_id, r_summ) VALUES ('2','3','8200');
INSERT INTO rates (user_id,lot_id, r_summ) VALUES ('1','4','11099');
INSERT INTO rates (user_id,lot_id, r_summ) VALUES ('2','4','11299');
INSERT INTO rates (user_id,lot_id, r_summ) VALUES ('1','6','5600');
INSERT INTO rates (user_id,lot_id, r_summ) VALUES ('2','6','5700');

/* получить все категории */
SELECT category FROM cats;

/*получить открытые лоты вместе с названиями категорий - работает*/
SELECT name, description, start-price, cat_id FROM lots l 
JOIN cats c
ON l.cat_id = c.id;

/*показать лот по его id вместе с названием категории - не работает с JOIN*/
SELECT * FROM lots l WHERE id = 3
JOIN cats c
ON l.cat_id = c.id;

/* обновить название лота по его id -  работает*/
UPDATE lots SET name = 'Куртка мужская QuickSilver' WHERE id = 5;

/* получить список свежих ставок по id лота - работает* /
SELECT * FROM rates WHERE lot_id = 2 ORDER BY r_date
LIMIT 5;