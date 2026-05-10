<?php

class ProfileController extends Controller
{
    protected $usersModel;

    public function __construct()
    {
        $this->usersModel = $this->model('Users');
    }

    public function index()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . BASE_URL . '/users/login');
            exit;
        }

        $userId = $_SESSION['user']['id'];
        $user = $this->usersModel->findById($userId);

        $data = [
            'title' => 'Hồ sơ cá nhân',
            'user' => $user,
            'page_css' => ['profile']
        ];

        $this->view('layouts/header', $data);
        $this->view('users/profile', $data);
        $this->view('layouts/footer');
    }

    public function update()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . BASE_URL . '/users/login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_SESSION['user']['id'];
            $name = trim($_POST['name'] ?? '');
            
            // Note: Users model doesn't have an updateProfile method yet
            // We need to add one to handle name, password, and avatar updates
            
            $avatarPath = null;
            if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = PUBLIC_PATH . '/uploads/avatars/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }

                $ext = strtolower(pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION));
                $filename = 'avatar_' . $userId . '_' . time() . '.' . $ext;
                $targetPath = $uploadDir . $filename;

                if (move_uploaded_file($_FILES['avatar']['tmp_name'], $targetPath)) {
                    $avatarPath = '/public/uploads/avatars/' . $filename;
                }
            }

            $currentPassword = $_POST['current_password'] ?? '';
            $newPassword = $_POST['new_password'] ?? '';
            
            $passwordToUpdate = null;
            if (!empty($currentPassword) && !empty($newPassword)) {
                $user = $this->usersModel->findById($userId);
                if (password_verify($currentPassword, $user->password)) {
                    $passwordToUpdate = password_hash($newPassword, PASSWORD_DEFAULT);
                } else {
                    $_SESSION['error_message'] = 'Mật khẩu hiện tại không đúng.';
                    header('Location: ' . BASE_URL . '/profile');
                    exit;
                }
            }

            $this->usersModel->updateProfile($userId, $name, $avatarPath, $passwordToUpdate);
            
            // Update session
            $_SESSION['user']['name'] = $name;
            if ($avatarPath) {
                $_SESSION['user']['avatar'] = $avatarPath;
            }

            $_SESSION['success_message'] = 'Cập nhật hồ sơ thành công.';
            header('Location: ' . BASE_URL . '/profile');
            exit;
        }
    }
}
