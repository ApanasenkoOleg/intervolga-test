-- Удаление пустых категорий (групп), в которых нет товаров
DELETE FROM `categories`
WHERE `id` NOT IN (
    SELECT DISTINCT `category_id` FROM `products`
);

-- Удаление товаров, которые не имеют наличия на складах
DELETE FROM `products`
WHERE `id` NOT IN (
    SELECT DISTINCT `product_id` FROM `availabilities`
);

-- Удаление складов, на которых нет товаров
DELETE FROM `stocks`
WHERE `id` NOT IN (
    SELECT DISTINCT `stock_id` FROM `availabilities`
);
