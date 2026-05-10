<?php
$order = $order ?? [];
$orderItems = $orderItems ?? [];

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

function getStatusLabel($status) {
    $labels = [
        'pending' => 'Chờ xử lý',
        'processing' => 'Đang xử lý',
        'shipped' => 'Đang giao',
        'delivered' => 'Đã giao',
        'cancelled' => 'Đã hủy'
    ];
    return $labels[$status] ?? $status;
}

function formatPrice($price) {
    return '$' . number_format((float)$price, 2);
}

$statusColors = [
    'pending' => '#ffc107',
    'processing' => '#17a2b8',
    'shipped' => '#007bff',
    'delivered' => '#28a745',
    'cancelled' => '#dc3545'
];
?>

<div class="order-detail-container">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="page-title mb-1">
                <i class="fa-solid fa-file-invoice text-primary me-2"></i>
                Chi tiết Đơn hàng #<?= htmlspecialchars((string)($order['id'] ?? '')) ?>
            </h2>
            <p class="text-muted mb-0">
                Ngày đặt: <?= isset($order['created_at']) ? date('d/m/Y H:i:s', strtotime($order['created_at'])) : '-' ?>
            </p>
        </div>
        <a href="<?= BASE_URL ?>/admin/orders" class="btn btn-outline-secondary">
            <i class="fa-solid fa-arrow-left me-1"></i> Quay lại
        </a>
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

    <div class="row">
        <!-- Left Column: Order Info & Status -->
        <div class="col-lg-4">
            <!-- Status Card -->
            <div class="card mb-4 border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0"><i class="fa-solid fa-info-circle me-2"></i>Trạng thái đơn hàng</h5>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <?= getStatusBadge($order['status'] ?? 'pending') ?>
                    </div>
                    
                    <form method="POST" action="<?= BASE_URL ?>/admin/orders?view=<?= (int)($order['id'] ?? 0) ?>">
                        <div class="mb-3">
                            <label class="form-label">Cập nhật trạng thái</label>
                            <select name="status" class="form-select">
                                <option value="pending" <?= ($order['status'] ?? '') === 'pending' ? 'selected' : '' ?>>Chờ xử lý</option>
                                <option value="processing" <?= ($order['status'] ?? '') === 'processing' ? 'selected' : '' ?>>Đang xử lý</option>
                                <option value="shipped" <?= ($order['status'] ?? '') === 'shipped' ? 'selected' : '' ?>>Đang giao</option>
                                <option value="delivered" <?= ($order['status'] ?? '') === 'delivered' ? 'selected' : '' ?>>Đã giao</option>
                                <option value="cancelled" <?= ($order['status'] ?? '') === 'cancelled' ? 'selected' : '' ?>>Đã hủy</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fa-solid fa-save me-1"></i> Cập nhật trạng thái
                        </button>
                    </form>
                </div>
            </div>

            <!-- Customer Info -->
            <div class="card mb-4 border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0"><i class="fa-solid fa-user me-2"></i>Thông tin khách hàng</h5>
                </div>
                <div class="card-body">
                    <div class="customer-info">
                        <div class="info-item mb-3">
                            <label class="text-muted small">Họ tên</label>
                            <p class="mb-0 fw-medium"><?= htmlspecialchars((string)($order['user_name'] ?? 'Khách')) ?></p>
                        </div>
                        <div class="info-item mb-3">
                            <label class="text-muted small">Email</label>
                            <p class="mb-0"><?= htmlspecialchars((string)($order['user_email'] ?? 'N/A')) ?></p>
                        </div>
                        <div class="info-item">
                            <label class="text-muted small">Số điện thoại</label>
                            <p class="mb-0"><?= htmlspecialchars((string)($order['user_phone'] ?? 'N/A')) ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0"><i class="fa-solid fa-calculator me-2"></i>Tóm tắt đơn hàng</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Tạm tính</span>
                        <span><?= formatPrice($order['total_amount'] ?? 0) ?></span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Phí vận chuyển</span>
                        <span>Miễn phí</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <span class="fw-bold">Tổng cộng</span>
                        <span class="fw-bold text-primary fs-5"><?= formatPrice($order['total_amount'] ?? 0) ?></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Order Items -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0"><i class="fa-solid fa-shopping-bag me-2"></i>Sản phẩm trong đơn</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th class="text-center">Size</th>
                                    <th class="text-center">Số lượng</th>
                                    <th class="text-end">Đơn giá</th>
                                    <th class="text-end">Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($orderItems)): ?>
                                    <tr>
                                        <td colspan="5" class="text-center py-4 text-muted">
                                            Không có sản phẩm nào
                                        </td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($orderItems as $item): 
                                        $subtotal = ($item['price'] ?? 0) * ($item['quantity'] ?? 0);
                                    ?>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <?php if (!empty($item['product_image'])): ?>
                                                        <img src="<?= BASE_URL . htmlspecialchars($item['product_image']) ?>" 
                                                             alt="" class="product-thumb me-3">
                                                    <?php else: ?>
                                                        <div class="product-thumb-placeholder me-3">
                                                            <i class="fa-solid fa-shoe-prints"></i>
                                                        </div>
                                                    <?php endif; ?>
                                                    <span class="fw-medium"><?= htmlspecialchars((string)($item['product_name'] ?? 'Sản phẩm')) ?></span>
                                                </div>
                                            </td>
                                            <td class="text-center"><?= htmlspecialchars((string)($item['size'] ?? '-')) ?></td>
                                            <td class="text-center"><?= (int)($item['quantity'] ?? 0) ?></td>
                                            <td class="text-end"><?= formatPrice($item['price'] ?? 0) ?></td>
                                            <td class="text-end fw-medium"><?= formatPrice($subtotal) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Timeline -->
            <div class="card mt-4 border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0"><i class="fa-solid fa-history me-2"></i>Lịch sử đơn hàng</h5>
                </div>
                <div class="card-body">
                    <div class="order-timeline">
                        <?php 
                        $statuses = [
                            'pending' => ['icon' => 'fa-clock', 'label' => 'Đơn hàng được tạo', 'time' => $order['created_at'] ?? ''],
                            'processing' => ['icon' => 'fa-cog', 'label' => 'Đang xử lý', 'time' => ''],
                            'shipped' => ['icon' => 'fa-shipping-fast', 'label' => 'Đang giao hàng', 'time' => ''],
                            'delivered' => ['icon' => 'fa-check-circle', 'label' => 'Đã giao hàng', 'time' => '']
                        ];
                        $currentStatus = $order['status'] ?? 'pending';
                        $passed = true;
                        ?>
                        
                        <?php foreach ($statuses as $status => $info): 
                            $isCurrent = ($status === $currentStatus);
                            $isPassed = $passed;
                            if ($isCurrent) $passed = false;
                            $color = $statusColors[$status] ?? '#6c757d';
                        ?>
                            <div class="timeline-item <?= $isPassed ? 'completed' : ($isCurrent ? 'current' : '') ?>">
                                <div class="timeline-icon" style="background-color: <?= $isPassed || $isCurrent ? $color : '#e9ecef' ?>; color: <?= $isPassed || $isCurrent ? 'white' : '#6c757d' ?>">
                                    <i class="fa-solid <?= $info['icon'] ?>"></i>
                                </div>
                                <div class="timeline-content">
                                    <div class="fw-medium"><?= $info['label'] ?></div>
                                    <?php if ($isPassed && !empty($info['time'])): ?>
                                        <small class="text-muted"><?= date('d/m/Y H:i', strtotime($info['time'])) ?></small>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.order-detail-container {
    padding: 20px;
}
.page-title {
    font-size: 1.5rem;
    font-weight: 600;
    color: #333;
}
.badge {
    font-size: 1rem;
    padding: 0.6em 1em;
}
.customer-info .info-item label {
    display: block;
    margin-bottom: 0.25rem;
}
.product-thumb {
    width: 60px;
    height: 60px;
    object-fit: cover;
    border-radius: 8px;
}
.product-thumb-placeholder {
    width: 60px;
    height: 60px;
    border-radius: 8px;
    background: #f8f9fa;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #6c757d;
}
.order-timeline {
    position: relative;
    padding-left: 30px;
}
.order-timeline::before {
    content: '';
    position: absolute;
    left: 15px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: #e9ecef;
}
.timeline-item {
    position: relative;
    padding: 15px 0;
    padding-left: 30px;
}
.timeline-item::before {
    content: '';
    position: absolute;
    left: -23px;
    top: 22px;
    width: 16px;
    height: 2px;
    background: #e9ecef;
}
.timeline-item.completed::before {
    background: #28a745;
}
.timeline-icon {
    position: absolute;
    left: -38px;
    top: 10px;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.875rem;
    z-index: 1;
}
.timeline-item.current .timeline-icon {
    animation: pulse 2s infinite;
}
@keyframes pulse {
    0% { box-shadow: 0 0 0 0 rgba(0, 123, 255, 0.7); }
    70% { box-shadow: 0 0 0 10px rgba(0, 123, 255, 0); }
    100% { box-shadow: 0 0 0 0 rgba(0, 123, 255, 0); }
}
</style>
