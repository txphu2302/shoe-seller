<main class="about-page">
    <!-- Hero Section -->
    <?php 
    $heroBg = !empty($settings['about_hero_image']) ? BASE_URL . '/' . $settings['about_hero_image'] : BASE_URL . '/public/images/about_hero_bg.png';
    ?>
    <section class="about-hero" style="background-image: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('<?= $heroBg ?>');">
        <div class="container">
            <div class="hero-content">
                <span class="sub-title"><?= $settings['about_hero_subtitle'] ?? 'OUR STORY' ?></span>
                <h1><?= $settings['about_hero_title'] ?? 'Đẳng cấp được đo bằng <span class="highlight">từng bước chân.</span>' ?></h1>
            </div>
        </div>
    </section>

    <!-- About Content Section -->
    <section class="about-content-section section-padding">
        <div class="container">
            <div class="about-grid">
                <div class="about-text">
                    <span class="sub-title"><?= $settings['about_main_subtitle'] ?? 'VỀ ShoeSeller' ?></span>
                    <h2><?= $settings['about_main_title'] ?? 'Hơn cả một đôi giày.' ?></h2>
                    <p><?= nl2br($settings['about_description_1'] ?? 'Thành lập năm 2020 tại TP. Hồ Chí Minh, ShoeSeller ra đời với sứ mệnh mang đến cho cộng đồng sneakerhead Việt Nam những đôi giày chính hãng, chất lượng cao cấp với trải nghiệm mua sắm đẳng cấp.') ?></p>
                    <p><?= nl2br($settings['about_description_2'] ?? 'Sau 5 năm phát triển, ShoeSeller tự hào sở hữu hơn 350 mẫu giày từ những thương hiệu hàng đầu, phục vụ hơn 120.000 khách hàng trên toàn quốc với hệ thống cửa hàng tại TP.HCM, Hà Nội và Đà Nẵng.') ?></p>
                    
                    <div class="stats-grid">
                        <div class="stat-item">
                            <span class="stat-number"><?= $settings['about_stat_1_num'] ?? '120K+' ?></span>
                            <span class="stat-label"><?= $settings['about_stat_1_label'] ?? 'KHÁCH HÀNG' ?></span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number"><?= $settings['about_stat_2_num'] ?? '350+' ?></span>
                            <span class="stat-label"><?= $settings['about_stat_2_label'] ?? 'MẪU GIÀY' ?></span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number"><?= $settings['about_stat_3_num'] ?? '4.9★' ?></span>
                            <span class="stat-label"><?= $settings['about_stat_3_label'] ?? 'ĐÁNH GIÁ' ?></span>
                        </div>
                    </div>
                </div>
                <div class="about-image">
                    <?php 
                    $mainImg = !empty($settings['about_main_image']) ? BASE_URL . '/' . $settings['about_main_image'] : BASE_URL . '/public/images/about_sneakers_feet.png';
                    ?>
                    <img src="<?= $mainImg ?>" alt="<?= $settings['company_name'] ?? 'ShoeSeller' ?> Sneakers">
                </div>
            </div>
        </div>
    </section>

    <!-- Core Values Section -->
    <section class="core-values-section section-padding">
        <div class="container">
            <span class="sub-title text-center" style="display: block; margin-bottom: 20px;"><?= $settings['about_core_values_subtitle'] ?? 'GIÁ TRỊ CỐT LÕI' ?></span>
            <h2 class="text-center"><?= $settings['about_core_values_title'] ?? 'Điều làm nên ' . ($settings['company_name'] ?? 'ShoeSeller') . '.' ?></h2>
            
            <div class="values-grid">
                <div class="value-card">
                    <i class="fa-solid fa-shield-check fa-2x mb-4 text-primary"></i>
                    <h3><?= $settings['about_value_1_title'] ?? 'Chính hãng 100%' ?></h3>
                    <p><?= $settings['about_value_1_desc'] ?? 'Cam kết hoàn tiền gấp 3 nếu phát hiện hàng giả, hàng kém chất lượng.' ?></p>
                </div>
                <div class="value-card">
                    <i class="fa-solid fa-leaf fa-2x mb-4 text-primary"></i>
                    <h3><?= $settings['about_value_2_title'] ?? 'Bền vững' ?></h3>
                    <p><?= $settings['about_value_2_desc'] ?? 'Ưu tiên các dòng sản phẩm từ chất liệu tái chế, thân thiện với môi trường.' ?></p>
                </div>
                <div class="value-card">
                    <i class="fa-solid fa-truck-fast fa-2x mb-4 text-primary"></i>
                    <h3><?= $settings['about_value_3_title'] ?? 'Giao nhanh toàn quốc' ?></h3>
                    <p><?= $settings['about_value_3_desc'] ?? 'Nội thành 1-2 ngày, miễn phí vận chuyển cho đơn hàng từ 1.500.000đ.' ?></p>
                </div>
                <div class="value-card">
                    <i class="fa-solid fa-award fa-2x mb-4 text-primary"></i>
                    <h3><?= $settings['about_value_4_title'] ?? 'Bảo hành dài hạn' ?></h3>
                    <p><?= $settings['about_value_4_desc'] ?? 'Bảo hành keo và đường chỉ trong vòng 6 tháng cho tất cả sản phẩm.' ?></p>
                </div>
            </div>
        </div>
    </section>
</main>
