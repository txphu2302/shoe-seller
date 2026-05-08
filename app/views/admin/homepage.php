<?php
// Đảm bảo các biến có giá trị mặc định
$heroData = $heroData ?? [];
$featuredProducts = $featuredProducts ?? [];
$brands = $brands ?? [];
$aboutData = $aboutData ?? [];
$currentPage = $currentPage ?? 1;
?>

<style>
/* Tab Navigation Styling */
.homepage-tabs {
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    margin-bottom: 20px;
}

.homepage-tabs .nav-pills .nav-link {
    color: #666;
    font-weight: 500;
    padding: 12px 20px;
    border-radius: 6px;
    margin: 0 4px;
    transition: all 0.3s ease;
}

.homepage-tabs .nav-pills .nav-link:hover {
    background: #f8f9fa;
    color: #b68a58;
}

.homepage-tabs .nav-pills .nav-link.active {
    background: linear-gradient(135deg, #b68a58 0%, #8b6f47 100%);
    color: white;
    box-shadow: 0 4px 15px rgba(182, 138, 88, 0.3);
}

.homepage-tabs .nav-link i {
    margin-right: 8px;
    font-size: 16px;
}

/* Card Styling */
.homepage-card {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.08);
    border: none;
}

.homepage-card .card-header {
    background: linear-gradient(135deg, #f8f9fa 0%, #fff 100%);
    border-bottom: 1px solid #eee;
    padding: 20px 24px;
    border-radius: 12px 12px 0 0;
}

.homepage-card .card-title {
    font-weight: 600;
    color: #333;
    margin: 0;
    font-size: 18px;
}

.homepage-card .card-body {
    padding: 24px;
}

/* Image Upload Zone */
.upload-zone {
    border: 2px dashed #ddd;
    border-radius: 8px;
    padding: 40px 20px;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s ease;
    background: #fafafa;
}

.upload-zone:hover {
    border-color: #b68a58;
    background: #fff9f5;
}

.upload-zone i {
    font-size: 48px;
    color: #ccc;
    margin-bottom: 12px;
}

.upload-zone:hover i {
    color: #b68a58;
}

.upload-zone p {
    color: #666;
    margin: 0;
}

.current-image {
    max-height: 200px;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

/* Form Styling */
.form-label {
    font-weight: 500;
    color: #555;
    margin-bottom: 8px;
}

.form-control:focus, .form-select:focus {
    border-color: #b68a58;
    box-shadow: 0 0 0 0.2rem rgba(182, 138, 88, 0.25);
}

.btn-primary {
    background: linear-gradient(135deg, #b68a58 0%, #8b6f47 100%);
    border: none;
    padding: 10px 24px;
    font-weight: 500;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #a67a48 0%, #7b5f37 100%);
    box-shadow: 0 4px 12px rgba(182, 138, 88, 0.4);
}

.btn-outline-secondary {
    border-color: #ddd;
    color: #666;
}

.btn-outline-secondary:hover {
    background: #f8f9fa;
    border-color: #b68a58;
    color: #b68a58;
}

/* Brand Item */
.brand-item {
    background: #f8f9fa;
    border-radius: 8px;
    padding: 16px;
    margin-bottom: 12px;
    border: 1px solid #eee;
}

.brand-number {
    width: 28px;
    height: 28px;
    background: #b68a58;
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 12px;
}

/* Alert */
.alert-success {
    background: #d4edda;
    border-color: #c3e6cb;
    color: #155724;
}

.alert-danger {
    background: #f8d7da;
    border-color: #f5c6cb;
    color: #721c24;
}
</style>

<!-- Tab Navigation -->
<div class="homepage-tabs">
    <div class="card-body">
        <ul class="nav nav-pills justify-content-center" id="homepageTabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link <?= $currentPage == 1 ? 'active' : '' ?>" href="?page=1">
                    <i class="fa-solid fa-image"></i> Hero Banner
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $currentPage == 2 ? 'active' : '' ?>" href="?page=2">
                    <i class="fa-solid fa-star"></i> Sản phẩm nổi bật
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $currentPage == 3 ? 'active' : '' ?>" href="?page=3">
                    <i class="fa-solid fa-building"></i> Brands & Giới thiệu
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= BASE_URL ?>/admin/settings">
                    <i class="fa-solid fa-gear"></i> Cài đặt Website
                </a>
            </li>
        </ul>
    </div>
</div>

<!-- AJAX Notification Container -->
<div id="ajaxNotification"></div>

<?php if ($currentPage == 1): ?>
<!-- Tab 1: Hero Banner Management -->
<div class="homepage-card card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa-solid fa-image text-warning me-2"></i>
            Quản lý Hero Banner
        </h3>
    </div>
    <div class="card-body">
        <form id="heroForm" enctype="multipart/form-data">
            <div class="row">
                <!-- Left Column: Image -->
                <div class="col-lg-6">
                    <div class="mb-4">
                        <label class="form-label">Ảnh nền hiện tại</label>
                        <div class="mb-3">
                            <img src="<?= BASE_URL . htmlspecialchars($heroData['hero_background'] ?? '/public/images/hero-bg.jpg') ?>" 
                                 alt="Hero Background" 
                                 class="current-image img-fluid"
                                 id="heroPreview">
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Thay đổi ảnh nền</label>
                        <div class="upload-zone" onclick="document.getElementById('heroBackground').click()">
                            <i class="fa-solid fa-cloud-arrow-up"></i>
                            <p><strong>Kéo thả ảnh vào đây</strong></p>
                            <p class="text-muted">hoặc click để chọn file</p>
                            <small class="text-muted">JPG, PNG, GIF, WEBP (tối đa 5MB)</small>
                        </div>
                        <input type="file" 
                               id="heroBackground" 
                               name="hero_background" 
                               class="d-none" 
                               accept="image/jpeg,image/jpg,image/png,image/gif,image/webp"
                               onchange="previewImage(this, 'heroPreview')">
                    </div>
                </div>
                
                <!-- Right Column: Text Content -->
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">Tiêu đề phụ <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control" 
                               name="hero_subtitle" 
                               value="<?= htmlspecialchars($heroData['hero_subtitle'] ?? 'GIÀY ĐẸP GIÁ TỐT') ?>" 
                               placeholder="VD: GIÀY ĐẸP GIÁ TỐT"
                               required>
                        <small class="text-muted">Tiêu đề nhỏ phía trên tiêu đề chính</small>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Tiêu đề chính <span class="text-danger">*</span></label>
                        <textarea class="form-control" 
                                  name="hero_title" 
                                  rows="2" 
                                  placeholder="VD: Hàng hiệu giá tốt lên đến 50%"
                                  required><?= htmlspecialchars($heroData['hero_title'] ?? 'Hàng hiệu giá tốt lên đến 50%') ?></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Mô tả</label>
                        <textarea class="form-control" 
                                  name="hero_description" 
                                  rows="3" 
                                  placeholder="Mô tả ngắn về chương trình khuyến mãi"><?= htmlspecialchars($heroData['hero_description'] ?? '') ?></textarea>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Text nút CTA</label>
                                <input type="text" 
                                       class="form-control" 
                                       name="hero_button_text" 
                                       value="<?= htmlspecialchars($heroData['hero_button_text'] ?? 'MUA NGAY') ?>" 
                                       placeholder="VD: MUA NGAY">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Link nút CTA</label>
                                <select class="form-select" name="hero_button_link">
                                    <option value="/products" <?= ($heroData['hero_button_link'] ?? '') == '/products' ? 'selected' : '' ?>>Trang sản phẩm</option>
                                    <option value="/" <?= ($heroData['hero_button_link'] ?? '') == '/' ? 'selected' : '' ?>>Trang chủ</option>
                                    <option value="/about" <?= ($heroData['hero_button_link'] ?? '') == '/about' ? 'selected' : '' ?>>Giới thiệu</option>
                                    <option value="/contact" <?= ($heroData['hero_button_link'] ?? '') == '/contact' ? 'selected' : '' ?>>Liên hệ</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-end mt-4">
                <button type="button" class="btn btn-outline-secondary me-2" onclick="window.open('/', '_blank')">
                    <i class="fa-solid fa-eye me-1"></i> Xem trước
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-save me-1"></i> Lưu thay đổi
                </button>
            </div>
        </form>
    </div>
</div>
<?php endif; ?>

<?php if ($currentPage == 2): ?>
<!-- Tab 2: Featured Products -->
<div class="homepage-card card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa-solid fa-star text-warning me-2"></i>
            Quản lý Sản phẩm nổi bật
        </h3>
    </div>
    <div class="card-body">
        <form id="featuredForm">
            <div class="row">
                <!-- Best Sellers Section -->
                <div class="col-lg-6">
                    <div class="card border">
                        <div class="card-header bg-light">
                            <h5 class="mb-0"><i class="fa-solid fa-fire text-danger me-2"></i>Bán chạy (Best Sellers)</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Tiêu đề section</label>
                                <input type="text" 
                                       class="form-control" 
                                       name="best_sellers_title" 
                                       value="<?= htmlspecialchars($featuredProducts['best_sellers_title'] ?? 'BÁN CHẠY') ?>"
                                       placeholder="VD: BÁN CHẠY">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Số lượng hiển thị</label>
                                <select class="form-select" name="best_sellers_count">
                                    <?php for ($i = 4; $i <= 12; $i += 2): ?>
                                        <option value="<?= $i ?>" <?= ($featuredProducts['best_sellers_count'] ?? 8) == $i ? 'selected' : '' ?>><?= $i ?> sản phẩm</option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                            <div class="alert alert-info">
                                <i class="fa-solid fa-info-circle me-2"></i>
                                Sản phẩm bán chạy sẽ được chọn tự động dựa trên số lượng bán ra.
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- New Arrivals Section -->
                <div class="col-lg-6">
                    <div class="card border">
                        <div class="card-header bg-light">
                            <h5 class="mb-0"><i class="fa-solid fa-sparkles text-success me-2"></i>Hàng mới (New Arrivals)</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Tiêu đề section</label>
                                <input type="text" 
                                       class="form-control" 
                                       name="new_arrivals_title" 
                                       value="<?= htmlspecialchars($featuredProducts['new_arrivals_title'] ?? 'HÀNG MỚI') ?>"
                                       placeholder="VD: HÀNG MỚI">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Số lượng hiển thị</label>
                                <select class="form-select" name="new_arrivals_count">
                                    <?php for ($i = 2; $i <= 8; $i += 2): ?>
                                        <option value="<?= $i ?>" <?= ($featuredProducts['new_arrivals_count'] ?? 4) == $i ? 'selected' : '' ?>><?= $i ?> sản phẩm</option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                            <div class="alert alert-info">
                                <i class="fa-solid fa-info-circle me-2"></i>
                                Hàng mới sẽ được chọn tự động dựa trên ngày thêm sản phẩm.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-end mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-save me-1"></i> Lưu thay đổi
                </button>
            </div>
        </form>
    </div>
</div>
<?php endif; ?>

<?php if ($currentPage == 3): ?>
<!-- Tab 3: Brands & About -->
<div class="homepage-card card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa-solid fa-building text-warning me-2"></i>
            Quản lý Brands & Giới thiệu
        </h3>
    </div>
    <div class="card-body">
        <form id="brandsAboutForm" enctype="multipart/form-data">
            <!-- Brands Section -->
            <h5 class="mb-3"><i class="fa-solid fa-truck-fast me-2"></i>Logo thương hiệu chạy ngang (Marquee)</h5>
            <div class="row mb-4">
                <?php for ($i = 0; $i < 6; $i++): 
                    $brand = $brands[$i] ?? ['name' => 'Brand ' . ($i + 1), 'logo' => '', 'link' => '#'];
                ?>
                <div class="col-lg-4 col-md-6">
                    <div class="brand-item">
                        <div class="d-flex align-items-center mb-2">
                            <span class="brand-number me-2"><?= $i + 1 ?></span>
                            <strong>Thương hiệu <?= $i + 1 ?></strong>
                        </div>
                        <div class="mb-2">
                            <input type="text" 
                                   class="form-control form-control-sm" 
                                   name="brand_name_<?= $i + 1 ?>" 
                                   value="<?= htmlspecialchars($brand['name']) ?>"
                                   placeholder="Tên thương hiệu">
                        </div>
                        <div class="mb-2">
                            <input type="text" 
                                   class="form-control form-control-sm" 
                                   name="brand_link_<?= $i + 1 ?>" 
                                   value="<?= htmlspecialchars($brand['link']) ?>"
                                   placeholder="Link website">
                        </div>
                        <div class="mb-2">
                            <input type="file" 
                                   class="form-control form-control-sm" 
                                   name="brand_logo_<?= $i + 1 ?>"
                                   accept="image/*">
                            <?php if (!empty($brand['logo'])): ?>
                                <small class="text-muted">Logo hiện tại: <a href="<?= BASE_URL . $brand['logo'] ?>" target="_blank">Xem</a></small>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endfor; ?>
            </div>
            
            <hr class="my-4">
            
            <!-- About Section -->
            <h5 class="mb-3"><i class="fa-solid fa-circle-info me-2"></i>Giới thiệu trên trang chủ</h5>
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">Tiêu đề</label>
                        <input type="text" 
                               class="form-control" 
                               name="about_title" 
                               value="<?= htmlspecialchars($aboutData['about_title'] ?? 'Về Shoe Seller') ?>"
                               placeholder="Tiêu đề phần giới thiệu">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nội dung</label>
                        <textarea class="form-control" 
                                  name="about_content" 
                                  rows="6" 
                                  placeholder="Nội dung giới thiệu về cửa hàng"><?= htmlspecialchars($aboutData['about_content'] ?? '') ?></textarea>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">Ảnh giới thiệu hiện tại</label>
                        <div class="mb-2">
                            <?php if (!empty($aboutData['about_image'])): ?>
                                <img src="<?= BASE_URL . $aboutData['about_image'] ?>" class="current-image img-fluid" alt="About Image">
                            <?php else: ?>
                                <div class="text-muted">Chưa có ảnh</div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Thay đổi ảnh</label>
                        <input type="file" 
                               class="form-control" 
                               name="about_image"
                               accept="image/*">
                    </div>
                </div>
            </div>
            
            <div class="text-end mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-save me-1"></i> Lưu thay đổi
                </button>
            </div>
        </form>
    </div>
</div>
<?php endif; ?>

<?php if ($currentPage == 4): ?>
<!-- Tab 4: Site Settings -->
<div class="homepage-card card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa-solid fa-gear text-warning me-2"></i>
            Thông tin công ty
        </h3>
    </div>
    <div class="card-body">
        <form id="siteSettingsForm" enctype="multipart/form-data">
            <div class="row">
                <!-- Logo & Basic Info -->
                <div class="col-lg-4">
                    <div class="mb-4 text-center">
                        <label class="form-label">Logo website</label>
                        <div class="mb-3">
                            <?php if (!empty($siteSettings['logo'])): ?>
                                <img src="<?= BASE_URL . $siteSettings['logo'] ?>" class="current-image" alt="Logo" style="max-height: 100px;">
                            <?php else: ?>
                                <div class="p-4 bg-light rounded">
                                    <i class="fa-solid fa-image fa-3x text-muted"></i>
                                    <p class="text-muted mt-2">Chưa có logo</p>
                                </div>
                            <?php endif; ?>
                        </div>
                        <input type="file" 
                               class="form-control" 
                               name="logo"
                               accept="image/*">
                    </div>
                </div>
                
                <!-- Contact Info -->
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tên công ty <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control" 
                                   name="company_name" 
                                   value="<?= htmlspecialchars($siteSettings['company_name'] ?? 'Shoe Seller') ?>"
                                   required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Số điện thoại <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control" 
                                   name="phone" 
                                   value="<?= htmlspecialchars($siteSettings['phone'] ?? '') ?>"
                                   placeholder="(+84) 123-456-789"
                                   required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" 
                                   class="form-control" 
                                   name="email" 
                                   value="<?= htmlspecialchars($siteSettings['email'] ?? '') ?>"
                                   placeholder="contact@shoeseller.com"
                                   required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Địa chỉ</label>
                            <input type="text" 
                                   class="form-control" 
                                   name="address" 
                                   value="<?= htmlspecialchars($siteSettings['address'] ?? '') ?>"
                                   placeholder="123 Đường ABC, TP.HCM">
                        </div>
                    </div>
                    
                    <hr class="my-3">
                    
                    <h6 class="mb-3"><i class="fa-solid fa-share-nodes me-2"></i>Mạng xã hội</h6>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label"><i class="fa-brands fa-facebook me-1 text-primary"></i>Facebook</label>
                            <input type="url" 
                                   class="form-control" 
                                   name="facebook" 
                                   value="<?= htmlspecialchars($siteSettings['facebook'] ?? '') ?>"
                                   placeholder="https://facebook.com/...">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label"><i class="fa-brands fa-instagram me-1 text-danger"></i>Instagram</label>
                            <input type="url" 
                                   class="form-control" 
                                   name="instagram" 
                                   value="<?= htmlspecialchars($siteSettings['instagram'] ?? '') ?>"
                                   placeholder="https://instagram.com/...">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label"><i class="fa-brands fa-twitter me-1 text-info"></i>Twitter/X</label>
                            <input type="url" 
                                   class="form-control" 
                                   name="twitter" 
                                   value="<?= htmlspecialchars($siteSettings['twitter'] ?? '') ?>"
                                   placeholder="https://twitter.com/...">
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-end mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-save me-1"></i> Lưu thay đổi
                </button>
            </div>
        </form>
    </div>
</div>
<?php endif; ?>

<script>
// Preview image before upload
function previewImage(input, previewId) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById(previewId).src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
}

// Show notification
function showNotification(message, type = 'success') {
    const notification = document.getElementById('ajaxNotification');
    notification.innerHTML = `
        <div class="alert alert-${type} alert-dismissible fade show" role="alert">
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    `;
    
    // Auto dismiss after 3 seconds
    setTimeout(() => {
        const alert = notification.querySelector('.alert');
        if (alert) {
            alert.remove();
        }
    }, 3000);
}

// Handle Hero Form Submit
document.getElementById('heroForm')?.addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    
    fetch('<?= BASE_URL ?>/homepage/updateHero', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showNotification(data.message, 'success');
        } else {
            showNotification(data.error || 'Có lỗi xảy ra', 'danger');
        }
    })
    .catch(error => {
        showNotification('Lỗi kết nối server', 'danger');
    });
});

// Handle Featured Products Form
document.getElementById('featuredForm')?.addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    
    fetch('<?= BASE_URL ?>/homepage/updateFeaturedProducts', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showNotification(data.message, 'success');
        } else {
            showNotification(data.error || 'Có lỗi xảy ra', 'danger');
        }
    })
    .catch(error => {
        showNotification('Lỗi kết nối server', 'danger');
    });
});

// Handle Brands & About Form
document.getElementById('brandsAboutForm')?.addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    
    fetch('<?= BASE_URL ?>/homepage/updateBrandsAbout', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showNotification(data.message, 'success');
        } else {
            showNotification(data.error || 'Có lỗi xảy ra', 'danger');
        }
    })
    .catch(error => {
        showNotification('Lỗi kết nối server', 'danger');
    });
});

</script>
