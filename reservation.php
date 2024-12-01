<?php
session_start();
require_once 'config/database.php';
require_once 'includes/auth.php';

// 確保用戶已登入
if (!isLoggedIn()) {
    $_SESSION['error'] = "請先登入才能進行訂位";
    header("Location: login.php");
    exit();
}

// 獲取用戶資料
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();
?>

<!DOCTYPE html>
<html>
<head>
    <title>線上訂位</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css">
    <!-- 添加 Font Awesome 圖示 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- 在每個頁面的 head 部分添加以下連結 -->
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@300;400;500;700&display=swap" rel="stylesheet">
</head>
</head>
<body>
    <?php include 'includes/nav.php'; ?>
    
    <div class="container">
        <div class="page-header">
            <h2><i class="fas fa-calendar-alt"></i> 線上訂位</h2>
            <p class="subtitle">預訂您的美好用餐時光</p>
        </div>

        <?php if(isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i>
                <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>
        
        <?php if(isset($_SESSION['success'])): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>

        <div class="reservation-container">
            <div class="reservation-info">
                <div class="info-card">
                    <h3><i class="fas fa-clock"></i> 營業時間</h3>
                    <p>週一至週五：11:00 - 21:00</p>
                    <p>週六至週日：10:00 - 22:00</p>
                </div>
                <div class="info-card">
                    <h3><i class="fas fa-info-circle"></i> 訂位須知</h3>
                    <ul>
                        <li>請提前24小時預訂</li>
                        <li>最多可預訂10人座位</li>
                        <li>訂位保留時間為15分鐘</li>
                        <li>如需取消請提前24小時告知</li>
                    </ul>
                </div>
            </div>

            <form method="POST" action="process/reservation_process.php" class="reservation-form">
                <div class="form-grid">
                    <div class="form-group">
                        <label><i class="fas fa-calendar"></i> 預約日期：</label>
                        <input type="date" name="reservation_date" required min="<?php echo date('Y-m-d'); ?>" class="form-control">
                    </div>
                    
                    <div class="form-group">
                        <label><i class="fas fa-clock"></i> 預約時間：</label>
                        <select name="reservation_time" required class="form-control">
                            <option value="">請選擇時間</option>
                            <?php
                            for($hour = 11; $hour <= 20; $hour++) {
                                for($min = 0; $min < 60; $min += 30) {
                                    $time = sprintf("%02d:%02d", $hour, $min);
                                    echo "<option value='$time'>$time</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label><i class="fas fa-users"></i> 用餐人數：</label>
                        <select name="people_count" required class="form-control">
                            <?php for($i = 1; $i <= 10; $i++): ?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?>人</option>
                            <?php endfor; ?>
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label><i class="fas fa-comment"></i> 特殊需求：</label>
                    <textarea name="special_request" class="form-control" placeholder="如：素食、過敏原、嬰兒座椅等需求"></textarea>
                </div>
                
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-check"></i> 確認訂位
                </button>
            </form>
        </div>

        <div class="reservation-history">
            <h3><i class="fas fa-history"></i> 我的訂位記錄</h3>
            <?php
            $stmt = $pdo->prepare("SELECT * FROM reservations WHERE user_id = ? ORDER BY reservation_date DESC, reservation_time DESC");
            $stmt->execute([$_SESSION['user_id']]);
            $reservations = $stmt->fetchAll();
            
            if($reservations): ?>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>訂位日期</th>
                                <th>時間</th>
                                <th>人數</th>
                                <th>狀態</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($reservations as $reservation): ?>
                                <tr>
                                    <td><?php echo $reservation['reservation_date']; ?></td>
                                    <td><?php echo $reservation['reservation_time']; ?></td>
                                    <td><?php echo $reservation['people_count']; ?>人</td>
                                    <td>
                                        <span class="status-badge status-<?php echo $reservation['status']; ?>">
                                            <?php echo $reservation['status']; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php if($reservation['status'] !== 'cancelled' && strtotime($reservation['reservation_date']) > time()): ?>
                                            <a href="process/cancel_reservation.php?id=<?php echo $reservation['id']; ?>" 
                                               class="btn btn-small btn-danger"
                                               onclick="return confirm('確定要取消這個訂位嗎？')">
                                                <i class="fas fa-times"></i> 取消訂位
                                            </a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="empty-state">
                    <i class="fas fa-calendar-times"></i>
                    <p>目前沒有訂位記錄</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html> 