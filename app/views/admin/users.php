<!-- users management area start -->
<div class="row mt-5">
    <div class="col-12">
        <?php if (isset($_SESSION['success_message'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa-solid fa-check-circle"></i> <?= $_SESSION['success_message'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['success_message']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['error_message'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fa-solid fa-exclamation-circle"></i> <?= $_SESSION['error_message'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['error_message']); ?>
        <?php endif; ?>

        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="header-title mb-0"><i class="fa-solid fa-users text-primary"></i> Danh sách Thành viên</h4>
                    <div>
                        <span class="badge bg-primary fs-6 px-3 py-2">Tổng số: <?= $totalUsers ?></span>
                    </div>
                </div>
                
                <?php if (empty($users)): ?>
                    <div class="text-center py-5">
                        <i class="fa-solid fa-users-slash fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">Không có thành viên nào</h5>
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Tên người dùng</th>
                                    <th>Email</th>
                                    <th>Vai trò</th>
                                    <th>Trạng thái</th>
                                    <th>Ngày tham gia</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($users as $user): ?>
                                    <tr>
                                        <td>#<?= $user->id ?></td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm me-3">
                                                    <?php if ($user->avatar): ?>
                                                        <img src="<?= BASE_URL . '/' . $user->avatar ?>" alt="avatar" class="rounded-circle" width="40" height="40">
                                                    <?php else: ?>
                                                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width:40px; height:40px;">
                                                            <?= strtoupper(substr($user->name, 0, 1)) ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0"><?= htmlspecialchars($user->name) ?></h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td><?= htmlspecialchars($user->email) ?></td>
                                        <td>
                                            <?php if ($user->role === 'admin'): ?>
                                                <span class="badge bg-danger">Quản trị viên</span>
                                            <?php else: ?>
                                                <span class="badge bg-secondary">Thành viên</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if ($user->status === 'active'): ?>
                                                <span class="badge bg-success">Hoạt động</span>
                                            <?php else: ?>
                                                <span class="badge bg-warning text-dark">Đã khóa</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= date('d/m/Y H:i', strtotime($user->created_at)) ?></td>
                                        <td>
                                            <?php if ($user->id != $_SESSION['user']['id']): ?>
                                                <div class="btn-group">
                                                    <form action="<?= BASE_URL ?>/admin/updateUserStatus/<?= $user->id ?>" method="post" class="d-inline">
                                                        <input type="hidden" name="status" value="<?= $user->status === 'active' ? 'locked' : 'active' ?>">
                                                        <button type="submit" class="btn btn-sm <?= $user->status === 'active' ? 'btn-outline-warning' : 'btn-outline-success' ?>" title="<?= $user->status === 'active' ? 'Khóa tài khoản' : 'Mở khóa tài khoản' ?>">
                                                            <i class="fa-solid <?= $user->status === 'active' ? 'fa-lock' : 'fa-unlock' ?>"></i>
                                                        </button>
                                                    </form>
                                                    
                                                    <form action="<?= BASE_URL ?>/admin/deleteUser/<?= $user->id ?>" method="post" class="d-inline ms-1" onsubmit="return confirm('Bạn có chắc muốn xóa tài khoản này? Thao tác này không thể hoàn tác!')">
                                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Xóa tài khoản">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            <?php else: ?>
                                                <span class="text-muted small">Tài khoản của bạn</span>
                                            <?php endif; ?>
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
                                    <a class="page-link" href="<?= BASE_URL ?>/admin/users?page=<?= $currentPage - 1 ?>">Trước</a>
                                </li>
                                
                                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                    <li class="page-item <?= $i === $currentPage ? 'active' : '' ?>">
                                        <a class="page-link" href="<?= BASE_URL ?>/admin/users?page=<?= $i ?>"><?= $i ?></a>
                                    </li>
                                <?php endfor; ?>
                                
                                <li class="page-item <?= $currentPage >= $totalPages ? 'disabled' : '' ?>">
                                    <a class="page-link" href="<?= BASE_URL ?>/admin/users?page=<?= $currentPage + 1 ?>">Sau</a>
                                </li>
                            </ul>
                        </nav>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<!-- users management area end -->
