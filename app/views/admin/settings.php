<!-- settings management area start -->
<div class="row mt-5">
    <div class="col-12">
        <?php if (!empty($success)): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa-solid fa-check-circle"></i> <?= $success ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php foreach ($errors as $error): ?>
                    <div><i class="fa-solid fa-exclamation-circle"></i> <?= $error ?></div>
                <?php endforeach; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-4"><i class="fa-solid fa-cog text-warning"></i> Cài đặt Website</h4>
                
                <form action="" method="post" enctype="multipart/form-data">
                    <!-- Company Information -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <h5 class="border-bottom pb-2 mb-3"><i class="fa-solid fa-building"></i> Thông tin Công ty</h5>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="company_name" class="form-label">Tên công ty</label>
                            <input type="text" class="form-control" id="company_name" name="company_name" 
                                   value="<?= htmlspecialchars($settings['company_name'] ?? 'Shoe Seller Inc.') ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email liên hệ</label>
                            <input type="email" class="form-control" id="email" name="email" 
                                   value="<?= htmlspecialchars($settings['email'] ?? 'info@shoeseller.com') ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">Số điện thoại</label>
                            <input type="text" class="form-control" id="phone" name="phone" 
                                   value="<?= htmlspecialchars($settings['phone'] ?? '0123456789') ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="address" class="form-label">Địa chỉ</label>
                            <input type="text" class="form-control" id="address" name="address" 
                                   value="<?= htmlspecialchars($settings['address'] ?? 'Ho Chi Minh City, Vietnam') ?>">
                        </div>
                    </div>

                    <!-- Logo -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <h5 class="border-bottom pb-2 mb-3"><i class="fa-solid fa-image"></i> Logo</h5>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="logo_file" class="form-label">Upload Logo mới</label>
                            <input type="file" class="form-control" id="logo_file" name="logo_file" accept="image/*">
                            <small class="text-muted">Chấp nhận: JPEG, PNG, GIF, WEBP (Tối đa 2MB)</small>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Logo hiện tại</label>
                            <div class="border p-2 rounded">
                                <?php if (!empty($settings['logo']) && $settings['logo'] !== 'default_logo.png'): ?>
                                    <img src="<?= BASE_URL ?>/public/<?= $settings['logo'] ?>" alt="Logo" style="max-height: 60px;">
                                <?php else: ?>
                                    <span class="text-muted"><i class="fa-solid fa-image"></i> Sử dụng logo mặc định</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Social Media -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <h5 class="border-bottom pb-2 mb-3"><i class="fa-solid fa-share-alt"></i> Mạng xã hội</h5>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="facebook" class="form-label">Facebook URL</label>
                            <input type="url" class="form-control" id="facebook" name="facebook" 
                                   value="<?= htmlspecialchars($settings['facebook'] ?? '') ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="instagram" class="form-label">Instagram URL</label>
                            <input type="url" class="form-control" id="instagram" name="instagram" 
                                   value="<?= htmlspecialchars($settings['instagram'] ?? '') ?>">
                        </div>
                    </div>

                    <!-- About Section -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <h5 class="border-bottom pb-2 mb-3"><i class="fa-solid fa-info-circle"></i> Giới thiệu</h5>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="about_short" class="form-label">Giới thiệu ngắn</label>
                            <textarea class="form-control" id="about_short" name="about_short" rows="4"><?= htmlspecialchars($settings['about_short'] ?? 'We sell the best shoes in the world.') ?></textarea>
                            <small class="text-muted">Hiển thị ở footer và trang giới thiệu</small>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-gold px-5">
                                <i class="fa-solid fa-save"></i> Lưu thay đổi
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- settings management area end -->
