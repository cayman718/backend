<?php
session_start();
require_once 'includes/auth.php';
require_once 'config/database.php';
checkLogin();

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
    <title>修改個人資料</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
    .card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.08) !important;
    }

    .card-header {
        background: linear-gradient(135deg, #0d6efd, #0b5ed7);
        border-bottom: none;
    }

    .form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
    }

    .input-group-text {
        border: none;
        background-color: #f8f9fa;
    }

    .btn-primary {
        background: linear-gradient(135deg, #0d6efd, #0b5ed7);
        border: none;
        padding: 12px 20px;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(13, 110, 253, 0.2);
    }

    .btn-outline-secondary {
        border-width: 2px;
        padding: 12px 20px;
        transition: all 0.3s ease;
    }

    .btn-outline-secondary:hover {
        transform: translateY(-2px);
    }

    .form-label {
        color: #495057;
        font-size: 0.95rem;
    }

    .input-group {
        border-radius: 10px;
        overflow: hidden;
    }

    .form-control {
        border: 1px solid #e9ecef;
        padding: 12px;
    }

    .alert {
        border: none;
        border-radius: 10px;
    }

    .card-body {
        padding: 2rem;
    }
    </style>
</head>

<body class="bg-light">
    <?php include 'includes/nav.php'; ?>
    <div class="content-wrapper">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow">
                        <div class="card-header text-white text-center py-4 rounded-top">
                            <h2 class="card-title mb-0">
                                <i class="bi bi-person-circle me-2"></i>修改個人資料
                            </h2>
                            <p class="mb-0 mt-2 opacity-75">更新您的個人資訊和密碼</p>
                        </div>
                        <div class="card-body p-4">
                            <?php if (isset($_SESSION['error'])): ?>
                            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                <?php echo $_SESSION['error'];
                                    unset($_SESSION['error']); ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                            <?php endif; ?>

                            <?php if (isset($_SESSION['success'])): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="bi bi-check-circle-fill me-2"></i>
                                <?php echo $_SESSION['success'];
                                    unset($_SESSION['success']); ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                            <?php endif; ?>

                            <form method="POST" action="process/profile_process.php" class="mt-3">
                                <div class="mb-4">
                                    <label class="form-label fw-bold">
                                        <i class="bi bi-envelope me-2"></i>電子郵件
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">
                                            <i class="bi bi-at"></i>
                                        </span>
                                        <input type="email" class="form-control" name="email"
                                            value="<?php echo htmlspecialchars($user['email']); ?>" required>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-bold">
                                        <i class="bi bi-telephone me-2"></i>聯絡電話
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">
                                            <i class="bi bi-phone"></i>
                                        </span>
                                        <input type="tel" class="form-control" name="phone"
                                            value="<?php echo htmlspecialchars($user['phone'] ?? ''); ?>"
                                            pattern="[0-9]{10}" title="請輸入10位數字的電話號碼">
                                    </div>
                                    <small class="text-muted">請輸入10位數字的電話號碼</small>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-bold">
                                        <i class="bi bi-key me-2"></i>新密碼
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">
                                            <i class="bi bi-lock"></i>
                                        </span>
                                        <input type="password" class="form-control" name="new_password" minlength="6">
                                    </div>
                                    <small class="text-muted">如不修改請留空</small>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-bold">
                                        <i class="bi bi-check-circle me-2"></i>確認新密碼
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">
                                            <i class="bi bi-lock-fill"></i>
                                        </span>
                                        <input type="password" class="form-control" name="confirm_password">
                                    </div>
                                </div>

                                <div class="d-grid gap-3">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="bi bi-check2-circle me-2"></i>更新資料
                                    </button>
                                    <a href="dashboard.php" class="btn btn-outline-secondary">
                                        <i class="bi bi-arrow-left me-2"></i>返回會員中心
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    $(document).ready(function() {
        // 頁面載入效果
        $('.content-wrapper').animate({
            opacity: 1
        }, 600);

        // 如果有提示訊息，平滑顯示
        $('.alert').fadeIn(800);

        // 表單提交時的效果
        $('form').on('submit', function() {
            $('.content-wrapper').animate({
                opacity: 0.6
            }, 300);
        });

        // 返回會員中心按鈕點擊效果
        $('.btn-outline-secondary').on('click', function(e) {
            e.preventDefault(); // 防止立即跳轉
            const href = $(this).attr('href'); // 保存要跳轉的URL

            $('.content-wrapper').animate({
                opacity: 0
            }, 300, function() {
                // 動畫完成後跳轉
                window.location.href = href;
            });
        });
    });
    </script>
</body>

</html>