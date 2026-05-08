<?php

class AdminController extends Controller
{
    protected $settingsModel;
    protected $contactsModel;

    public function __construct()
    {
        $this->settingsModel = $this->model('Settings');
        $this->contactsModel = $this->model('Contacts');
    }

    protected function checkAdminAuth()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . BASE_URL . '/users/login');
            exit;
        }

        if (($_SESSION['user']['role'] ?? '') !== 'admin') {
            header('Location: ' . BASE_URL . '/users');
            exit;
        }
    }

    public function index()
    {
        $this->checkAdminAuth();

        // Get dashboard statistics - Nhiệm vụ 1
        $totalContacts = $this->contactsModel->countContacts();
        $unreadContacts = $this->contactsModel->countContacts('unread');

        // Get recent contacts for dashboard
        $recentContacts = $this->contactsModel->getAllContacts(5, 0);

        $data = [
            'totalContacts' => $totalContacts,
            'unreadContacts' => $unreadContacts,
            'contacts' => $recentContacts,
            'pageTitle' => 'Dashboard'
        ];

        $this->view('admin/layouts/header', $data);
        $this->view('admin/dashboard', $data);
        $this->view('admin/layouts/footer');
    }

    // Settings Management
    public function settings()
    {
        $this->checkAdminAuth();

        $data = [
            'errors' => [],
            'success' => '',
            'pageTitle' => 'Quản lý Cài đặt Website'
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Update settings
            $allowedSettings = ['company_name', 'phone', 'address', 'about_short', 'logo', 'email', 'facebook', 'instagram'];
            
            foreach ($allowedSettings as $key) {
                if (isset($_POST[$key])) {
                    $value = trim($_POST[$key]);
                    if ($this->settingsModel->settingExists($key)) {
                        $this->settingsModel->updateSetting($key, $value);
                    } else {
                        $this->settingsModel->createSetting($key, $value);
                    }
                }
            }

            // Handle logo upload
            if (isset($_FILES['logo_file']) && $_FILES['logo_file']['error'] === UPLOAD_ERR_OK) {
                $uploadResult = $this->handleLogoUpload($_FILES['logo_file']);
                if ($uploadResult['success']) {
                    $this->settingsModel->updateSetting('logo', $uploadResult['filename']);
                } else {
                    $data['errors'][] = $uploadResult['message'];
                }
            }

            if (empty($data['errors'])) {
                $data['success'] = 'Cài đặt đã được cập nhật thành công!';
            }
        }

        // Get current settings
        $settings = $this->settingsModel->getAllSettings();
        $data['settings'] = [];
        foreach ($settings as $setting) {
            $data['settings'][$setting['key_name']] = $setting['key_value'];
        }

        $this->view('admin/layouts/header', $data);
        $this->view('admin/settings', $data);
        $this->view('admin/layouts/footer');
    }

    protected function handleLogoUpload($file)
    {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        $maxSize = 2 * 1024 * 1024; // 2MB

        if (!in_array($file['type'], $allowedTypes)) {
            return ['success' => false, 'message' => 'Chỉ chấp nhận file ảnh (JPEG, PNG, GIF, WEBP)'];
        }

        if ($file['size'] > $maxSize) {
            return ['success' => false, 'message' => 'Kích thước file không được vượt quá 2MB'];
        }

        $uploadDir = PUBLIC_PATH . '/uploads/logo/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $filename = 'logo_' . time() . '_' . basename($file['name']);
        $targetPath = $uploadDir . $filename;

        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            return ['success' => true, 'filename' => 'uploads/logo/' . $filename];
        }

        return ['success' => false, 'message' => 'Không thể upload file. Vui lòng thử lại.'];
    }

    // Contacts Management
    public function contacts()
    {
        $this->checkAdminAuth();

        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perPage = 10;
        $offset = ($page - 1) * $perPage;

        $status = isset($_GET['status']) ? $_GET['status'] : null;
        
        if ($status && in_array($status, ['unread', 'read', 'replied'])) {
            $contacts = $this->contactsModel->getContactsByStatus($status, $perPage, $offset);
            $totalContacts = $this->contactsModel->countContacts($status);
        } else {
            $contacts = $this->contactsModel->getAllContacts($perPage, $offset);
            $totalContacts = $this->contactsModel->countContacts();
        }

        $totalPages = ceil($totalContacts / $perPage);

        $data = [
            'contacts' => $contacts,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'totalContacts' => $totalContacts,
            'unreadCount' => $this->contactsModel->countContacts('unread'),
            'readCount' => $this->contactsModel->countContacts('read'),
            'repliedCount' => $this->contactsModel->countContacts('replied'),
            'currentStatus' => $status,
            'pageTitle' => 'Quản lý Liên hệ'
        ];

        $this->view('admin/layouts/header', $data);
        $this->view('admin/contacts', $data);
        $this->view('admin/layouts/footer');
    }

    public function updateContactStatus($id)
    {
        $this->checkAdminAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $status = $_POST['status'] ?? '';
            if (in_array($status, ['unread', 'read', 'replied'])) {
                $this->contactsModel->updateStatus($id, $status);
                $_SESSION['success_message'] = 'Trạng thái liên hệ đã được cập nhật!';
            }
        }

        header('Location: ' . BASE_URL . '/admin/contacts');
        exit;
    }

    public function deleteContact($id)
    {
        $this->checkAdminAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->contactsModel->deleteContact($id);
            $_SESSION['success_message'] = 'Liên hệ đã được xóa thành công!';
        }

        header('Location: ' . BASE_URL . '/admin/contacts');
        exit;
    }

    public function viewContact($id)
    {
        $this->checkAdminAuth();

        $contact = $this->contactsModel->getContactById($id);
        
        if (!$contact) {
            header('Location: ' . BASE_URL . '/admin/contacts');
            exit;
        }

        // Auto mark as read if unread
        if ($contact->status === 'unread') {
            $this->contactsModel->updateStatus($id, 'read');
            $contact->status = 'read';
        }

        $data = [
            'contact' => $contact,
            'pageTitle' => 'Chi tiết Liên hệ'
        ];

        $this->view('admin/layouts/header', $data);
        $this->view('admin/contact_detail', $data);
        $this->view('admin/layouts/footer');
    }
}
