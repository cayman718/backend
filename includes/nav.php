<?php
require_once __DIR__ . '/auth.php';
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-lg">
    <div class="container">
        <a class="navbar-brand fw-bold text-light" href="index.php">
            <i class="bi bi-shop me-2"></i>Fine Dining
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link text-light fw-semibold" href="index.php">
                        <i class="bi bi-house-door me-1"></i> 首頁
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light fw-semibold" href="menu.php">
                        <i class="bi bi-book me-1"></i> 菜單
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light fw-semibold" href="reservation.php">
                        <i class="bi bi-calendar-check me-1"></i> 訂位
                    </a>
                </li>

                <?php if (isset($_SESSION['user_id'])): ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-light fw-semibold" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle me-1"></i> 會員中心
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark shadow">
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
                    <a class="nav-link text-light fw-semibold" href="login.php">
                        <i class="bi bi-box-arrow-in-right me-1"></i> 登入
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light fw-semibold" href="register.php">
                        <i class="bi bi-person-plus me-1"></i> 註冊
                    </a>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<style>
.navbar {
    padding: 0.8rem 1rem;
    background: linear-gradient(90deg, #212529, #343a40);
    border-bottom: 3px solid #495057;
}

.nav-link {
    padding: 0.6rem 1rem;
    transition: all 0.3s ease;
    color: #f8f9fa !important;
}

.nav-link:hover {
    background-color: #495057;
    border-radius: 0.5rem;
    color: #ffffff !important;
}

.dropdown-menu {
    border-radius: 0.5rem;
    padding: 0.5rem 0;
    background: #343a40;
    border: 1px solid #495057;
}

.dropdown-item {
    padding: 0.5rem 1.5rem;
    transition: background-color 0.2s ease;
    color: #f8f9fa;
}

.dropdown-item:hover {
    background-color: #495057;
    color: #ffffff;
}

.navbar-toggler {
    border: none;
}

.navbar-toggler-icon {
    filter: brightness(0.9) invert(1);
}
</style>