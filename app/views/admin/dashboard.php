
<!-- ShoeSeller Dashboard - Nhiệm vụ 1 -->
<!-- Statistics Cards -->
<div class="row mt-5">
    <div class="col-lg-4 col-md-6">
        <div class="card border-left-success mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted text-uppercase mb-1">Tổng liên hệ</h6>
                        <h3 class="mb-0 font-weight-bold"><?= $totalContacts ?? 0 ?></h3>
                    </div>
                    <div class="card-icon text-primary">
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-white border-top-0">
                <a href="<?= BASE_URL ?>/admin/contacts" class="text-decoration-none">
                    <span class="text-primary">Xem tất cả</span> <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="card border-left-warning mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted text-uppercase mb-1">Liên hệ chưa đọc</h6>
                        <h3 class="mb-0 font-weight-bold"><?= $unreadContacts ?? 0 ?></h3>
                    </div>
                    <div class="card-icon text-warning">
                        <i class="fa-solid fa-envelope-open"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-white border-top-0">
                <a href="<?= BASE_URL ?>/admin/contacts?status=unread" class="text-decoration-none">
                    <span class="text-warning">Xem ngay</span> <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="card border-left-info mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted text-uppercase mb-1">Cài đặt Website</h6>
                        <h3 class="mb-0 font-weight-bold"><i class="fa-solid fa-cog"></i></h3>
                    </div>
                    <div class="card-icon text-info">
                        <i class="fa-solid fa-sliders-h"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-white border-top-0">
                <a href="<?= BASE_URL ?>/admin/settings" class="text-decoration-none">
                    <span class="text-info">Quản lý cài đặt</span> <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Quick Access Links -->
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-white">
                <h4 class="header-title mb-0"><i class="fa-solid fa-bolt text-warning"></i> Truy cập nhanh</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <a href="<?= BASE_URL ?>/admin/settings" class="btn btn-outline-dark w-100 py-3">
                            <i class="fa-solid fa-cog fa-2x mb-2 d-block"></i>
                            Cài đặt Website
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="<?= BASE_URL ?>/admin/contacts" class="btn btn-outline-dark w-100 py-3">
                            <i class="fa-solid fa-envelope fa-2x mb-2 d-block"></i>
                            Quản lý Liên hệ
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="<?= BASE_URL ?>" target="_blank" class="btn btn-outline-dark w-100 py-3">
                            <i class="fa-solid fa-external-link-alt fa-2x mb-2 d-block"></i>
                            Xem Website
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="<?= BASE_URL ?>/users/logout" class="btn btn-outline-danger w-100 py-3" onclick="return confirm('Bạn có chắc muốn đăng xuất?')">
                            <i class="fa-solid fa-sign-out-alt fa-2x mb-2 d-block"></i>
                            Đăng xuất
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Contacts -->
<div class="row mt-4">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h4 class="header-title mb-0"><i class="fa-solid fa-envelope text-warning"></i> Liên hệ gần đây</h4>
                <a href="<?= BASE_URL ?>/admin/contacts" class="btn btn-sm btn-gold">Xem tất cả</a>
            </div>
            <div class="card-body">
                <?php if (!empty($contacts) && count($contacts) > 0): ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Người gửi</th>
                                    <th>Nội dung</th>
                                    <th>Trạng thái</th>
                                    <th>Ngày</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $recentContacts = array_slice($contacts, 0, 5);
                                foreach ($recentContacts as $contact): 
                                ?>
                                    <tr class="<?= $contact->status === 'unread' ? 'table-warning' : '' ?>">
                                        <td>
                                            <strong><?= htmlspecialchars($contact->name) ?></strong><br>
                                            <small class="text-muted"><?= htmlspecialchars($contact->email) ?></small>
                                        </td>
                                        <td><?= htmlspecialchars(substr($contact->message, 0, 50)) ?>...</td>
                                        <td>
                                            <?php if ($contact->status === 'unread'): ?>
                                                <span class="badge bg-warning text-dark">Chưa đọc</span>
                                            <?php elseif ($contact->status === 'read'): ?>
                                                <span class="badge bg-info">Đã đọc</span>
                                            <?php else: ?>
                                                <span class="badge bg-success">Đã phản hồi</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= date('d/m/Y', strtotime($contact->created_at)) ?></td>
                                        <td>
                                            <a href="<?= BASE_URL ?>/admin/contact/view/<?= $contact->id ?>" class="btn btn-sm btn-outline-primary">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="text-center py-4">
                        <i class="fa-solid fa-inbox fa-3x text-muted mb-3"></i>
                        <p class="text-muted">Chưa có liên hệ nào</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header bg-white">
                <h4 class="header-title mb-0"><i class="fa-solid fa-info-circle text-warning"></i> Thông tin hệ thống</h4>
            </div>
            <div class="card-body">
                <ul class="list-unstyled mb-0">
                    <li class="mb-3 d-flex justify-content-between">
                        <span><i class="fa-solid fa-code"></i> Phiên bản PHP:</span>
                        <span class="badge bg-secondary"><?= phpversion() ?></span>
                    </li>
                    <li class="mb-3 d-flex justify-content-between">
                        <span><i class="fa-solid fa-database"></i> Database:</span>
                        <span class="badge bg-secondary">MySQL</span>
                    </li>
                    <li class="mb-3 d-flex justify-content-between">
                        <span><i class="fa-solid fa-user-shield"></i> Tài khoản:</span>
                        <span class="badge bg-success"><?= $_SESSION['user']['name'] ?? 'Admin' ?></span>
                    </li>
                    <li class="mb-3 d-flex justify-content-between">
                        <span><i class="fa-solid fa-clock"></i> Thời gian:</span>
                        <span class="badge bg-info"><?= date('H:i d/m/Y') ?></span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- row area start-->
</div>
</div>