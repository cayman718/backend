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
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <!-- 導航欄 -->
    <?php include 'includes/nav.php'; ?>

    <!-- 主視覺區 -->
    <div class="hero-section">
        <div class="hero-content">
            <h1>品味美食的藝術</h1>
            <p>讓每一道料理都成為難忘的回憶</p>
            <div class="hero-buttons">
                <a href="menu.php" class="btn btn-primary">瀏覽菜單</a>
                <a href="reservation.php" class="btn btn-secondary">立即訂位</a>
            </div>
        </div>
    </div>

    <!-- 特色料理區 -->
    <section class="featured-section">
        <div class="container">
            <h2>特色料理</h2>
            <div class="featured-grid">
                <div class="featured-item">
                    <div class="featured-image">
                        <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836" alt="特色料理1" width="100%" height="">
                    </div>
                    <div class="featured-content">
                        <h3>主廚推薦</h3>
                        <p>精選當季食材，呈現最佳風味</p>
                    </div>
                </div>
                <div class="featured-item">
                    <div class="featured-image">
                        <img src="https://images.unsplash.com/photo-1476224203421-9ac39bcb3327" alt="特色料理2" width="100%">
                    </div>
                    <div class="featured-content">
                        <h3>季節限定</h3>
                        <p>獨特的創意料理，帶來驚喜體驗</p>
                    </div>
                </div>
                <div class="featured-item">
                    <div class="featured-image">
                        <img src="https://images.unsplash.com/photo-1473093226795-af9932fe5856" alt="特色料理3" width="100%">
                    </div>
                    <div class="featured-content">
                        <h3>經典饗宴</h3>
                        <p>傳統美味，永恆經典</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 頁尾 -->
    <footer class="site-footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-info">
                    <h3>聯絡我們</h3>
                    <p><i class="fas fa-map-marker-alt"></i> 台北市中山區...</p>
                    <p><i class="fas fa-phone"></i> 02-2222-2222</p>
                </div>
                <div class="footer-hours">
                    <h3>營業時間</h3>
                    <p>週一至週五：11:00 - 21:00</p>
                    <p>週六至週日：10:00 - 22:00</p>
                </div>
            </div>
        </div>
    </footer>
</body>
</html> 