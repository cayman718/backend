<?php
require_once __DIR__ . '/auth.php';
?>
<header class="site-header">
    <nav class="main-nav">
        <div class="nav-container">
            <div class="nav-logo">
                <a href="index.php">餐廳會員系統</a>
            </div>
            <div class="nav-links">
                <a href="index.php">首頁</a>
                <a href="menu.php">菜單</a>
                <a href="reservation.php">線上訂位</a>
                <?php if(isLoggedIn()): ?>
                    <a href="dashboard.php">會員中心</a>
                    <a href="process/logout_process.php">登出</a>
                <?php else: ?>
                    <a href="login.php">登入</a>
                    <a href="register.php">註冊</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>
</header> 