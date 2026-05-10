<?php
$categories = $categories ?? [];
$products = $products ?? [];
$selectedCategory = $selected_category ?? null;
$searchKeyword = $search_keyword ?? '';
$pagination = $pagination ?? [];

$currentPage = (int)($pagination['current_page'] ?? 1);
$totalPages = (int)($pagination['total_pages'] ?? 1);

if (!function_exists('format_vnd_product_page')) {
    function format_vnd_product_page($value)
    {
        return '$' . number_format((float)$value, 2);
    }
}

function product_image_src($image)
{
    $image = (string)$image;
    if ($image === '') {
        return '';
    }

    if (str_starts_with($image, 'http://') || str_starts_with($image, 'https://')) {
        return $image;
    }

    if (str_starts_with($image, '/')) {
        return BASE_URL . $image;
    }

    return BASE_URL . '/' . ltrim($image, '/');
}

function product_page_url($page, $selectedCategory, $searchKeyword = '')
{
    $params = ['page' => max(1, (int)$page)];
    if ($selectedCategory !== null) {
        $params['category'] = (int)$selectedCategory;
    }
    if (!empty($searchKeyword)) {
        $params['search'] = $searchKeyword;
    }

    return BASE_URL . '/product?' . http_build_query($params);
}
?>

<section class="product-page">
    <div class="container">
        <div class="product-page-head">
            <h1>Danh sách sản phẩm</h1>
            <p>Khám phá các mẫu giày mới nhất và lọc nhanh theo danh mục.</p>
        </div>

        <div class="category-filter" role="tablist" aria-label="Lọc theo danh mục">
            <a href="<?= BASE_URL ?>/product<?= !empty($searchKeyword) ? '?search=' . urlencode($searchKeyword) : '' ?>" class="filter-chip <?= $selectedCategory === null ? 'is-active' : '' ?>">Tất cả</a>
            <?php foreach ($categories as $category): ?>
                <?php $catId = (int)($category['id'] ?? 0); ?>
                <?php $catUrl = BASE_URL . '/product?category=' . $catId; ?>
                <?php if (!empty($searchKeyword)) $catUrl .= '&search=' . urlencode($searchKeyword); ?>
                <a
                    href="<?= $catUrl ?>"
                    class="filter-chip <?= $selectedCategory === $catId ? 'is-active' : '' ?>">
                    <?= htmlspecialchars((string)($category['name'] ?? '')) ?>
                </a>
            <?php endforeach; ?>
        </div>

        <!-- Search Section -->
        <div class="search-section mb-4">
            <form method="GET" action="<?= BASE_URL ?>/product" class="search-form">
                <div class="input-group">
                    <input type="text" 
                           name="search" 
                           class="form-control" 
                           placeholder="Tìm kiếm sản phẩm..." 
                           value="<?= htmlspecialchars($searchKeyword) ?>">
                    <?php if ($selectedCategory !== null): ?>
                        <input type="hidden" name="category" value="<?= $selectedCategory ?>">
                    <?php endif; ?>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-search me-1"></i> Tìm kiếm
                    </button>
                    <?php if (!empty($searchKeyword)): ?>
                        <a href="<?= BASE_URL ?>/product<?= $selectedCategory !== null ? '?category=' . $selectedCategory : '' ?>" class="btn btn-outline-secondary">
                            <i class="fa-solid fa-times"></i>
                        </a>
                    <?php endif; ?>
                </div>
            </form>
            <?php if (!empty($searchKeyword)): ?>
                <div class="search-results-info mt-2">
                    <small class="text-muted">
                        Kết quả tìm kiếm cho: <strong>"<?= htmlspecialchars($searchKeyword) ?>"</strong>
                        (<?= $pagination['total_products'] ?? 0 ?> sản phẩm)
                    </small>
                </div>
            <?php endif; ?>
        </div>

        <?php if (!empty($products)): ?>
            <div class="product-grid product-grid-page">
                <?php foreach ($products as $item): ?>
                    <?php $imgSrc = product_image_src($item['image'] ?? ''); ?>
                    <article class="product-card">
                        <div class="product-image">
                            <a href="<?= BASE_URL ?>/product/detail/<?= $item['id'] ?>">
                                <?php if (!empty($imgSrc)): ?>
                                    <img src="<?= htmlspecialchars($imgSrc) ?>" alt="<?= htmlspecialchars((string)($item['name'] ?? 'Sản phẩm')) ?>" loading="lazy">
                                <?php else: ?>
                                    <div class="product-image-placeholder"><i class="fa-solid fa-shoe-prints"></i></div>
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
                            <h3 class="product-name">
                                <a href="<?= BASE_URL ?>/product/detail/<?= $item['id'] ?>"><?= htmlspecialchars((string)($item['name'] ?? '')) ?></a>
                            </h3>
                            <p class="product-desc"><?= htmlspecialchars((string)($item['description'] ?? '')) ?></p>
                            <div class="product-price"><?= format_vnd_product_page($item['price'] ?? 0) ?></div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>

            <?php if ($totalPages > 1): ?>
                <nav class="pagination" aria-label="Phân trang sản phẩm">
                    <?php if ($currentPage > 1): ?>
                        <a class="page-link" href="<?= htmlspecialchars(product_page_url($currentPage - 1, $selectedCategory, $searchKeyword)) ?>" aria-label="Trang trước">&laquo;</a>
                    <?php endif; ?>

                    <?php for ($page = 1; $page <= $totalPages; $page++): ?>
                        <a
                            class="page-link <?= $page === $currentPage ? 'is-active' : '' ?>"
                            href="<?= htmlspecialchars(product_page_url($page, $selectedCategory, $searchKeyword)) ?>"
                            <?= $page === $currentPage ? 'aria-current="page"' : '' ?>>
                            <?= $page ?>
                        </a>
                    <?php endfor; ?>

                    <?php if ($currentPage < $totalPages): ?>
                        <a class="page-link" href="<?= htmlspecialchars(product_page_url($currentPage + 1, $selectedCategory, $searchKeyword)) ?>" aria-label="Trang sau">&raquo;</a>
                    <?php endif; ?>
                </nav>
            <?php endif; ?>
        <?php else: ?>
            <div class="empty-state product-empty">
                <p>Không tìm thấy sản phẩm trong danh mục đã chọn.</p>
            </div>
        <?php endif; ?>

    </div>
</section>