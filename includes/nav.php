<?php
require_once __DIR__ . '/auth.php';
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <i class="bi bi-shop me-2"></i>美食餐廳
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">
                        <i class="bi bi-house-door"></i> 首頁
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="menu.php">
                        <i class="bi bi-book"></i> 菜單
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="reservation.php">
                        <i class="bi bi-calendar-check"></i> 訂位
                    </a>
                </li>

                <?php if (isset($_SESSION['user_id'])): ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="bi bi-person-circle"></i> 會員中心
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="dashboard.php">
                                <i class="bi bi-speedometer2 me-2"></i>會員總覽
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="profile.php">
                                <i class="bi bi-person-gear me-2"></i>個人資料
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item text-danger" href="process/logout_process.php">
                                <i class="bi bi-box-arrow-right me-2"></i>登出
                            </a>
                        </li>
                    </ul>
                </li>
                <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">
                        <i class="bi bi-box-arrow-in-right"></i> 登入
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="register.php">
                        <i class="bi bi-person-plus"></i> 註冊
                    </a>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<style>
.navbar {
    padding: 0.5rem 0;
}

.nav-link {
    padding: 1rem 1.5rem !important;
}

.dropdown-menu {
    margin-top: 0;
    border-radius: 0;
    border: none;
}

.dropdown-item {
    padding: 0.75rem 1.5rem;
}

/* 移除下拉選單的箭頭 */
.dropdown-toggle::after {
    display: none;
}
</style>