<?php
$categories = $categories ?? [];
$products = $products ?? [];
$selectedCategory = $selected_category ?? null;
$pagination = $pagination ?? [];

$currentPage = (int)($pagination['current_page'] ?? 1);
$totalPages = (int)($pagination['total_pages'] ?? 1);

if (!function_exists('format_vnd_product_page')) {
    function format_vnd_product_page($value)
    {
        return number_format((float)$value, 0, ',', '.') . 'đ';
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

function product_page_url($page, $selectedCategory)
{
    $params = ['page' => max(1, (int)$page)];
    if ($selectedCategory !== null) {
        $params['category'] = (int)$selectedCategory;
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
            <a href="<?= BASE_URL ?>/product" class="filter-chip <?= $selectedCategory === null ? 'is-active' : '' ?>">Tất cả</a>
            <?php foreach ($categories as $category): ?>
                <?php $catId = (int)($category['id'] ?? 0); ?>
                <a
                    href="<?= BASE_URL ?>/product?category=<?= $catId ?>"
                    class="filter-chip <?= $selectedCategory === $catId ? 'is-active' : '' ?>">
                    <?= htmlspecialchars((string)($category['name'] ?? '')) ?>
                </a>
            <?php endforeach; ?>
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
                        <a class="page-link" href="<?= htmlspecialchars(product_page_url($currentPage - 1, $selectedCategory)) ?>" aria-label="Trang trước">&laquo;</a>
                    <?php endif; ?>

                    <?php for ($page = 1; $page <= $totalPages; $page++): ?>
                        <a
                            class="page-link <?= $page === $currentPage ? 'is-active' : '' ?>"
                            href="<?= htmlspecialchars(product_page_url($page, $selectedCategory)) ?>"
                            <?= $page === $currentPage ? 'aria-current="page"' : '' ?>>
                            <?= $page ?>
                        </a>
                    <?php endfor; ?>

                    <?php if ($currentPage < $totalPages): ?>
                        <a class="page-link" href="<?= htmlspecialchars(product_page_url($currentPage + 1, $selectedCategory)) ?>" aria-label="Trang sau">&raquo;</a>
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