<?php

class HomepageController extends Controller
{
    private $settingsModel;

    public function __construct()
    {
        $this->settingsModel = $this->model('Settings');
        $this->checkAdminAuth();
    }

    /**
     * Kiểm tra quyền admin
     */
    private function checkAdminAuth()
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

    /**
     * Trang quản lý trang chủ với các tabs
     */
    public function index()
    {
        // Lấy tab hiện tại (mặc định là 1 - Hero Section)
        $currentPage = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
        // Quản lý trang chủ: chỉ gồm 3 tab (Hero / Sản phẩm nổi bật / Brands & About)
        if ($currentPage > 3) {
            $currentPage = 1;
        }

        // Dữ liệu chung
        $viewData = [
            'title' => 'Quản lý Trang chủ',
            'currentPage' => $currentPage
        ];

        // Tab 1: Hero Section
        if ($currentPage === 1) {
            $viewData['heroData'] = $this->getHeroData();
        }

        // Tab 2: Sản phẩm nổi bật (Best Sellers & New Arrivals)
        if ($currentPage === 2) {
            $viewData['featuredProducts'] = $this->getFeaturedProductsData();
        }

        // Tab 3: Marquee/Brands & About Section
        if ($currentPage === 3) {
            $viewData['brands'] = $this->getBrandsData();
            $viewData['aboutData'] = $this->getAboutData();
        }

        // Tab 4: Cài đặt chung (thông tin công ty)
        $this->view('admin/layouts/header', $viewData);
        $this->view('admin/homepage', $viewData);
        $this->view('admin/layouts/footer');
    }

    /**
     * Lấy dữ liệu Hero Section
     */
    private function getHeroData()
    {
        return [
            'hero_title' => $this->settingsModel->getSetting('hero_title') ?? 'GIÀY ĐẸP GIÁ TỐT',
            'hero_subtitle' => $this->settingsModel->getSetting('hero_subtitle') ?? 'Hàng hiệu giá tốt lên đến 50%',
            'hero_description' => $this->settingsModel->getSetting('hero_description') ?? 'Khám phá bộ sưu tập giày thời trang mới nhất với giá ưu đãi đặc biệt.',
            'hero_button_text' => $this->settingsModel->getSetting('hero_button_text') ?? 'MUA NGAY',
            'hero_button_link' => $this->settingsModel->getSetting('hero_button_link') ?? '/product',
            'hero_background' => $this->settingsModel->getSetting('hero_background') ?? '/public/images/hero-bg.jpg',
        ];
    }

    /**
     * Lấy dữ liệu sản phẩm nổi bật
     */
    private function getFeaturedProductsData()
    {
        // Trong tương lai sẽ lấy từ Products model
        return [
            'best_sellers_title' => $this->settingsModel->getSetting('best_sellers_title') ?? 'BÁN CHẠY',
            'best_sellers_count' => intval($this->settingsModel->getSetting('best_sellers_count') ?? '8'),
            'new_arrivals_title' => $this->settingsModel->getSetting('new_arrivals_title') ?? 'HÀNG MỚI',
            'new_arrivals_count' => intval($this->settingsModel->getSetting('new_arrivals_count') ?? '4'),
        ];
    }

    /**
     * Lấy dữ liệu brands cho marquee
     */
    private function getBrandsData()
    {
        $brands = [];
        for ($i = 1; $i <= 6; $i++) {
            $brands[] = [
                'name' => $this->settingsModel->getSetting("brand_name_{$i}") ?? "Brand {$i}",
                'logo' => $this->settingsModel->getSetting("brand_logo_{$i}") ?? '/public/images/brand-default.png',
                'link' => $this->settingsModel->getSetting("brand_link_{$i}") ?? '#'
            ];
        }
        return $brands;
    }

    /**
     * Lấy dữ liệu About Section
     */
    private function getAboutData()
    {
        return [
            'about_title' => $this->settingsModel->getSetting('about_title') ?? 'Về Shoe Seller',
            'about_content' => $this->settingsModel->getSetting('about_content') ?? 'Shoe Seller là cửa hàng giày chính hãng với nhiều năm kinh nghiệm.',
            'about_image' => $this->settingsModel->getSetting('about_image') ?? '/public/images/about.jpg',
        ];
    }

    /**
     * Lấy cài đặt chung website
     */
    private function getSiteSettings()
    {
        return [
            'company_name' => $this->settingsModel->getSetting('company_name') ?? 'Shoe Seller',
            'phone' => $this->settingsModel->getSetting('phone') ?? '(+84) 123-456-789',
            'email' => $this->settingsModel->getSetting('email') ?? 'contact@shoeseller.com',
            'address' => $this->settingsModel->getSetting('address') ?? '123 Đường ABC, TP.HCM',
            'logo' => $this->settingsModel->getSetting('logo') ?? '/public/images/logo.png',
            'facebook' => $this->settingsModel->getSetting('facebook') ?? '',
            'instagram' => $this->settingsModel->getSetting('instagram') ?? '',
            'twitter' => $this->settingsModel->getSetting('twitter') ?? '',
        ];
    }

    /**
     * Cập nhật Hero Section
     */
    public function updateHero()
    {
        header('Content-Type: application/json');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false, 'error' => 'Request không hợp lệ']);
            exit;
        }

        $data = [
            'hero_title' => $_POST['hero_title'] ?? '',
            'hero_subtitle' => $_POST['hero_subtitle'] ?? '',
            'hero_description' => $_POST['hero_description'] ?? '',
            'hero_button_text' => $_POST['hero_button_text'] ?? '',
            'hero_button_link' => $_POST['hero_button_link'] ?? '',
        ];

        // Xử lý upload ảnh nền
        if (isset($_FILES['hero_background'])) {
            if ($_FILES['hero_background']['error'] === UPLOAD_ERR_OK) {
                $uploadResult = $this->handleImageUpload($_FILES['hero_background'], 'hero');
                if ($uploadResult['success']) {
                    $data['hero_background'] = $uploadResult['path'];
                } else {
                    echo json_encode(['success' => false, 'error' => $uploadResult['error'] ?? 'Upload ảnh thất bại']);
                    exit;
                }
            } elseif ($_FILES['hero_background']['error'] !== UPLOAD_ERR_NO_FILE) {
                echo json_encode(['success' => false, 'error' => 'Upload ảnh thất bại (code ' . intval($_FILES['hero_background']['error']) . ')']);
                exit;
            }
        }

        // Validation
        if (empty($data['hero_title']) || empty($data['hero_subtitle'])) {
            echo json_encode(['success' => false, 'error' => 'Vui lòng điền đầy đủ tiêu đề']);
            exit;
        }

        // Cập nhật settings
        $success = true;
        foreach ($data as $key => $value) {
            if ($this->settingsModel->settingExists($key)) {
                if (!$this->settingsModel->updateSetting($key, $value)) {
                    $success = false;
                }
            } else {
                if (!$this->settingsModel->createSetting($key, $value)) {
                    $success = false;
                }
            }
        }

        echo json_encode([
            'success' => $success,
            'message' => $success ? 'Cập nhật Hero Section thành công!' : 'Có lỗi xảy ra'
        ]);
        exit;
    }

    /**
     * Cập nhật Featured Products settings
     */
    public function updateFeaturedProducts()
    {
        header('Content-Type: application/json');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false, 'error' => 'Request không hợp lệ']);
            exit;
        }

        $data = [
            'best_sellers_title' => $_POST['best_sellers_title'] ?? 'BÁN CHẠY',
            'best_sellers_count' => intval($_POST['best_sellers_count'] ?? '8'),
            'new_arrivals_title' => $_POST['new_arrivals_title'] ?? 'HÀNG MỚI',
            'new_arrivals_count' => intval($_POST['new_arrivals_count'] ?? '4'),
        ];

        $success = true;
        foreach ($data as $key => $value) {
            if ($this->settingsModel->settingExists($key)) {
                if (!$this->settingsModel->updateSetting($key, $value)) {
                    $success = false;
                }
            } else {
                if (!$this->settingsModel->createSetting($key, $value)) {
                    $success = false;
                }
            }
        }

        echo json_encode([
            'success' => $success,
            'message' => $success ? 'Cập nhật thành công!' : 'Có lỗi xảy ra'
        ]);
        exit;
    }

    /**
     * Cập nhật Brands & About
     */
    public function updateBrandsAbout()
    {
        header('Content-Type: application/json');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false, 'error' => 'Request không hợp lệ']);
            exit;
        }

        $success = true;

        // Cập nhật thông tin brands
        for ($i = 1; $i <= 6; $i++) {
            $nameKey = "brand_name_{$i}";
            $linkKey = "brand_link_{$i}";
            
            $name = $_POST[$nameKey] ?? "Brand {$i}";
            $link = $_POST[$linkKey] ?? '#';

            // Xử lý upload logo brand
            $logoKey = "brand_logo_{$i}";
            if (isset($_FILES[$logoKey]) && $_FILES[$logoKey]['error'] === UPLOAD_ERR_OK) {
                $uploadResult = $this->handleImageUpload($_FILES[$logoKey], 'brands');
                if ($uploadResult['success']) {
                    $this->settingsModel->createSetting($logoKey, $uploadResult['path']);
                }
            }

            $this->saveOrUpdateSetting($nameKey, $name);
            $this->saveOrUpdateSetting($linkKey, $link);
        }

        // Cập nhật About section
        $aboutData = [
            'about_title' => $_POST['about_title'] ?? '',
            'about_content' => $_POST['about_content'] ?? '',
        ];

        if (isset($_FILES['about_image']) && $_FILES['about_image']['error'] === UPLOAD_ERR_OK) {
            $uploadResult = $this->handleImageUpload($_FILES['about_image'], 'about');
            if ($uploadResult['success']) {
                $aboutData['about_image'] = $uploadResult['path'];
            }
        }

        foreach ($aboutData as $key => $value) {
            $this->saveOrUpdateSetting($key, $value);
        }

        echo json_encode([
            'success' => $success,
            'message' => $success ? 'Cập nhật thành công!' : 'Có lỗi xảy ra'
        ]);
        exit;
    }

    /**
     * Cập nhật Site Settings
     */
    public function updateSiteSettings()
    {
        header('Content-Type: application/json');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false, 'error' => 'Request không hợp lệ']);
            exit;
        }

        $data = [
            'company_name' => $_POST['company_name'] ?? '',
            'phone' => $_POST['phone'] ?? '',
            'email' => $_POST['email'] ?? '',
            'address' => $_POST['address'] ?? '',
            'facebook' => $_POST['facebook'] ?? '',
            'instagram' => $_POST['instagram'] ?? '',
            'twitter' => $_POST['twitter'] ?? '',
        ];

        // Xử lý upload logo
        if (isset($_FILES['logo']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK) {
            $uploadResult = $this->handleImageUpload($_FILES['logo'], 'logo');
            if ($uploadResult['success']) {
                $data['logo'] = $uploadResult['path'];
            }
        }

        // Validation
        if (empty($data['company_name']) || empty($data['phone']) || empty($data['email'])) {
            echo json_encode(['success' => false, 'error' => 'Vui lòng điền đầy đủ thông tin bắt buộc']);
            exit;
        }

        $success = true;
        foreach ($data as $key => $value) {
            $this->saveOrUpdateSetting($key, $value);
        }

        echo json_encode([
            'success' => $success,
            'message' => $success ? 'Cập nhật thông tin website thành công!' : 'Có lỗi xảy ra'
        ]);
        exit;
    }

    /**
     * Helper: Lưu hoặc cập nhật setting
     */
    private function saveOrUpdateSetting($key, $value)
    {
        if ($this->settingsModel->settingExists($key)) {
            return $this->settingsModel->updateSetting($key, $value);
        } else {
            return $this->settingsModel->createSetting($key, $value);
        }
    }

    /**
     * Helper: Xử lý upload ảnh
     */
    private function handleImageUpload($file, $folder)
    {
        if ($file['error'] !== UPLOAD_ERR_OK) {
            return ['success' => false, 'error' => 'Lỗi khi tải file lên'];
        }

        // Kiểm tra kích thước (tối đa 5MB)
        if ($file['size'] > 5 * 1024 * 1024) {
            return ['success' => false, 'error' => 'File quá lớn (tối đa 5MB)'];
        }

        // Kiểm tra MIME type
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mimeType = $finfo->file($file['tmp_name']);

        $allowedMimes = [
            'image/jpeg' => 'jpg',
            'image/jpg' => 'jpg',
            'image/png' => 'png',
            'image/gif' => 'gif',
            'image/webp' => 'webp'
        ];

        if (!array_key_exists($mimeType, $allowedMimes)) {
            return ['success' => false, 'error' => 'Chỉ chấp nhận file ảnh (JPG, PNG, GIF, WEBP)'];
        }

        // Tạo thư mục upload
        $uploadDir = PUBLIC_PATH . '/uploads/' . $folder . '/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        // Tạo tên file an toàn
        $extension = $allowedMimes[$mimeType];
        $filename = uniqid() . '_' . time() . '.' . $extension;
        $filepath = $uploadDir . $filename;

        if (move_uploaded_file($file['tmp_name'], $filepath)) {
            return [
                'success' => true,
                'path' => '/public/uploads/' . $folder . '/' . $filename
            ];
        }

        return ['success' => false, 'error' => 'Không thể lưu file'];
    }
}
