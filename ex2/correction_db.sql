-- Удаление товаров, которые не имеют наличия на складах
DELETE FROM products
WHERE id NOT IN (
    SELECT DISTINCT product_id FROM availabilities
);

-- Удаление складов, на которых нет товаров
DELETE FROM stocks
WHERE id NOT IN (
    SELECT DISTINCT stock_id FROM availabilities
);

-- Удаление записей из availabilities с несуществующими product_id или stock_id
DELETE FROM availabilities
WHERE product_id NOT IN (
    SELECT id FROM products
)
OR stock_id NOT IN (
    SELECT id FROM stocks
);

-- Удаление пустых категорий (групп), в которых нет товаров
DELETE FROM categories
WHERE id NOT IN (
    SELECT DISTINCT category_id FROM products
);

