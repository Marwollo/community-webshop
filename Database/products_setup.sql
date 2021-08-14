CREATE TABLE IF NOT EXISTS `products`(
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `description` VARCHAR(255) NOT NULL,
    `price` DECIMAL(12, 2) NOT NULL,
    `uploader_id` INT NOT NULL,
    FOREIGN KEY (`uploader_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
);