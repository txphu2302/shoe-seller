<?php
class ContactController extends Controller {
    public function index() {
        $this->view('layouts/header', ['title' => 'Liên hệ', 'page_css' => 'contact']);
        $this->view('home/contact');
        $this->view('layouts/footer');
    }
}
