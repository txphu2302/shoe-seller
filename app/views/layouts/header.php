<?php
// Xác định trang hiện tại dựa trên URL
$currentUrl = isset($_GET['url']) ? rtrim($_GET['url'], '/') : '';
$urlParts = explode('/', $currentUrl);
$currentPage = strtolower($urlParts[0] ?? 'home');
$currentAction = strtolower($urlParts[1] ?? 'index');
$isProductPage = ($currentPage === 'product' || $currentPage === 'products');

// Xác định nav active
$navActive = '';
if ($currentPage === '' || ($currentPage === 'home' && $currentAction === 'index')) {
    $navActive = 'home';
} elseif ($isProductPage) {
    $navActive = 'product';
} elseif ($currentPage === 'about' || ($currentPage === 'home' && $currentAction === 'about')) {
    $navActive = 'about';
} elseif ($currentPage === 'contact' || ($currentPage === 'home' && $currentAction === 'contact')) {
    $navActive = 'contact';
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title . ' - ' . ($settings['company_name'] ?? 'ShoeSeller') : ($settings['company_name'] ?? 'ShoeSeller') . ' - Bước đi đẳng cấp' ?></title>

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Base Layout CSS (theme + header + footer) -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/css/style.css">

    <!-- Page-specific CSS -->
    <?php if (isset($page_css) && is_array($page_css)): ?>
        <?php foreach ($page_css as $css): ?>
            <link rel="stylesheet" href="<?= BASE_URL ?>/public/css/<?= $css ?>.css">
        <?php endforeach; ?>
    <?php elseif (isset($page_css) && is_string($page_css)): ?>
        <link rel="stylesheet" href="<?= BASE_URL ?>/public/css/<?= $page_css ?>.css">
    <?php endif; ?>
</head>

<body>

    <!-- HEADER -->
    <header class="header<?= $isProductPage ? ' header-product' : '' ?>">
        <div class="container">
            <a href="<?= BASE_URL ?>" class="logo">
                <i class="fa-solid fa-shoe-prints" style="color: var(--primary-color);"></i>
                <?= $settings['company_name'] ?? 'ShoeSeller' ?>
            </a>

            <nav class="nav-links">
                <a href="<?= BASE_URL ?>" class="<?= $navActive === 'home' ? 'active' : '' ?>">Trang chủ</a>
                <a href="<?= BASE_URL ?>/product" class="<?= $navActive === 'product' ? 'active' : '' ?>">Sản phẩm</a>
                <a href="<?= BASE_URL ?>/about" class="<?= $navActive === 'about' ? 'active' : '' ?>">Giới thiệu</a>
                <a href="<?= BASE_URL ?>/contact" class="<?= $navActive === 'contact' ? 'active' : '' ?>">Liên hệ</a>
            </nav>

            <div class="header-actions">
                <a href="#" class="header-icon"><i class="fa-solid fa-magnifying-glass"></i></a>
                <a href="<?= BASE_URL ?>/cart" class="header-icon"><i class="fa-solid fa-cart-shopping"></i></a>
                <?php if (isset($_SESSION['user'])): ?>
                    <div class="header-user-dropdown">
                        <a href="#" class="header-icon" id="userDropdownBtn">
                            <?php if (!empty($_SESSION['user']['avatar'])): ?>
                                <img src="<?= BASE_URL . $_SESSION['user']['avatar'] ?>" alt="Avatar" class="avatar-img" style="width: 30px; height: 30px; border-radius: 50%; object-fit: cover;">
                            <?php else: ?>
                                <i class="fa-solid fa-user-check" style="color: var(--primary-color);"></i>
                            <?php endif; ?>
                        </a>
                        <div class="user-dropdown-content" id="userDropdownContent">
                            <div class="user-info">
                                <strong><?= htmlspecialchars($_SESSION['user']['name']) ?></strong>
                            </div>
                            <hr style="margin: 5px 0; border-color: rgba(255,255,255,0.1);">
                            <a href="<?= BASE_URL ?>/profile"><i class="fa-solid fa-id-card"></i> Hồ sơ cá nhân</a>
                            <?php if ($_SESSION['user']['role'] === 'admin'): ?>
                                <a href="<?= BASE_URL ?>/admin"><i class="fa-solid fa-gauge"></i> Trang quản trị</a>
                            <?php endif; ?>
                            <a href="<?= BASE_URL ?>/users/logout" onclick="return confirm('Bạn có chắc muốn đăng xuất?')"><i class="fa-solid fa-right-from-bracket"></i> Đăng xuất</a>
                        </div>
                    </div>
                <?php else: ?>
                    <?php 
                        $currentUri = $_SERVER['REQUEST_URI'] ?? '';
                        $loginUrl = BASE_URL . '/users/login';
                        // Do not append redirect if we are already on auth pages
                        if (strpos($currentUri, '/users/') === false) {
                            $loginUrl .= '?redirect=' . urlencode($currentUri);
                        }
                    ?>
                    <a href="<?= $loginUrl ?>" class="header-icon"><i class="fa-regular fa-user"></i></a>
                <?php endif; ?>
            </div>
        </div>
    </header>