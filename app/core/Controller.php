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

        if (file_exists(APP_PATH . '/views/' . $view . '.php')) {
            require_once APP_PATH . '/views/' . $view . '.php';
        } else {
            die('View không tồn tại.');
        }
    }
}
