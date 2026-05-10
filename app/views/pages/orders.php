<div class="orders-container section-padding">
    <div class="container">
        <h1 class="page-title mb-5">Lịch sử mua hàng</h1>

        <?php if (empty($orders)): ?>
            <div class="empty-orders text-center py-5">
                <div class="empty-icon mb-4">
                    <i class="fa-solid fa-box-open fa-4x text-muted"></i>
                </div>
                <h3 class="text-light">Bạn chưa có đơn hàng nào</h3>
                <p class="text-muted mb-4">Bắt đầu mua sắm để lấp đầy lịch sử của bạn!</p>
                <a href="<?= BASE_URL ?>/product" class="btn btn-primary">Mua sắm ngay</a>
            </div>
        <?php else: ?>
            <div class="orders-list">
                <?php foreach ($orders as $order): ?>
                    <div class="order-card mb-4">
                        <div class="order-header">
                            <div class="order-id">
                                <span class="text-gray">Mã đơn hàng:</span>
                                <strong>#<?= $order['id'] ?></strong>
                            </div>
                            <div class="order-status">
                                <span class="badge status-<?= $order['status'] ?>">
                                    <?php 
                                        $statusText = [
                                            'pending' => 'Chờ xử lý',
                                            'processing' => 'Đang xử lý',
                                            'completed' => 'Đã hoàn thành',
                                            'cancelled' => 'Đã hủy'
                                        ];
                                        echo $statusText[$order['status']] ?? $order['status'];
                                    ?>
                                </span>
                            </div>
                        </div>
                        
                        <div class="order-body">
                            <div class="order-items">
                                <?php foreach ($order['items'] as $item): ?>
                                    <div class="order-item">
                                        <div class="item-img-xs">
                                            <img src="<?= BASE_URL . $item['product_image'] ?>" alt="<?= htmlspecialchars($item['product_name']) ?>">
                                        </div>
                                        <div class="item-details">
                                            <h5 class="item-name"><?= htmlspecialchars($item['product_name']) ?></h5>
                                            <p class="item-meta">Size: <?= $item['size'] ?> | SL: <?= $item['quantity'] ?></p>
                                        </div>
                                        <div class="item-price">
                                            $<?= number_format($item['price'] * $item['quantity'], 2) ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <div class="order-footer">
                            <div class="order-date">
                                <span class="text-gray">Ngày đặt:</span> <?= date('d/m/Y H:i', strtotime($order['created_at'])) ?>
                            </div>
                            <div class="order-total">
                                <span class="text-gray me-2">Tổng cộng:</span>
                                <span class="total-amount text-primary">$<?= number_format($order['total_amount'], 2) ?></span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>
