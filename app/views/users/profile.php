<div class="profile-container">
    <?php if (isset($_SESSION['success_message'])): ?>
        <div class="profile-alert profile-alert-success">
            <i class="fa-solid fa-check-circle"></i> <?= $_SESSION['success_message'] ?>
        </div>
        <?php unset($_SESSION['success_message']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['error_message'])): ?>
        <div class="profile-alert profile-alert-danger">
            <i class="fa-solid fa-exclamation-circle"></i> <?= $_SESSION['error_message'] ?>
        </div>
        <?php unset($_SESSION['error_message']); ?>
    <?php endif; ?>

    <div class="profile-grid">
        <!-- Sidebar -->
        <aside class="profile-sidebar-wrapper">
            <div class="profile-card">
                <div class="profile-sidebar-header">
                    <div class="avatar-wrapper">
                        <?php if (!empty($user->avatar)): ?>
                            <img src="<?= BASE_URL . $user->avatar ?>" alt="Avatar" class="profile-avatar">
                        <?php else: ?>
                            <div class="profile-avatar-placeholder">
                                <?= strtoupper(substr($user->name, 0, 1)) ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <h3 class="profile-name"><?= htmlspecialchars($user->name) ?></h3>
                    <p class="profile-email"><?= htmlspecialchars($user->email) ?></p>
                </div>
                <div class="profile-menu">
                    <a href="<?= BASE_URL ?>/profile" class="profile-menu-item active">
                        <i class="fa-solid fa-user"></i> Hồ sơ cá nhân
                    </a>
                    <a href="<?= BASE_URL ?>/users/logout" class="profile-menu-item text-danger" onclick="return confirm('Bạn có chắc muốn đăng xuất?')">
                        <i class="fa-solid fa-right-from-bracket"></i> Đăng xuất
                    </a>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="profile-main-content">
            <div class="profile-card">
                <div class="profile-card-body">
                    <h2 class="profile-section-title"><i class="fa-solid fa-user-pen"></i> Thông tin tài khoản</h2>
                    
                    <form action="<?= BASE_URL ?>/profile/update" method="POST" enctype="multipart/form-data" class="profile-form">
                        <div class="form-group">
                            <label class="form-label">Ảnh đại diện (Avatar)</label>
                            <input type="file" name="avatar" id="avatar" class="form-control" accept="image/*">
                            <small class="form-hint">Định dạng hỗ trợ: JPG, PNG, WEBP. Tối đa 2MB.</small>
                        </div>

                        <div class="form-row">
                            <div class="form-group half-width">
                                <label for="name" class="form-label">Họ và tên</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($user->name) ?>" required>
                            </div>
                            <div class="form-group half-width">
                                <label for="email" class="form-label">Địa chỉ Email</label>
                                <input type="email" class="form-control" id="email" value="<?= htmlspecialchars($user->email) ?>" readonly>
                                <small class="form-hint">Không thể thay đổi email sau khi đăng ký.</small>
                            </div>
                        </div>

                        <hr class="profile-divider">

                        <h3 class="profile-section-title mb-1">Đổi mật khẩu <span class="title-hint">(Bỏ trống nếu không muốn đổi)</span></h3>
                        
                        <div class="form-group">
                            <label for="current_password" class="form-label">Mật khẩu hiện tại</label>
                            <input type="password" class="form-control" id="current_password" name="current_password">
                        </div>
                        <div class="form-row">
                            <div class="form-group half-width">
                                <label for="new_password" class="form-label">Mật khẩu mới</label>
                                <input type="password" class="form-control" id="new_password" name="new_password">
                            </div>
                            <div class="form-group half-width">
                                <label for="confirm_password" class="form-label">Xác nhận mật khẩu mới</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn-save-profile">
                                <i class="fa-solid fa-save"></i> Lưu thay đổi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>

<script>
    document.querySelector('.profile-form').addEventListener('submit', function(e) {
        var newPass = document.getElementById('new_password').value;
        var confPass = document.getElementById('confirm_password').value;
        if (newPass !== '' && newPass !== confPass) {
            e.preventDefault();
            alert('Mật khẩu xác nhận không khớp!');
        }
    });
</script>
