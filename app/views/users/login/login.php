<?php
// session_start();
if (isset($_SESSION['success_message'])) {
    echo '<script>alert("' . $_SESSION['success_message'] . '");</script>';
    unset($_SESSION['success_message']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - ShoeSeller</title>
    <!-- Bootstrap 5.3.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Google Fonts: Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Outfit', sans-serif;
            margin: 0;
            overflow-x: hidden;
            background-color: #000;
            color: #fff;
        }

        .login-container {
            min-height: 100vh;
        }

        .bg-image {
            background-image: url('<?= BASE_URL ?>/app/views/users/img/Different-Shoe-Leather-Trimly_2051a6f8-00f4-4a52-a567-a6f3066610f3_1000x.webp');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Dark overlay for the background image */
        .bg-image::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background: linear-gradient(to right, rgba(0, 0, 0, 0.4), rgba(17, 17, 17, 1));
        }

        .login-panel {
            background-color: #111111;
            color: white;
            border-left: 1px solid #333;
            position: relative;
            box-shadow: -10px 0 30px rgba(0, 0, 0, 0.8);
            z-index: 1;
        }

        .form-wrapper {
            max-width: 400px;
            width: 100%;
        }

        .form-title {
            font-family: 'Outfit', sans-serif;
            font-weight: 800;
            margin-bottom: 30px;
            font-size: 2.5rem;
            letter-spacing: -1px;
        }

        .form-title span {
            color: #d4af37;
            /* Luxury Gold */
        }

        .form-label {
            font-weight: 500;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
            color: #aaa;
        }

        .form-control {
            border-radius: 0;
            padding: 15px;
            background-color: #000;
            border: 1px solid #333;
            color: #fff;
            margin-bottom: 20px;
            transition: all 0.3s;
        }

        .form-control:focus {
            background-color: #1a1a1a;
            border-color: #d4af37;
            box-shadow: none;
            color: #fff;
        }

        .btn-login {
            background-color: #d4af37;
            color: #000;
            border: none;
            border-radius: 0;
            padding: 12px 30px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s;
            width: 100%;
        }

        .btn-login:hover {
            background-color: #fff;
            color: #000;
        }

        .remember-checkbox {
            accent-color: #d4af37;
        }

        .register-link {
            color: #d4af37;
            font-weight: 600;
            text-decoration: none;
            transition: color 0.3s;
        }

        .register-link:hover {
            text-decoration: underline;
            color: #fff;
        }

        .decor-icon {
            position: absolute;
            top: 30px;
            right: 30px;
            font-size: 30px;
            color: #d4af37;
        }

        .back-home {
            position: absolute;
            top: 30px;
            left: 30px;
            color: #aaa;
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.3s;
            z-index: 2;
        }

        .back-home:hover {
            color: #d4af37;
        }
    </style>
</head>

<body>

    <div class="container-fluid p-0">
        <div class="row g-0 login-container">
            <!-- Left Background Image -->
            <div class="col-md-6 d-none d-md-flex bg-image">
                <a href="<?= BASE_URL ?>" class="back-home"><i class="fa-solid fa-arrow-left"></i> Quay lại cửa hàng</a>
            </div>

            <!-- Right Login Form -->
            <div class="col-md-6 login-panel d-flex align-items-center justify-content-center p-4 p-md-5">

                <div class="decor-icon">
                    <i class="fa-solid fa-shoe-prints"></i>
                </div>

                <div class="form-wrapper">
                    <form action="" method="post">
                        <h2 class="form-title">Login</h2>

                        <?php if (isset($errors["message"])): ?>
                            <div class="alert alert-warning p-2 mb-3">
                                <?php echo htmlspecialchars($errors["message"]); ?>
                            </div>
                        <?php endif; ?>

                        <div class="mb-3">
                            <label for="usernameEmail" class="form-label">Username or email address *</label>
                            <input type="text" class="form-control" id="usernameEmail" name="usernameEmail"
                                value="<?php echo isset($oldInput["usernameEmail"]) ? htmlspecialchars($oldInput["usernameEmail"]) : ""; ?>" required>
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label">Password *</label>
                            <input type="password" class="form-control" id="password" name="password"
                                required>
                        </div>

                        <div class="mb-4">
                            <button type="submit" class="btn btn-login px-4">Log in</button>
                        </div>

                        <div class="form-check mb-4">
                            <input class="form-check-input remember-checkbox" type="checkbox" id="remember" name="remember">
                            <label class="form-check-label" for="remember">
                                Remember me
                            </label>
                        </div>

                        <div class="mt-3">
                            Don't have an account? <a href="<?= BASE_URL ?>/auth/register" class="register-link">Register</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>