<?php
class ContactController extends Controller {
    protected $contactsModel;

    public function __construct()
    {
        $this->contactsModel = $this->model('Contacts');
    }

    public function index() {
        // Settings tự động được load từ Controller base class
        $data = [
            'title' => 'Liên hệ',
            'page_css' => 'contact',
            'success' => '',
            'error' => ''
        ];

        // Xử lý form submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $phone = trim($_POST['phone'] ?? '');
            $subject = trim($_POST['subject'] ?? '');
            $message = trim($_POST['message'] ?? '');

            // Validation
            if (empty($name) || empty($email) || empty($message)) {
                $data['error'] = 'Vui lòng điền đầy đủ thông tin bắt buộc.';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $data['error'] = 'Email không hợp lệ.';
            } else {
                // Lưu vào database
                $contactData = [
                    'name' => $name,
                    'email' => $email,
                    'phone' => $phone,
                    'subject' => $subject,
                    'message' => $message,
                    'status' => 'unread'
                ];

                if ($this->contactsModel->createContact($contactData)) {
                    $data['success'] = 'Cảm ơn bạn đã liên hệ! Chúng tôi sẽ phản hồi trong thời gian sớm nhất.';
                } else {
                    $data['error'] = 'Có lỗi xảy ra. Vui lòng thử lại sau.';
                }
            }
        }

        $this->view('layouts/header', $data);
        $this->view('pages/contact', $data);
        $this->view('layouts/footer');
    }
}
