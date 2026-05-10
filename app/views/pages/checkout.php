<div class="checkout-container section-padding">
    <div class="container">
        <h1 class="page-title mb-5">Thanh toán</h1>

        <form action="<?= BASE_URL ?>/checkout/process" method="POST" class="checkout-form">
            <div class="checkout-grid">
                <!-- Shipping Info -->
                <div class="checkout-section">
                    <div class="checkout-card">
                        <h3 class="card-title"><i class="fa-solid fa-truck me-2"></i> Thông tin giao hàng</h3>
                        
                        <div class="form-group mb-3">
                            <label class="form-label">Họ và tên</label>
                            <input type="text" name="name" class="form-control-custom" value="<?= htmlspecialchars($user['name']) ?>" required>
                        </div>
                        
                        <div class="form-group mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control-custom" value="<?= htmlspecialchars($user['email']) ?>" required>
                        </div>
                        
                        <div class="form-group mb-3">
                            <label class="form-label">Số điện thoại</label>
                            <input type="text" name="phone" class="form-control-custom" placeholder="Nhập số điện thoại của bạn" required>
                        </div>
                        
                        <div class="form-group mb-3">
                            <label class="form-label">Địa chỉ nhận hàng</label>
                            <textarea name="address" class="form-control-custom" rows="3" placeholder="Nhập địa chỉ giao hàng cụ thể" required></textarea>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Ghi chú (Tùy chọn)</label>
                            <textarea name="note" class="form-control-custom" rows="2" placeholder="Ví dụ: Giao giờ hành chính..."></textarea>
                        </div>
                    </div>

                    <div class="checkout-card mt-4">
                        <h3 class="card-title"><i class="fa-solid fa-credit-card me-2"></i> Phương thức thanh toán</h3>
                        
                        <div class="payment-options">
                            <div class="payment-option">
                                <input type="radio" name="payment_method" id="cod" value="cod" checked>
                                <label for="cod" class="payment-label">
                                    <i class="fa-solid fa-money-bill-1-wave"></i>
                                    <span>Thanh toán khi nhận hàng (COD)</span>
                                </label>
                            </div>
                            
                            <div class="payment-option">
                                <input type="radio" name="payment_method" id="bank" value="bank">
                                <label for="bank" class="payment-label">
                                    <i class="fa-solid fa-building-columns"></i>
                                    <span>Chuyển khoản ngân hàng</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="checkout-summary-section">
                    <div class="summary-card">
                        <h3 class="summary-title">Đơn hàng của bạn</h3>
                        
                        <div class="checkout-items-list mb-4">
                            <?php foreach ($cartItems as $item): ?>
                                <div class="checkout-item">
                                    <div class="item-img-sm">
                                        <img src="<?= BASE_URL . $item['image'] ?>" alt="<?= htmlspecialchars($item['name']) ?>">
                                        <span class="item-qty-badge"><?= $item['quantity'] ?></span>
                                    </div>
                                    <div class="item-info-sm">
                                        <p class="item-name-sm"><?= htmlspecialchars($item['name']) ?></p>
                                        <p class="item-meta-sm">Size: <?= $item['size'] ?></p>
                                    </div>
                                    <div class="item-price-sm">
                                        $<?= number_format($item['subtotal'], 2) ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="summary-row">
                            <span>Tạm tính</span>
                            <span>$<?= number_format($totalPrice, 2) ?></span>
                        </div>
                        <div class="summary-row">
                            <span>Phí vận chuyển</span>
                            <span class="text-success">Miễn phí</span>
                        </div>
                        
                        <div class="summary-divider"></div>
                        
                        <div class="summary-row total-row">
                            <span>Tổng cộng</span>
                            <span class="text-primary">$<?= number_format($totalPrice, 2) ?></span>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mt-4">
                            ĐẶT HÀNG NGAY <i class="fa-solid fa-check ms-2"></i>
                        </button>
                        
                        <p class="text-center text-muted small mt-3">
                            <i class="fa-solid fa-shield-halved me-1"></i> Thanh toán an toàn & bảo mật
                        </p>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
