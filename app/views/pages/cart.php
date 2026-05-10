<div class="cart-container section-padding">
    <div class="container">



        <h1 class="page-title mb-5">Giỏ hàng của bạn</h1>

        <?php if (isset($_SESSION['success_message'])): ?>
            <div class="alert alert-success alert-custom">
                <i class="fa-solid fa-check-circle"></i> <?= $_SESSION['success_message'] ?>
            </div>
            <?php unset($_SESSION['success_message']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['error_message'])): ?>
            <div class="alert alert-danger alert-custom">
                <i class="fa-solid fa-exclamation-circle"></i> <?= $_SESSION['error_message'] ?>
            </div>
            <?php unset($_SESSION['error_message']); ?>
        <?php endif; ?>

        <?php if (empty($cartItems)): ?>
            <div class="empty-cart text-center py-5">
                <div class="empty-cart-icon mb-4">
                    <i class="fa-solid fa-cart-shopping fa-4x text-muted"></i>
                </div>
                <h3 class="text-light mb-3">Giỏ hàng trống</h3>
                <p class="text-muted mb-4">Bạn chưa thêm bất kỳ sản phẩm nào vào giỏ hàng.</p>
                <a href="<?= BASE_URL ?>/product" class="btn btn-primary btn-lg px-5">Tiếp tục mua sắm</a>
            </div>
        <?php else: ?>
            <div class="cart-grid">
                <div class="cart-items-section">
                    <div class="cart-header d-none d-md-grid">
                        <div class="col-product">Sản phẩm</div>
                        <div class="col-price">Đơn giá</div>
                        <div class="col-qty">Số lượng</div>
                        <div class="col-subtotal">Thành tiền</div>
                        <div class="col-action"></div>
                    </div>
                    
                    <div class="cart-items-list">
                        <?php foreach ($cartItems as $item): ?>
                            <div class="cart-item">
                                <div class="col-product">
                                    <div class="item-img">
                                        <?php if (!empty($item['image'])): ?>
                                            <a href="<?= BASE_URL ?>/product/detail/<?= $item['product_id'] ?>">
                                                <img src="<?= BASE_URL . $item['image'] ?>" alt="<?= htmlspecialchars($item['name']) ?>">
                                            </a>
                                        <?php else: ?>
                                            <div class="item-img-placeholder">
                                                <i class="fa-solid fa-shoe-prints"></i>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="item-info">
                                        <h4 class="item-name">
                                            <a href="<?= BASE_URL ?>/product/detail/<?= $item['product_id'] ?>"><?= htmlspecialchars($item['name']) ?></a>
                                        </h4>
                                        <div class="item-meta text-muted">
                                            <span>Size: <?= htmlspecialchars($item['size']) ?></span>
                                        </div>
                                        <!-- Mobile only elements -->
                                        <div class="item-price-mobile d-md-none mt-2">
                                            $<?= number_format($item['price'], 2) ?>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-price d-none d-md-flex align-items-center">
                                    <span class="price-val">$<?= number_format($item['price'], 2) ?></span>
                                </div>
                                
                                <div class="col-qty d-flex align-items-center">
                                    <form action="<?= BASE_URL ?>/cart/update" method="POST" class="d-flex w-100">
                                        <input type="hidden" name="cart_id" value="<?= $item['cart_id'] ?>">
                                        <div class="quantity-control w-100">
                                            <input type="number" name="quantity" class="qty-input-cart" value="<?= $item['quantity'] ?>" min="1" max="10" onchange="this.form.submit()">
                                        </div>
                                    </form>
                                </div>
                                
                                <div class="col-subtotal d-none d-md-flex align-items-center">
                                    <span class="subtotal-val fw-bold text-primary">$<?= number_format($item['subtotal'], 2) ?></span>
                                </div>
                                
                                <div class="col-action d-flex align-items-center justify-content-end">
                                    <a href="<?= BASE_URL ?>/cart/remove/<?= $item['cart_id'] ?>" class="btn-remove" onclick="return confirm('Xóa sản phẩm này khỏi giỏ hàng?')" title="Xóa">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <div class="cart-actions mt-4 d-flex justify-content-between">
                        <a href="<?= BASE_URL ?>/product" class="btn btn-outline"><i class="fa-solid fa-arrow-left me-2"></i> Tiếp tục mua sắm</a>
                    </div>
                </div>

                <div class="cart-summary-section">
                    <div class="summary-card">
                        <h3 class="summary-title">Tóm tắt đơn hàng</h3>
                        
                        <div class="summary-row">
                            <span class="summary-label">Tạm tính</span>
                            <span class="summary-val">$<?= number_format($totalPrice, 2) ?></span>
                        </div>
                        
                        <div class="summary-row">
                            <span class="summary-label">Phí giao hàng</span>
                            <span class="summary-val">Miễn phí</span>
                        </div>
                        
                        <div class="summary-divider"></div>
                        
                        <div class="summary-row total-row">
                            <span class="summary-label">Tổng cộng</span>
                            <span class="summary-val text-primary">$<?= number_format($totalPrice, 2) ?></span>
                        </div>
                        
                        <a href="<?= BASE_URL ?>/checkout" class="btn btn-primary btn-checkout w-100 mt-4">
                            Tiến hành thanh toán <i class="fa-solid fa-arrow-right ms-2"></i>
                        </a>
                        
                        <div class="payment-methods mt-4 text-center">
                            <p class="text-muted small mb-2">Chấp nhận thanh toán</p>
                            <div class="payment-icons">
                                <i class="fa-brands fa-cc-visa"></i>
                                <i class="fa-brands fa-cc-mastercard"></i>
                                <i class="fa-brands fa-cc-paypal"></i>
                                <i class="fa-brands fa-cc-apple-pay"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
