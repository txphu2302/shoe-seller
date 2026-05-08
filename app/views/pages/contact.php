<!-- ================= CONTACT HERO ================= -->
<section class="contact-hero">
    <div class="container">
        <div class="contact-hero-inner">
            <div class="contact-hero-content">
                <span class="contact-hero-tag">GET IN TOUCH</span>
                <h1 class="contact-hero-title">Trò chuyện<br>cùng <span>ShoeSeller.</span></h1>
                <p class="contact-hero-desc">Đội ngũ chăm sóc khách hàng của chúng tôi sẵn sàng hỗ trợ bạn 24/7 — từ tư vấn sản phẩm, theo dõi đơn hàng đến đổi trả dễ dàng.</p>
                <div class="contact-hero-badges">
                    <span class="contact-badge"><i class="fa-solid fa-headset"></i> Live chat 24/7</span>
                    <span class="contact-badge"><i class="fa-solid fa-wrench"></i> Hỗ trợ kỹ thuật</span>
                    <span class="contact-badge"><i class="fa-solid fa-clock"></i> Phản hồi &lt; 24h</span>
                </div>
            </div>
            <div class="contact-hero-right">
                <!-- Floating badges on the right -->
                <div class="contact-float-card contact-float-hotline">
                    <i class="fa-solid fa-phone"></i>
                    <div>
                        <span class="float-label">Hotline</span>
                        <strong><?= $settings['phone'] ?? '1900 1234' ?></strong>
                    </div>
                </div>
                <div class="contact-float-card contact-float-review">
                    <i class="fa-solid fa-star"></i>
                    <div>
                        <span class="float-label">Đánh giá</span>
                        <strong>4.9 / 5 sao</strong>
                    </div>
                </div>
                <div class="contact-float-card contact-float-response">
                    <i class="fa-solid fa-bolt"></i>
                    <div>
                        <span class="float-label">Phản hồi</span>
                        <strong>&lt; 15 phút</strong>
                    </div>
                </div>
                <!-- Hero shoe image placeholder -->
                <div class="contact-hero-shoe">
                    <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg" width="260" height="260">
                        <defs>
                            <linearGradient id="shoeGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" style="stop-color:#FBB03B;stop-opacity:0.8"/>
                                <stop offset="100%" style="stop-color:#e09b2e;stop-opacity:0.6"/>
                            </linearGradient>
                        </defs>
                        <circle cx="100" cy="100" r="90" fill="rgba(251,176,59,0.1)" stroke="rgba(251,176,59,0.2)" stroke-width="1"/>
                        <text x="100" y="95" text-anchor="middle" font-size="50" fill="url(#shoeGrad)">👟</text>
                        <text x="100" y="130" text-anchor="middle" font-size="11" fill="#999" font-family="Outfit">Premium Collection</text>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- ================= CONTACT FORM + MAP (LIGHT) ================= -->
<section class="contact-form-section section-padding">
    <div class="container">
        <span class="section-subtitle contact-kicker">GỬI TIN NHẮN</span>
        <h1 class="contact-heading">Bạn cần hỗ trợ điều gì?</h1>
        <p class="contact-form-desc">Điền thông tin bên dưới, đội ngũ Shoe Seller sẽ liên hệ lại trong vòng 24 giờ.</p>

        <div class="contact-form-grid">
            <div>

                <?php if (!empty($success)): ?>
                    <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
                <?php endif; ?>
                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                <?php endif; ?>

                <form method="post" class="contact-form" id="contactForm">
                    <div class="form-row">
                        <div class="form-group">
                            <label>Họ và tên <span class="req">*</span></label>
                            <input type="text" name="name" placeholder="Nguyễn Văn A" required>
                        </div>
                        <div class="form-group">
                            <label>Email <span class="req">*</span></label>
                            <input type="email" name="email" placeholder="ban@email.com" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Số điện thoại</label>
                            <input type="text" name="phone" placeholder="0901 234 567">
                        </div>
                        <div class="form-group">
                            <label>Tiêu đề</label>
                            <input type="text" name="subject" placeholder="Tư vấn sản phẩm">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Nội dung <span class="req">*</span></label>
                        <textarea name="message" id="contactMessage" rows="7" maxlength="1000" placeholder="Bạn cần hỗ trợ điều gì?" required></textarea>
                        <div class="field-meta">
                            <span></span>
                            <span id="messageCounter">0/1000</span>
                        </div>
                    </div>
                    <button class="btn btn-primary contact-submit" type="submit">
                        Gửi liên hệ <i class="fa-solid fa-paper-plane"></i>
                    </button>
                </form>
            </div>

            <div class="contact-map-side">
                <div class="contact-map-wrapper">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.394747117587!2d106.68194637486087!3d10.782167089362!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f3ae5901c2d%3A0x6a0b2c511f28ef1!2zMTI4IMSQ4buTbmcgS2jhu51pLCBRdeG6rW4gMSwgVGjDoG5oIHBo4buRIEjhu5MgQ2jDrSBNaW5o!5e0!3m2!1svi!2s!4f13.1"
                        width="100%"
                        height="300"
                        style="border:0; border-radius: 16px;"
                        allowfullscreen=""
                        loading="lazy"
                        title="ShoeSeller Location Map">
                    </iframe>
                </div>

                <div class="contact-community-card">
                    <div class="community-card-overlay"></div>
                    <div class="community-card-content">
                        <span class="community-tag">THEO DÕI CHÚNG TÔI</span>
                        <h3>Cộng đồng ShoeSeller Squad</h3>
                        <p>Cập nhật collection mới nhất, behind-the-scenes và ưu đãi độc quyền dành riêng cho follower.</p>
                        <div class="community-socials">
                            <a href="<?= $settings['facebook'] ?? '#' ?>" target="_blank" rel="noopener"><i class="fa-brands fa-facebook-f"></i></a>
                            <a href="<?= $settings['instagram'] ?? '#' ?>" target="_blank" rel="noopener"><i class="fa-brands fa-instagram"></i></a>
                            <a href="<?= $settings['twitter'] ?? '#' ?>" target="_blank" rel="noopener"><i class="fa-brands fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ================= STORE LOCATIONS ================= -->
<section class="store-locations section-padding" style="background-color: #fff;">
    <div class="container">
        <span class="section-subtitle">HỆ THỐNG CỬA HÀNG</span>
        <h2 class="section-title" style="margin-bottom: 48px;">Ghé ShoeSeller store</h2>

        <div class="stores-grid">
            <div class="store-card">
                <h4>TP. Hồ Chí Minh</h4>
                <ul>
                    <li><i class="fa-solid fa-location-dot"></i> <?= htmlspecialchars($settings['address'] ?? '128 Đồng Khởi, Quận 1, TP.HCM') ?></li>
                    <li><i class="fa-solid fa-phone"></i> <?= htmlspecialchars($settings['phone'] ?? '028 3823 8888') ?></li>
                    <li><i class="fa-solid fa-clock"></i> 9:00 — 22:00 hàng ngày</li>
                </ul>
            </div>
            <div class="store-card">
                <h4>Hà Nội</h4>
                <ul>
                    <li><i class="fa-solid fa-location-dot"></i> 45 Lý Thường Kiệt, Hoàn Kiếm, Hà Nội</li>
                    <li><i class="fa-solid fa-phone"></i> 024 3936 8888</li>
                    <li><i class="fa-solid fa-clock"></i> 9:00 — 22:00 hàng ngày</li>
                </ul>
            </div>
            <div class="store-card">
                <h4>Đà Nẵng</h4>
                <ul>
                    <li><i class="fa-solid fa-location-dot"></i> 212 Bạch Đằng, Hải Châu, Đà Nẵng</li>
                    <li><i class="fa-solid fa-phone"></i> 0236 3888 686</li>
                    <li><i class="fa-solid fa-clock"></i> 9:30 — 21:30 hàng ngày</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- ================= FAQ SECTION ================= -->
<section class="contact-faq section-padding">
    <div class="container">
        <div class="faq-grid">
            <div class="faq-item">
                <div class="faq-icon"><i class="fa-solid fa-truck-fast"></i></div>
                <div>
                    <h4>Thời gian giao hàng bao lâu?</h4>
                    <p>Nội thành 1-2 ngày, toàn quốc 2-5 ngày tùy khu vực. Miễn phí vận chuyển cho đơn từ 1.500.000₫.</p>
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-icon"><i class="fa-solid fa-rotate-left"></i></div>
                <div>
                    <h4>Chính sách đổi trả?</h4>
                    <p>Đổi/trả miễn phí trong 14 ngày kể từ ngày nhận hàng nếu sản phẩm còn nguyên tem mác và chưa qua sử dụng.</p>
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-icon"><i class="fa-solid fa-certificate"></i></div>
                <div>
                    <h4>Sản phẩm có chính hãng không?</h4>
                    <p>100% chính hãng. Shoe Seller cam kết hoàn tiền nếu phát hiện hàng giả/hàng nhái.</p>
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-icon"><i class="fa-solid fa-comments"></i></div>
                <div>
                    <h4>Có hỗ trợ trả góp không?</h4>
                    <p>Có. Hỗ trợ trả góp 0% qua thẻ tín dụng và các đối tác thanh toán.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
(() => {
    const textarea = document.getElementById('contactMessage');
    const counter = document.getElementById('messageCounter');
    if (!textarea || !counter) return;

    const update = () => {
        const max = Number(textarea.getAttribute('maxlength')) || 1000;
        counter.textContent = `${textarea.value.length}/${max}`;
    };

    textarea.addEventListener('input', update);
    update();
})();
</script>
