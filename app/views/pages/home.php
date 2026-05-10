<?php
$hero = $hero ?? [];
$featured = $featured ?? [];
$brands = $brands ?? [];
$about = $about ?? [];
$best_sellers = $best_sellers ?? [];
$new_arrivals = $new_arrivals ?? [];

$heroTitle = (string)($hero['hero_title'] ?? '');
$heroSubtitle = (string)($hero['hero_subtitle'] ?? '');
$heroDescription = (string)($hero['hero_description'] ?? '');
$heroButtonText = (string)($hero['hero_button_text'] ?? 'MUA NGAY');
$heroButtonLink = (string)($hero['hero_button_link'] ?? '/product');
$heroImage = (string)($hero['hero_background'] ?? '');

$heroCtaHref = str_starts_with($heroButtonLink, '/')
    ? (BASE_URL . $heroButtonLink)
    : (BASE_URL . '/' . ltrim($heroButtonLink, '/'));

$heroImgSrc = !empty($heroImage) ? (BASE_URL . $heroImage) : '';

function format_vnd($value)
{
    return '$' . number_format((float)$value, 2);
}
?>

<!-- HERO SECTION -->
<section class="hero">
    <div class="container">
        <div class="hero-content">
            <?php if (!empty($heroSubtitle)): ?>
                <span class="hero-tag"><i class="fa-solid fa-crown" style="margin-right: 8px;"></i><?= htmlspecialchars($heroSubtitle) ?></span>
            <?php endif; ?>

            <?php if (!empty($heroTitle)): ?>
                <h1 class="hero-title"><?= nl2br(htmlspecialchars($heroTitle)) ?></h1>
            <?php endif; ?>

            <?php if (!empty($heroDescription)): ?>
                <p class="hero-desc"><?= nl2br(htmlspecialchars($heroDescription)) ?></p>
            <?php endif; ?>

            <div class="hero-btns">
                <a class="btn btn-primary" href="<?= htmlspecialchars($heroCtaHref) ?>">
                    <?= htmlspecialchars($heroButtonText) ?>
                    <i class="fa-solid fa-arrow-right" style="margin-left: 8px;"></i>
                </a>
                <a class="btn btn-outline" href="<?= BASE_URL ?>/about">Về chúng tôi</a>
            </div>
        </div>

        <div class="hero-image">
            <?php if (!empty($heroImgSrc)): ?>
                <img src="<?= htmlspecialchars($heroImgSrc) ?>" alt="Hero Banner" loading="lazy">
            <?php else: ?>
                <div class="hero-image-fallback">
                    <svg viewBox="0 0 500 300" width="100%" xmlns="http://www.w3.org/2000/svg">
                        <path d="M50 200 Q150 100 250 200 T450 200" fill="none" stroke="var(--primary-color)" stroke-width="4"/>
                        <rect x="100" y="50" width="300" height="200" rx="20" fill="rgba(255,255,255,0.05)" stroke="rgba(255,255,255,0.1)"/>
                        <text x="250" y="150" font-family="Outfit" font-size="24" fill="white" text-anchor="middle">HÌNH ẢNH HERO</text>
                    </svg>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- MARQUEE BRANDS -->
<?php if (!empty($brands)): ?>
<div class="marquee-section">
    <div class="marquee-content">
        <?php for ($loop = 0; $loop < 2; $loop++): ?>
            <?php foreach ($brands as $brand): ?>
                <div class="marquee-item">
                    <?= htmlspecialchars((string)($brand['name'] ?? '')) ?> <i class="fa-solid fa-diamond"></i>
                </div>
            <?php endforeach; ?>
        <?php endfor; ?>
    </div>
</div>
<?php endif; ?>

<!-- BEST SELLERS -->
<section class="section-padding">
    <div class="container">
        <div class="section-header">
            <div>
                <span class="section-subtitle">Best Sellers</span>
                <h2 class="section-title"><?= htmlspecialchars((string)($featured['best_sellers_title'] ?? 'Bán chạy')) ?></h2>
            </div>
            <div class="section-actions">
                <a class="btn btn-outline btn-sm" href="<?= BASE_URL ?>/product">Xem tất cả</a>
            </div>
        </div>

        <div class="product-grid">
            <?php if (!empty($best_sellers)): ?>
                <?php foreach ($best_sellers as $item): ?>
                    <div class="product-card">
                        <div class="product-image">
                            <a href="<?= BASE_URL ?>/product/detail/<?= $item['id'] ?>">
                                <?php if (!empty($item['image'])): ?>
                                    <img src="<?= BASE_URL . htmlspecialchars((string)$item['image']) ?>" alt="<?= htmlspecialchars((string)($item['name'] ?? 'Product')) ?>" loading="lazy">
                                <?php else: ?>
                                    <div class="product-image-placeholder">
                                        <i class="fa-solid fa-shoe-prints"></i>
                                    </div>
                                <?php endif; ?>
                            </a>

                            <div class="product-action">
                                <button class="btn-add-cart ajax-add-to-cart" data-id="<?= $item['id'] ?>" data-name="<?= htmlspecialchars($item['name']) ?>">
                                    <i class="fa-solid fa-cart-plus" style="margin-right: 8px;"></i> Thêm vào giỏ hàng
                                </button>
                            </div>
                        </div>

                        <div class="product-info">
                            <div class="product-brand"><?= htmlspecialchars((string)($item['category_name'] ?? '')) ?></div>
                            <h3 class="product-name"><?= htmlspecialchars((string)($item['name'] ?? '')) ?></h3>
                            <div class="product-meta">
                                <div class="product-price"><?= format_vnd($item['price'] ?? 0) ?></div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="empty-state">
                    <p>Chưa có sản phẩm để hiển thị. Hãy thêm sản phẩm vào database để trang chủ tự động cập nhật.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- PROMO BANNER -->
<section>
    <div class="container">
        <div class="promo-banner">
            <div class="promo-content">
                <span class="hero-tag" style="background-color: var(--primary-color); color: var(--bg-dark); border:none;">Ưu đãi độc quyền</span>
                <h2 class="promo-title">Giảm đến <br><span>50% OFF</span></h2>
                <p class="promo-desc">Săn ưu đãi theo mùa — số lượng có hạn. Theo dõi trang để cập nhật sản phẩm mới và deal tốt mỗi tuần.</p>
                <a class="btn btn-primary" href="<?= BASE_URL ?>/product">Xem sản phẩm <i class="fa-solid fa-arrow-right" style="margin-left: 8px;"></i></a>
            </div>
            <div class="promo-image">
                <svg viewBox="0 0 300 200" width="300" xmlns="http://www.w3.org/2000/svg">
                    <rect x="0" y="0" width="300" height="200" rx="10" fill="rgba(255,255,255,0.1)" stroke="var(--primary-color)" stroke-width="2"/>
                    <text x="150" y="110" font-family="Outfit" font-size="24" fill="var(--primary-color)" text-anchor="middle">KHUYẾN MÃI</text>
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
                <h2 class="section-title"><?= htmlspecialchars((string)($featured['new_arrivals_title'] ?? 'Hàng mới')) ?></h2>
            </div>
            <div class="section-actions">
                <a class="btn btn-outline btn-sm" href="<?= BASE_URL ?>/product">Xem tất cả</a>
            </div>
        </div>

        <div class="product-grid">
            <?php if (!empty($new_arrivals)): ?>
                <?php foreach ($new_arrivals as $item): ?>
                    <div class="product-card">
                        <div class="product-image">
                            <a href="<?= BASE_URL ?>/product/detail/<?= $item['id'] ?>">
                                <div class="product-action">
                                    <button class="btn-add-cart ajax-add-to-cart" data-id="<?= $item['id'] ?>" data-name="<?= htmlspecialchars($item['name']) ?>">
                                        <i class="fa-solid fa-cart-plus" style="margin-right: 8px;"></i> Thêm vào giỏ hàng
                                    </button>
                                </div>

                                <?php if (!empty($item['image'])): ?>
                                    <img src="<?= BASE_URL . htmlspecialchars((string)$item['image']) ?>" alt="<?= htmlspecialchars((string)($item['name'] ?? 'Product')) ?>" loading="lazy">
                                <?php else: ?>
                                    <div class="product-image-placeholder">
                                        <i class="fa-solid fa-shoe-prints"></i>
                                    </div>
                                <?php endif; ?>
                            </a>
                        </div>

                        <div class="product-info">
                            <div class="product-brand"><?= htmlspecialchars((string)($item['category_name'] ?? '')) ?></div>
                            <h3 class="product-name"><?= htmlspecialchars((string)($item['name'] ?? '')) ?></h3>
                            <div class="product-meta">
                                <div class="product-price"><?= format_vnd($item['price'] ?? 0) ?></div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="empty-state">
                    <p>Chưa có sản phẩm mới để hiển thị.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- ABOUT SECTION -->
<?php if (!empty($about['about_title']) || !empty($about['about_content'])): ?>
<section class="section-padding about-section">
    <div class="container">
        <div class="about-grid">
            <div class="about-copy">
                <span class="section-subtitle">About</span>
                <h2 class="section-title"><?= htmlspecialchars((string)($about['about_title'] ?? 'Về chúng tôi')) ?></h2>
                <p class="about-text"><?= nl2br(htmlspecialchars((string)($about['about_content'] ?? ''))) ?></p>
                <a class="btn btn-outline" href="<?= BASE_URL ?>/about">Xem thêm</a>
            </div>
            <div class="about-media">
                <?php if (!empty($about['about_image'])): ?>
                    <img src="<?= BASE_URL . htmlspecialchars((string)$about['about_image']) ?>" alt="About" loading="lazy">
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

