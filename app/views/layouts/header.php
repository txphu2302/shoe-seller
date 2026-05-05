<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title . ' - ShoeSeller' : 'ShoeSeller - Bước đi đẳng cấp' ?></title>
    
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/css/style.css">
</head>
<body>

    <!-- HEADER -->
    <header class="header">
        <div class="container">
            <a href="<?= BASE_URL ?>" class="logo">
                <i class="fa-solid fa-shoe-prints" style="color: var(--primary-color);"></i>
                Shoe<span>Seller</span>
            </a>
            
            <nav class="nav-links">
                <a href="<?= BASE_URL ?>" class="active">Trang chủ</a>
                <a href="<?= BASE_URL ?>/product">Sản phẩm</a>
                <a href="<?= BASE_URL ?>/home/about">Giới thiệu</a>
                <a href="<?= BASE_URL ?>/home/contact">Liên hệ</a>
            </nav>

            <div class="header-actions">
                <a href="#" class="header-icon"><i class="fa-solid fa-magnifying-glass"></i></a>
                <a href="<?= BASE_URL ?>/cart" class="header-icon"><i class="fa-solid fa-cart-shopping"></i></a>
                <a href="<?= BASE_URL ?>/users/login" class="header-icon"><i class="fa-regular fa-user"></i></a>
            </div>
        </div>
    </header>
