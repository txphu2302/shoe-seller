<?php

class UsersController extends Controller
{
    protected $usersModel;

    public function __construct()
    {
        $this->usersModel = $this->model('Users');
    }

    public function login()
    {
        $data = [
            'errors' => [],
            'oldInput' => []
        ];

        if (isset($_SESSION['user']['role'])) {
            $this->redirectByRole($_SESSION['user']['role']);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $identifier = trim($_POST['usernameEmail'] ?? '');
            $password = $_POST['password'] ?? '';

            $data['oldInput']['usernameEmail'] = $identifier;

            if ($identifier === '' || $password === '') {
                $data['errors']['message'] = 'Vui lòng nhập đầy đủ email/tên đăng nhập và mật khẩu.';
                return $this->view('users/login', $data);
            }

            $user = $this->usersModel->findByUsernameOrEmail($identifier);

            if (!$user) {
                $data['errors']['message'] = 'Tài khoản không tồn tại.';
                return $this->view('users/login', $data);
            }

            if (!isset($user->status) || $user->status !== 'active') {
                $data['errors']['message'] = 'Tài khoản của bạn đang bị khóa.';
                return $this->view('users/login', $data);
            }

            if (!password_verify($password, $user->password)) {
                $data['errors']['message'] = 'Mật khẩu không chính xác.';
                return $this->view('users/login', $data);
            }

            $_SESSION['user'] = [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'avatar' => $user->avatar,
                'role' => $user->role
            ];

            $_SESSION['success_message'] = 'Đăng nhập thành công.';
            // Xóa error_message cũ (nếu có) để không hiển thị ở trang cart
            unset($_SESSION['error_message']);
            
            // Handle redirect
            $redirect = $_POST['redirect'] ?? '';
            if (!empty($redirect) && strpos($redirect, BASE_URL) !== false) {
                // Ensure redirect is safe (starts with BASE_URL)
                header('Location: ' . $redirect);
                exit;
            } else if (!empty($redirect) && strpos($redirect, '/') === 0) {
                // Handle absolute path starting with /
                header('Location: ' . $redirect);
                exit;
            }

            $this->redirectByRole($user->role);
        }

        // Pass redirect URL from GET to View
        $data['redirect'] = $_GET['redirect'] ?? '';


        $this->view('users/login', $data);
    }

    public function index()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . BASE_URL . '/users/login');
            exit;
        }

        if (($_SESSION['user']['role'] ?? '') === 'admin') {
            header('Location: ' . BASE_URL . '/admin');
            exit;
        }

        $this->view('users/users');
    }

    public function logout()
    {
        unset($_SESSION['user']);
        session_destroy();
        header('Location: ' . BASE_URL . '/users/login');
        exit;
    }

    public function register()
    {
        $data = [
            'errors' => [],
            'oldInput' => []
        ];

        if (isset($_SESSION['user']['role'])) {
            $this->redirectByRole($_SESSION['user']['role']);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $confirmPassword = $_POST['confirm_password'] ?? '';

            $data['oldInput']['name'] = $name;
            $data['oldInput']['email'] = $email;

            if ($name === '' || $email === '' || $password === '' || $confirmPassword === '') {
                $data['errors']['message'] = 'Vui lòng nhập đầy đủ thông tin.';
                return $this->view('users/register', $data);
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $data['errors']['message'] = 'Email không hợp lệ.';
                return $this->view('users/register', $data);
            }

            if (strlen($password) < 6) {
                $data['errors']['message'] = 'Mật khẩu phải có ít nhất 6 ký tự.';
                return $this->view('users/register', $data);
            }

            if ($password !== $confirmPassword) {
                $data['errors']['message'] = 'Mật khẩu xác nhận không khớp.';
                return $this->view('users/register', $data);
            }

            if ($this->usersModel->findByEmail($email)) {
                $data['errors']['message'] = 'Email này đã được sử dụng.';
                return $this->view('users/register', $data);
            }

            $created = $this->usersModel->createUser([
                'name' => $name,
                'email' => $email,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'avatar' => null,
                'role' => 'member',
                'status' => 'active'
            ]);

            if ($created) {
                $_SESSION['success_message'] = 'Đăng ký thành công. Vui lòng đăng nhập.';
                header('Location: ' . BASE_URL . '/users/login');
                exit;
            }

            $data['errors']['message'] = 'Không thể tạo tài khoản. Vui lòng thử lại.';
        }

        $this->view('users/register', $data);
    }

    protected function redirectByRole($role)
    {
        if ($role === 'admin') {
            header('Location: ' . BASE_URL . '/admin');
            exit;
        }

        header('Location: ' . BASE_URL . '/');
        exit;
    }
}
