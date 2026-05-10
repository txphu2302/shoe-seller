<?php
class Controller
{
    // Hàm gọi model
    public function model($model)
    {
        if (file_exists(APP_PATH . '/models/' . $model . '.php')) {
            require_once APP_PATH . '/models/' . $model . '.php';
            return new $model();
        }
        return false;
    }

    // Hàm gọi view
    public function view($view, $data = [])
    {
        // Removed AJAX check here so that full HTML is always generated.
        // This allows the SPA frontend (ajax_nav.js) to extract updated page titles and breadcrumbs.

        // Tự động load settings nếu chưa có
        if (!isset($data['settings'])) {
            $data['settings'] = $this->getSettings();
        }

        // Giải nén mảng data thành các biến riêng biệt để view có thể sử dụng
        if (!empty($data)) {
            extract($data);
        }

        if (file_exists(APP_PATH . '/views/' . $view . '.php')) {
            require_once APP_PATH . '/views/' . $view . '.php';
        } else {
            die('View không tồn tại.');
        }
    }

    // Hàm lấy settings từ database
    protected function getSettings()
    {
        static $settings = null;

        if ($settings === null) {
            $settings = [];
            $settingsModel = $this->model('Settings');
            if ($settingsModel) {
                $allSettings = $settingsModel->getAllSettings();
                foreach ($allSettings as $setting) {
                    $settings[$setting['key_name']] = $setting['key_value'];
                }
            }
        }

        return $settings;
    }
}
