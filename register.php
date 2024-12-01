<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>會員註冊</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include 'includes/nav.php'; ?>
    <div class="container">
        <h2>會員註冊</h2>
        <?php if(isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
                <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="process/register_process.php">
            <div class="form-group">
                <label>帳號：</label>
                <input type="text" name="username" required minlength="3" maxlength="20">
            </div>
            <div class="form-group">
                <label>電子郵件：</label>
                <input type="email" name="email" required>
            </div>
            <div class="form-group">
                <label>密碼：</label>
                <input type="password" name="password" required minlength="6">
            </div>
            <div class="form-group">
                <label>確認密碼：</label>
                <input type="password" name="confirm_password" required>
            </div>
            <button type="submit" class="btn">註冊</button>
            <p>已有帳號？<a href="login.php">立即登入</a></p>
        </form>
    </div>
</body>
</html>