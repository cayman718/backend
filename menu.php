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
</head>
<body>
    <?php include 'includes/nav.php'; ?>
    
    <div class="container">
        <h2>餐廳菜單</h2>
        
        <div class="menu-container">
            <?php foreach($categories as $category): ?>
                <?php
                // 獲取該分類的所有菜品
                $stmt = $pdo->prepare("SELECT * FROM menu_items WHERE category_id = ? AND is_available = TRUE");
                $stmt->execute([$category['id']]);
                $items = $stmt->fetchAll();
                
                if(count($items) > 0):
                ?>
                    <div class="menu-category">
                        <h3><?php echo htmlspecialchars($category['name']); ?></h3>
                        <div class="menu-items">
                            <?php foreach($items as $item): ?>
                                <div class="menu-item">
                                    <?php if($item['image_url']): ?>
                                        <img src="<?php echo htmlspecialchars($item['image_url']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>">
                                    <?php endif; ?>
                                    <div class="item-details">
                                        <h4><?php echo htmlspecialchars($item['name']); ?></h4>
                                        <p class="item-description"><?php echo htmlspecialchars($item['description']); ?></p>
                                        <p class="item-price">$<?php echo number_format($item['price'], 2); ?></p>
                                        <?php if(isLoggedIn()): ?>
                                            <button class="btn btn-small add-to-cart" data-item-id="<?php echo $item['id']; ?>">加入購物車</button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html> 