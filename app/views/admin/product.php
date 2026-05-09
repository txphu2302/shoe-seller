<?php
$products = $products ?? [];
$categories = $categories ?? [];
$filters = $filters ?? ['product_id' => '', 'name' => '', 'category_id' => ''];
$perPage = (int)($perPage ?? 25);
$currentPage = (int)($currentPage ?? 1);
$totalPages = (int)($totalPages ?? 1);
$totalProducts = (int)($totalProducts ?? 0);
$editProduct = $editProduct ?? null;
$mode = (string)($mode ?? '');
$alert = $alert ?? ['type' => '', 'message' => ''];

if (!function_exists('adminPrice')) {
    function adminPrice($price)
    {
        return number_format((float)$price, 2, '.', ',');
    }
}

if (!function_exists('adminProductUrl')) {
    function adminProductUrl($params, $filters, $perPage)
    {
        $query = [];
        if (!empty($filters['product_id'])) {
            $query['product_id'] = $filters['product_id'];
        }
        if (!empty($filters['name'])) {
            $query['name'] = $filters['name'];
        }
        if (!empty($filters['category_id'])) {
            $query['category_id'] = $filters['category_id'];
        }
        if (!empty($perPage)) {
            $query['per_page'] = (int)$perPage;
        }

        foreach ($params as $k => $v) {
            $query[$k] = $v;
        }

        return BASE_URL . '/admin/products' . (!empty($query) ? ('?' . http_build_query($query)) : '');
    }
}

$showAddForm = ($mode === 'add');
?>

<div class="row mt-4">
    <div class="col-12">
        <?php if (!empty($alert['message'])): ?>
            <div class="alert alert-<?= htmlspecialchars($alert['type'] ?: 'info') ?> alert-dismissible fade show" role="alert">
                <?= htmlspecialchars($alert['message']) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="mb-3">
            <a href="<?= BASE_URL ?>/admin/products?mode=add" class="btn btn-primary">Add a product</a>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <form method="GET" action="<?= BASE_URL ?>/admin/products" class="row g-3 align-items-end mb-3">
                    <div class="col-lg-3 col-md-6">
                        <label class="form-label">ProductID Input</label>
                        <input type="text" name="product_id" class="form-control" placeholder="Enter product ID" value="<?= htmlspecialchars((string)$filters['product_id']) ?>">
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <label class="form-label">Name Input</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter product name" value="<?= htmlspecialchars((string)$filters['name']) ?>">
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <label class="form-label">Category Input</label>
                        <select name="category_id" class="form-select">
                            <option value="">Choose</option>
                            <?php foreach ($categories as $category): ?>
                                <?php $categoryId = (int)($category['id'] ?? 0); ?>
                                <option value="<?= $categoryId ?>" <?= ((string)$filters['category_id'] === (string)$categoryId) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars((string)($category['name'] ?? '')) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-6 d-flex gap-2">
                        <button type="submit" class="btn btn-success">Search</button>
                        <a href="<?= BASE_URL ?>/admin/products" class="btn btn-secondary">Reset</a>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label mb-0">entries per page</label>
                        <select name="per_page" class="form-select">
                            <?php foreach ([10, 25, 50, 100] as $size): ?>
                                <option value="<?= $size ?>" <?= $perPage === $size ? 'selected' : '' ?>><?= $size ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>ProductID</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Category</th>
                                <th>Image</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($products)): ?>
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">Không có sản phẩm nào phù hợp bộ lọc.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($products as $product): ?>
                                    <tr>
                                        <td><?= (int)$product['id'] ?></td>
                                        <td><?= htmlspecialchars((string)$product['name']) ?></td>
                                        <td>$<?= adminPrice($product['price'] ?? 0) ?></td>
                                        <td><?= htmlspecialchars((string)($product['category_name'] ?? '')) ?></td>
                                        <td>
                                            <?php if (!empty($product['image'])): ?>
                                                <img src="<?= BASE_URL . htmlspecialchars((string)$product['image']) ?>" alt="product" style="width: 52px; height: 52px; object-fit: cover; border-radius: 6px;">
                                            <?php else: ?>
                                                <span class="text-muted">No image</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="<?= adminProductUrl(['edit' => (int)$product['id']], $filters, $perPage) ?>" class="btn btn-sm btn-primary">Edit</a>
                                            <form method="POST" action="<?= BASE_URL ?>/admin/products" class="d-inline" onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">
                                                <input type="hidden" name="action" value="delete">
                                                <input type="hidden" name="product_id" value="<?= (int)$product['id'] ?>">
                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <?php if ($totalPages > 1): ?>
                    <nav aria-label="Product pagination" class="mt-3">
                        <ul class="pagination justify-content-center mb-0">
                            <li class="page-item <?= $currentPage <= 1 ? 'disabled' : '' ?>">
                                <a class="page-link" href="<?= adminProductUrl(['page' => $currentPage - 1], $filters, $perPage) ?>">Previous</a>
                            </li>
                            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                <li class="page-item <?= $i === $currentPage ? 'active' : '' ?>">
                                    <a class="page-link" href="<?= adminProductUrl(['page' => $i], $filters, $perPage) ?>"><?= $i ?></a>
                                </li>
                            <?php endfor; ?>
                            <li class="page-item <?= $currentPage >= $totalPages ? 'disabled' : '' ?>">
                                <a class="page-link" href="<?= adminProductUrl(['page' => $currentPage + 1], $filters, $perPage) ?>">Next</a>
                            </li>
                        </ul>
                    </nav>
                <?php endif; ?>
            </div>
        </div>

        <?php if ($showAddForm): ?>
            <div class="card mb-4">
                <div class="card-body">
                    <h3 class="mb-3">Add Product</h3>
                    <form method="POST" action="<?= BASE_URL ?>/admin/products" enctype="multipart/form-data" class="row g-3">
                        <input type="hidden" name="action" value="create">
                        <div class="col-md-6">
                            <label class="form-label">Product Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Price</label>
                            <input type="number" name="price" class="form-control" min="0" step="0.01" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Category</label>
                            <select name="category_id" class="form-select" required>
                                <option value="">Choose category</option>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?= (int)$category['id'] ?>"><?= htmlspecialchars((string)$category['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Image (optional)</label>
                            <input type="file" name="image" class="form-control" accept="image/*">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="4"></textarea>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Create Product</button>
                            <a href="<?= BASE_URL ?>/admin/products" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        <?php endif; ?>

        <?php if (!empty($editProduct)): ?>
            <div class="card">
                <div class="card-body">
                    <h2 class="mb-3">Edit Product</h2>
                    <form method="POST" action="<?= BASE_URL ?>/admin/products" enctype="multipart/form-data" class="row g-3">
                        <input type="hidden" name="action" value="update">
                        <input type="hidden" name="product_id" value="<?= (int)$editProduct['id'] ?>">

                        <div class="col-md-6">
                            <label class="form-label">Product Name</label>
                            <input type="text" name="name" class="form-control" required value="<?= htmlspecialchars((string)$editProduct['name']) ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Price</label>
                            <input type="number" name="price" class="form-control" min="0" step="0.01" required value="<?= htmlspecialchars((string)$editProduct['price']) ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Category</label>
                            <select name="category_id" class="form-select" required>
                                <?php foreach ($categories as $category): ?>
                                    <?php $categoryId = (int)$category['id']; ?>
                                    <option value="<?= $categoryId ?>" <?= ((int)$editProduct['category_id'] === $categoryId) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars((string)$category['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Image (optional)</label>
                            <input type="file" name="image" class="form-control" accept="image/*">
                            <small class="text-muted">Leave blank to keep the current image.</small>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="4"><?= htmlspecialchars((string)($editProduct['description'] ?? '')) ?></textarea>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Update Product</button>
                            <a href="<?= BASE_URL ?>/admin/products" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>