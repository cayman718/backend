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
    <title>會員登入</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include 'includes/nav.php'; ?>
    <div class="container">
        <h2>會員登入</h2>
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

        <form method="POST" action="process/login_process.php">
            <div class="form-group">
                <label>帳號：</label>
                <input type="text" name="username" required>
            </div>
            <div class="form-group">
                <label>密碼：</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit" class="btn">登入</button>
            <p>還沒有帳號？<a href="register.php">立即註冊</a></p>
        </form>
    </div>
</body>
</html>