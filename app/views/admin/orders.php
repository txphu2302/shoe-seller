<?php
$orders = $orders ?? [];
$filters = $filters ?? ['status' => '', 'order_id' => '', 'user_name' => ''];
$currentPage = (int)($currentPage ?? 1);
$perPage = (int)($perPage ?? 25);
$totalPages = (int)($totalPages ?? 1);
$totalOrders = (int)($totalOrders ?? 0);

function getStatusBadge($status) {
    $badges = [
        'pending' => '<span class="badge bg-warning">Chờ xử lý</span>',
        'processing' => '<span class="badge bg-info">Đang xử lý</span>',
        'shipped' => '<span class="badge bg-primary">Đang giao</span>',
        'delivered' => '<span class="badge bg-success">Đã giao</span>',
        'cancelled' => '<span class="badge bg-danger">Đã hủy</span>'
    ];
    return $badges[$status] ?? '<span class="badge bg-secondary">' . htmlspecialchars($status) . '</span>';
}

function formatPrice($price) {
    return '$' . number_format((float)$price, 2);
}

function ordersUrl($params, $filters, $perPage) {
    $query = [];
    if (!empty($filters['status'])) $query['status'] = $filters['status'];
    if (!empty($filters['order_id'])) $query['order_id'] = $filters['order_id'];
    if (!empty($filters['user_name'])) $query['user_name'] = $filters['user_name'];
    if (!empty($perPage)) $query['per_page'] = $perPage;
    
    foreach ($params as $k => $v) {
        $query[$k] = $v;
    }
    
    return BASE_URL . '/admin/orders' . (!empty($query) ? ('?' . http_build_query($query)) : '');
}
?>

<div class="orders-container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="page-title">
            <i class="fa-solid fa-box text-primary me-2"></i>
            Quản lý Đơn hàng
        </h2>
    </div>

    <?php if (isset($_SESSION['success_message'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($_SESSION['success_message']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php unset($_SESSION['success_message']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['error_message'])): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($_SESSION['error_message']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php unset($_SESSION['error_message']); ?>
    <?php endif; ?>

    <!-- Filter Section -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="<?= BASE_URL ?>/admin/orders" class="row g-3 align-items-end">
                <div class="col-lg-3 col-md-6">
                    <label class="form-label">Mã đơn hàng</label>
                    <input type="text" name="order_id" class="form-control" placeholder="Nhập mã đơn" value="<?= htmlspecialchars((string)$filters['order_id']) ?>">
                </div>
                <div class="col-lg-3 col-md-6">
                    <label class="form-label">Tên khách hàng</label>
                    <input type="text" name="user_name" class="form-control" placeholder="Nhập tên khách hàng" value="<?= htmlspecialchars((string)$filters['user_name']) ?>">
                </div>
                <div class="col-lg-2 col-md-6">
                    <label class="form-label">Trạng thái</label>
                    <select name="status" class="form-select">
                        <option value="">Tất cả</option>
                        <option value="pending" <?= $filters['status'] === 'pending' ? 'selected' : '' ?>>Chờ xử lý</option>
                        <option value="processing" <?= $filters['status'] === 'processing' ? 'selected' : '' ?>>Đang xử lý</option>
                        <option value="shipped" <?= $filters['status'] === 'shipped' ? 'selected' : '' ?>>Đang giao</option>
                        <option value="delivered" <?= $filters['status'] === 'delivered' ? 'selected' : '' ?>>Đã giao</option>
                        <option value="cancelled" <?= $filters['status'] === 'cancelled' ? 'selected' : '' ?>>Đã hủy</option>
                    </select>
                </div>
                <div class="col-lg-2 col-md-6">
                    <label class="form-label">Số mục/trang</label>
                    <select name="per_page" class="form-select">
                        <?php foreach ([10, 25, 50, 100] as $size): ?>
                            <option value="<?= $size ?>" <?= $perPage === $size ? 'selected' : '' ?>><?= $size ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-lg-2 col-md-12 d-flex gap-2">
                    <button type="submit" class="btn btn-success w-100">
                        <i class="fa-solid fa-search me-1"></i> Tìm kiếm
                    </button>
                    <a href="<?= BASE_URL ?>/admin/orders" class="btn btn-secondary">
                        <i class="fa-solid fa-refresh"></i>
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Orders Table -->
    <div class="card">
        <div class="card-header bg-light d-flex justify-content-between align-items-center">
            <span><strong><?= $totalOrders ?></strong> đơn hàng</span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center">#</th>
                            <th>Mã đơn</th>
                            <th>Khách hàng</th>
                            <th>Tổng tiền</th>
                            <th>Trạng thái</th>
                            <th>Ngày đặt</th>
                            <th class="text-center">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($orders)): ?>
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">
                                    <i class="fa-solid fa-inbox fa-2x mb-2"></i>
                                    <p>Không tìm thấy đơn hàng nào</p>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($orders as $index => $order): ?>
                                <tr>
                                    <td class="text-center"><?= $offset + $index + 1 ?></td>
                                    <td>
                                        <span class="fw-bold">#<?= htmlspecialchars((string)($order['id'] ?? '')) ?></span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="fa-solid fa-user text-muted me-2"></i>
                                            <div>
                                                <div class="fw-medium"><?= htmlspecialchars((string)($order['user_name'] ?? 'Khách')) ?></div>
                                                <small class="text-muted"><?= htmlspecialchars((string)($order['user_email'] ?? '')) ?></small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bold text-primary"><?= formatPrice($order['total_amount'] ?? 0) ?></span>
                                    </td>
                                    <td><?= getStatusBadge($order['status'] ?? 'pending') ?></td>
                                    <td>
                                        <small class="text-muted">
                                            <?= isset($order['created_at']) ? date('d/m/Y H:i', strtotime($order['created_at'])) : '-' ?>
                                        </small>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a href="<?= BASE_URL ?>/admin/orders?view=<?= (int)($order['id'] ?? 0) ?>" class="btn btn-sm btn-outline-primary" title="Xem chi tiết">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                            <a href="<?= BASE_URL ?>/admin/orders?delete=<?= (int)($order['id'] ?? 0) ?>" 
                                               class="btn btn-sm btn-outline-danger" 
                                               title="Xóa"
                                               onclick="return confirm('Bạn có chắc muốn xóa đơn hàng này?')">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    <?php if ($totalPages > 1): ?>
        <nav aria-label="Page navigation" class="mt-4">
            <ul class="pagination justify-content-center">
                <li class="page-item <?= $currentPage <= 1 ? 'disabled' : '' ?>">
                    <a class="page-link" href="<?= ordersUrl(['page' => $currentPage - 1], $filters, $perPage) ?>">
                        <i class="fa-solid fa-chevron-left"></i>
                    </a>
                </li>
                
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <?php if ($i == 1 || $i == $totalPages || ($i >= $currentPage - 2 && $i <= $currentPage + 2)): ?>
                        <li class="page-item <?= $i === $currentPage ? 'active' : '' ?>">
                            <a class="page-link" href="<?= ordersUrl(['page' => $i], $filters, $perPage) ?>"><?= $i ?></a>
                        </li>
                    <?php elseif ($i == $currentPage - 3 || $i == $currentPage + 3): ?>
                        <li class="page-item disabled"><span class="page-link">...</span></li>
                    <?php endif; ?>
                <?php endfor; ?>
                
                <li class="page-item <?= $currentPage >= $totalPages ? 'disabled' : '' ?>">
                    <a class="page-link" href="<?= ordersUrl(['page' => $currentPage + 1], $filters, $perPage) ?>">
                        <i class="fa-solid fa-chevron-right"></i>
                    </a>
                </li>
            </ul>
        </nav>
    <?php endif; ?>
</div>

<style>
.orders-container {
    padding: 20px;
}
.page-title {
    font-size: 1.5rem;
    font-weight: 600;
    color: #333;
    margin-bottom: 0;
}
.badge {
    font-size: 0.75rem;
    padding: 0.5em 0.8em;
}
.table th {
    font-weight: 600;
    font-size: 0.875rem;
}
.table td {
    font-size: 0.875rem;
}
.btn-group .btn {
    padding: 0.25rem 0.5rem;
}
.pagination .page-link {
    color: #b68a58;
}
.pagination .page-item.active .page-link {
    background-color: #b68a58;
    border-color: #b68a58;
    color: white;
}
</style>
