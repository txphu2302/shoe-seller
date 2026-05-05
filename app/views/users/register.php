<!-- REGISTER SECTION -->
<section class="section-padding">
    <div class="container" style="max-width: 500px; margin: 0 auto;">
        <div class="auth-wrapper" style="background: rgba(255, 255, 255, 0.05); padding: 40px; border-radius: 20px; border: 1px solid rgba(255, 255, 255, 0.1);">
            <div class="section-header" style="text-align: center; margin-bottom: 30px;">
                <h2 class="section-title">Đăng Ký</h2>
                <p style="color: #aaa; margin-top: 10px;">Tạo tài khoản để trải nghiệm ShoeSeller</p>
            </div>

            <form action="<?= BASE_URL ?>/users/register" method="POST" class="auth-form">
                <div class="form-group" style="margin-bottom: 20px;">
                    <label for="name" style="display: block; margin-bottom: 8px; color: #fff;">Họ và tên</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Nhập họ và tên" style="width: 100%; padding: 12px 15px; background: rgba(0,0,0,0.5); border: 1px solid rgba(255,255,255,0.2); border-radius: 8px; color: #fff; outline: none;" required>
                </div>

                <div class="form-group" style="margin-bottom: 20px;">
                    <label for="email" style="display: block; margin-bottom: 8px; color: #fff;">Email</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Nhập email của bạn" style="width: 100%; padding: 12px 15px; background: rgba(0,0,0,0.5); border: 1px solid rgba(255,255,255,0.2); border-radius: 8px; color: #fff; outline: none;" required>
                </div>

                <div class="form-group" style="margin-bottom: 20px;">
                    <label for="password" style="display: block; margin-bottom: 8px; color: #fff;">Mật khẩu</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Tạo mật khẩu" style="width: 100%; padding: 12px 15px; background: rgba(0,0,0,0.5); border: 1px solid rgba(255,255,255,0.2); border-radius: 8px; color: #fff; outline: none;" required>
                </div>

                <div class="form-group" style="margin-bottom: 25px;">
                    <label for="confirm_password" style="display: block; margin-bottom: 8px; color: #fff;">Xác nhận mật khẩu</label>
                    <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Nhập lại mật khẩu" style="width: 100%; padding: 12px 15px; background: rgba(0,0,0,0.5); border: 1px solid rgba(255,255,255,0.2); border-radius: 8px; color: #fff; outline: none;" required>
                </div>

                <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center; padding: 12px;">Đăng Ký <i class="fa-solid fa-user-plus" style="margin-left: 8px;"></i></button>
            </form>

            <div class="auth-links" style="margin-top: 25px; text-align: center; border-top: 1px solid rgba(255,255,255,0.1); padding-top: 20px;">
                <p style="color: #aaa;">Đã có tài khoản? <a href="<?= BASE_URL ?>/users/login" style="color: var(--primary-color); text-decoration: none; font-weight: 600;">Đăng nhập</a></p>
            </div>
        </div>
    </div>
</section>
