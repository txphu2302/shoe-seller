<?php

class AdminController extends Controller
{
    protected $settingsModel;
    protected $contactsModel;
    protected $productModel;

    public function __construct()
    {
        $this->settingsModel = $this->model('Settings');
        $this->contactsModel = $this->model('Contacts');
        $this->productModel = $this->model('Product');
        $this->usersModel = $this->model('Users');
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

    // About Us Settings Management
    public function aboutSettings()
    {
        $this->checkAdminAuth();

        $data = [
            'errors' => [],
            'success' => '',
            'pageTitle' => 'Quản lý trang Giới thiệu'
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Text fields to update
            $allowedSettings = [
                'about_hero_title',
                'about_hero_subtitle',
                'about_main_title',
                'about_main_subtitle',
                'about_description_1',
                'about_description_2',
                'about_stat_1_num',
                'about_stat_1_label',
                'about_stat_2_num',
                'about_stat_2_label',
                'about_stat_3_num',
                'about_stat_3_label',
                'about_core_values_title',
                'about_core_values_subtitle',
                'about_value_1_title',
                'about_value_1_desc',
                'about_value_2_title',
                'about_value_2_desc',
                'about_value_3_title',
                'about_value_3_desc',
                'about_value_4_title',
                'about_value_4_desc'
            ];

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

            // Handle image uploads
            $imageFields = [
                'about_hero_image_file' => 'about_hero_image',
                'about_main_image_file' => 'about_main_image'
            ];

            foreach ($imageFields as $fileKey => $settingKey) {
                if (isset($_FILES[$fileKey]) && $_FILES[$fileKey]['error'] === UPLOAD_ERR_OK) {
                    $uploadResult = $this->handleAboutImageUpload($_FILES[$fileKey], $fileKey);
                    if ($uploadResult['success']) {
                        if ($this->settingsModel->settingExists($settingKey)) {
                            $this->settingsModel->updateSetting($settingKey, $uploadResult['filename']);
                        } else {
                            $this->settingsModel->createSetting($settingKey, $uploadResult['filename']);
                        }
                    } else {
                        $data['errors'][] = $uploadResult['message'];
                    }
                }
            }

            if (empty($data['errors'])) {
                $data['success'] = 'Cài đặt trang Giới thiệu đã được cập nhật!';
            }
        }

        // Get current settings
        $settings = $this->settingsModel->getAllSettings();
        $data['settings'] = [];
        foreach ($settings as $setting) {
            $data['settings'][$setting['key_name']] = $setting['key_value'];
        }

        $this->view('admin/layouts/header', $data);
        $this->view('admin/about_settings', $data);
        $this->view('admin/layouts/footer');
    }

    protected function handleAboutImageUpload($file, $prefix)
    {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        $maxSize = 5 * 1024 * 1024; // 5MB

        if (!in_array($file['type'], $allowedTypes)) {
            return ['success' => false, 'message' => 'Chỉ chấp nhận file ảnh (JPEG, PNG, GIF, WEBP)'];
        }

        if ($file['size'] > $maxSize) {
            return ['success' => false, 'message' => 'Kích thước file không được vượt quá 5MB'];
        }

        $uploadDir = PUBLIC_PATH . '/uploads/about/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $filename = $prefix . '_' . time() . '_' . basename($file['name']);
        $targetPath = $uploadDir . $filename;

        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            return ['success' => true, 'filename' => 'public/uploads/about/' . $filename];
        }

        return ['success' => false, 'message' => 'Không thể upload file. Vui lòng thử lại.'];
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

    public function products()
    {
        $this->checkAdminAuth();

        $alert = ['type' => '', 'message' => ''];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = trim((string)($_POST['action'] ?? ''));

            if ($action === 'delete') {
                $productId = (int)($_POST['product_id'] ?? 0);
                if ($productId > 0 && $this->productModel->deleteProduct($productId)) {
                    $alert = ['type' => 'success', 'message' => 'Đã xóa sản phẩm thành công.'];
                } else {
                    $alert = ['type' => 'danger', 'message' => 'Không thể xóa sản phẩm.'];
                }
            } elseif ($action === 'create' || $action === 'update') {
                $productId = (int)($_POST['product_id'] ?? 0);
                $name = trim((string)($_POST['name'] ?? ''));
                $price = trim((string)($_POST['price'] ?? '0'));
                $description = trim((string)($_POST['description'] ?? ''));
                $categoryId = (int)($_POST['category_id'] ?? 0);

                if ($name === '' || $categoryId <= 0 || !is_numeric($price) || (float)$price < 0) {
                    $alert = ['type' => 'danger', 'message' => 'Vui lòng nhập đúng tên, danh mục và giá sản phẩm.'];
                } else {
                    $existingProduct = $productId > 0 ? $this->productModel->getProductById($productId) : null;
                    $imagePath = (string)($existingProduct['image'] ?? '');

                    if (isset($_FILES['image']) && $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE) {
                        $uploadResult = $this->handleProductImageUpload($_FILES['image']);
                        if (!$uploadResult['success']) {
                            $alert = ['type' => 'danger', 'message' => $uploadResult['message']];
                        } else {
                            $imagePath = $uploadResult['filename'];
                        }
                    }

                    if ($alert['message'] === '') {
                        $payload = [
                            'category_id' => $categoryId,
                            'name' => $name,
                            'description' => $description,
                            'price' => (float)$price,
                            'image' => $imagePath,
                        ];

                        if ($action === 'create') {
                            if ($this->productModel->createProduct($payload)) {
                                $alert = ['type' => 'success', 'message' => 'Đã thêm sản phẩm mới thành công.'];
                            } else {
                                $alert = ['type' => 'danger', 'message' => 'Không thể thêm sản phẩm.'];
                            }
                        } else {
                            if ($productId > 0 && $this->productModel->updateProduct($productId, $payload)) {
                                $alert = ['type' => 'success', 'message' => 'Đã cập nhật sản phẩm thành công.'];
                            } else {
                                $alert = ['type' => 'danger', 'message' => 'Không thể cập nhật sản phẩm.'];
                            }
                        }
                    }
                }
            }
        }

        $filters = [
            'product_id' => trim((string)($_GET['product_id'] ?? '')),
            'name' => trim((string)($_GET['name'] ?? '')),
            'category_id' => trim((string)($_GET['category_id'] ?? '')),
        ];

        $page = max(1, (int)($_GET['page'] ?? 1));
        $perPage = (int)($_GET['per_page'] ?? 25);
        if (!in_array($perPage, [10, 25, 50, 100], true)) {
            $perPage = 25;
        }

        $totalProducts = $this->productModel->countAdminProducts($filters);
        $totalPages = max(1, (int)ceil($totalProducts / $perPage));
        if ($page > $totalPages) {
            $page = $totalPages;
        }

        $offset = ($page - 1) * $perPage;
        $products = $this->productModel->getAdminProducts($filters, $perPage, $offset);
        $categories = $this->productModel->getCategories();

        $editId = (int)($_GET['edit'] ?? 0);
        $editProduct = $editId > 0 ? $this->productModel->getProductById($editId) : null;

        $data = [
            'pageTitle' => 'Quản lý trang sản phẩm',
            'products' => $products,
            'categories' => $categories,
            'filters' => $filters,
            'perPage' => $perPage,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'totalProducts' => $totalProducts,
            'editProduct' => $editProduct,
            'mode' => trim((string)($_GET['mode'] ?? '')),
            'alert' => $alert,
        ];

        $this->view('admin/layouts/header', $data);
        $this->view('admin/product', $data);
        $this->view('admin/layouts/footer');
    }

    protected function handleProductImageUpload($file)
    {
        if (!isset($file['error']) || $file['error'] !== UPLOAD_ERR_OK) {
            return ['success' => false, 'message' => 'Upload ảnh sản phẩm thất bại.'];
        }

        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/avif'];
        $maxSize = 5 * 1024 * 1024;

        if (!in_array((string)$file['type'], $allowedTypes, true)) {
            return ['success' => false, 'message' => 'Chỉ chấp nhận ảnh JPG, PNG, GIF, WEBP, AVIF.'];
        }

        if ((int)$file['size'] > $maxSize) {
            return ['success' => false, 'message' => 'Kích thước ảnh không được vượt quá 5MB.'];
        }

        $uploadDir = PUBLIC_PATH . '/uploads/product/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $ext = strtolower(pathinfo((string)$file['name'], PATHINFO_EXTENSION));
        if ($ext === '') {
            $ext = 'jpg';
        }

        $filename = 'product_' . time() . '_' . bin2hex(random_bytes(4)) . '.' . $ext;
        $targetPath = $uploadDir . $filename;

        if (!move_uploaded_file((string)$file['tmp_name'], $targetPath)) {
            return ['success' => false, 'message' => 'Không thể lưu ảnh vào thư mục uploads.'];
        }

        return ['success' => true, 'filename' => '/public/uploads/product/' . $filename];
    }
    // User Management Methods
    public function users()
    {
        $this->checkAdminAuth();

        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perPage = 10;
        $offset = ($page - 1) * $perPage;

        $users = $this->usersModel->getAllUsers($perPage, $offset);
        $totalUsers = $this->usersModel->countUsers();
        $totalPages = ceil($totalUsers / $perPage);

        $data = [
            'users' => $users,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'totalUsers' => $totalUsers,
            'pageTitle' => 'Quản lý Thành viên'
        ];

        $this->view('admin/layouts/header', $data);
        $this->view('admin/users', $data);
        $this->view('admin/layouts/footer');
    }

    public function updateUserStatus($id)
    {
        $this->checkAdminAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $status = $_POST['status'] ?? '';
            if (in_array($status, ['active', 'locked'])) {
                // Prevent locking the current admin
                if ($id == $_SESSION['user']['id']) {
                    $_SESSION['error_message'] = 'Bạn không thể tự khóa tài khoản của mình!';
                } else {
                    $this->usersModel->updateStatus($id, $status);
                    $_SESSION['success_message'] = 'Cập nhật trạng thái thành công!';
                }
            }
        }

        header('Location: ' . BASE_URL . '/admin/users');
        exit;
    }

    public function deleteUser($id)
    {
        $this->checkAdminAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Prevent deleting the current admin
            if ($id == $_SESSION['user']['id']) {
                $_SESSION['error_message'] = 'Bạn không thể tự xóa tài khoản của mình!';
            } else {
                $this->usersModel->deleteUser($id);
                $_SESSION['success_message'] = 'Tài khoản đã được xóa thành công!';
            }
        }

        header('Location: ' . BASE_URL . '/admin/users');
        exit;
    }
}
