<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <title><?= isset($pageTitle) ? $pageTitle . ' | ' : '' ?>ShoeSeller Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="ShoeSeller Admin Dashboard - Quản lý cửa hàng giày">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="<?= BASE_URL ?>/public/admin_assets/images/icon/logo.png">
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/admin_assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/admin_assets/css/fontawesome.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/admin_assets/css/themify-icons.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/admin_assets/css/metismenujs.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/admin_assets/css/swiper-bundle.min.css">
    <!-- others css -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/admin_assets/css/typography.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/admin_assets/css/default-css.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/admin_assets/css/styles.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/admin_assets/css/responsive.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/admin_assets/css/custom.css">
    <style>
        .metismenu li a.active { color: #d4af37 !important; }
        .btn-gold { background-color: #d4af37; color: #000; border: none; }
        .btn-gold:hover { background-color: #b8962e; color: #000; }
        .badge-gold { background-color: #d4af37; color: #000; }
        .card-icon { font-size: 2.5rem; color: #d4af37; }
    </style>
    <script>window.BASE_URL = '<?= BASE_URL ?>';</script>
</head>

<body>
    <a href="#main-content" class="skip-link">Skip to main content</a>
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- page container area start -->
    <div class="page-container">
        <!-- sidebar menu area start -->
        <div class="sidebar-menu">
            <div class="sidebar-header">
                <div class="logo">
                    <a href="<?= BASE_URL ?>/admin"><h4 class="mb-0" style="color: #d4af37; font-weight: 700;"><i class="fa-solid fa-shoe-prints"></i> ShoeSeller</h4></a>
                </div>
            </div>
            <div class="main-menu">
                <div class="menu-inner">
                    <nav>
                        <ul class="metismenu" id="menu">
                            <li class="active">
                                <a href="<?= BASE_URL ?>/admin" aria-expanded="true"><i class="ti-dashboard"></i><span>Dashboard</span></a>
                            </li>
                             <li>
                                <a href="<?= BASE_URL ?>/homepage" aria-expanded="true"><i class="fa-solid fa-home"></i><span>Quản lý Trang chủ</span></a>
                            </li>
                            <li>
                                <a href="<?= BASE_URL ?>/admin/aboutSettings" aria-expanded="true"><i class="fa-solid fa-info-circle"></i><span>Quản lý Trang Giới thiệu</span></a>
                            </li>
                            <li>
                                <a href="<?= BASE_URL ?>/admin/contacts" aria-expanded="true"><i class="fa-solid fa-envelope"></i><span>Quản lý Liên hệ</span></a>
                            </li>
                            <li>
                                <a href="<?= BASE_URL ?>/admin/settings" aria-expanded="true"><i class="fa-solid fa-cog"></i><span>Cài đặt Website</span></a>
                            </li>
                            <li class="sidebar-divider" style="border-top: 1px solid rgba(255,255,255,0.1); margin: 15px 0;"></li>
                            <li>
                                <a href="<?= BASE_URL ?>" target="_blank" rel="noopener"><i class="fa-solid fa-external-link-alt"></i> <span>Xem Website</span></a>
                            </li>
                            <li>
                                <a href="<?= BASE_URL ?>/users/logout" onclick="return confirm('Bạn có chắc muốn đăng xuất?')"><i class="fa-solid fa-sign-out-alt"></i> <span>Đăng xuất</span></a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- sidebar menu area end -->
        <!-- main content area start -->
        <div class="main-content">
            <!-- header area start -->
            <div class="header-area">
                <div class="row align-items-center">
                    <!-- nav and search button -->
                    <div class="col-md-6 col-sm-8 clearfix">
                        <div class="nav-btn float-start">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <div class="search-box float-start">
                            <h5 class="mb-0" style="color: #fff; font-weight: 600;"><?= isset($pageTitle) ? $pageTitle : 'Dashboard' ?></h5>
                        </div>
                    </div>
                    <!-- profile info -->
                    <div class="col-md-6 col-sm-4 clearfix">
                        <ul class="notification-area float-end">
                            <li id="full-view" title="Toàn màn hình"><i class="ti-fullscreen"></i></li>
                            <li id="full-view-exit" title="Thoát toàn màn hình" style="display: none;"><i class="ti-zoom-out"></i></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- header area end -->
            <!-- page title area start -->
            <div class="page-title-area">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="breadcrumbs-area clearfix">
                            <h1 class="page-title float-start"><?= isset($pageTitle) ? $pageTitle : 'Dashboard' ?></h1>
                            <ul class="breadcrumbs float-start">
                                <li><a href="<?= BASE_URL ?>/admin">Admin</a></li>
                                <li><span><?= isset($pageTitle) ? $pageTitle : 'Dashboard' ?></span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6 clearfix">
                        <div class="user-profile float-end">
                            <img class="avatar user-thumb" src="<?= BASE_URL ?>/public/admin_assets/images/author/avatar.png" alt="avatar">
                            <h4 class="user-name dropdown-toggle" data-bs-toggle="dropdown"><?= $_SESSION['user']['name'] ?? 'Admin' ?> <i class="fa-solid fa-angle-down"></i></h4>
                            <div class="dropdown-menu user-dropdown">
                                <a class="dropdown-item" href="<?= BASE_URL ?>/admin/settings"><i class="fa-solid fa-gear"></i> Cài đặt Website</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item user-dropdown-logout" href="<?= BASE_URL ?>/users/logout" onclick="return confirm('Bạn có chắc muốn đăng xuất?')"><i class="fa-solid fa-right-from-bracket"></i> Đăng xuất</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page title area end -->
            <div class="main-content-inner" id="main-content">
