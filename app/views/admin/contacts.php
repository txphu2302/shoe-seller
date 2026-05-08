<!-- contacts management area start -->
<div class="row mt-5">
    <div class="col-12">
        <?php if (isset($_SESSION['success_message'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa-solid fa-check-circle"></i> <?= $_SESSION['success_message'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['success_message']); ?>
        <?php endif; ?>

        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted">Tổng liên hệ</h6>
                            <h3 class="mb-0"><?= $totalContacts ?></h3>
                        </div>
                        <div class="card-icon">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-warning">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted">Chưa đọc</h6>
                            <h3 class="mb-0 text-warning"><?= $unreadCount ?></h3>
                        </div>
                        <div class="card-icon text-warning">
                            <i class="fa-solid fa-envelope-open-text"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-success">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted">Đã phản hồi</h6>
                            <h3 class="mb-0 text-success"><?= $repliedCount ?></h3>
                        </div>
                        <div class="card-icon text-success">
                            <i class="fa-solid fa-check-circle"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Tabs -->
        <div class="card">
            <div class="card-header bg-white">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link <?= !$currentStatus ? 'active' : '' ?>" href="<?= BASE_URL ?>/admin/contacts">Tất cả</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $currentStatus === 'unread' ? 'active' : '' ?>" href="<?= BASE_URL ?>/admin/contacts?status=unread">
                            Chưa đọc <?= $unreadCount > 0 ? "<span class='badge bg-warning text-dark'>{$unreadCount}</span>" : '' ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $currentStatus === 'read' ? 'active' : '' ?>" href="<?= BASE_URL ?>/admin/contacts?status=read">Đã đọc</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $currentStatus === 'replied' ? 'active' : '' ?>" href="<?= BASE_URL ?>/admin/contacts?status=replied">Đã phản hồi</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <h4 class="header-title mb-4"><i class="fa-solid fa-envelope text-warning"></i> Danh sách Liên hệ</h4>
                
                <?php if (empty($contacts)): ?>
                    <div class="text-center py-5">
                        <i class="fa-solid fa-inbox fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">Không có liên hệ nào</h5>
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Người gửi</th>
                                    <th>Email</th>
                                    <th>Số điện thoại</th>
                                    <th>Nội dung</th>
                                    <th>Ngày gửi</th>
                                    <th>Trạng thái</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($contacts as $contact): ?>
                                    <tr class="<?= $contact->status === 'unread' ? 'table-warning' : '' ?>">
                                        <td><?= $contact->id ?></td>
                                        <td>
                                            <strong><?= htmlspecialchars($contact->name) ?></strong>
                                        </td>
                                        <td><?= htmlspecialchars($contact->email) ?></td>
                                        <td><?= htmlspecialchars($contact->phone ?? 'N/A') ?></td>
                                        <td>
                                            <span class="text-truncate d-inline-block" style="max-width: 200px;">
                                                <?= htmlspecialchars(substr($contact->message, 0, 50)) ?>...
                                            </span>
                                        </td>
                                        <td><?= date('d/m/Y H:i', strtotime($contact->created_at)) ?></td>
                                        <td>
                                            <?php if ($contact->status === 'unread'): ?>
                                                <span class="badge bg-warning text-dark">Chưa đọc</span>
                                            <?php elseif ($contact->status === 'read'): ?>
                                                <span class="badge bg-info">Đã đọc</span>
                                            <?php else: ?>
                                                <span class="badge bg-success">Đã phản hồi</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="<?= BASE_URL ?>/admin/contact/view/<?= $contact->id ?>" class="btn btn-sm btn-outline-primary" title="Xem chi tiết">
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>
                                                
                                                <?php if ($contact->status !== 'replied'): ?>
                                                    <form action="<?= BASE_URL ?>/admin/contact/update/<?= $contact->id ?>" method="post" class="d-inline">
                                                        <input type="hidden" name="status" value="replied">
                                                        <button type="submit" class="btn btn-sm btn-outline-success" title="Đánh dấu đã phản hồi">
                                                            <i class="fa-solid fa-check"></i>
                                                        </button>
                                                    </form>
                                                <?php endif; ?>
                                                
                                                <form action="<?= BASE_URL ?>/admin/contact/delete/<?= $contact->id ?>" method="post" class="d-inline" onsubmit="return confirm('Bạn có chắc muốn xóa liên hệ này?')">
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Xóa">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <?php if ($totalPages > 1): ?>
                        <nav aria-label="Page navigation" class="mt-4">
                            <ul class="pagination justify-content-center">
                                <li class="page-item <?= $currentPage <= 1 ? 'disabled' : '' ?>">
                                    <a class="page-link" href="<?= BASE_URL ?>/admin/contacts?page=<?= $currentPage - 1 ?><?= $currentStatus ? '&status=' . $currentStatus : '' ?>">Trước</a>
                                </li>
                                
                                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                    <li class="page-item <?= $i === $currentPage ? 'active' : '' ?>">
                                        <a class="page-link" href="<?= BASE_URL ?>/admin/contacts?page=<?= $i ?><?= $currentStatus ? '&status=' . $currentStatus : '' ?>"><?= $i ?></a>
                                    </li>
                                <?php endfor; ?>
                                
                                <li class="page-item <?= $currentPage >= $totalPages ? 'disabled' : '' ?>">
                                    <a class="page-link" href="<?= BASE_URL ?>/admin/contacts?page=<?= $currentPage + 1 ?><?= $currentStatus ? '&status=' . $currentStatus : '' ?>">Sau</a>
                                </li>
                            </ul>
                        </nav>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<!-- contacts management area end -->
