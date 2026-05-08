<?php
// Bắt đầu session
session_start();

// Nạp file cấu hình
require_once 'config/config.php';

// Cấu hình Autoload các class trong thư mục core
spl_autoload_register(function ($className) {
    if (file_exists(APP_PATH . '/core/' . $className . '.php')) {
        require_once APP_PATH . '/core/' . $className . '.php';
    } else if (file_exists(APP_PATH . '/controllers/' . $className . '.php')) {
        require_once APP_PATH . '/controllers/' . $className . '.php';
    } else if (file_exists(APP_PATH . '/models/' . $className . '.php')) {
        require_once APP_PATH . '/models/' . $className . '.php';
    }
});

// Khởi tạo App
$app = new App();
