<?php
session_start();
require_once '../config/database.php';
require_once '../includes/auth.php';
checkLogin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    
    try {
        // 檢查郵箱是否已被其他用戶使用
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = ? AND id != ?");
        $stmt->execute([$email, $_SESSION['user_id']]);
        if ($stmt->fetchColumn() > 0) {
            $_SESSION['error'] = "此電子郵件已被使用";
            header("Location: ../profile.php");
            exit();
        }
        
        // 如果要更改密碼
        if (!empty($new_password)) {
            if (strlen($new_password) < 6) {
                $_SESSION['error'] = "密碼長度必須至少為6個字符";
                header("Location: ../profile.php");
                exit();
            }
            
            if ($new_password !== $confirm_password) {
                $_SESSION['error'] = "兩次輸入的密碼不一致";
                header("Location: ../profile.php");
                exit();
            }
            
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("UPDATE users SET email = ?, password = ? WHERE id = ?");
            $stmt->execute([$email, $hashed_password, $_SESSION['user_id']]);
        } else {
            $stmt = $pdo->prepare("UPDATE users SET email = ? WHERE id = ?");
            $stmt->execute([$email, $_SESSION['user_id']]);
        }
        
        $_SESSION['success'] = "個人資料更新成功！";
        header("Location: ../profile.php");
        exit();
        
    } catch(PDOException $e) {
        $_SESSION['error'] = "更新失敗：" . $e->getMessage();
        header("Location: ../profile.php");
        exit();
    }
}

header("Location: ../profile.php");
exit(); 