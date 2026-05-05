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
    <title>Register - ShoeSeller</title>
    <!-- Bootstrap 5.3.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Google Fonts: Roboto -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            overflow-x: hidden;
            background-color: #000;
        }

        .login-container {
            min-height: 100vh;
        }

        .bg-image {
            background-image: url('<?php echo defined("BASE_URL") ? BASE_URL : ""; ?>/app/views/users/img/Different-Shoe-Leather-Trimly_2051a6f8-00f4-4a52-a567-a6f3066610f3_1000x.webp');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            position: relative;
        }

        /* Dark overlay for the background image */
        .bg-image::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background: linear-gradient(to right, rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.7));
        }

        .login-panel {
            background-color: #534343;
            color: white;
            border-top-left-radius: 40px;
            border-bottom-left-radius: 40px;
            position: relative;
            box-shadow: -10px 0 30px rgba(0, 0, 0, 0.5);
            z-index: 1;
        }

        @media (max-width: 767.98px) {
            .login-panel {
                border-radius: 40px 40px 0 0;
                margin-top: -40px;
                min-height: 100vh;
            }

            .bg-image {
                min-height: 40vh;
            }
        }

        .form-wrapper {
            max-width: 400px;
            width: 100%;
        }

        .form-title {
            font-weight: 700;
            margin-bottom: 30px;
            font-size: 2rem;
        }

        .form-label {
            font-weight: 500;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .form-control {
            border-radius: 8px;
            padding: 10px 15px;
            border: none;
            margin-bottom: 15px;
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(255, 255, 255, 0.25);
        }

        .btn-login {
            background-color: #1a365d;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 10px 30px;
            font-weight: 500;
            transition: all 0.3s;
            width: 100%;
        }

        .btn-login:hover {
            background-color: #0f213d;
            color: white;
        }

        .register-link {
            color: #1a365d;
            font-weight: 600;
            text-decoration: none;
        }

        .register-link:hover {
            text-decoration: underline;
            color: #0f213d;
        }

        /* Decorative Icon */
        .decor-icon {
            position: absolute;
            top: 30px;
            right: 30px;
            width: 70px;
            height: 70px;
            background-color: #000000;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 35px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            transform: rotate(5deg);
            border: 4px solid #fff;
        }
    </style>
</head>

<body>

    <div class="container-fluid p-0">
        <div class="row g-0 login-container">
            <!-- Left Background Image -->
            <div class="col-md-7 d-none d-md-block bg-image"></div>

            <!-- Right Form -->
            <div class="col-md-5 login-panel d-flex align-items-center justify-content-center p-4 p-md-5">

                <!-- Decorative Icon -->
                <div class="decor-icon">
                    <i class="fa-solid fa-shoe-prints"></i>
                </div>

                <div class="form-wrapper">
                    <form action="<?= BASE_URL ?>/users/register" method="post">
                        <h2 class="form-title">Register</h2>

                        <?php if (isset($errors["message"])): ?>
                            <div class="alert alert-warning p-2 mb-3">
                                <?php echo htmlspecialchars($errors["message"]); ?>
                            </div>
                        <?php endif; ?>

                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name *</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="<?php echo isset($oldInput["name"]) ? htmlspecialchars($oldInput["name"]) : ""; ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email address *</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="<?php echo isset($oldInput["email"]) ? htmlspecialchars($oldInput["email"]) : ""; ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password *</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>

                        <div class="mb-4">
                            <label for="confirm_password" class="form-label">Confirm Password *</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                        </div>

                        <div class="mb-4">
                            <button type="submit" class="btn btn-login">Register</button>
                        </div>

                        <div class="mt-3">
                            Already have an account? <a href="<?= BASE_URL ?>/users/login" class="register-link">Log in</a>
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