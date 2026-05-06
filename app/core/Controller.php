<?php
class Controller
{
    // Hàm gọi model
    public function model($model)
    {
        if (file_exists(APP_PATH . '/model/' . $model . '.php')) {
            require_once APP_PATH . '/model/' . $model . '.php';
            return new $model();
        }

        if (file_exists(APP_PATH . '/models/' . $model . '.php')) {
            require_once APP_PATH . '/models/' . $model . '.php';
            return new $model();
        }
        return false;
    }

    // Hàm gọi view
    public function view($view, $data = [])
    {
        // Giải nén mảng data thành các biến riêng biệt để view có thể sử dụng
        if (!empty($data)) {
            extract($data);
        }

        $viewFile = APP_PATH . '/views/' . $view . '.php';
        // Fallback: if view is provided as a path like 'users/login' but the
        // actual file is stored at 'views/users/login/login.php', try that.
        $altFile = APP_PATH . '/views/' . $view . '/' . basename($view) . '.php';

        if (file_exists($viewFile)) {
            require_once $viewFile;
        } elseif (file_exists($altFile)) {
            require_once $altFile;
        } else {
            die('View không tồn tại.');
        }
    }
}
