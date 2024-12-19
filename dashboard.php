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
</head>

<body class="bg-light">
    <?php include 'includes/nav.php'; ?>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- 用戶資訊卡片 -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body p-4">
                        <div class="text-center mb-4">
                            <div class="avatar-circle mb-3">
                                <i class="bi bi-person-circle display-1 text-primary"></i>
                            </div>
                            <h2 class="h3">歡迎回來，<?php echo htmlspecialchars($user['username']); ?>！</h2>
                        </div>

                        <?php if (isset($_SESSION['success'])): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <?php echo $_SESSION['success'];
                                unset($_SESSION['success']); ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>

                        <!-- 用戶詳細資訊 -->
                        <div class="user-info p-3 bg-light rounded mb-4">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-envelope-fill text-primary me-2"></i>
                                        <div>
                                            <small class="text-muted d-block">電子信箱</small>
                                            <span><?php echo htmlspecialchars($user['email']); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-calendar-check text-primary me-2"></i>
                                        <div>
                                            <small class="text-muted d-block">註冊時間</small>
                                            <span><?php echo $user['created_at']; ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 功能按鈕區 -->
                        <div class="row g-3">
                            <div class="col-md-6">
                                <a href="profile.php"
                                    class="btn btn-primary w-100 d-flex align-items-center justify-content-center gap-2">
                                    <i class="bi bi-person-gear"></i>
                                    <span>修改個人資料</span>
                                </a>
                            </div>
                            <div class="col-md-6">
                                <a href="reservation.php"
                                    class="btn btn-info text-white w-100 d-flex align-items-center justify-content-center gap-2">
                                    <i class="bi bi-calendar2-check"></i>
                                    <span>我的訂位</span>
                                </a>
                            </div>
                            <div class="col-md-6">
                                <a href="menu.php"
                                    class="btn btn-success w-100 d-flex align-items-center justify-content-center gap-2">
                                    <i class="bi bi-book"></i>
                                    <span>瀏覽菜單</span>
                                </a>
                            </div>
                            <div class="col-md-6">
                                <a href="process/logout_process.php"
                                    class="btn btn-danger w-100 d-flex align-items-center justify-content-center gap-2">
                                    <i class="bi bi-box-arrow-right"></i>
                                    <span>登出</span>
                                </a>
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