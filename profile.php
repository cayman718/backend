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
</head>

<body class="bg-light">
    <?php include 'includes/nav.php'; ?>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4">修改個人資料</h2>

                        <?php if (isset($_SESSION['error'])): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?php echo $_SESSION['error'];
                                unset($_SESSION['error']); ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>

                        <form method="POST" action="process/profile_process.php">
                            <div class="mb-3">
                                <label class="form-label">電子郵件</label>
                                <input type="email" class="form-control" name="email"
                                    value="<?php echo htmlspecialchars($user['email']); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">新密碼（如不修改請留空）</label>
                                <input type="password" class="form-control" name="new_password" minlength="6">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">確認新密碼</label>
                                <input type="password" class="form-control" name="confirm_password">
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">更新資料</button>
                                <a href="dashboard.php" class="btn btn-secondary">返回會員中心</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>