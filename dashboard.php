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
} catch(PDOException $e) {
    $_SESSION['error'] = "獲取資料失敗：" . $e->getMessage();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>會員中心</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include 'includes/nav.php'; ?>
    <div class="container">
        <h2>會員中心</h2>
        <?php if(isset($_SESSION['success'])): ?>
            <div class="alert alert-success">
                <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>
        
        <div class="profile-info">
            <h3>歡迎, <?php echo htmlspecialchars($user['username']); ?>!</h3>
            <p>電子郵件: <?php echo htmlspecialchars($user['email']); ?></p>
            <p>註冊時間: <?php echo $user['created_at']; ?></p>
        </div>

        <nav class="dashboard-nav">
            <ul>
                <li><a href="profile.php" class="btn">修改個人資料</a></li>
                <li><a href="process/logout_process.php" class="btn btn-danger">登出</a></li>
            </ul>
        </nav>
    </div>
</body>
</html>