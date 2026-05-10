<div class="success-container section-padding">
    <div class="container text-center">
        <div class="success-icon mb-4">
            <i class="fa-solid fa-circle-check fa-5x text-success"></i>
        </div>
        <h1 class="page-title text-light mb-3">Đặt hàng thành công!</h1>
        <p class="text-muted mb-4 fs-5">Cảm ơn bạn đã tin tưởng chọn ShoeSeller. Đơn hàng của bạn đang được xử lý.</p>
        
        <div class="order-info-card bg-dark p-4 rounded mb-5" style="max-width: 500px; margin: 0 auto; border: 1px solid rgba(255,255,255,0.05);">
            <p class="text-gray mb-2">Mã đơn hàng: <strong class="text-light">#<?= $orderId ?></strong></p>
            <p class="text-gray">Chúng tôi sẽ liên hệ với bạn sớm nhất để xác nhận đơn hàng.</p>
        </div>

        <div class="success-actions">
            <a href="<?= BASE_URL ?>/order/history" class="btn btn-primary me-3">Xem đơn hàng của tôi</a>
            <a href="<?= BASE_URL ?>/product" class="btn btn-outline">Tiếp tục mua sắm</a>
        </div>
    </div>
</div>
