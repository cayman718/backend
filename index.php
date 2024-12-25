<!DOCTYPE html>
<html lang="zh-TW">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>精緻餐酒館 - 首頁</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css"
        rel="stylesheet">
    <style>
    body {
        font-family: 'Noto Sans TC', sans-serif;
        background-color: #fdfcf8;
        color: #333;
    }

    .hero-banner {
        height: 90vh;
        background: url('hero-banner.jpg') no-repeat center center/cover;
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
    }

    .hero-content {
        position: relative;
        color: #fff;
        text-align: center;
    }

    .hero-content h1 {
        font-size: 3.5rem;
        font-weight: bold;
    }

    .hero-content p {
        font-size: 1.25rem;
        margin: 1rem 0;
    }

    .features {
        padding: 3rem 0;
        background-color: #f8f9fa;
    }

    .feature-card {
        border: none;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .feature-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .special-menu {
        background-color: #fff;
        padding: 3rem 0;
    }

    .special-menu img {
        width: 100%;
        border-radius: 10px;
    }

    .events {
        background-color: #eae7dc;
        padding: 3rem 0;
    }

    .contact-info {
        background-color: #333;
        color: #fff;
        padding: 3rem 0;
    }

    .contact-info p {
        margin: 0.5rem 0;
    }
    </style>
</head>

<body>

    <?php include 'nav.php'; ?>

    <div class="hero-banner">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1>品味中西融合的藝術</h1>
            <p>精選食材，匠心烹製，打造前所未有的味覺體驗。</p>
            <a href="menu.php" class="btn btn-primary btn-lg"><i class="bi bi-book me-2"></i>探索菜單</a>
            <a href="reservation.php" class="btn btn-outline-light btn-lg ms-2"><i
                    class="bi bi-calendar-check me-2"></i>立即預約</a>
        </div>
    </div>

    <section class="features">
        <div class="container">
            <div class="text-center mb-4">
                <h2 class="fw-bold">精選特色</h2>
                <p class="text-muted">融合傳統與現代的美味，滿足每一位饕客的期待。</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card feature-card p-4 text-center">
                        <i class="bi bi-cup-hot-fill text-warning display-4 mb-3"></i>
                        <h5 class="fw-bold">創意料理</h5>
                        <p class="text-muted">結合中西技法，創造令人驚艷的全新口感。</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card feature-card p-4 text-center">
                        <i class="bi bi-wine text-danger display-4 mb-3"></i>
                        <h5 class="fw-bold">專業品酒</h5>
                        <p class="text-muted">甄選來自世界各地的佳釀，為您的餐桌添色。</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card feature-card p-4 text-center">
                        <i class="bi bi-buildings text-primary display-4 mb-3"></i>
                        <h5 class="fw-bold">雅致環境</h5>
                        <p class="text-muted">感受每個細節的用心，讓用餐成為一場藝術之旅。</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="special-menu">
        <div class="container">
            <div class="text-center mb-4">
                <h2 class="fw-bold">當季推薦</h2>
                <p class="text-muted">嚴選時令食材，獻上最美味的饗宴。</p>
            </div>
            <div class="row g-4 align-items-center">
                <div class="col-md-6">
                    <img src="special-dish.jpg" alt="當季推薦">
                </div>
                <div class="col-md-6">
                    <h3 class="fw-bold">香烤迷迭香羊排</h3>
                    <p>搭配特製醬汁與新鮮蔬果，完美呈現食材的原始風味。</p>
                    <a href="menu.php" class="btn btn-primary mt-3">探索更多菜單</a>
                </div>
            </div>
        </div>
    </section>

    <section class="events">
        <div class="container">
            <div class="text-center mb-4">
                <h2 class="fw-bold">活動與優惠</h2>
                <p class="text-muted">不容錯過的精彩活動與專屬優惠。</p>
            </div>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card p-3">
                        <img src="wine-tasting.jpg" class="card-img-top" alt="品酒活動">
                        <div class="card-body">
                            <h5 class="card-title">品酒之夜</h5>
                            <p class="card-text">參加我們的品酒活動，體驗專屬的美酒之旅。</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card p-3">
                        <img src="dining-offer.jpg" class="card-img-top" alt="用餐優惠">
                        <div class="card-body">
                            <h5 class="card-title">雙人套餐優惠</h5>
                            <p class="card-text">與摯愛共享特別設計的雙人美味套餐。</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="contact-info">
        <div class="container text-center">
            <h2 class="fw-bold">聯絡我們</h2>
            <p class="mb-4">如有任何問題，歡迎隨時聯繫我們。</p>
            <p><i class="bi bi-telephone"></i> 電話：123-456-789</p>
            <p><i class="bi bi-envelope"></i> 電子郵件：info@example.com</p>
            <p><i class="bi bi-geo-alt"></i> 地址：台北市中山區某某路 123 號</p>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>