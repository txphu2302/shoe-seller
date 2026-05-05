<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>ICO Dashboard - SRTdash Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="ICO cryptocurrency dashboard with real-time market data, sales reports, and trading analytics.">
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
                    <a href="index.html"><picture><source srcset="<?= BASE_URL ?>/public/admin_assets/images/icon/logo.avif" type="image/avif"><img src="<?= BASE_URL ?>/public/admin_assets/images/icon/logo.png" alt="logo"></picture></a>
                </div>
            </div>
            <div class="main-menu">
                <div class="menu-inner">
                    <nav>
                        <ul class="metismenu" id="menu">
                            <li class="active">
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i><span>dashboard</span></a>
                                <ul class="collapse">
                                    <li class="active"><a href="index.html">ICO dashboard</a></li>
                                    <li><a href="index2.html">Ecommerce dashboard</a></li>
                                    <li><a href="index3.html">SEO dashboard</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="https://dashboardpack.com/?utm_source=srtdash&utm_medium=sidebar&utm_campaign=demo" target="_blank" rel="noopener"><i class="fa-solid fa-crown"></i> <span>Go Pro</span><span class="badge rounded-pill bg-danger ms-2" style="font-size:10px;">Hot</span></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-layout-sidebar-left"></i><span>Sidebar
                                        Types
                                    </span></a>
                                <ul class="collapse">
                                    <li><a href="index.html">Left Sidebar</a></li>
                                    <li><a href="index3-horizontalmenu.html">Horizontal Sidebar</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-pie-chart"></i><span>Charts</span></a>
                                <ul class="collapse">
                                    <li><a href="barchart.html">bar chart</a></li>
                                    <li><a href="linechart.html">line Chart</a></li>
                                    <li><a href="piechart.html">pie chart</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-palette"></i><span>UI Features</span></a>
                                <ul class="collapse">
                                    <li><a href="accordion.html">Accordion</a></li>
                                    <li><a href="alert.html">Alert</a></li>
                                    <li><a href="badge.html">Badge</a></li>
                                    <li><a href="button.html">Button</a></li>
                                    <li><a href="button-group.html">Button Group</a></li>
                                    <li><a href="cards.html">Cards</a></li>
                                    <li><a href="dropdown.html">Dropdown</a></li>
                                    <li><a href="list-group.html">List Group</a></li>
                                    <li><a href="media-object.html">Media Object</a></li>
                                    <li><a href="modal.html">Modal</a></li>
                                    <li><a href="pagination.html">Pagination</a></li>
                                    <li><a href="popovers.html">Popover</a></li>
                                    <li><a href="progressbar.html">Progressbar</a></li>
                                    <li><a href="tab.html">Tab</a></li>
                                    <li><a href="typography.html">Typography</a></li>
                                    <li><a href="form.html">Form</a></li>
                                    <li><a href="grid.html">grid system</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-slice"></i><span>icons</span></a>
                                <ul class="collapse">
                                    <li><a href="fontawesome.html">fontawesome icons</a></li>
                                    <li><a href="themify.html">themify icons</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="fa-solid fa-table"></i>
                                    <span>Tables</span></a>
                                <ul class="collapse">
                                    <li><a href="table-basic.html">basic table</a></li>
                                    <li><a href="table-layout.html">table layout</a></li>
                                    <li><a href="datatable.html">datatable</a></li>
                                </ul>
                            </li>
                            <li><a href="maps.html"><i class="ti-map-alt"></i> <span>maps</span></a></li>
                            <li><a href="invoice.html"><i class="ti-receipt"></i> <span>Invoice Summary</span></a></li>
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-widget"></i><span>Apps</span></a>
                                <ul class="collapse">
                                    <li><a href="profile.html">Profile</a></li>
                                    <li><a href="notifications.html">Notifications</a></li>
                                    <li><a href="settings.html">Settings</a></li>
                                    <li><a href="calendar.html">Calendar</a></li>
                                    <li><a href="file-manager.html">File Manager</a></li>
                                    <li><a href="chat.html">Chat</a></li>
                                    <li><a href="email.html">Email</a></li>
                                    <li><a href="widgets.html">Widgets</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-layers-alt"></i> <span>Pages</span></a>
                                <ul class="collapse">
                                    <li><a href="login.html">Login</a></li>
                                    <li><a href="login2.html">Login 2</a></li>
                                    <li><a href="login3.html">Login 3</a></li>
                                    <li><a href="register.html">Register</a></li>
                                    <li><a href="register2.html">Register 2</a></li>
                                    <li><a href="register3.html">Register 3</a></li>
                                    <li><a href="register4.html">Register 4</a></li>
                                    <li><a href="screenlock.html">Lock Screen</a></li>
                                    <li><a href="screenlock2.html">Lock Screen 2</a></li>
                                    <li><a href="reset-pass.html">reset password</a></li>
                                    <li><a href="forgot-password.html">Forgot Password</a></li>
                                    <li><a href="pricing.html">Pricing</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="fa-solid fa-exclamation-triangle"></i>
                                    <span>Error</span></a>
                                <ul class="collapse">
                                    <li><a href="404.html">Error 404</a></li>
                                    <li><a href="403.html">Error 403</a></li>
                                    <li><a href="500.html">Error 500</a></li>
                                    <li><a href="401.html">Error 401</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="fa-solid fa-align-left"></i> <span>Multi
                                        level menu</span></a>
                                <ul class="collapse">
                                    <li><a href="#">Item level (1)</a></li>
                                    <li><a href="#">Item level (1)</a></li>
                                    <li><a href="#" aria-expanded="true">Item level (1)</a>
                                        <ul class="collapse">
                                            <li><a href="#">Item level (2)</a></li>
                                            <li><a href="#">Item level (2)</a></li>
                                            <li><a href="#">Item level (2)</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#">Item level (1)</a></li>
                                </ul>
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
                            <form action="#">
                                <input type="text" name="search" placeholder="Search..." required>
                                <i class="ti-search"></i>
                            </form>
                        </div>
                    </div>
                    <!-- profile info & task notification -->
                    <div class="col-md-6 col-sm-4 clearfix">
                        <ul class="notification-area float-end">
                            <li id="full-view"><i class="ti-fullscreen"></i></li>
                            <li id="full-view-exit"><i class="ti-zoom-out"></i></li>
                            <li class="dropdown">
                                <i class="ti-bell dropdown-toggle" data-bs-toggle="dropdown">
                                    <span>2</span>
                                </i>
                                <div class="dropdown-menu bell-notify-box notify-box">
                                    <span class="notify-title">You have 3 new notifications <a href="#">view all</a></span>
                                    <div class="notify-list">
                                        <a href="#" class="notify-item">
                                            <div class="notify-thumb"><i class="ti-key bg-danger"></i></div>
                                            <div class="notify-text">
                                                <p>You have Changed Your Password</p>
                                                <span>Just Now</span>
                                            </div>
                                        </a>
                                        <a href="#" class="notify-item">
                                            <div class="notify-thumb"><i class="ti-comments-smiley bg-info"></i></div>
                                            <div class="notify-text">
                                                <p>New Comments On Post</p>
                                                <span>30 Seconds ago</span>
                                            </div>
                                        </a>
                                        <a href="#" class="notify-item">
                                            <div class="notify-thumb"><i class="ti-key bg-primary"></i></div>
                                            <div class="notify-text">
                                                <p>Some special like you</p>
                                                <span>Just Now</span>
                                            </div>
                                        </a>
                                        <a href="#" class="notify-item">
                                            <div class="notify-thumb"><i class="ti-comments-smiley bg-info"></i></div>
                                            <div class="notify-text">
                                                <p>New Comments On Post</p>
                                                <span>30 Seconds ago</span>
                                            </div>
                                        </a>
                                        <a href="#" class="notify-item">
                                            <div class="notify-thumb"><i class="ti-key bg-primary"></i></div>
                                            <div class="notify-text">
                                                <p>Some special like you</p>
                                                <span>Just Now</span>
                                            </div>
                                        </a>
                                        <a href="#" class="notify-item">
                                            <div class="notify-thumb"><i class="ti-key bg-danger"></i></div>
                                            <div class="notify-text">
                                                <p>You have Changed Your Password</p>
                                                <span>Just Now</span>
                                            </div>
                                        </a>
                                        <a href="#" class="notify-item">
                                            <div class="notify-thumb"><i class="ti-key bg-danger"></i></div>
                                            <div class="notify-text">
                                                <p>You have Changed Your Password</p>
                                                <span>Just Now</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </li>
                            <li class="dropdown">
                                <i class="fa-regular fa-envelope dropdown-toggle" data-bs-toggle="dropdown"><span>3</span></i>
                                <div class="dropdown-menu notify-box nt-enveloper-box">
                                    <span class="notify-title">You have 3 new notifications <a href="#">view all</a></span>
                                    <div class="notify-list">
                                        <a href="#" class="notify-item">
                                            <div class="notify-thumb">
                                                <picture><source srcset="<?= BASE_URL ?>/public/admin_assets/images/author/author-img1.avif" type="image/avif"><img src="<?= BASE_URL ?>/public/admin_assets/images/author/author-img1.jpg" alt="image"></picture>
                                            </div>
                                            <div class="notify-text">
                                                <p>Aglae Mayer</p>
                                                <span class="msg">Hey I am waiting for you...</span>
                                                <span>3:15 PM</span>
                                            </div>
                                        </a>
                                        <a href="#" class="notify-item">
                                            <div class="notify-thumb">
                                                <picture><source srcset="<?= BASE_URL ?>/public/admin_assets/images/author/author-img2.avif" type="image/avif"><img src="<?= BASE_URL ?>/public/admin_assets/images/author/author-img2.jpg" alt="image"></picture>
                                            </div>
                                            <div class="notify-text">
                                                <p>Aglae Mayer</p>
                                                <span class="msg">When you can connect with me...</span>
                                                <span>3:15 PM</span>
                                            </div>
                                        </a>
                                        <a href="#" class="notify-item">
                                            <div class="notify-thumb">
                                                <picture><source srcset="<?= BASE_URL ?>/public/admin_assets/images/author/author-img3.avif" type="image/avif"><img src="<?= BASE_URL ?>/public/admin_assets/images/author/author-img3.jpg" alt="image"></picture>
                                            </div>
                                            <div class="notify-text">
                                                <p>Aglae Mayer</p>
                                                <span class="msg">I missed you so much...</span>
                                                <span>3:15 PM</span>
                                            </div>
                                        </a>
                                        <a href="#" class="notify-item">
                                            <div class="notify-thumb">
                                                <picture><source srcset="<?= BASE_URL ?>/public/admin_assets/images/author/author-img4.avif" type="image/avif"><img src="<?= BASE_URL ?>/public/admin_assets/images/author/author-img4.jpg" alt="image"></picture>
                                            </div>
                                            <div class="notify-text">
                                                <p>Aglae Mayer</p>
                                                <span class="msg">Your product is completely Ready...</span>
                                                <span>3:15 PM</span>
                                            </div>
                                        </a>
                                        <a href="#" class="notify-item">
                                            <div class="notify-thumb">
                                                <picture><source srcset="<?= BASE_URL ?>/public/admin_assets/images/author/author-img2.avif" type="image/avif"><img src="<?= BASE_URL ?>/public/admin_assets/images/author/author-img2.jpg" alt="image"></picture>
                                            </div>
                                            <div class="notify-text">
                                                <p>Aglae Mayer</p>
                                                <span class="msg">Hey I am waiting for you...</span>
                                                <span>3:15 PM</span>
                                            </div>
                                        </a>
                                        <a href="#" class="notify-item">
                                            <div class="notify-thumb">
                                                <picture><source srcset="<?= BASE_URL ?>/public/admin_assets/images/author/author-img1.avif" type="image/avif"><img src="<?= BASE_URL ?>/public/admin_assets/images/author/author-img1.jpg" alt="image"></picture>
                                            </div>
                                            <div class="notify-text">
                                                <p>Aglae Mayer</p>
                                                <span class="msg">Hey I am waiting for you...</span>
                                                <span>3:15 PM</span>
                                            </div>
                                        </a>
                                        <a href="#" class="notify-item">
                                            <div class="notify-thumb">
                                                <picture><source srcset="<?= BASE_URL ?>/public/admin_assets/images/author/author-img3.avif" type="image/avif"><img src="<?= BASE_URL ?>/public/admin_assets/images/author/author-img3.jpg" alt="image"></picture>
                                            </div>
                                            <div class="notify-text">
                                                <p>Aglae Mayer</p>
                                                <span class="msg">Hey I am waiting for you...</span>
                                                <span>3:15 PM</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </li>
                            <li class="settings-btn">
                                <i class="ti-settings"></i>
                            </li>
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
                            <h1 class="page-title float-start">Dashboard</h1>
                            <ul class="breadcrumbs float-start">
                                <li><a href="index.html">Home</a></li>
                                <li><span>Dashboard</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6 clearfix">
                        <div class="user-profile float-end">
                            <picture><source srcset="<?= BASE_URL ?>/public/admin_assets/images/author/avatar.avif" type="image/avif"><img class="avatar user-thumb" src="<?= BASE_URL ?>/public/admin_assets/images/author/avatar.png" alt="avatar"></picture>
                            <h4 class="user-name dropdown-toggle" data-bs-toggle="dropdown">Aigars Silkalns <i class="fa-solid fa-angle-down"></i></h4>
                            <div class="dropdown-menu user-dropdown">
                                <a class="dropdown-item" href="profile.html"><i class="fa-solid fa-user"></i> My Profile</a>
                                <a class="dropdown-item" href="notifications.html"><i class="fa-solid fa-envelope"></i> Inbox <span class="badge rounded-pill bg-primary ms-auto">3</span></a>
                                <a class="dropdown-item" href="settings.html"><i class="fa-solid fa-gear"></i> Account Settings</a>
                                <a class="dropdown-item" href="screenlock.html"><i class="fa-solid fa-lock"></i> Lock Screen</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item user-dropdown-logout" href="#"><i class="fa-solid fa-right-from-bracket"></i> Log Out</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page title area end -->
            <div class="main-content-inner" id="main-content">
