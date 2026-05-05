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

        // Redirect member về trang chủ
        header('Location: ' . BASE_URL);
        exit;
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

        // Member về trang chủ sau khi đăng nhập
        header('Location: ' . BASE_URL);
        exit;
    }

    public function profile()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . BASE_URL . '/users/login');
            exit;
        }

        $user = $this->usersModel->findById($_SESSION['user']['id']);

        $data = [
            'user'    => $user,
            'errors'  => [],
            'success' => [],
            'activeTab' => 'info'
        ];

        $this->view('users/profile', $data);
    }

    public function updateInfo()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . BASE_URL . '/users/login');
            exit;
        }

        $user = $this->usersModel->findById($_SESSION['user']['id']);
        $data = [
            'user'      => $user,
            'errors'    => [],
            'success'   => [],
            'activeTab' => 'info'
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name  = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');

            if ($name === '' || $email === '') {
                $data['errors']['info'] = 'Vui lòng nhập đầy đủ thông tin.';
                return $this->view('users/profile', $data);
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $data['errors']['info'] = 'Email không hợp lệ.';
                return $this->view('users/profile', $data);
            }

            // Kiểm tra email đã tồn tại chưa (ngoại trừ user hiện tại)
            if ($this->usersModel->findByEmailExcept($email, $_SESSION['user']['id'])) {
                $data['errors']['info'] = 'Email này đã được sử dụng bởi tài khoản khác.';
                return $this->view('users/profile', $data);
            }

            $updated = $this->usersModel->updateProfile($_SESSION['user']['id'], $name, $email);

            if ($updated) {
                $_SESSION['user']['name']  = $name;
                $_SESSION['user']['email'] = $email;
                $user->name  = $name;
                $user->email = $email;
                $data['user'] = $user;
                $data['success']['info'] = 'Cập nhật thông tin thành công!';
            } else {
                $data['errors']['info'] = 'Không thể cập nhật. Vui lòng thử lại.';
            }
        }

        $this->view('users/profile', $data);
    }

    public function changePassword()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . BASE_URL . '/users/login');
            exit;
        }

        $user = $this->usersModel->findById($_SESSION['user']['id']);
        $data = [
            'user'      => $user,
            'errors'    => [],
            'success'   => [],
            'activeTab' => 'password'
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $currentPassword = $_POST['current_password'] ?? '';
            $newPassword     = $_POST['new_password'] ?? '';
            $confirmPassword = $_POST['confirm_password'] ?? '';

            if ($currentPassword === '' || $newPassword === '' || $confirmPassword === '') {
                $data['errors']['password'] = 'Vui lòng nhập đầy đủ thông tin.';
                return $this->view('users/profile', $data);
            }

            if (!password_verify($currentPassword, $user->password)) {
                $data['errors']['password'] = 'Mật khẩu hiện tại không chính xác.';
                return $this->view('users/profile', $data);
            }

            if (strlen($newPassword) < 6) {
                $data['errors']['password'] = 'Mật khẩu mới phải có ít nhất 6 ký tự.';
                return $this->view('users/profile', $data);
            }

            if ($newPassword !== $confirmPassword) {
                $data['errors']['password'] = 'Mật khẩu xác nhận không khớp.';
                return $this->view('users/profile', $data);
            }

            $updated = $this->usersModel->updatePassword(
                $_SESSION['user']['id'],
                password_hash($newPassword, PASSWORD_DEFAULT)
            );

            if ($updated) {
                $data['success']['password'] = 'Đổi mật khẩu thành công!';
            } else {
                $data['errors']['password'] = 'Không thể đổi mật khẩu. Vui lòng thử lại.';
            }
        }

        $this->view('users/profile', $data);
    }

    public function uploadAvatar()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . BASE_URL . '/users/login');
            exit;
        }

        $user = $this->usersModel->findById($_SESSION['user']['id']);
        $data = [
            'user'      => $user,
            'errors'    => [],
            'success'   => [],
            'activeTab' => 'avatar'
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_FILES['avatar']) || $_FILES['avatar']['error'] === UPLOAD_ERR_NO_FILE) {
                $data['errors']['avatar'] = 'Vui lòng chọn ảnh để tải lên.';
                return $this->view('users/profile', $data);
            }

            $file     = $_FILES['avatar'];
            $allowed  = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
            $maxSize  = 2 * 1024 * 1024; // 2MB

            if (!in_array($file['type'], $allowed)) {
                $data['errors']['avatar'] = 'Chỉ chấp nhận file ảnh JPG, PNG, GIF, WEBP.';
                return $this->view('users/profile', $data);
            }

            if ($file['size'] > $maxSize) {
                $data['errors']['avatar'] = 'Kích thước ảnh không được vượt quá 2MB.';
                return $this->view('users/profile', $data);
            }

            $uploadDir = ROOT_PATH . '/public/uploads/avatars/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            // Xóa avatar cũ nếu có
            if (!empty($user->avatar)) {
                $oldPath = ROOT_PATH . '/public/uploads/avatars/' . $user->avatar;
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            $ext      = pathinfo($file['name'], PATHINFO_EXTENSION);
            $filename = 'avatar_' . $_SESSION['user']['id'] . '_' . time() . '.' . $ext;
            $destPath = $uploadDir . $filename;

            if (move_uploaded_file($file['tmp_name'], $destPath)) {
                $this->usersModel->updateAvatar($_SESSION['user']['id'], $filename);
                $_SESSION['user']['avatar'] = $filename;
                $user->avatar = $filename;
                $data['user'] = $user;
                $data['success']['avatar'] = 'Cập nhật ảnh đại diện thành công!';
            } else {
                $data['errors']['avatar'] = 'Không thể tải ảnh lên. Vui lòng thử lại.';
            }
        }

        $this->view('users/profile', $data);
    }
}
