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
                        <strong>1900 1234</strong>
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

<!-- ================= CONTACT INFO CARDS ================= -->
<section class="contact-info-cards">
    <div class="container">
        <div class="info-cards-grid">
            <div class="info-card">
                <div class="info-card-icon" style="background: linear-gradient(135deg, #FBB03B, #e09b2e);">
                    <i class="fa-solid fa-phone-volume"></i>
                </div>
                <span class="info-card-label">HOTLINE 24/7</span>
                <h3 class="info-card-value">1900 1234</h3>
                <p class="info-card-desc">Miễn phí · Toàn quốc</p>
            </div>
            <div class="info-card">
                <div class="info-card-icon" style="background: linear-gradient(135deg, #FBB03B, #e09b2e);">
                    <i class="fa-solid fa-envelope"></i>
                </div>
                <span class="info-card-label">EMAIL</span>
                <h3 class="info-card-value">support@shoeseller.vn</h3>
                <p class="info-card-desc">Phản hồi trong ngày</p>
            </div>
            <div class="info-card">
                <div class="info-card-icon" style="background: linear-gradient(135deg, #FBB03B, #e09b2e);">
                    <i class="fa-solid fa-clock"></i>
                </div>
                <span class="info-card-label">GIỜ LÀM VIỆC</span>
                <h3 class="info-card-value">9:00 — 22:00</h3>
                <p class="info-card-desc">Tất cả các ngày trong tuần</p>
            </div>
        </div>
    </div>
</section>

<!-- ================= CONTACT FORM + MAP ================= -->
<section class="contact-form-section section-padding">
    <div class="container">
        <span class="section-subtitle">GỬI TIN NHẮN</span>
        <h2 class="section-title" style="margin-bottom: 8px;">Bạn cần hỗ trợ điều gì?</h2>
        <p class="contact-form-desc">Điền thông tin bên dưới, Google ShoeSeller sẽ liên hệ lại với bạn trong 24 giờ.</p>

        <div class="contact-form-grid">
            <form class="contact-form" action="<?= BASE_URL ?>/contact" method="POST" id="contactForm">
                <div class="form-row">
                    <div class="form-group">
                        <label for="contact_name">HỌ VÀ TÊN</label>
                        <input type="text" id="contact_name" name="name" placeholder="Nguyễn Văn A" required>
                    </div>
                    <div class="form-group">
                        <label for="contact_email">EMAIL</label>
                        <input type="email" id="contact_email" name="email" placeholder="ban@email.com" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="contact_phone">SỐ ĐIỆN THOẠI</label>
                        <input type="tel" id="contact_phone" name="phone" placeholder="0912 345 678">
                    </div>
                    <div class="form-group">
                        <label for="contact_subject">TIÊU ĐỀ</label>
                        <input type="text" id="contact_subject" name="subject" placeholder="Tư vấn sản phẩm">
                    </div>
                </div>
                <div class="form-group full-width">
                    <label for="contact_message">NỘI DUNG</label>
                    <textarea id="contact_message" name="message" rows="5" placeholder="Bạn cần hỗ trợ điều gì?" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary contact-submit">
                    Gửi liên hệ <i class="fa-solid fa-paper-plane"></i>
                </button>
            </form>

            <div class="contact-map-side">
                <!-- Google Maps embed -->
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
                <!-- Community Card -->
                <div class="contact-community-card">
                    <div class="community-card-overlay"></div>
                    <div class="community-card-content">
                        <span class="community-tag">THAM GIA CỘNG ĐỒNG</span>
                        <h3>Cộng đồng ShoeSeller Squad</h3>
                        <p>Tham gia nhận ưu đãi, theo dõi bộ sưu tập mới và kết nối với cộng đồng yêu giày.</p>
                        <div class="community-socials">
                            <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                            <a href="#"><i class="fa-brands fa-instagram"></i></a>
                            <a href="#"><i class="fa-brands fa-tiktok"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ================= STORE LOCATIONS ================= -->
<section class="store-locations section-padding" style="background-color: var(--bg-light);">
    <div class="container">
        <span class="section-subtitle">HỆ THỐNG CỬA HÀNG</span>
        <h2 class="section-title" style="margin-bottom: 48px;">Ghé ShoeSeller store</h2>

        <div class="stores-grid">
            <div class="store-card">
                <h4>TP. Hồ Chí Minh</h4>
                <ul>
                    <li><i class="fa-solid fa-location-dot"></i> 128 Đồng Khởi, Quận 1, TP.HCM</li>
                    <li><i class="fa-solid fa-phone"></i> 028 3822 8888</li>
                    <li><i class="fa-solid fa-clock"></i> 9:00 — 22:00 hằng ngày</li>
                </ul>
            </div>
            <div class="store-card">
                <h4>Hà Nội</h4>
                <ul>
                    <li><i class="fa-solid fa-location-dot"></i> 45 Lý Tương Kiệt, Hoàn Kiếm, Hà Nội</li>
                    <li><i class="fa-solid fa-phone"></i> 024 3818 8888</li>
                    <li><i class="fa-solid fa-clock"></i> 9:00 — 22:00 hằng ngày</li>
                </ul>
            </div>
            <div class="store-card">
                <h4>Đà Nẵng</h4>
                <ul>
                    <li><i class="fa-solid fa-location-dot"></i> 210 Bạch Đằng, Hải Châu, Đà Nẵng</li>
                    <li><i class="fa-solid fa-phone"></i> 0236 3888 888</li>
                    <li><i class="fa-solid fa-clock"></i> 9:30 — 21:30 hằng ngày</li>
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
                    <p>Nội thành: 1-2 ngày. Ngoại tỉnh: 3-5 ngày. Miễn phí vận chuyển cho đơn từ 1.000.000đ.</p>
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-icon"><i class="fa-solid fa-rotate-left"></i></div>
                <div>
                    <h4>Chính sách đổi trả?</h4>
                    <p>Đổi trả miễn phí trong 14 ngày nếu sản phẩm bị lỗi hoặc không đúng như mô tả. Giữ nguyên tem mác.</p>
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-icon"><i class="fa-solid fa-certificate"></i></div>
                <div>
                    <h4>Sản phẩm có chính hãng không?</h4>
                    <p>100% chính hãng. Mỗi sản phẩm đều kèm hóa đơn chứng nhận từ nhà phân phối ủy quyền.</p>
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-icon"><i class="fa-solid fa-comments"></i></div>
                <div>
                    <h4>Có hỗ trợ trả góp không?</h4>
                    <p>Có. Hỗ trợ trả góp qua thẻ tín dụng và các ví điện tử. Lãi suất 0% cho kỳ hạn 3 tháng.</p>
                </div>
            </div>
        </div>
    </div>
</section>
