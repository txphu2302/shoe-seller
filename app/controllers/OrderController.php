<?php
class OrderController extends Controller
{
    protected $orderModel;

    public function __construct()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . BASE_URL . '/users/login');
            exit;
        }
        $this->orderModel = $this->model('Order');
    }

    public function history()
    {
        $orders = $this->orderModel->getOrdersByUserId($_SESSION['user']['id']);

        // Get details for each order
        foreach ($orders as &$order) {
            $order['items'] = $this->orderModel->getOrderDetails($order['id']);
        }

        $data = [
            'title' => 'Lịch sử mua hàng',
            'page_css' => 'orders',
            'orders' => $orders
        ];

        $this->view('layouts/header', $data);
        $this->view('pages/orders', $data);
        $this->view('layouts/footer');
    }

    public function success($orderId)
    {
        $data = [
            'title' => 'Đặt hàng thành công',
            'page_css' => 'orders',
            'orderId' => $orderId
        ];

        $this->view('layouts/header', $data);
        $this->view('pages/order_success', $data);
        $this->view('layouts/footer');
    }
}
