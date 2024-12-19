<?php
session_start();
require_once 'includes/auth.php';
?>
<!DOCTYPE html>
<html>

<head>
    <title>餐廳會員系統</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@300;400;500;700&display=swap"
        rel="stylesheet">

    <style>
    body {
        font-family: 'Noto Sans TC', sans-serif;
    }

    .hero-section {
        background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)),
            url('./img/background.jpeg') center/cover no-repeat;
        min-height: 100vh;
        display: flex;
        align-items: center;
        margin-top: -56px;
    }

    .featured-card {
        border: none;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .featured-card:hover {
        transform: translateY(-10px);
    }

    .featured-card img {
        height: 250px;
        object-fit: cover;
    }

    .featured-card .card-body {
        padding: 1.5rem;
        background: white;
    }

    .section-title {
        font-weight: 700;
        margin-bottom: 3rem;
        position: relative;
        display: inline-block;
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 0;
        width: 60%;
        height: 3px;
        background-color: #0d6efd;
    }

    .footer-link {
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .footer-link:hover {
        color: white;
    }
    </style>
</head>

<body>
    <?php include 'includes/nav.php'; ?>

    <!-- 主視覺區 -->
    <section class="hero-section text-white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h1 class="display-4 fw-bold mb-4">品味美食的藝術</h1>
                    <p class="lead mb-5">讓每一道料理都成為難忘的回憶</p>
                    <div class="d-flex gap-3 justify-content-center">
                        <a href="menu.php" class="btn btn-primary btn-lg px-4">
                            <i class="bi bi-book me-2"></i>瀏覽菜單
                        </a>
                        <a href="reservation.php" class="btn btn-outline-light btn-lg px-4">
                            <i class="bi bi-calendar-check me-2"></i>立即訂位
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 特色料理區 -->
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">特色料理</h2>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="featured-card">
                        <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836" alt="主廚推薦"
                            class="w-100">
                        <div class="card-body text-center">
                            <h3 class="h5 mb-3">主廚推薦</h3>
                            <p class="text-muted mb-0">精選當季食材，呈現最佳風味</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="featured-card">
                        <img src="https://images.unsplash.com/photo-1476224203421-9ac39bcb3327" alt="季節限定"
                            class="w-100">
                        <div class="card-body text-center">
                            <h3 class="h5 mb-3">季節限定</h3>
                            <p class="text-muted mb-0">獨特的創意料理，帶來驚喜體驗</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="featured-card">
                        <img src="https://images.unsplash.com/photo-1473093226795-af9932fe5856" alt="經典饗宴"
                            class="w-100">
                        <div class="card-body text-center">
                            <h3 class="h5 mb-3">經典饗宴</h3>
                            <p class="text-muted mb-0">傳統美味，永恆經典</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 頁尾 -->
    <footer class="bg-dark text-light py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <h3 class="h5 mb-3">聯絡我們</h3>
                    <p class="mb-2">
                        <i class="bi bi-geo-alt-fill me-2 text-primary"></i>
                        台北市中山區...
                    </p>
                    <p class="mb-0">
                        <i class="bi bi-telephone-fill me-2 text-primary"></i>
                        02-2222-2222
                    </p>
                </div>
                <div class="col-md-4">
                    <h3 class="h5 mb-3">營業時間</h3>
                    <p class="mb-2">
                        <i class="bi bi-clock-fill me-2 text-primary"></i>
                        週一至週五：11:00 - 21:00
                    </p>
                    <p class="mb-0">
                        <i class="bi bi-clock-fill me-2 text-primary"></i>
                        週六至週日：10:00 - 22:00
                    </p>
                </div>
                <div class="col-md-4">
                    <h3 class="h5 mb-3">社群媒體</h3>
                    <div class="d-flex gap-3">
                        <a href="#" class="footer-link fs-4"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="footer-link fs-4"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="footer-link fs-4"><i class="bi bi-line"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>