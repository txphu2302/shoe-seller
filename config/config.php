<?php
// Tên database
define('DB_HOST', 'localhost');
define('DB_USER', 'root'); // Thay đổi nếu có user khác
define('DB_PASS', '');     // Thay đổi nếu có mật khẩu
define('DB_NAME', 'shoe_seller');

// URL cơ sở của website
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'];
$scriptDir = dirname($_SERVER['SCRIPT_NAME']);
$scriptDir = str_replace('\\', '/', $scriptDir);
if ($scriptDir === '/') {
    $scriptDir = '';
}
define('BASE_URL', $protocol . '://' . $host . $scriptDir);

define('ROOT_PATH', dirname(__DIR__));
define('APP_PATH', ROOT_PATH . '/app');
define('PUBLIC_PATH', ROOT_PATH . '/public');

// Autoload core, controller và model
spl_autoload_register(function ($className) {

    $file = APP_PATH . '/core/' . $className . '.php';
    if (file_exists($file)) {
        require_once $file;
        return;
    }

    $file = APP_PATH . '/controllers/' . $className . '.php';
    if (file_exists($file)) {
        require_once $file;
        return;
    }

    $file = APP_PATH . '/model/' . $className . '.php';
    if (file_exists($file)) {
        require_once $file;
        return;
    }
});
