<!-- HERO SECTION -->
<section class="hero">
    <div class="container">
        <div class="hero-content">
            <span class="hero-tag"><i class="fa-solid fa-crown" style="margin-right: 8px;"></i>Bộ sưu tập giới hạn</span>
            <h1 class="hero-title">Bước đi <br><span>đẳng cấp.</span></h1>
            <p class="hero-desc">Đôi giày không chỉ là phụ kiện — đó là tuyên ngôn phong cách của bạn. Khám phá bộ sưu tập luxury streetwear giới hạn.</p>
            <div class="hero-btns">
                <button class="btn btn-primary">Mua ngay <i class="fa-solid fa-arrow-right" style="margin-left: 8px;"></i></button>
                <button class="btn btn-outline">Khám phá bộ sưu tập</button>
            </div>
            
            <div class="hero-stats">
                <div class="stat-item">
                    <h4>120K+</h4>
                    <p>Khách hàng</p>
                </div>
                <div class="stat-item">
                    <h4>4.9<i class="fa-solid fa-star" style="font-size: 14px; margin-left: 4px;"></i></h4>
                    <p>Đánh giá</p>
                </div>
                <div class="stat-item">
                    <h4>350+</h4>
                    <p>Sản phẩm</p>
                </div>
            </div>
        </div>
        
        <div class="hero-image">
            <!-- Hình ảnh SVG Placeholder (Đại diện cho hình ảnh giày) -->
            <svg viewBox="0 0 500 300" width="100%" xmlns="http://www.w3.org/2000/svg">
                <path d="M50 200 Q150 100 250 200 T450 200" fill="none" stroke="var(--primary-color)" stroke-width="4"/>
                <rect x="100" y="50" width="300" height="200" rx="20" fill="rgba(255,255,255,0.05)" stroke="rgba(255,255,255,0.1)"/>
                <text x="250" y="150" font-family="Outfit" font-size="24" fill="white" text-anchor="middle">HÌNH ẢNH GIÀY LUXURY</text>
            </svg>
        </div>
    </div>
</section>

<!-- MARQUEE BRANDS -->
<div class="marquee-section">
    <div class="marquee-content">
        <!-- Lặp lại 2 lần để scroll mượt -->
        <div class="marquee-item">CONVERSE <i class="fa-solid fa-diamond"></i></div>
        <div class="marquee-item">VANS <i class="fa-solid fa-diamond"></i></div>
        <div class="marquee-item">ASICS <i class="fa-solid fa-diamond"></i></div>
        <div class="marquee-item">NIKE <i class="fa-solid fa-diamond"></i></div>
        <div class="marquee-item">ADIDAS <i class="fa-solid fa-diamond"></i></div>
        <div class="marquee-item">JORDAN <i class="fa-solid fa-diamond"></i></div>
        <div class="marquee-item">NEW BALANCE <i class="fa-solid fa-diamond"></i></div>
        
        <div class="marquee-item">CONVERSE <i class="fa-solid fa-diamond"></i></div>
        <div class="marquee-item">VANS <i class="fa-solid fa-diamond"></i></div>
        <div class="marquee-item">ASICS <i class="fa-solid fa-diamond"></i></div>
        <div class="marquee-item">NIKE <i class="fa-solid fa-diamond"></i></div>
        <div class="marquee-item">ADIDAS <i class="fa-solid fa-diamond"></i></div>
        <div class="marquee-item">JORDAN <i class="fa-solid fa-diamond"></i></div>
        <div class="marquee-item">NEW BALANCE <i class="fa-solid fa-diamond"></i></div>
    </div>
</div>

<!-- BEST SELLERS -->
<section class="section-padding">
    <div class="container">
        <div class="section-header">
            <div>
                <span class="section-subtitle">Best Sellers</span>
                <h2 class="section-title">Bán chạy nhất</h2>
            </div>
            <div class="filters">
                <button class="filter-btn active">Tất cả</button>
                <button class="filter-btn">LUXE</button>
                <button class="filter-btn">URBAN</button>
                <button class="filter-btn">STRIDE</button>
                <button class="filter-btn">ATELIER</button>
            </div>
        </div>

        <div class="product-grid">
            <?php foreach ($best_sellers as $item): ?>
            <div class="product-card">
                <?php if ($item['is_new']): ?>
                    <span class="product-badge new">Mới</span>
                <?php elseif (isset($item['discount'])): ?>
                    <span class="product-badge"><?= $item['discount'] ?></span>
                <?php endif; ?>
                
                <div class="product-image">
                    <!-- Placeholder SVG Image -->
                    <svg viewBox="0 0 200 150" width="80%" xmlns="http://www.w3.org/2000/svg">
                        <rect x="0" y="0" width="200" height="150" rx="10" fill="#e0e0e0" />
                        <text x="100" y="80" font-family="Outfit" font-size="14" fill="#666" text-anchor="middle">SẢN PHẨM <?= $item['id'] ?></text>
                    </svg>
                    
                    <div class="product-action">
                        <button class="btn-add-cart"><i class="fa-solid fa-cart-plus" style="margin-right: 8px;"></i> Thêm vào giỏ</button>
                    </div>
                </div>
                
                <div class="product-info">
                    <div class="product-brand"><?= $item['brand'] ?></div>
                    <h3 class="product-name"><?= $item['name'] ?></h3>
                    
                    <div class="product-meta">
                        <div class="product-price"><?= $item['price'] ?>₫</div>
                        <div class="product-rating">
                            <i class="fa-solid fa-star"></i> <?= $item['rating'] ?>
                        </div>
                    </div>
                    
                    <div class="color-dots">
                        <span class="dot" style="background-color: #000;"></span>
                        <span class="dot" style="background-color: #fff;"></span>
                        <span class="dot" style="background-color: #808080;"></span>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- PROMO BANNER -->
<section>
    <div class="container">
        <div class="promo-banner">
            <div class="promo-content">
                <span class="hero-tag" style="background-color: var(--primary-color); color: var(--bg-dark); border:none;">Luxury Tech - 40%</span>
                <h2 class="promo-title">Giảm đến <br><span>50% OFF</span></h2>
                <p class="promo-desc">Ưu đãi độc quyền dành cho bộ sưu tập Fall/Winter 2026. Số lượng có hạn - Sở hữu ngay trước khi hết hàng.</p>
                <button class="btn btn-primary">Xem sản phẩm <i class="fa-solid fa-arrow-right" style="margin-left: 8px;"></i></button>
            </div>
            
            <div class="promo-image">
                <!-- Placeholder SVG Image -->
                <svg viewBox="0 0 300 200" width="300" xmlns="http://www.w3.org/2000/svg">
                    <rect x="0" y="0" width="300" height="200" rx="10" fill="rgba(255,255,255,0.1)" stroke="var(--primary-color)" stroke-width="2"/>
                    <text x="150" y="110" font-family="Outfit" font-size="24" fill="var(--primary-color)" text-anchor="middle">GIÀY KHUYẾN MÃI</text>
                </svg>
            </div>
        </div>
    </div>
</section>

<!-- NEW ARRIVALS -->
<section class="section-padding" style="padding-top: 0;">
    <div class="container">
        <div class="section-header">
            <div>
                <span class="section-subtitle">New Arrivals</span>
                <h2 class="section-title">Vừa cập bến</h2>
            </div>
            <div class="filters">
                <button class="filter-btn active">Tất cả</button>
                <button class="filter-btn">LUXE</button>
                <button class="filter-btn">URBAN</button>
            </div>
        </div>

        <div class="product-grid">
            <?php foreach ($new_arrivals as $item): ?>
            <div class="product-card">
                <?php if ($item['is_new']): ?>
                    <span class="product-badge new">Mới</span>
                <?php elseif (isset($item['discount'])): ?>
                    <span class="product-badge"><?= $item['discount'] ?></span>
                <?php endif; ?>
                
                <div class="product-image">
                    <!-- Placeholder SVG Image -->
                    <svg viewBox="0 0 200 150" width="80%" xmlns="http://www.w3.org/2000/svg">
                        <rect x="0" y="0" width="200" height="150" rx="10" fill="#e0e0e0" />
                        <text x="100" y="80" font-family="Outfit" font-size="14" fill="#666" text-anchor="middle">SẢN PHẨM <?= $item['id'] ?></text>
                    </svg>
                    
                    <div class="product-action">
                        <button class="btn-add-cart"><i class="fa-solid fa-cart-plus" style="margin-right: 8px;"></i> Thêm vào giỏ</button>
                    </div>
                </div>
                
                <div class="product-info">
                    <div class="product-brand"><?= $item['brand'] ?></div>
                    <h3 class="product-name"><?= $item['name'] ?></h3>
                    
                    <div class="product-meta">
                        <div class="product-price"><?= $item['price'] ?>₫</div>
                        <div class="product-rating">
                            <i class="fa-solid fa-star"></i> <?= $item['rating'] ?>
                        </div>
                    </div>
                    
                    <div class="color-dots">
                        <span class="dot" style="background-color: #000;"></span>
                        <span class="dot" style="background-color: #fff;"></span>
                        <span class="dot" style="background-color: #808080;"></span>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
