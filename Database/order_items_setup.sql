CREATE TABLE IF NOT EXISTS `order_items`(
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `product_id` INT NOT NULL,
    `product_price` DECIMAL(12, 2) NOT NULL,
    `product_quantity` INT NOT NULL,
    `order_id` INT NOT NULL,
    FOREIGN KEY (`order_id`) REFERENCES `orders`(`id`) ON DELETE CASCADE
);