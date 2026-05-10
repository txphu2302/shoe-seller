<?php
class CheckoutController extends Controller
{
    protected $orderModel;
    protected $productModel;

    public function __construct()
    {
        // Require login for checkout
        if (!isset($_SESSION['user'])) {
            $_SESSION['error_message'] = 'Vui lòng đăng nhập để tiến hành thanh toán.';
            header('Location: ' . BASE_URL . '/users/login');
            exit;
        }

        $this->orderModel = $this->model('Order');
        $this->productModel = $this->model('Product');
    }

    public function index()
    {
        if (empty($_SESSION['cart'])) {
            header('Location: ' . BASE_URL . '/cart');
            exit;
        }

        $cartItems = [];
        $totalPrice = 0;

        foreach ($_SESSION['cart'] as $item) {
            $product = $this->productModel->getProductById($item['product_id']);
            if ($product) {
                $subtotal = $product['price'] * $item['quantity'];
                $totalPrice += $subtotal;
                
                $cartItems[] = [
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
            'title' => 'Thanh toán',
            'page_css' => 'checkout',
            'cartItems' => $cartItems,
            'totalPrice' => $totalPrice,
            'user' => $_SESSION['user']
        ];

        $this->view('layouts/header', $data);
        $this->view('pages/checkout', $data);
        $this->view('layouts/footer');
    }

    public function process()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_SESSION['cart'])) {
                header('Location: ' . BASE_URL . '/cart');
                exit;
            }

            // Gather cart data
            $cartItems = [];
            $totalPrice = 0;

            foreach ($_SESSION['cart'] as $item) {
                $product = $this->productModel->getProductById($item['product_id']);
                if ($product) {
                    $subtotal = $product['price'] * $item['quantity'];
                    $totalPrice += $subtotal;
                    
                    $cartItems[] = [
                        'product_id' => $product['id'],
                        'size' => $item['size'],
                        'quantity' => $item['quantity'],
                        'price' => $product['price']
                    ];
                }
            }

            // Create order
            $orderId = $this->orderModel->createOrder($_SESSION['user']['id'], $totalPrice, $cartItems);

            if ($orderId) {
                // Clear cart
                $_SESSION['cart'] = [];
                $_SESSION['success_message'] = 'Đặt hàng thành công! Cảm ơn bạn đã mua sắm.';
                header('Location: ' . BASE_URL . '/order/success/' . $orderId);
                exit;
            } else {
                $_SESSION['error_message'] = 'Có lỗi xảy ra khi xử lý đơn hàng. Vui lòng thử lại.';
                header('Location: ' . BASE_URL . '/checkout');
                exit;
            }
        }
    }
}
