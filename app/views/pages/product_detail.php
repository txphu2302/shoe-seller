<div class="product-detail-container section-padding">
    <div class="container">


        <div class="detail-grid">
            <!-- Product Image Gallery -->
            <div class="detail-gallery">
                <div class="main-image">
                    <?php if (!empty($product['image'])): ?>
                        <img src="<?= BASE_URL . $product['image'] ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                    <?php else: ?>
                        <div class="product-image-placeholder">
                            <i class="fa-solid fa-shoe-prints"></i>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Product Info -->
            <div class="detail-info">
                <div class="detail-header">
                    <span class="detail-category"><?= htmlspecialchars($product['category_name']) ?></span>
                    <h1 class="detail-title"><?= htmlspecialchars($product['name']) ?></h1>
                    
                    <div class="detail-meta">
                        <div class="product-rating">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star-half-stroke"></i>
                            <span class="reviews-count">(4.5/5 - 24 đánh giá)</span>
                        </div>
                    </div>
                </div>

                <div class="detail-price-box">
                    <span class="detail-price">$<?= number_format($product['price'], 2) ?></span>
                </div>

                <div class="detail-desc">
                    <p><?= nl2br(htmlspecialchars($product['description'])) ?></p>
                </div>

                <!-- Add to cart form -->
                <form action="<?= BASE_URL ?>/cart/add" method="POST" class="add-to-cart-form">
                    <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                    
                    <div class="form-group mb-4">
                        <label class="form-label text-light mb-2">Chọn Size</label>
                        <div class="size-selector">
                            <input type="radio" name="size" id="size-39" value="39" class="d-none" required>
                            <label for="size-39" class="size-label">39</label>
                            
                            <input type="radio" name="size" id="size-40" value="40" class="d-none">
                            <label for="size-40" class="size-label">40</label>
                            
                            <input type="radio" name="size" id="size-41" value="41" class="d-none" checked>
                            <label for="size-41" class="size-label">41</label>
                            
                            <input type="radio" name="size" id="size-42" value="42" class="d-none">
                            <label for="size-42" class="size-label">42</label>
                            
                            <input type="radio" name="size" id="size-43" value="43" class="d-none">
                            <label for="size-43" class="size-label">43</label>
                        </div>
                    </div>

                    <div class="add-to-cart-actions">
                        <div class="quantity-selector">
                            <button type="button" class="qty-btn minus"><i class="fa-solid fa-minus"></i></button>
                            <input type="number" name="quantity" class="qty-input" value="1" min="1" max="10" readonly>
                            <button type="button" class="qty-btn plus"><i class="fa-solid fa-plus"></i></button>
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-add-large">
                            <i class="fa-solid fa-cart-plus me-2"></i> Thêm vào giỏ hàng
                        </button>
                    </div>
                </form>

                <div class="detail-features mt-5">
                    <div class="feature-item">
                        <div class="feature-icon"><i class="fa-solid fa-truck-fast"></i></div>
                        <div class="feature-text">
                            <h6>Giao hàng toàn quốc</h6>
                            <p>Miễn phí giao hàng cho đơn từ $200</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon"><i class="fa-solid fa-rotate-left"></i></div>
                        <div class="feature-text">
                            <h6>Đổi trả miễn phí</h6>
                            <p>Đổi trả miễn phí trong vòng 30 ngày</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon"><i class="fa-solid fa-shield-halved"></i></div>
                        <div class="feature-text">
                            <h6>Bảo hành chính hãng</h6>
                            <p>Cam kết hàng chính hãng 100%</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <?php if (!empty($related_products)): ?>
        <div class="related-products mt-5 pt-5 border-top border-dark">
            <h3 class="section-title mb-4">Sản phẩm liên quan</h3>
            <div class="product-grid">
                <?php foreach ($related_products as $rp): ?>
                    <?php if ($rp['id'] != $product['id']): ?>
                    <div class="product-card">
                        <div class="product-image">
                            <?php if (!empty($rp['image'])): ?>
                                <a href="<?= BASE_URL ?>/product/detail/<?= $rp['id'] ?>">
                                    <img src="<?= BASE_URL . $rp['image'] ?>" alt="<?= htmlspecialchars($rp['name']) ?>">
                                </a>
                            <?php else: ?>
                                <div class="product-image-placeholder">
                                    <i class="fa-solid fa-shoe-prints"></i>
                                </div>
                            <?php endif; ?>
                            
                            <div class="product-action">
                                <a href="<?= BASE_URL ?>/product/detail/<?= $rp['id'] ?>" class="btn-add-cart">Xem chi tiết</a>
                            </div>
                        </div>
                        <div class="product-info">
                            <div class="product-brand"><?= htmlspecialchars($rp['category_name']) ?></div>
                            <h3 class="product-name">
                                <a href="<?= BASE_URL ?>/product/detail/<?= $rp['id'] ?>"><?= htmlspecialchars($rp['name']) ?></a>
                            </h3>
                            <div class="product-meta">
                                <div class="product-price">$<?= number_format($rp['price'], 2) ?></div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const minusBtn = document.querySelector('.qty-btn.minus');
        const plusBtn = document.querySelector('.qty-btn.plus');
        const qtyInput = document.querySelector('.qty-input');

        if (minusBtn && plusBtn && qtyInput) {
            minusBtn.addEventListener('click', function() {
                let currentVal = parseInt(qtyInput.value);
                if (currentVal > parseInt(qtyInput.min)) {
                    qtyInput.value = currentVal - 1;
                }
            });

            plusBtn.addEventListener('click', function() {
                let currentVal = parseInt(qtyInput.value);
                if (currentVal < parseInt(qtyInput.max)) {
                    qtyInput.value = currentVal + 1;
                }
            });
        }
    });
</script>
