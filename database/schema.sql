CREATE DATABASE IF NOT EXISTS `shoe_seller` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `shoe_seller`;

-- Table: users
CREATE TABLE IF NOT EXISTS `users` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `avatar` VARCHAR(255) DEFAULT NULL,
  `role` ENUM('admin', 'member') DEFAULT 'member',
  `status` ENUM('active', 'banned') DEFAULT 'active',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: settings
CREATE TABLE IF NOT EXISTS `settings` (
  `key_name` VARCHAR(50) PRIMARY KEY,
  `key_value` TEXT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert default settings
INSERT IGNORE INTO `settings` (`key_name`, `key_value`) VALUES
('logo', 'default_logo.png'),
('phone', '0123456789'),
('address', 'Ho Chi Minh City, Vietnam'),
('company_name', 'Shoe Seller Inc.'),
('about_short', 'We sell the best shoes in the world.');

-- Table: categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `description` TEXT,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: products
CREATE TABLE IF NOT EXISTS `products` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `category_id` INT NOT NULL,
  `name` VARCHAR(200) NOT NULL,
  `description` TEXT,
  `price` DECIMAL(10,2) NOT NULL,
  `image` VARCHAR(255) DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`category_id`) REFERENCES `categories`(`id`) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: product_attributes (for sizes and stock)
CREATE TABLE IF NOT EXISTS `product_attributes` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `product_id` INT NOT NULL,
  `size` INT NOT NULL,
  `stock` INT DEFAULT 0,
  FOREIGN KEY (`product_id`) REFERENCES `products`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: orders
CREATE TABLE IF NOT EXISTS `orders` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT NOT NULL,
  `total_amount` DECIMAL(10,2) NOT NULL,
  `status` ENUM('pending', 'processing', 'completed', 'cancelled') DEFAULT 'pending',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: order_details
CREATE TABLE IF NOT EXISTS `order_details` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `order_id` INT NOT NULL,
  `product_id` INT NOT NULL,
  `size` INT NOT NULL,
  `quantity` INT NOT NULL,
  `price` DECIMAL(10,2) NOT NULL,
  FOREIGN KEY (`order_id`) REFERENCES `orders`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`product_id`) REFERENCES `products`(`id`) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: contacts
CREATE TABLE IF NOT EXISTS `contacts` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `phone` VARCHAR(20),
  `message` TEXT NOT NULL,
  `status` ENUM('unread', 'read', 'replied') DEFAULT 'unread',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: faqs
CREATE TABLE IF NOT EXISTS `faqs` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `question` TEXT NOT NULL,
  `answer` TEXT NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Default Admin User (Password is 'admin123')
INSERT IGNORE INTO `users` (`name`, `email`, `password`, `role`) VALUES
('Administrator', 'admin@shoeseller.com', '$2y$10$0MGhvm.8E8QqIQpFSCa.de3qlnOJWr/z9F6LTFTbfWOZCJ7t6Epqy', 'admin'),
('John Doe', 'john.doe@shoeseller.com', '$2a$12$oK894.lncwdpKw3mUNP9J.hTvD5VForAob3o6G5ONlgzzC1Cq52ha', 'member');


-- Product data
INSERT IGNORE INTO `categories` (`name`, `description`) VALUES
('Sneakers', 'Comfortable and stylish sneakers for everyday wear.'),
('Boots', 'Durable boots for all weather conditions.'),
('Sandals', 'Lightweight sandals perfect for summer.'),
('Formal Shoes', 'Elegant shoes for special occasions.');

INSERT IGNORE INTO `products` (`category_id`, `name`, `description`, `price`, `image`) VALUES
(1, 'Classic Sneakers', 'Timeless design with superior comfort.', 59.99, 'sneakers1.jpg'),
(1, 'Sporty Sneakers', 'Perfect for workouts and casual outings.', 69.99, 'sneakers2.jpg'),
(2, 'Leather Boots', 'Premium leather boots for durability and style.', 129.99, 'boots1.jpg'),
(2, 'Hiking Boots', 'Rugged boots designed for outdoor adventures.', 149.99, 'boots2.jpg'),
(3, 'Beach Sandals', 'Light and airy sandals for beach days.', 29.99, 'sandals1.jpg'),
(3, 'City Sandals', 'Chic sandals for urban exploration.', 39.99, 'sandals2.jpg'),
(4, 'Oxford Shoes', 'Classic formal shoes for business and events.', 89.99, 'formal1.jpg'),
(4, 'Derby Shoes', 'Versatile formal shoes with a modern twist.', 99.99, 'formal2.jpg');  
