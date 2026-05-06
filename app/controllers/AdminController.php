<?php

class AdminController extends Controller
{
    public function index()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }

        if (($_SESSION['user']['role'] ?? '') !== 'admin') {
            header('Location: ' . BASE_URL . '/');
            exit;
        }

        $this->view('admin/layouts/header');
        $this->view('admin/dashboard');
        $this->view('admin/layouts/footer');
    }
}
