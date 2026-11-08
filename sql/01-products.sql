-- E-Clothing: Product entity for Vaííčko ORM.
-- Docker imports this SQL file automatically on the first database initialization.

CREATE TABLE IF NOT EXISTS `products`
(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(150) NOT NULL,
    `category` VARCHAR(80) NOT NULL,
    `description` TEXT NOT NULL,
    `price` DECIMAL(10, 2) NOT NULL DEFAULT 0.00,
    `size` VARCHAR(10) NOT NULL,
    `color` VARCHAR(40) NOT NULL,
    `stockQuantity` INT UNSIGNED NOT NULL DEFAULT 0,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- A few initial products make the Read/list page immediately demonstrable.
INSERT INTO `products` (`name`, `category`, `description`, `price`, `size`, `color`, `stockQuantity`)
SELECT 'Bavlnené tričko', 'Tričká', 'Pohodlné tričko zo 100 % bavlny s okrúhlym výstrihom.', 19.90, 'M', 'Čierna', 25
WHERE NOT EXISTS (SELECT 1 FROM `products` WHERE `name` = 'Bavlnené tričko' AND `size` = 'M' AND `color` = 'Čierna');

INSERT INTO `products` (`name`, `category`, `description`, `price`, `size`, `color`, `stockQuantity`)
SELECT 'Dámska mikina', 'Mikiny', 'Mäkká mikina vhodná na každodenné nosenie.', 34.50, 'L', 'Biela', 12
WHERE NOT EXISTS (SELECT 1 FROM `products` WHERE `name` = 'Dámska mikina' AND `size` = 'L' AND `color` = 'Biela');

INSERT INTO `products` (`name`, `category`, `description`, `price`, `size`, `color`, `stockQuantity`)
SELECT 'Letné šaty', 'Šaty', 'Ľahké letné šaty s pohodlným strihom.', 42.00, 'S', 'Žltá', 8
WHERE NOT EXISTS (SELECT 1 FROM `products` WHERE `name` = 'Letné šaty' AND `size` = 'S' AND `color` = 'Žltá');
