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
            $this->redirectByRole($user->role);
        }

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
        $this->view('users/register');
    }

    protected function redirectByRole($role)
    {
        if ($role === 'admin') {
            header('Location: ' . BASE_URL . '/admin');
            exit;
        }

        header('Location: ' . BASE_URL . '/users');
        exit;
    }
}
