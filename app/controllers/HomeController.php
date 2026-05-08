<?php
class HomeController extends Controller {
    public function index() {
        $settingsModel = $this->model('Settings');
        $productModel = $this->model('Product');

        $heroData = [
            'hero_title' => $settingsModel?->getSetting('hero_title') ?? 'GIÀY ĐẸP GIÁ TỐT',
            'hero_subtitle' => $settingsModel?->getSetting('hero_subtitle') ?? 'Hàng hiệu giá tốt lên đến 50%',
            'hero_description' => $settingsModel?->getSetting('hero_description') ?? 'Khám phá bộ sưu tập giày thời trang mới nhất với giá ưu đãi đặc biệt.',
            'hero_button_text' => $settingsModel?->getSetting('hero_button_text') ?? 'MUA NGAY',
            'hero_button_link' => $settingsModel?->getSetting('hero_button_link') ?? '/products',
            'hero_background' => $settingsModel?->getSetting('hero_background') ?? '/public/images/hero-bg.jpg',
        ];

        $featuredSettings = [
            'best_sellers_title' => $settingsModel?->getSetting('best_sellers_title') ?? 'BÁN CHẠY',
            'best_sellers_count' => (int)($settingsModel?->getSetting('best_sellers_count') ?? 8),
            'new_arrivals_title' => $settingsModel?->getSetting('new_arrivals_title') ?? 'HÀNG MỚI',
            'new_arrivals_count' => (int)($settingsModel?->getSetting('new_arrivals_count') ?? 4),
        ];

        $brands = [];
        for ($i = 1; $i <= 6; $i++) {
            $brands[] = [
                'name' => $settingsModel?->getSetting("brand_name_{$i}") ?? "Brand {$i}",
                'logo' => $settingsModel?->getSetting("brand_logo_{$i}") ?? '',
                'link' => $settingsModel?->getSetting("brand_link_{$i}") ?? '#',
            ];
        }

        $aboutData = [
            'about_title' => $settingsModel?->getSetting('about_title') ?? 'Về Shoe Seller',
            'about_content' => $settingsModel?->getSetting('about_content') ?? 'Shoe Seller là cửa hàng giày chính hãng với nhiều năm kinh nghiệm.',
            'about_image' => $settingsModel?->getSetting('about_image') ?? '/public/images/about.jpg',
        ];

        $bestSellers = $productModel ? $productModel->getBestSellingProducts($featuredSettings['best_sellers_count']) : [];
        $newArrivals = $productModel ? $productModel->getLatestProducts($featuredSettings['new_arrivals_count']) : [];

        $data = [
            'title' => 'Trang chủ',
            'page_css' => 'home',
            'hero' => $heroData,
            'featured' => $featuredSettings,
            'brands' => $brands,
            'about' => $aboutData,
            'best_sellers' => $bestSellers,
            'new_arrivals' => $newArrivals,
        ];

        $this->view('layouts/header', $data);
        $this->view('pages/home', $data);
        $this->view('layouts/footer');
    }
}
