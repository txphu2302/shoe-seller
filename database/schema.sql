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
-- Website Info
('logo', 'default_logo.png'),
('phone', '0123456789'),
('address', '227 Nguyễn Văn Cừ, Phường 4, Quận 5, TP.HCM'),
('company_name', 'ShoeSeller'),
('about_short', 'ShoeSeller - Cửa hàng giày thời trang cao cấp. Chúng tôi cung cấp những mẫu giày mới nhất, chất lượng nhất với giá cả hợp lý.'),
('email', 'info@shoeseller.com'),
('facebook', 'https://facebook.com/shoeseller'),
('instagram', 'https://instagram.com/shoeseller'),
('twitter', ''),

-- Hero Banner Settings
('hero_title', 'Hàng hiệu giá tốt lên đến 50%'),
('hero_subtitle', 'GIÀY ĐẸP GIÁ TỐT'),
('hero_description', 'Khám phá bộ sưu tập giày thời trang mới nhất với giá ưu đãi đặc biệt. Chất lượng cao cấp, phong cách đẳng cấp.'),
('hero_button_text', 'MUA NGAY'),
('hero_button_link', '/products'),
('hero_background', '/public/images/hero-bg.jpg'),

-- Featured Products Settings
('best_sellers_title', 'BÁN CHẠY'),
('best_sellers_count', '8'),
('new_arrivals_title', 'HÀNG MỚI'),
('new_arrivals_count', '4'),

-- About Section
('about_title', 'Về Shoe Seller'),
('about_content', 'Shoe Seller là cửa hàng giày chính hãng với nhiều năm kinh nghiệm trong ngành. Chúng tôi cam kết mang đến cho khách hàng những sản phẩm chất lượng cao nhất với giá cả hợp lý.'),
('about_image', '/public/images/about.jpg'),

-- Brand Names (for marquee)
('brand_name_1', 'Nike'),
('brand_name_2', 'Adidas'),
('brand_name_3', 'Puma'),
('brand_name_4', 'Converse'),
('brand_name_5', 'Vans'),
('brand_name_6', 'New Balance'),
('brand_link_1', '#'),
('brand_link_2', '#'),
('brand_link_3', '#'),
('brand_link_4', '#'),
('brand_link_5', '#'),
('brand_link_6', '#');

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
  `subject` VARCHAR(255),
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

-- Default Admin User (Password is 'password')
INSERT IGNORE INTO `users` (`name`, `email`, `password`, `role`) VALUES
('Administrator', 'admin@shoeseller.com', '$2y$10$0MGhvm.8E8QqIQpFSCa.de3qlnOJWr/z9F6LTFTbfWOZCJ7t6Epqy', 'admin'),
('John Doe', 'john.doe@shoeseller.com', '$2a$12$oK894.lncwdpKw3mUNP9J.hTvD5VForAob3o6G5ONlgzzC1Cq52ha', 'member');
