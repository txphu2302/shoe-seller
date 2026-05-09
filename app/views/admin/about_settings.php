<div class="main-content-inner">
    <div class="row">
        <div class="col-lg-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Quản lý trang Giới thiệu</h4>
                    
                    <?php if (!empty($success)): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Thành công!</strong> <?= $success ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span class="fa fa-times"></span>
                            </button>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($errors)): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Lỗi!</strong> 
                            <ul>
                                <?php foreach($errors as $error): ?>
                                    <li><?= $error ?></li>
                                <?php endforeach; ?>
                            </ul>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span class="fa fa-times"></span>
                            </button>
                        </div>
                    <?php endif; ?>

                    <form action="<?= BASE_URL ?>/admin/aboutSettings" method="POST" enctype="multipart/form-data">
                        <!-- Hero Section -->
                        <div class="section-title mb-4 mt-5">
                            <h5 class="text-primary"><i class="fa fa-image mr-2"></i>Phần Banner (Hero)</h5>
                            <hr>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="about_hero_subtitle">Sub-title Banner</label>
                                    <input type="text" class="form-control" id="about_hero_subtitle" name="about_hero_subtitle" value="<?= $settings['about_hero_subtitle'] ?? 'OUR STORY' ?>">
                                </div>
                                <div class="form-group">
                                    <label for="about_hero_title">Tiêu đề Banner</label>
                                    <input type="text" class="form-control" id="about_hero_title" name="about_hero_title" value="<?= $settings['about_hero_title'] ?? 'Đẳng cấp được đo bằng từng bước chân.' ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Ảnh Banner</label>
                                    <input type="file" class="form-control" name="about_hero_image_file">
                                    <small class="text-muted">Ảnh hiện tại: <?= $settings['about_hero_image'] ?? 'Mặc định' ?></small>
                                    <?php if(!empty($settings['about_hero_image'])): ?>
                                        <div class="mt-2">
                                            <img src="<?= BASE_URL . '/' . $settings['about_hero_image'] ?>" style="max-height: 100px; border-radius: 5px;" alt="Hero">
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <!-- Main Content Section -->
                        <div class="section-title mb-4 mt-5">
                            <h5 class="text-primary"><i class="fa fa-file-text mr-2"></i>Nội dung chính</h5>
                            <hr>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="about_main_subtitle">Sub-title Nội dung</label>
                                    <input type="text" class="form-control" id="about_main_subtitle" name="about_main_subtitle" value="<?= $settings['about_main_subtitle'] ?? 'VỀ ShoeSeller' ?>">
                                </div>
                                <div class="form-group">
                                    <label for="about_main_title">Tiêu đề Nội dung</label>
                                    <input type="text" class="form-control" id="about_main_title" name="about_main_title" value="<?= $settings['about_main_title'] ?? 'Hơn cả một đôi giày.' ?>">
                                </div>
                                <div class="form-group">
                                    <label for="about_description_1">Đoạn văn 1</label>
                                    <textarea class="form-control" id="about_description_1" name="about_description_1" rows="3"><?= $settings['about_description_1'] ?? '' ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="about_description_2">Đoạn văn 2</label>
                                    <textarea class="form-control" id="about_description_2" name="about_description_2" rows="3"><?= $settings['about_description_2'] ?? '' ?></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Ảnh minh họa</label>
                                    <input type="file" class="form-control" name="about_main_image_file">
                                    <small class="text-muted">Ảnh hiện tại: <?= $settings['about_main_image'] ?? 'Mặc định' ?></small>
                                    <?php if(!empty($settings['about_main_image'])): ?>
                                        <div class="mt-2">
                                            <img src="<?= BASE_URL . '/' . $settings['about_main_image'] ?>" style="max-height: 150px; border-radius: 10px;" alt="Main Content">
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <!-- Stats Section -->
                        <div class="section-title mb-4 mt-5">
                            <h5 class="text-primary"><i class="fa fa-bar-chart mr-2"></i>Thông số Thống kê</h5>
                            <hr>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Thông số 1 (Số)</label>
                                    <input type="text" class="form-control" name="about_stat_1_num" value="<?= $settings['about_stat_1_num'] ?? '120K+' ?>">
                                </div>
                                <div class="form-group">
                                    <label>Thông số 1 (Nhãn)</label>
                                    <input type="text" class="form-control" name="about_stat_1_label" value="<?= $settings['about_stat_1_label'] ?? 'KHÁCH HÀNG' ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Thông số 2 (Số)</label>
                                    <input type="text" class="form-control" name="about_stat_2_num" value="<?= $settings['about_stat_2_num'] ?? '350+' ?>">
                                </div>
                                <div class="form-group">
                                    <label>Thông số 2 (Nhãn)</label>
                                    <input type="text" class="form-control" name="about_stat_2_label" value="<?= $settings['about_stat_2_label'] ?? 'MẪU GIÀY' ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Thông số 3 (Số)</label>
                                    <input type="text" class="form-control" name="about_stat_3_num" value="<?= $settings['about_stat_3_num'] ?? '4.9★' ?>">
                                </div>
                                <div class="form-group">
                                    <label>Thông số 3 (Nhãn)</label>
                                    <input type="text" class="form-control" name="about_stat_3_label" value="<?= $settings['about_stat_3_label'] ?? 'ĐÁNH GIÁ' ?>">
                                </div>
                            </div>
                        </div>

                        <!-- Core Values Section -->
                        <div class="section-title mb-4 mt-5">
                            <h5 class="text-primary"><i class="fa fa-diamond mr-2"></i>Giá trị cốt lõi</h5>
                            <hr>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="about_core_values_subtitle">Sub-title Giá trị</label>
                                    <input type="text" class="form-control" id="about_core_values_subtitle" name="about_core_values_subtitle" value="<?= $settings['about_core_values_subtitle'] ?? 'GIÁ TRỊ CỐT LÕI' ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="about_core_values_title">Tiêu đề Giá trị</label>
                                    <input type="text" class="form-control" id="about_core_values_title" name="about_core_values_title" value="<?= $settings['about_core_values_title'] ?? 'Điều làm nên ShoeSeller.' ?>">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card mb-3 border p-3">
                                    <h6>Giá trị 1</h6>
                                    <div class="form-group">
                                        <label>Tiêu đề</label>
                                        <input type="text" class="form-control" name="about_value_1_title" value="<?= $settings['about_value_1_title'] ?? 'Chính hãng 100%' ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Mô tả</label>
                                        <textarea class="form-control" name="about_value_1_desc" rows="2"><?= $settings['about_value_1_desc'] ?? '' ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card mb-3 border p-3">
                                    <h6>Giá trị 2</h6>
                                    <div class="form-group">
                                        <label>Tiêu đề</label>
                                        <input type="text" class="form-control" name="about_value_2_title" value="<?= $settings['about_value_2_title'] ?? 'Bền vững' ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Mô tả</label>
                                        <textarea class="form-control" name="about_value_2_desc" rows="2"><?= $settings['about_value_2_desc'] ?? '' ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card mb-3 border p-3">
                                    <h6>Giá trị 3</h6>
                                    <div class="form-group">
                                        <label>Tiêu đề</label>
                                        <input type="text" class="form-control" name="about_value_3_title" value="<?= $settings['about_value_3_title'] ?? 'Giao nhanh toàn quốc' ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Mô tả</label>
                                        <textarea class="form-control" name="about_value_3_desc" rows="2"><?= $settings['about_value_3_desc'] ?? '' ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card mb-3 border p-3">
                                    <h6>Giá trị 4</h6>
                                    <div class="form-group">
                                        <label>Tiêu đề</label>
                                        <input type="text" class="form-control" name="about_value_4_title" value="<?= $settings['about_value_4_title'] ?? 'Bảo hành dài hạn' ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Mô tả</label>
                                        <textarea class="form-control" name="about_value_4_desc" rows="2"><?= $settings['about_value_4_desc'] ?? '' ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-right mt-4">
                            <button type="submit" class="btn btn-primary px-5">Lưu thay đổi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
