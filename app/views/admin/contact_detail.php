<!-- contact detail area start -->
<div class="row mt-5">
    <div class="col-md-8 mx-auto">
        <?php if (isset($_SESSION['success_message'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa-solid fa-check-circle"></i> <?= $_SESSION['success_message'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['success_message']); ?>
        <?php endif; ?>

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center bg-white">
                <h4 class="header-title mb-0"><i class="fa-solid fa-envelope-open text-warning"></i> Chi tiết Liên hệ #<?= $contact->id ?></h4>
                <div>
                    <?php if ($contact->status === 'unread'): ?>
                        <span class="badge bg-warning text-dark">Chưa đọc</span>
                    <?php elseif ($contact->status === 'read'): ?>
                        <span class="badge bg-info">Đã đọc</span>
                    <?php else: ?>
                        <span class="badge bg-success">Đã phản hồi</span>
                    <?php endif; ?>
                </div>
            </div>
            <div class="card-body">
                <!-- Contact Info -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h6 class="text-muted mb-2">Thông tin người gửi</h6>
                        <p class="mb-1"><strong><i class="fa-solid fa-user"></i> Họ tên:</strong> <?= htmlspecialchars($contact->name) ?></p>
                        <p class="mb-1"><strong><i class="fa-solid fa-envelope"></i> Email:</strong> <a href="mailto:<?= htmlspecialchars($contact->email) ?>"><?= htmlspecialchars($contact->email) ?></a></p>
                        <?php if ($contact->phone): ?>
                            <p class="mb-1"><strong><i class="fa-solid fa-phone"></i> SĐT:</strong> <a href="tel:<?= htmlspecialchars($contact->phone) ?>"><?= htmlspecialchars($contact->phone) ?></a></p>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <h6 class="text-muted mb-2">Thời gian</h6>
                        <p class="mb-1"><strong>Ngày gửi:</strong> <?= date('d/m/Y', strtotime($contact->created_at)) ?></p>
                        <p class="mb-1"><strong>Giờ gửi:</strong> <?= date('H:i:s', strtotime($contact->created_at)) ?></p>
                    </div>
                </div>

                <!-- Message -->
                <div class="border rounded p-3 mb-4 bg-light">
                    <h6 class="text-muted mb-2">Nội dung tin nhắn:</h6>
                    <p class="mb-0" style="white-space: pre-wrap;"><?= nl2br(htmlspecialchars($contact->message)) ?></p>
                </div>

                <!-- Actions -->
                <div class="d-flex justify-content-between">
                    <a href="<?= BASE_URL ?>/admin/contacts" class="btn btn-outline-secondary">
                        <i class="fa-solid fa-arrow-left"></i> Quay lại
                    </a>
                    
                    <div class="btn-group">
                        <?php if ($contact->status !== 'read'): ?>
                            <form action="<?= BASE_URL ?>/admin/contact/update/<?= $contact->id ?>" method="post" class="d-inline">
                                <input type="hidden" name="status" value="read">
                                <button type="submit" class="btn btn-info">
                                    <i class="fa-solid fa-check"></i> Đánh dấu đã đọc
                                </button>
                            </form>
                        <?php endif; ?>
                        
                        <?php if ($contact->status !== 'replied'): ?>
                            <form action="<?= BASE_URL ?>/admin/contact/update/<?= $contact->id ?>" method="post" class="d-inline">
                                <input type="hidden" name="status" value="replied">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa-solid fa-reply"></i> Đánh dấu đã phản hồi
                                </button>
                            </form>
                        <?php endif; ?>
                        
                        <form action="<?= BASE_URL ?>/admin/contact/delete/<?= $contact->id ?>" method="post" class="d-inline" onsubmit="return confirm('Bạn có chắc muốn xóa liên hệ này?')">
                            <button type="submit" class="btn btn-danger">
                                <i class="fa-solid fa-trash"></i> Xóa
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Quick Reply -->
                <hr class="my-4">
                <h6 class="mb-3"><i class="fa-solid fa-reply"></i> Gửi phản hồi nhanh</h6>
                <form action="mailto:<?= htmlspecialchars($contact->email) ?>" method="post" enctype="text/plain">
                    <div class="mb-3">
                        <textarea class="form-control" rows="4" placeholder="Nhập nội dung phản hồi..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-gold">
                        <i class="fa-solid fa-paper-plane"></i> Mở Email Client
                    </button>
                    <small class="text-muted ms-2">Sẽ mở ứng dụng email mặc định của bạn</small>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- contact detail area end -->
