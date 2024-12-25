<?php
session_start();
require_once 'includes/auth.php';
checkLogin();
require_once 'config/database.php';

// 獲取用戶資料
try {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch();
} catch (PDOException $e) {
    $_SESSION['error'] = "獲取資料失敗：" . $e->getMessage();
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>會員中心</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.lordicon.com/lordicon.js"></script>
</head>


<body class="bg-light">
    <?php include 'includes/nav.php'; ?>
    <div class="container py-5">
        <div class="row">
            <!-- 左側選單 -->
            <div class="col-lg-3 mb-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="mb-3">
                            <lord-icon src="https://cdn.lordicon.com/dxjqoygy.json" trigger="hover"
                                colors="primary:#3b71ca" style="width:80px;height:80px">
                            </lord-icon>
                        </div>
                        <h5 class="mb-1"><?php echo htmlspecialchars($user['username']); ?></h5>
                        <p class="text-muted small mb-3"><?php echo htmlspecialchars($user['email']); ?></p>
                        <hr class="my-3">
                        <div class="d-grid">
                            <a href="profile.php" class="btn btn-outline-primary mb-2">編輯個人資料</a>
                            <a href="process/logout_process.php" class="btn btn-outline-danger">登出</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 右側內容 -->
            <div class="col-lg-9">
                <!-- 歡迎橫幅 -->
                <div class="card border-0 bg-primary bg-gradient text-white shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h4 class="mb-1">歡迎回來！</h4>
                        <p class="mb-0 opacity-75">查看您的帳戶資訊和最新動態</p>
                    </div>
                </div>

                <!-- 快速操作按鈕 -->
                <div class="row g-4 mb-4">
                    <div class="col-md-4">
                        <a href="reservation.php" class="card h-100 border-0 shadow-sm hover-lift text-decoration-none">
                            <div class="card-body p-4">
                                <div class="feature-icon bg-primary bg-opacity-10 text-primary rounded-3 mb-3">
                                    <i class="bi bi-calendar2-check fs-4"></i>
                                </div>
                                <h5 class="card-title text-dark">訂位管理</h5>
                                <p class="card-text text-muted small">查看您的訂位記錄</p>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-4">
                        <a href="menu.php" class="card h-100 border-0 shadow-sm hover-lift text-decoration-none">
                            <div class="card-body p-4">
                                <div class="feature-icon bg-success bg-opacity-10 text-success rounded-3 mb-3">
                                    <i class="bi bi-book fs-4"></i>
                                </div>
                                <h5 class="card-title text-dark">菜單瀏覽</h5>
                                <p class="card-text text-muted small">查看最新餐點資訊</p>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-4">
                        <a href="profile.php" class="card h-100 border-0 shadow-sm hover-lift text-decoration-none">
                            <div class="card-body p-4">
                                <div class="feature-icon bg-info bg-opacity-10 text-info rounded-3 mb-3">
                                    <i class="bi bi-person-gear fs-4"></i>
                                </div>
                                <h5 class="card-title text-dark">帳戶設定</h5>
                                <p class="card-text text-muted small">管理您的個人資料</p>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- 帳戶資訊卡片 -->
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-transparent border-0 pt-4 pb-2">
                        <h5 class="mb-0">帳戶資訊</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="d-flex align-items-center p-3 bg-light rounded-3">
                                    <i class="bi bi-person text-primary me-3"></i>
                                    <div>
                                        <div class="text-muted small">會員帳號</div>
                                        <div class="fw-medium"><?php echo htmlspecialchars($user['username']); ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center p-3 bg-light rounded-3">
                                    <i class="bi bi-envelope text-primary me-3"></i>
                                    <div>
                                        <div class="text-muted small">電子信箱</div>
                                        <div class="fw-medium"><?php echo htmlspecialchars($user['email']); ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center p-3 bg-light rounded-3">
                                    <i class="bi bi-calendar3 text-primary me-3"></i>
                                    <div>
                                        <div class="text-muted small">註冊時間</div>
                                        <div class="fw-medium"><?php echo $user['created_at']; ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center p-3 bg-light rounded-3">
                                    <i class="bi bi-telephone text-primary me-3"></i>
                                    <div>
                                        <div class="text-muted small">聯絡電話</div>
                                        <div class="fw-medium"><?php echo htmlspecialchars($user['phone'] ?? '尚未設定'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>