-- E-Clothing: complete initial schema for Category 1:N Product.
-- Vaííčko imports SQL files from docker/sql on the first initialization of MariaDB.
-- Import order: categories first, then products with the categoryId foreign key.

CREATE TABLE IF NOT EXISTS `categories`
(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(80) NOT NULL,
    `description` TEXT NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `uq_categories_name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `products`
(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `categoryId` INT UNSIGNED NULL,
    `name` VARCHAR(150) NOT NULL,
    `description` TEXT NOT NULL,
    `price` DECIMAL(10, 2) NOT NULL DEFAULT 0.00,
    `size` VARCHAR(10) NOT NULL,
    `color` VARCHAR(40) NOT NULL,
    `stockQuantity` INT UNSIGNED NOT NULL DEFAULT 0,
    PRIMARY KEY (`id`),
    KEY `idx_products_categoryId` (`categoryId`),
    CONSTRAINT `fk_products_category`
        FOREIGN KEY (`categoryId`) REFERENCES `categories` (`id`)
        ON UPDATE CASCADE ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Initial categories.
INSERT INTO `categories` (`name`, `description`) VALUES
    ('Tričká', 'Tričká s krátkym alebo dlhým rukávom.'),
    ('Nohavice', 'Dámske a pánske nohavice.'),
    ('Bundy', 'Bundy a vrchné oblečenie.'),
    ('Mikiny', 'Mikiny a pohodlné vrchné diely.'),
    ('Šaty', 'Šaty na každodenné nosenie aj špeciálne príležitosti.'),
    ('Doplnky', 'Módne doplnky.')
ON DUPLICATE KEY UPDATE `description` = VALUES(`description`);

-- Initial products linked to their categories through categoryId.
INSERT INTO `products` (`categoryId`, `name`, `description`, `price`, `size`, `color`, `stockQuantity`)
SELECT c.`id`, 'Bavlnené tričko', 'Pohodlné tričko zo 100 % bavlny s okrúhlym výstrihom.', 19.90, 'M', 'Čierna', 25
FROM `categories` c
WHERE c.`name` = 'Tričká'
  AND NOT EXISTS (SELECT 1 FROM `products` p WHERE p.`name` = 'Bavlnené tričko' AND p.`size` = 'M' AND p.`color` = 'Čierna');

INSERT INTO `products` (`categoryId`, `name`, `description`, `price`, `size`, `color`, `stockQuantity`)
SELECT c.`id`, 'Dámska mikina', 'Mäkká mikina vhodná na každodenné nosenie.', 34.50, 'L', 'Biela', 12
FROM `categories` c
WHERE c.`name` = 'Mikiny'
  AND NOT EXISTS (SELECT 1 FROM `products` p WHERE p.`name` = 'Dámska mikina' AND p.`size` = 'L' AND p.`color` = 'Biela');

INSERT INTO `products` (`categoryId`, `name`, `description`, `price`, `size`, `color`, `stockQuantity`)
SELECT c.`id`, 'Letné šaty', 'Ľahké letné šaty s pohodlným strihom.', 42.00, 'S', 'Žltá', 8
FROM `categories` c
WHERE c.`name` = 'Šaty'
  AND NOT EXISTS (SELECT 1 FROM `products` p WHERE p.`name` = 'Letné šaty' AND p.`size` = 'S' AND p.`color` = 'Žltá');
