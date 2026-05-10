<?php
class CartController extends Controller
{
    protected $productModel;

    public function __construct()
    {
        $this->productModel = $this->model('Product');
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
    }

    public function index()
    {
        $cartItems = [];
        $totalPrice = 0;

        foreach ($_SESSION['cart'] as $item) {
            $product = $this->productModel->getProductById($item['product_id']);
            if ($product) {
                $subtotal = $product['price'] * $item['quantity'];
                $totalPrice += $subtotal;
                
                $cartItems[] = [
                    'cart_id' => $item['id'], // unique identifier for the cart item
                    'product_id' => $product['id'],
                    'name' => $product['name'],
                    'price' => $product['price'],
                    'image' => $product['image'],
                    'size' => $item['size'],
                    'quantity' => $item['quantity'],
                    'subtotal' => $subtotal
                ];
            }
        }

        $data = [
            'title' => 'Giỏ hàng của bạn',
            'page_css' => 'cart',
            'cartItems' => $cartItems,
            'totalPrice' => $totalPrice
        ];

        $this->view('layouts/header', $data);
        $this->view('pages/cart', $data);
        $this->view('layouts/footer');
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productId = isset($_POST['product_id']) ? (int)$_POST['product_id'] : 0;
            $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;
            $size = isset($_POST['size']) ? $_POST['size'] : '41';

            if ($productId > 0 && $quantity > 0) {
                // Check if product exists in DB
                $product = $this->productModel->getProductById($productId);
                
                if ($product) {
                    $found = false;
                    // Check if already in cart with same size
                    foreach ($_SESSION['cart'] as &$item) {
                        if ($item['product_id'] == $productId && $item['size'] == $size) {
                            $item['quantity'] += $quantity;
                            $found = true;
                            break;
                        }
                    }

                    if (!$found) {
                        $_SESSION['cart'][] = [
                            'id' => uniqid(), // Unique cart item ID
                            'product_id' => $productId,
                            'quantity' => $quantity,
                            'size' => $size
                        ];
                    }
                    
                    $_SESSION['success_message'] = 'Đã thêm ' . $product['name'] . ' vào giỏ hàng!';

                    // If AJAX request, return JSON
                    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                        header('Content-Type: application/json');
                        echo json_encode([
                            'success' => true,
                            'message' => 'Đã thêm sản phẩm vào giỏ hàng!',
                            'cart_count' => count($_SESSION['cart'])
                        ]);
                        exit;
                    }
                } else {
                    $_SESSION['error_message'] = 'Sản phẩm không tồn tại!';
                    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                        header('Content-Type: application/json');
                        echo json_encode(['success' => false, 'message' => 'Sản phẩm không tồn tại!']);
                        exit;
                    }
                }
            }
            
            header('Location: ' . BASE_URL . '/cart');
            exit;
        }
        
        header('Location: ' . BASE_URL . '/product');
        exit;
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cartId = $_POST['cart_id'] ?? '';
            $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;
            
            if (!empty($cartId) && $quantity > 0) {
                foreach ($_SESSION['cart'] as &$item) {
                    if ($item['id'] === $cartId) {
                        $item['quantity'] = $quantity;
                        break;
                    }
                }
                $_SESSION['success_message'] = 'Đã cập nhật số lượng!';
            }
        }
        
        header('Location: ' . BASE_URL . '/cart');
        exit;
    }

    public function remove($cartId = null)
    {
        if ($cartId) {
            foreach ($_SESSION['cart'] as $key => $item) {
                if ($item['id'] === $cartId) {
                    unset($_SESSION['cart'][$key]);
                    $_SESSION['success_message'] = 'Đã xóa sản phẩm khỏi giỏ hàng!';
                    break;
                }
            }
            // Re-index array
            $_SESSION['cart'] = array_values($_SESSION['cart']);
        }
        
        header('Location: ' . BASE_URL . '/cart');
        exit;
    }
}
