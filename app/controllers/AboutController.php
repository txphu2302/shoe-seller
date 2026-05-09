<?php
class AboutController extends Controller {
    public function index() {
        $data = [
            'title' => 'Giới thiệu',
            'page_css' => 'about'
        ];

        $this->view('layouts/header', $data);
        $this->view('pages/about', $data);
        $this->view('layouts/footer', $data);
    }
}
