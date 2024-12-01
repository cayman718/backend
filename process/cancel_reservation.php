<?php
session_start();
require_once '../config/database.php';
require_once '../includes/auth.php';

if (!isLoggedIn()) {
    $_SESSION['error'] = "請先登入";
    header("Location: ../login.php");
    exit();
}

if (isset($_GET['id'])) {
    $reservation_id = $_GET['id'];
    $user_id = $_SESSION['user_id'];
    
    try {
        // 確認訂位存在且屬於當前用戶
        $stmt = $pdo->prepare("SELECT * FROM reservations WHERE id = ? AND user_id = ?");
        $stmt->execute([$reservation_id, $user_id]);
        $reservation = $stmt->fetch();
        
        if (!$reservation) {
            $_SESSION['error'] = "找不到該訂位記錄";
            header("Location: ../reservation.php");
            exit();
        }
        
        // 檢查是否可以取消（例如：24小時前）
        $reservation_time = strtotime($reservation['reservation_date'] . ' ' . $reservation['reservation_time']);
        if ($reservation_time - time() < 24 * 3600) {
            $_SESSION['error'] = "抱歉，必須至少在24小時前取消訂位";
            header("Location: ../reservation.php");
            exit();
        }
        
        // 更新訂位狀態
        $stmt = $pdo->prepare("UPDATE reservations SET status = 'cancelled' WHERE id = ?");
        $stmt->execute([$reservation_id]);
        
        $_SESSION['success'] = "訂位已成功取消";
        
    } catch(PDOException $e) {
        $_SESSION['error'] = "取消失敗：" . $e->getMessage();
    }
}

header("Location: ../reservation.php");
exit(); 