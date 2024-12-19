<?php
session_start();
require_once 'config/database.php';

// 獲取所有菜單分類
$categories = $pdo->query("SELECT * FROM menu_categories ORDER BY sort_order")->fetchAll();
?>

<!DOCTYPE html>
<html>

<head>
    <title>餐廳菜單</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/menu.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- 原有的 Font Awesome -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    <?php include 'includes/nav.php'; ?>

    <div class="menu-hero"
        style="background-image: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('./img/din.jpg');">
        <h1>精選菜單</h1>
        <p>用心製作的每一道佳餚</p>
    </div>

    <div class="menu-container">
        <div class="menu-categories">
            <button class="category-btn active" data-category="all">全部餐點</button>
            <button class="category-btn" data-category="appetizer">開胃菜</button>
            <button class="category-btn" data-category="main">主餐</button>
            <button class="category-btn" data-category="dessert">甜點</button>
            <button class="category-btn" data-category="drinks">飲品</button>
        </div>

        <div class="menu-grid">
            <!-- 前菜 -->
            <div class="menu-item" data-category="appetizer" data-price="180">
                <div class="menu-item-image">
                    <img src="https://images.unsplash.com/photo-1550304943-4f24f54ddde9?auto=format&fit=crop&w=600"
                        alt="凱薩沙拉">
                    <div class="menu-item-badge">主廚推薦</div>
                </div>
                <div class="menu-item-content">
                    <h3>凱薩沙拉</h3>
                    <p class="menu-item-description">新鮮生菜配凱薩醬</p>
                    <div class="menu-item-footer">
                        <span class="price">NT$ 180</span>
                        <button class="add-to-cart-btn" data-id="1" data-name="凱薩沙拉" data-price="180">
                            <i class="fas fa-plus"></i> 加入購物車
                        </button>
                    </div>
                </div>
            </div>

            <div class="menu-item" data-category="appetizer" data-price="200">
                <div class="menu-item-image">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSrrEDPI-gjy8GLG2xEiZByJC3H3wurpTjRsg&s"
                        alt="蒜香蘑菇">
                </div>
                <div class="menu-item-content">
                    <h3>蒜香蘑菇</h3>
                    <p class="menu-item-description">香煎蘑菇配蒜香醬</p>
                    <div class="menu-item-footer">
                        <span class="price">NT$ 200</span>
                        <button class="add-to-cart-btn" data-id="2" data-name="蒜香蘑菇" data-price="200">
                            <i class="fas fa-plus"></i> 加入購物車
                        </button>
                    </div>
                </div>
            </div>

            <!-- 主菜 -->
            <div class="menu-item" data-category="main" data-price="580">
                <div class="menu-item-image">
                    <img src="https://images.unsplash.com/photo-1544025162-d76694265947?auto=format&fit=crop&w=600"
                        alt="紐約客牛排">
                    <div class="menu-item-badge">主廚推薦</div>
                </div>
                <div class="menu-item-content">
                    <h3>紐約客牛排</h3>
                    <p class="menu-item-description">頂級紐約客牛排佐松露醬</p>
                    <div class="menu-item-footer">
                        <span class="price">NT$ 580</span>
                        <button class="add-to-cart-btn" data-id="3" data-name="紐約客牛排" data-price="580">
                            <i class="fas fa-plus"></i> 加入購物車
                        </button>
                    </div>
                </div>
            </div>

            <div class="menu-item" data-category="main" data-price="620">
                <div class="menu-item-image">
                    <img src="https://images.unsplash.com/photo-1485921325833-c519f76c4927?auto=format&fit=crop&w=600"
                        alt="香煎鮭魚">
                </div>
                <div class="menu-item-content">
                    <h3>香煎鮭魚</h3>
                    <p class="menu-item-description">挪威鮭魚配香草奶油醬</p>
                    <div class="menu-item-footer">
                        <span class="price">NT$ 620</span>
                        <button class="add-to-cart-btn" data-id="4" data-name="香煎鮭魚" data-price="620">
                            <i class="fas fa-plus"></i> 加入購物車
                        </button>
                    </div>
                </div>
            </div>

            <!-- 甜點 -->
            <div class="menu-item" data-category="dessert" data-price="220">
                <div class="menu-item-image">
                    <img src="https://images.unsplash.com/photo-1571877227200-a0d98ea607e9?auto=format&fit=crop&w=600"
                        alt="提拉米蘇">
                    <div class="menu-item-badge">主廚推薦</div>
                </div>
                <div class="menu-item-content">
                    <h3>提拉米蘇</h3>
                    <p class="menu-item-description">經典義大利提拉米蘇</p>
                    <div class="menu-item-footer">
                        <span class="price">NT$ 220</span>
                        <button class="add-to-cart-btn" data-id="5" data-name="提拉米蘇" data-price="220">
                            <i class="fas fa-plus"></i> 加入購物車
                        </button>
                    </div>
                </div>
            </div>

            <div class="menu-item" data-category="dessert" data-price="180">
                <div class="menu-item-image">
                    <img src="https://images.unsplash.com/photo-1606313564200-e75d5e30476c?auto=format&fit=crop&w=600"
                        alt="巧克力布朗尼">
                </div>
                <div class="menu-item-content">
                    <h3>巧克力布朗尼</h3>
                    <p class="menu-item-description">溫熱巧克力布朗尼配香草冰淇淋</p>
                    <div class="menu-item-footer">
                        <span class="price">NT$ 180</span>
                        <button class="add-to-cart-btn" data-id="6" data-name="巧克力布朗尼" data-price="180">
                            <i class="fas fa-plus"></i> 加入購物車
                        </button>
                    </div>
                </div>
            </div>

            <!-- 飲品 -->
            <div class="menu-item" data-category="drinks" data-price="320">
                <div class="menu-item-image">
                    <img src="https://images.unsplash.com/photo-1510626176961-4b57d4fbad03?auto=format&fit=crop&w=600"
                        alt="波爾多紅酒">
                    <div class="menu-item-badge">主廚推薦</div>
                </div>
                <div class="menu-item-content">
                    <h3>波爾多紅酒</h3>
                    <p class="menu-item-description">法國波爾多紅酒</p>
                    <div class="menu-item-footer">
                        <span class="price">NT$ 320</span>
                        <button class="add-to-cart-btn" data-id="7" data-name="波爾多紅酒" data-price="320">
                            <i class="fas fa-plus"></i> 加入購物車
                        </button>
                    </div>
                </div>
            </div>

            <div class="menu-item" data-category="drinks" data-price="150">
                <div class="menu-item-image">
                    <img src="https://images.unsplash.com/photo-1622483767028-3f66f32aef97?auto=format&fit=crop&w=600"
                        alt="季節鮮果汁">
                </div>
                <div class="menu-item-content">
                    <h3>季節鮮果汁</h3>
                    <p class="menu-item-description">當季新鮮現榨果汁</p>
                    <div class="menu-item-footer">
                        <span class="price">NT$ 150</span>
                        <button class="add-to-cart-btn" data-id="8" data-name="季節鮮果汁" data-price="150">
                            <i class="fas fa-plus"></i> 加入購物車
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 購物車摘要 -->
    <div class="cart-summary">
        <div class="cart-items-count">
            購物車 (<span id="itemCount">0</span>)
        </div>
        <div class="cart-total">
            總計: NT$ <span id="cartTotalAmount">0</span>
        </div>
        <button class="view-cart-btn" id="viewCartBtn">
            <i class="fas fa-shopping-cart"></i> 查看購物車
        </button>
    </div>

    <!-- 購物車側邊欄 -->
    <div class="cart-sidebar" id="cartSidebar">
        <div class="cart-header">
            <h3>購物車</h3>
            <button class="close-cart" id="closeCartBtn">&times;</button>
        </div>
        <div class="cart-items" id="cartItems">
            <!-- 購物車項目會動態插入這裡 -->
        </div>
        <div class="cart-footer">
            <div class="cart-total">
                總計: NT$ <span id="sidebarTotal">0</span>
            </div>
            <button class="checkout-btn" id="checkoutBtn">
                送出訂單
            </button>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/menu.js" defer></script>
</body>

</html>