<?php
class AboutController extends Controller {
    public function index() {
        $this->view('layouts/header', ['title' => 'Giới thiệu', 'page_css' => 'about']);
        echo '<div class="container section-padding"><h1>Giới thiệu ShoeSeller</h1></div>';
        $this->view('layouts/footer');
    }
}
