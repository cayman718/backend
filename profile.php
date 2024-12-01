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
} catch(PDOException $e) {
    $_SESSION['error'] = "獲取資料失敗：" . $e->getMessage();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>修改個人資料</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include 'includes/nav.php'; ?>
    <div class="container">
        <h2>修改個人資料</h2>
        <?php if(isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
                <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>
        <?php if(isset($_SESSION['success'])): ?>
            <div class="alert alert-success">
                <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="process/profile_process.php">
            <div class="form-group">
                <label>電子郵件：</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            </div>
            <div class="form-group">
                <label>新密碼（如不修改請留空）：</label>
                <input type="password" name="new_password" minlength="6">
            </div>
            <div class="form-group">
                <label>確認新密碼：</label>
                <input type="password" name="confirm_password">
            </div>
            <button type="submit" class="btn">更新資料</button>
            <a href="dashboard.php" class="btn btn-secondary">返回會員中心</a>
        </form>
    </div>
</body>
</html> 