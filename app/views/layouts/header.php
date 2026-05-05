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
                <?php if (isset($_SESSION['user'])): ?>
                <div class="header-user-dropdown" style="position:relative;display:inline-block;">
                    <button class="header-icon" id="userMenuBtn" onclick="toggleUserMenu()" style="background:none;border:none;cursor:pointer;padding:0;display:flex;align-items:center;gap:6px;">
                        <?php if (!empty($_SESSION['user']['avatar'])): ?>
                            <img src="<?= BASE_URL ?>/public/uploads/avatars/<?= htmlspecialchars($_SESSION['user']['avatar']) ?>" alt="Avatar"
                                style="width:34px;height:34px;border-radius:50%;object-fit:cover;border:2px solid var(--primary-color);">
                        <?php else: ?>
                            <i class="fa-solid fa-circle-user" style="font-size:1.5rem;"></i>
                        <?php endif; ?>
                    </button>
                    <div id="userDropdown" style="display:none;position:absolute;right:0;top:calc(100% + 10px);
                        background:#1a1a1a;border:1px solid #333;border-radius:12px;min-width:190px;
                        box-shadow:0 8px 32px rgba(0,0,0,.5);z-index:999;overflow:hidden;">
                        <div style="padding:12px 16px;border-bottom:1px solid #2a2a2a;">
                            <div style="font-size:.85rem;font-weight:600;color:#f0ede8;"><?= htmlspecialchars($_SESSION['user']['name']) ?></div>
                            <div style="font-size:.75rem;color:#888;"><?= htmlspecialchars($_SESSION['user']['email']) ?></div>
                        </div>
                        <a href="<?= BASE_URL ?>/users/profile" style="display:flex;align-items:center;gap:10px;padding:11px 16px;color:#ccc;text-decoration:none;font-size:.85rem;transition:background .2s;" onmouseover="this.style.background='#252525'" onmouseout="this.style.background=''">
                            <i class="fa-regular fa-user" style="width:16px;text-align:center;"></i> Hồ sơ cá nhân
                        </a>
                        <a href="<?= BASE_URL ?>/users/changePassword" style="display:flex;align-items:center;gap:10px;padding:11px 16px;color:#ccc;text-decoration:none;font-size:.85rem;transition:background .2s;" onmouseover="this.style.background='#252525'" onmouseout="this.style.background=''">
                            <i class="fa-solid fa-lock" style="width:16px;text-align:center;"></i> Đổi mật khẩu
                        </a>
                        <div style="border-top:1px solid #2a2a2a;margin-top:4px;"></div>
                        <a href="<?= BASE_URL ?>/users/logout" style="display:flex;align-items:center;gap:10px;padding:11px 16px;color:#f87171;text-decoration:none;font-size:.85rem;transition:background .2s;" onmouseover="this.style.background='#252525'" onmouseout="this.style.background=''">
                            <i class="fa-solid fa-right-from-bracket" style="width:16px;text-align:center;"></i> Đăng xuất
                        </a>
                    </div>
                </div>
                <script>
                function toggleUserMenu() {
                    var d = document.getElementById('userDropdown');
                    d.style.display = d.style.display === 'none' ? 'block' : 'none';
                }
                document.addEventListener('click', function(e) {
                    var btn = document.getElementById('userMenuBtn');
                    var dd  = document.getElementById('userDropdown');
                    if (dd && btn && !btn.contains(e.target) && !dd.contains(e.target)) {
                        dd.style.display = 'none';
                    }
                });
                </script>
                <?php else: ?>
                <a href="<?= BASE_URL ?>/users/login" class="header-icon"><i class="fa-regular fa-user"></i></a>
                <?php endif; ?>
            </div>
        </div>
    </header>
