USE Yeticave_pro;

INSERT INTO cats (category) VALUES ('Доски и лыжи', 'Крепления', 'Ботинки','Одежда','Инструменты','Разное');

INSERT INTO users (regist_date,email,user_name,password,contact_phone, avatar_url) VALUES ('NOW','Михаил','mike348@examle.com','4574','+72345678901','img/avatars/mike_thebest.img');
INSERT INTO users (regist_date,email,user_name,password,contact_phone, avatar_url) VALUES ('NOW','Андрей','trav@academy.net','0964','+74251457892','img/avatars/fhg.jpg');

/*внесение информации таблицу лотов*/
INSERT INTO lots (name, description, image_url,cat_id, start_price, end_date, rate_step, user_id, status, act_price) VALUES ('','2014 Rossignol District Snowboard','"At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus','img/lot-1.jpg','1','10999','01.03.2019 00:00:00','100','1','true');
INSERT INTO lots (name, description, image_url,cat_id, start_price, end_date, rate_step, user_id, status, act_price) VALUES ('','DC Ply Mens 2016/2017 Snowboard','Легкий маневренный сноуборд, готовый дать жару в любом парке, растопив снег мощным щелчком и четкими дугами. Стекловолокно Bi-Ax, уложенное в двух направлениях, наделяет этот снаряд отличной гибкостью и отзывчивостью, а симметричная геометрия в сочетании с классическим прогибом кэмбер позволит уверенно держать высокие скорости. А если к концу катального дня сил совсем не останется, просто посмотрите на Вашу доску и улыбнитесь, крутая графика от Шона Кливера еще никого не оставляла равнодушным.','img/lot-2.jpg','1','159999','01.03.2019 00:00:00','100','2','false');
INSERT INTO lots (name, description, image_url,cat_id, start_price, end_date, rate_step, user_id, status, act_price) VALUES ('','Крепления Union Contact Pro 2015 года размер L/XL','Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.','img/lot-3.jpg','2','8000','01.03.2019 00:00:00','100','2','false');
INSERT INTO lots (name, description, image_url,cat_id, start_price, end_date, rate_step, user_id, status, act_price) VALUES ('','Ботинки для сноуборда DC Mutiny Charocal','On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. ','img/lot-4.jpg','3','10999','01.03.2019 00:00:00','100','1','true');
INSERT INTO lots (name, description, image_url,cat_id, start_price, end_date, rate_step, user_id, status, act_price) VALUES ('','Куртка для сноуборда DC Mutiny Charocal','In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.','img/lot-5.jpg','4','7500','01.03.2019 00:00:00','100','2','false');
INSERT INTO lots (name, description, image_url,cat_id, start_price, end_date, rate_step, user_id, status, act_price) VALUES ('','Маска Oakley Canopy','But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful.','img/lot-6.jpg','6','5400','01.03.2019 00:00:00','100','1','true');

/*ставки для объявлений*/
INSERT INTO rates (r_date, user_id,lot_id, rsumm) VALUES ('NOW','1','5','7700');
INSERT INTO rates (r_date, user_id,lot_id, rsumm) VALUES ('NOW','2','5','7900');
INSERT INTO rates (r_date, user_id,lot_id, rsumm) VALUES ('NOW','1','1','11199');
INSERT INTO rates (r_date, user_id,lot_id, rsumm) VALUES ('NOW','2','1','11599');
INSERT INTO rates (r_date, user_id,lot_id, rsumm) VALUES ('NOW','1','2','160399');
INSERT INTO rates (r_date, user_id,lot_id, rsumm) VALUES ('NOW','2','2','160199');
INSERT INTO rates (r_date, user_id,lot_id, rsumm) VALUES ('NOW','1','3','8100');
INSERT INTO rates (r_date, user_id,lot_id, rsumm) VALUES ('NOW','2','3','8200');
INSERT INTO rates (r_date, user_id,lot_id, rsumm) VALUES ('NOW','1','4','11099');
INSERT INTO rates (r_date, user_id,lot_id, rsumm) VALUES ('NOW','2','4','11299');
INSERT INTO rates (r_date, user_id,lot_id, rsumm) VALUES ('NOW','1','6','5600');
INSERT INTO rates (r_date, user_id,lot_id, rsumm) VALUES ('NOW','2','6','5700');

/* получить все категории */
SELECT category FROM cats;

/*получить открытые лоты вместе с названиями категорий*/
SELECT name, start-price, img_url, act_price,cat_id FROM lots l WHERE status = true
JOIN cats c
ON l.cat_id = c.id;

/*показать лот по его id вместе с названием категории*/
SELECT * FROM lots l WHERE id = 4
JOIN cats c
ON l.cat_id = c.id;

/* обновить название лота по его id */
UPDATE lots SET name = 'Куртка мужская QuickSilver' WHERE id = 5;

/* получить список свежих ставок по id лота*/
SELECT * FROM rates WHERE lot_id = 2 ORDER BY r_date
LIMIT 5;