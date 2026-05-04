<?php
class HomeController extends Controller {
    public function index() {
        // Khởi tạo dữ liệu mẫu cho Giai đoạn thiết kế Layout
        $data = [
            'title' => 'Trang chủ',
            'best_sellers' => [
                ['id'=>1, 'name'=>'AirMax Pure White', 'price'=>'2,500,000', 'brand'=>'Luxe', 'rating'=>4.8, 'is_new'=>true],
                ['id'=>2, 'name'=>'Noir High-Top', 'price'=>'3,200,000', 'brand'=>'Urban', 'rating'=>4.9, 'is_new'=>false, 'discount'=>'-10%'],
                ['id'=>3, 'name'=>'Velocity Crimson', 'price'=>'2,100,000', 'brand'=>'Stride', 'rating'=>4.7, 'is_new'=>false],
                ['id'=>4, 'name'=>'Suede Camel Low', 'price'=>'1,850,000', 'brand'=>'Atelier', 'rating'=>4.6, 'is_new'=>true]
            ],
            'new_arrivals' => [
                ['id'=>5, 'name'=>'Onyx Gold Edition', 'price'=>'4,500,000', 'brand'=>'Luxe', 'rating'=>5.0, 'is_new'=>true],
                ['id'=>6, 'name'=>'Cloud Walker Grey', 'price'=>'2,750,000', 'brand'=>'Stride', 'rating'=>4.8, 'is_new'=>true, 'discount'=>'-20%']
            ]
        ];

        $this->view('layouts/header', $data);
        $this->view('home/index', $data);
        $this->view('layouts/footer');
    }

    public function about() {
        $this->view('layouts/header', ['title' => 'Giới thiệu']);
        echo '<div class="container section-padding"><h1>Giới thiệu ShoeSeller</h1></div>';
        $this->view('layouts/footer');
    }

    public function contact() {
        $this->view('layouts/header', ['title' => 'Liên hệ']);
        echo '<div class="container section-padding"><h1>Liên hệ chúng tôi</h1></div>';
        $this->view('layouts/footer');
    }
}
