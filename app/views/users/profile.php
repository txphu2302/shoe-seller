<?php
if (!isset($_SESSION['user'])) {
    header('Location: ' . BASE_URL . '/users/login');
    exit;
}
$activeTab = $activeTab ?? 'info';
$u = $user ?? null;
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Hồ sơ cá nhân - ShoeSeller</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #c8a96e;
            --primary-dark: #a8843e;
            --dark-bg: #0f0f0f;
            --card-bg: #1a1a1a;
            --card-border: #2a2a2a;
            --text-main: #f0ede8;
            --text-muted: #8a8a8a;
            --input-bg: #222222;
            --input-border: #333333;
            --success-clr: #4ade80;
            --danger-clr: #f87171;
            --tab-active-bg: linear-gradient(135deg, #c8a96e, #a8843e);
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Inter', sans-serif;
            background: var(--dark-bg);
            color: var(--text-main);
            min-height: 100vh;
        }
        /* ─── TOPBAR ─── */
        .topbar {
            background: rgba(26,26,26,0.95);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--card-border);
            padding: 16px 0;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .topbar-inner {
            max-width: 1100px;
            margin: 0 auto;
            padding: 0 24px;
            display: flex;
            align-items: center;
            gap: 16px;
        }
        .logo-link {
            font-size: 1.4rem;
            font-weight: 800;
            color: var(--text-main);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .logo-link i { color: var(--primary); }
        .logo-link span { color: var(--primary); }
        .back-btn {
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 6px;
            color: var(--text-muted);
            text-decoration: none;
            font-size: 0.875rem;
            transition: color .2s;
        }
        .back-btn:hover { color: var(--primary); }

        /* ─── MAIN LAYOUT ─── */
        .profile-wrap {
            max-width: 960px;
            margin: 48px auto;
            padding: 0 24px 80px;
            display: grid;
            grid-template-columns: 280px 1fr;
            gap: 28px;
            align-items: start;
        }
        @media(max-width: 720px){
            .profile-wrap { grid-template-columns: 1fr; margin-top: 24px; }
        }

        /* ─── LEFT SIDEBAR ─── */
        .sidebar-card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 20px;
            overflow: hidden;
        }
        .sidebar-avatar-box {
            background: linear-gradient(135deg, #1e1e1e, #2a2a2a);
            padding: 32px 20px 24px;
            text-align: center;
            border-bottom: 1px solid var(--card-border);
        }
        .avatar-ring {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            padding: 3px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            margin: 0 auto 14px;
            display: block;
        }
        .avatar-ring img, .avatar-ring .avatar-placeholder {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
            display: block;
            background: #2e2e2e;
        }
        .avatar-placeholder {
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: var(--primary);
        }
        .sidebar-name {
            font-size: 1rem;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 4px;
        }
        .sidebar-email {
            font-size: 0.78rem;
            color: var(--text-muted);
        }
        .sidebar-badge {
            display: inline-block;
            margin-top: 10px;
            padding: 3px 12px;
            border-radius: 20px;
            font-size: 0.72rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .5px;
            background: rgba(200,169,110,.15);
            color: var(--primary);
            border: 1px solid rgba(200,169,110,.3);
        }
        .sidebar-nav { padding: 12px 0; }
        .sidebar-nav a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 13px 22px;
            color: var(--text-muted);
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all .2s;
            border-left: 3px solid transparent;
        }
        .sidebar-nav a:hover { color: var(--text-main); background: rgba(255,255,255,.04); }
        .sidebar-nav a.active {
            color: var(--primary);
            background: rgba(200,169,110,.08);
            border-left-color: var(--primary);
        }
        .sidebar-nav a i { width: 18px; text-align: center; font-size: 0.9rem; }

        /* ─── RIGHT PANEL ─── */
        .panel-card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 20px;
            overflow: hidden;
        }
        .panel-header {
            padding: 28px 32px 20px;
            border-bottom: 1px solid var(--card-border);
            display: flex;
            align-items: center;
            gap: 14px;
        }
        .panel-header-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            color: #fff;
            flex-shrink: 0;
        }
        .panel-title { font-size: 1.1rem; font-weight: 700; }
        .panel-subtitle { font-size: 0.8rem; color: var(--text-muted); margin-top: 2px; }
        .panel-body { padding: 32px; }

        /* ─── FORM ─── */
        .field-label {
            display: block;
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: .5px;
            margin-bottom: 8px;
        }
        .field-input {
            width: 100%;
            background: var(--input-bg);
            border: 1px solid var(--input-border);
            border-radius: 10px;
            padding: 12px 16px;
            color: var(--text-main);
            font-size: 0.9rem;
            font-family: 'Inter', sans-serif;
            outline: none;
            transition: border-color .2s, box-shadow .2s;
        }
        .field-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(200,169,110,.15);
        }
        .field-group { margin-bottom: 20px; }
        .field-group:last-of-type { margin-bottom: 0; }
        .input-icon-wrap { position: relative; }
        .input-icon-wrap .field-input { padding-left: 42px; }
        .input-icon-wrap .fi-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-size: 0.85rem;
        }

        .btn-save {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-top: 24px;
            padding: 12px 28px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: #fff;
            font-weight: 600;
            font-size: 0.9rem;
            border: none;
            cursor: pointer;
            transition: all .25s;
            text-decoration: none;
        }
        .btn-save:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(200,169,110,.4);
            color: #fff;
        }
        .btn-save:active { transform: translateY(0); }

        /* ─── ALERTS ─── */
        .alert-box {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            padding: 13px 16px;
            border-radius: 10px;
            font-size: 0.875rem;
            margin-bottom: 20px;
        }
        .alert-success {
            background: rgba(74,222,128,.1);
            border: 1px solid rgba(74,222,128,.25);
            color: var(--success-clr);
        }
        .alert-danger {
            background: rgba(248,113,113,.1);
            border: 1px solid rgba(248,113,113,.25);
            color: var(--danger-clr);
        }

        /* ─── AVATAR UPLOAD ZONE ─── */
        .upload-zone {
            border: 2px dashed var(--input-border);
            border-radius: 16px;
            padding: 40px 24px;
            text-align: center;
            cursor: pointer;
            transition: all .25s;
            position: relative;
        }
        .upload-zone:hover, .upload-zone.dragover {
            border-color: var(--primary);
            background: rgba(200,169,110,.06);
        }
        .upload-zone input[type="file"] {
            position: absolute;
            inset: 0;
            opacity: 0;
            cursor: pointer;
            width: 100%;
            height: 100%;
        }
        .upload-icon { font-size: 2.5rem; color: var(--primary); margin-bottom: 12px; }
        .upload-text { font-size: 0.9rem; color: var(--text-muted); }
        .upload-hint { font-size: 0.78rem; color: #555; margin-top: 6px; }
        #preview-wrap {
            margin-top: 20px;
            display: none;
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }
        #preview-img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--primary);
        }
        #preview-name { font-size: 0.8rem; color: var(--text-muted); }

        /* ─── CURRENT AVATAR DISPLAY ─── */
        .current-avatar-row {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 16px;
            background: rgba(255,255,255,.03);
            border-radius: 12px;
            margin-bottom: 24px;
        }
        .cur-avatar-img {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--primary);
        }
        .cur-avatar-placeholder {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            background: #2e2e2e;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            color: var(--primary);
            border: 2px solid var(--primary);
        }
        .cur-avatar-info p { font-size: 0.875rem; font-weight: 600; color: var(--text-main); margin-bottom: 2px; }
        .cur-avatar-info span { font-size: 0.78rem; color: var(--text-muted); }

        /* ─── PASSWORD STRENGTH ─── */
        .strength-bar {
            height: 4px;
            border-radius: 2px;
            background: var(--input-border);
            margin-top: 8px;
            overflow: hidden;
        }
        .strength-fill {
            height: 100%;
            border-radius: 2px;
            transition: width .3s, background .3s;
            width: 0%;
        }
        .strength-label {
            font-size: 0.75rem;
            margin-top: 4px;
            color: var(--text-muted);
        }
    </style>
</head>
<body>

<!-- TOPBAR -->
<div class="topbar">
    <div class="topbar-inner">
        <a href="<?= BASE_URL ?>" class="logo-link">
            <i class="fa-solid fa-shoe-prints"></i>
            Shoe<span>Seller</span>
        </a>
        <a href="<?= BASE_URL ?>" class="back-btn">
            <i class="fa-solid fa-arrow-left"></i> Về trang chủ
        </a>
    </div>
</div>

<!-- MAIN -->
<div class="profile-wrap">

    <!-- SIDEBAR -->
    <aside>
        <div class="sidebar-card">
            <div class="sidebar-avatar-box">
                <div class="avatar-ring">
                    <?php if (!empty($u->avatar)): ?>
                        <img src="<?= BASE_URL ?>/public/uploads/avatars/<?= htmlspecialchars($u->avatar) ?>" alt="Avatar">
                    <?php else: ?>
                        <div class="avatar-placeholder"><i class="fa-solid fa-user"></i></div>
                    <?php endif; ?>
                </div>
                <div class="sidebar-name"><?= htmlspecialchars($u->name ?? $_SESSION['user']['name']) ?></div>
                <div class="sidebar-email"><?= htmlspecialchars($u->email ?? $_SESSION['user']['email']) ?></div>
                <span class="sidebar-badge"><?= htmlspecialchars($u->role ?? $_SESSION['user']['role']) ?></span>
            </div>
            <nav class="sidebar-nav">
                <a href="<?= BASE_URL ?>/users/profile" class="<?= $activeTab === 'info' ? 'active' : '' ?>">
                    <i class="fa-regular fa-user"></i> Thông tin cá nhân
                </a>
                <a href="<?= BASE_URL ?>/users/changePassword" class="<?= $activeTab === 'password' ? 'active' : '' ?>">
                    <i class="fa-solid fa-lock"></i> Đổi mật khẩu
                </a>
                <a href="<?= BASE_URL ?>/users/uploadAvatar" class="<?= $activeTab === 'avatar' ? 'active' : '' ?>">
                    <i class="fa-regular fa-image"></i> Ảnh đại diện
                </a>
                <a href="<?= BASE_URL ?>/users/logout" style="margin-top:8px; border-top:1px solid #222; padding-top:16px;">
                    <i class="fa-solid fa-right-from-bracket"></i> Đăng xuất
                </a>
            </nav>
        </div>
    </aside>

    <!-- PANEL -->
    <main>

        <?php if ($activeTab === 'info'): ?>
        <!-- ── TAB: THÔNG TIN ── -->
        <div class="panel-card">
            <div class="panel-header">
                <div class="panel-header-icon"><i class="fa-regular fa-pen-to-square"></i></div>
                <div>
                    <div class="panel-title">Thông tin cá nhân</div>
                    <div class="panel-subtitle">Cập nhật tên và email của bạn</div>
                </div>
            </div>
            <div class="panel-body">
                <?php if (!empty($errors['info'])): ?>
                    <div class="alert-box alert-danger"><i class="fa-solid fa-circle-exclamation"></i><?= htmlspecialchars($errors['info']) ?></div>
                <?php endif; ?>
                <?php if (!empty($success['info'])): ?>
                    <div class="alert-box alert-success"><i class="fa-solid fa-circle-check"></i><?= htmlspecialchars($success['info']) ?></div>
                <?php endif; ?>

                <form action="<?= BASE_URL ?>/users/updateInfo" method="POST">
                    <div class="field-group">
                        <label class="field-label">Họ và tên</label>
                        <div class="input-icon-wrap">
                            <i class="fi-icon fa-solid fa-user"></i>
                            <input type="text" name="name" class="field-input"
                                value="<?= htmlspecialchars($u->name ?? '') ?>" placeholder="Nhập họ tên..." required>
                        </div>
                    </div>
                    <div class="field-group">
                        <label class="field-label">Địa chỉ Email</label>
                        <div class="input-icon-wrap">
                            <i class="fi-icon fa-solid fa-envelope"></i>
                            <input type="email" name="email" class="field-input"
                                value="<?= htmlspecialchars($u->email ?? '') ?>" placeholder="Nhập email..." required>
                        </div>
                    </div>
                    <button type="submit" class="btn-save">
                        <i class="fa-solid fa-floppy-disk"></i> Lưu thay đổi
                    </button>
                </form>
            </div>
        </div>

        <?php elseif ($activeTab === 'password'): ?>
        <!-- ── TAB: MẬT KHẨU ── -->
        <div class="panel-card">
            <div class="panel-header">
                <div class="panel-header-icon"><i class="fa-solid fa-lock"></i></div>
                <div>
                    <div class="panel-title">Đổi mật khẩu</div>
                    <div class="panel-subtitle">Bảo vệ tài khoản với mật khẩu mạnh</div>
                </div>
            </div>
            <div class="panel-body">
                <?php if (!empty($errors['password'])): ?>
                    <div class="alert-box alert-danger"><i class="fa-solid fa-circle-exclamation"></i><?= htmlspecialchars($errors['password']) ?></div>
                <?php endif; ?>
                <?php if (!empty($success['password'])): ?>
                    <div class="alert-box alert-success"><i class="fa-solid fa-circle-check"></i><?= htmlspecialchars($success['password']) ?></div>
                <?php endif; ?>

                <form action="<?= BASE_URL ?>/users/changePassword" method="POST">
                    <div class="field-group">
                        <label class="field-label">Mật khẩu hiện tại</label>
                        <div class="input-icon-wrap">
                            <i class="fi-icon fa-solid fa-key"></i>
                            <input type="password" name="current_password" class="field-input"
                                placeholder="Nhập mật khẩu hiện tại..." required>
                        </div>
                    </div>
                    <div class="field-group">
                        <label class="field-label">Mật khẩu mới</label>
                        <div class="input-icon-wrap">
                            <i class="fi-icon fa-solid fa-lock"></i>
                            <input type="password" name="new_password" id="new_password" class="field-input"
                                placeholder="Tối thiểu 6 ký tự..." required>
                        </div>
                        <div class="strength-bar"><div class="strength-fill" id="strength-fill"></div></div>
                        <div class="strength-label" id="strength-label"></div>
                    </div>
                    <div class="field-group">
                        <label class="field-label">Xác nhận mật khẩu mới</label>
                        <div class="input-icon-wrap">
                            <i class="fi-icon fa-solid fa-shield-halved"></i>
                            <input type="password" name="confirm_password" id="confirm_password" class="field-input"
                                placeholder="Nhập lại mật khẩu mới..." required>
                        </div>
                        <div class="strength-label" id="match-label"></div>
                    </div>
                    <button type="submit" class="btn-save">
                        <i class="fa-solid fa-shield-halved"></i> Cập nhật mật khẩu
                    </button>
                </form>
            </div>
        </div>

        <?php elseif ($activeTab === 'avatar'): ?>
        <!-- ── TAB: AVATAR ── -->
        <div class="panel-card">
            <div class="panel-header">
                <div class="panel-header-icon"><i class="fa-regular fa-image"></i></div>
                <div>
                    <div class="panel-title">Ảnh đại diện</div>
                    <div class="panel-subtitle">JPG, PNG, WEBP · Tối đa 2MB</div>
                </div>
            </div>
            <div class="panel-body">
                <?php if (!empty($errors['avatar'])): ?>
                    <div class="alert-box alert-danger"><i class="fa-solid fa-circle-exclamation"></i><?= htmlspecialchars($errors['avatar']) ?></div>
                <?php endif; ?>
                <?php if (!empty($success['avatar'])): ?>
                    <div class="alert-box alert-success"><i class="fa-solid fa-circle-check"></i><?= htmlspecialchars($success['avatar']) ?></div>
                <?php endif; ?>

                <!-- Current Avatar -->
                <div class="current-avatar-row">
                    <?php if (!empty($u->avatar)): ?>
                        <img class="cur-avatar-img" src="<?= BASE_URL ?>/public/uploads/avatars/<?= htmlspecialchars($u->avatar) ?>" alt="Avatar">
                    <?php else: ?>
                        <div class="cur-avatar-placeholder"><i class="fa-solid fa-user"></i></div>
                    <?php endif; ?>
                    <div class="cur-avatar-info">
                        <p>Ảnh đại diện hiện tại</p>
                        <span><?= !empty($u->avatar) ? htmlspecialchars($u->avatar) : 'Chưa có ảnh' ?></span>
                    </div>
                </div>

                <form action="<?= BASE_URL ?>/users/uploadAvatar" method="POST" enctype="multipart/form-data" id="avatar-form">
                    <div class="upload-zone" id="upload-zone">
                        <input type="file" name="avatar" id="avatar-input" accept="image/jpeg,image/png,image/gif,image/webp">
                        <div class="upload-icon"><i class="fa-solid fa-cloud-arrow-up"></i></div>
                        <div class="upload-text">Kéo thả hoặc <strong style="color:var(--primary)">chọn ảnh</strong></div>
                        <div class="upload-hint">JPG, PNG, GIF, WEBP · Tối đa 2MB</div>
                    </div>

                    <div id="preview-wrap">
                        <img id="preview-img" src="#" alt="Preview">
                        <div id="preview-name"></div>
                    </div>

                    <button type="submit" class="btn-save" id="submit-btn" style="display:none">
                        <i class="fa-solid fa-cloud-arrow-up"></i> Tải ảnh lên
                    </button>
                </form>
            </div>
        </div>
        <?php endif; ?>

    </main>
</div>

<script>
// ─── PASSWORD STRENGTH ───
const pwInput = document.getElementById('new_password');
const cfInput = document.getElementById('confirm_password');
const fill    = document.getElementById('strength-fill');
const label   = document.getElementById('strength-label');
const matchLb = document.getElementById('match-label');

if (pwInput) {
    pwInput.addEventListener('input', function() {
        const v = this.value;
        let score = 0;
        if (v.length >= 6) score++;
        if (v.length >= 10) score++;
        if (/[A-Z]/.test(v)) score++;
        if (/[0-9]/.test(v)) score++;
        if (/[^A-Za-z0-9]/.test(v)) score++;

        const pct = (score / 5) * 100;
        fill.style.width = pct + '%';
        if (score <= 1) { fill.style.background = '#f87171'; label.textContent = 'Yếu'; label.style.color = '#f87171'; }
        else if (score <= 3) { fill.style.background = '#fbbf24'; label.textContent = 'Trung bình'; label.style.color = '#fbbf24'; }
        else { fill.style.background = '#4ade80'; label.textContent = 'Mạnh'; label.style.color = '#4ade80'; }
        checkMatch();
    });
}
if (cfInput) {
    cfInput.addEventListener('input', checkMatch);
}
function checkMatch() {
    if (!cfInput || !pwInput || cfInput.value === '') { matchLb.textContent = ''; return; }
    if (cfInput.value === pwInput.value) {
        matchLb.textContent = '✓ Mật khẩu khớp'; matchLb.style.color = '#4ade80';
    } else {
        matchLb.textContent = '✗ Mật khẩu không khớp'; matchLb.style.color = '#f87171';
    }
}

// ─── AVATAR PREVIEW ───
const avatarInput = document.getElementById('avatar-input');
const previewWrap = document.getElementById('preview-wrap');
const previewImg  = document.getElementById('preview-img');
const previewName = document.getElementById('preview-name');
const submitBtn   = document.getElementById('submit-btn');
const uploadZone  = document.getElementById('upload-zone');

if (avatarInput) {
    avatarInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            const file = this.files[0];
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                previewName.textContent = file.name + ' (' + (file.size / 1024).toFixed(1) + ' KB)';
                previewWrap.style.display = 'flex';
                submitBtn.style.display = 'inline-flex';
            };
            reader.readAsDataURL(file);
        }
    });

    // Drag & Drop
    uploadZone.addEventListener('dragover', function(e) {
        e.preventDefault();
        this.classList.add('dragover');
    });
    uploadZone.addEventListener('dragleave', function() {
        this.classList.remove('dragover');
    });
    uploadZone.addEventListener('drop', function(e) {
        e.preventDefault();
        this.classList.remove('dragover');
        const file = e.dataTransfer.files[0];
        if (file) {
            const dt = new DataTransfer();
            dt.items.add(file);
            avatarInput.files = dt.files;
            avatarInput.dispatchEvent(new Event('change'));
        }
    });
}
</script>
</body>
</html>
