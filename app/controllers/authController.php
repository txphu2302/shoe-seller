<?php
require_once "app/model/userModel.php";

class AuthController extends Controller
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    private function redirect($path = '')
    {
        header('Location: ' . BASE_URL . $path);
        exit;
    }

    private function ensureDefaultAdmin()
    {
        if ($this->userModel->checkEmailExists('admin@shoeseller.com')) {
            return;
        }

        $this->userModel->register([
            'name' => 'Administrator',
            'email' => 'admin@shoeseller.com',
            'password' => 'admin123',
            'role' => 'admin',
            'status' => 'active'
        ]);
    }


    public function register()
    {
        if (isset($_SESSION['user'])) {
            $this->redirect('/');
        }

        $errors = [];
        $oldInput = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $oldInput = $_POST;
            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $confirmPassword = $_POST['confirm_password'] ?? '';

            if ($name === '' || $email === '' || $password === '') {
                $errors['message'] = 'Please fill in all required fields.';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['message'] = 'Email format is invalid.';
            } elseif (strlen($password) < 6) {
                $errors['message'] = 'Password must be at least 6 characters.';
            } elseif ($password !== $confirmPassword) {
                $errors['message'] = 'Password confirmation does not match.';
            }

            if (empty($errors) && $this->userModel->checkUsernameExists($name)) {
                $errors['message'] = 'This name is already in use, please choose another one.';
            }

            if (empty($errors) && $this->userModel->checkEmailExists($email)) {
                $errors['message'] = 'This email already exists, please use another email.';
            }

            if (empty($errors)) {
                if ($this->userModel->register([
                    'name' => $name,
                    'email' => $email,
                    'password' => $password,
                    'role' => 'member',
                    'status' => 'active'
                ])) {
                    $_SESSION['success_message'] = "Registration successfully!";
                    $this->redirect('/auth/login');
                } else {
                    $errors['message'] = 'Registration failed, please try again.';
                }
            }
        }

        $this->view('users/register/register', [
            'errors' => $errors,
            'oldInput' => $oldInput
        ]);
    }

    public function login()
    {
        if (isset($_SESSION['user'])) {
            if (($_SESSION['user']['role'] ?? 'member') === 'admin') {
                $this->redirect('/admin');
            }
            $this->redirect('/');
        }

        $this->ensureDefaultAdmin();

        $errors = [];
        $oldInput = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $oldInput = $_POST;
            $usernameEmail = trim($_POST['usernameEmail'] ?? '');
            $password = $_POST['password'] ?? '';

            if ($usernameEmail === '' || $password === '') {
                $errors['message'] = 'Please enter username/email and password.';
            }

            if (empty($errors)) {
                $user = $this->userModel->login([
                    'usernameEmail' => $usernameEmail,
                    'password' => $password
                ]);

                if (!$user) {
                    $errors['message'] = 'Username/email or password is not correct.';
                }
            }

            if (empty($errors)) {
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'role' => $user['role']
                ];
                $_SESSION['userid'] = $user['id'];
                $_SESSION['mySession'] = $user['email'];

                $_SESSION['success_message'] = 'Login successfully!';

                if ($user['role'] === 'admin') {
                    $this->redirect('/admin');
                }

                $this->redirect('/');
            }
        }

        $this->view('users/login/login', [
            'errors' => $errors,
            'oldInput' => $oldInput
        ]);
    }

    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION = [];

        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
        }

        session_destroy();
        session_start();
        $_SESSION['success_message'] = 'Logout successfully!';

        $this->redirect('/auth/login');
    }
}
