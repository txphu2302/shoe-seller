<?php
class ProductController extends Controller
{
    protected $productModel;

    public function __construct()
    {
        $this->productModel = $this->model('Product');
    }

    public function index()
    {
        $selectedCategory = isset($_GET['category']) ? trim((string)$_GET['category']) : '';
        $selectedCategoryId = ctype_digit($selectedCategory) ? (int)$selectedCategory : null;
        $pageParam = isset($_GET['page']) ? trim((string)$_GET['page']) : '1';
        $currentPage = ctype_digit($pageParam) ? max(1, (int)$pageParam) : 1;
        $perPage = 6;

        $categories = $this->productModel ? $this->productModel->getCategories() : [];
        $totalProducts = $this->productModel ? $this->productModel->countProductsByCategory($selectedCategoryId) : 0;
        $totalPages = max(1, (int)ceil($totalProducts / $perPage));

        if ($currentPage > $totalPages) {
            $currentPage = $totalPages;
        }

        $offset = ($currentPage - 1) * $perPage;
        $products = $this->productModel
            ? $this->productModel->getProductsByCategory($selectedCategoryId, $perPage, $offset)
            : [];

        $data = [
            'title' => 'Sản phẩm',
            'page_css' => 'product',
            'categories' => $categories,
            'products' => $products,
            'selected_category' => $selectedCategoryId,
            'pagination' => [
                'current_page' => $currentPage,
                'per_page' => $perPage,
                'total_products' => $totalProducts,
                'total_pages' => $totalPages,
            ],
        ];

        $this->view('layouts/header', $data);
        $this->view('pages/product', $data);
        $this->view('layouts/footer');
    }

    public function detail($id = null)
    {
        if (!$id) {
            header('Location: ' . BASE_URL . '/product');
            exit;
        }

        $product = $this->productModel->getProductById($id);

        if (!$product) {
            header('Location: ' . BASE_URL . '/product');
            exit;
        }

        // Optional: fetch related products (same category)
        $relatedProducts = $this->productModel->getProductsByCategory($product['category_id'], 4, 0);

        $data = [
            'title' => $product['name'],
            'page_css' => 'product_detail',
            'product' => $product,
            'related_products' => $relatedProducts
        ];

        $this->view('layouts/header', $data);
        $this->view('pages/product_detail', $data);
        $this->view('layouts/footer');
    }
}
