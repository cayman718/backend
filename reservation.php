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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>線上訂位</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@300;400;500;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* 自定義樣式 */
        .reservation-table tr {
            transition: all 0.2s ease-in-out;
        }

        .reservation-table tr:hover {
            background-color: rgba(0, 0, 0, 0.02);
        }

        .btn-cancel {
            color: #dc3545;
            background-color: transparent;
            border: 1px solid #dc3545;
            transition: all 0.2s ease-in-out;
        }

        .btn-cancel:hover {
            color: #fff;
            background-color: #dc3545;
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(220, 53, 69, 0.2);
        }

        .status-badge {
            font-weight: normal;
            font-size: 0.875rem;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(0, 0, 0, 0.02);
        }
    </style>
</head>

<body class="bg-light">
    <?php include 'includes/nav.php'; ?>

    <div class="container py-5">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold"><i class="bi bi-calendar-check"></i> 線上訂位</h2>
            <p class="lead text-muted">預訂您的美好用餐時光</p>
        </div>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-circle-fill"></i>
                <?php echo $_SESSION['error'];
                unset($_SESSION['error']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill"></i>
                <?php echo $_SESSION['success'];
                unset($_SESSION['success']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="row g-4">
            <!-- 左側資訊欄 -->
            <div class="col-md-4">
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h3 class="h5 mb-3"><i class="bi bi-clock"></i> 營業時間</h3>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="bi bi-calendar-week text-primary"></i> 週一至週五：11:00 - 21:00</li>
                            <li><i class="bi bi-calendar-week text-primary"></i> 週六至週日：10:00 - 22:00</li>
                        </ul>
                    </div>
                </div>

                <div class="card shadow-sm">
                    <div class="card-body">
                        <h3 class="h5 mb-3"><i class="bi bi-info-circle"></i> 訂位須知</h3>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="bi bi-check2 text-success"></i> 請提前24小時預訂</li>
                            <li class="mb-2"><i class="bi bi-check2 text-success"></i> 最多可預訂10人座位</li>
                            <li class="mb-2"><i class="bi bi-check2 text-success"></i> 訂位保留時間為15分鐘</li>
                            <li><i class="bi bi-check2 text-success"></i> 如需取消請提前24小時告知</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- 右側訂位表單 -->
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <h3 class="card-title mb-4">預約資訊</h3>
                        <form method="POST" action="process/reservation_process.php">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="date" class="form-control" id="reservation_date"
                                            name="reservation_date" required min="<?php echo date('Y-m-d'); ?>">
                                        <label for="reservation_date">預約日期</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <select class="form-select" id="reservation_time" name="reservation_time"
                                            required>
                                            <option value="">請選擇時間</option>
                                            <?php
                                            for ($hour = 11; $hour <= 20; $hour++) {
                                                for ($min = 0; $min < 60; $min += 30) {
                                                    $time = sprintf("%02d:%02d", $hour, $min);
                                                    echo "<option value='$time'>$time</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                        <label for="reservation_time">預約時間</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <select class="form-select" id="people_count" name="people_count" required>
                                            <?php for ($i = 1; $i <= 10; $i++): ?>
                                                <option value="<?php echo $i; ?>"><?php echo $i; ?>人</option>
                                            <?php endfor; ?>
                                        </select>
                                        <label for="people_count">用餐人數</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-floating mb-3">
                                <textarea class="form-control" id="special_request" name="special_request"
                                    style="height: 100px" placeholder="特殊需求"></textarea>
                                <label for="special_request">特殊需求</label>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="bi bi-calendar-check"></i> 確認訂位
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- 訂位記錄 -->
                <div class="card shadow-sm mt-4">
                    <div class="card-body">
                        <h3 class="card-title h5 mb-4">
                            <i class="bi bi-clock-history me-2"></i>我的訂位記錄
                        </h3>
                        <?php
                        $stmt = $pdo->prepare("SELECT * FROM reservations WHERE user_id = ? ORDER BY reservation_date DESC, reservation_time DESC");
                        $stmt->execute([$_SESSION['user_id']]);
                        $reservations = $stmt->fetchAll();

                        if ($reservations): ?>
                            <div class="table-responsive">
                                <table class="table table-hover align-middle reservation-table">
                                    <thead class="table-light">
                                        <tr>
                                            <th>訂位日期</th>
                                            <th>時間</th>
                                            <th>人數</th>
                                            <th>狀態</th>
                                            <th class="text-end">操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($reservations as $reservation): ?>
                                            <tr>
                                                <td class="fw-medium">
                                                    <?php echo date('Y-m-d', strtotime($reservation['reservation_date'])); ?>
                                                </td>
                                                <td><?php echo date('H:i', strtotime($reservation['reservation_time'])); ?></td>
                                                <td><?php echo $reservation['people_count']; ?>人</td>
                                                <td>
                                                    <?php
                                                    $statusClass = '';
                                                    $statusText = '';
                                                    switch ($reservation['status']) {
                                                        case 'pending':
                                                            $statusClass = 'warning';
                                                            $statusText = '待確認';
                                                            break;
                                                        case 'confirmed':
                                                            $statusClass = 'success';
                                                            $statusText = '已確認';
                                                            break;
                                                        case 'cancelled':
                                                            $statusClass = 'danger';
                                                            $statusText = '已取消';
                                                            break;
                                                    }
                                                    ?>
                                                    <span
                                                        class="badge rounded-pill bg-<?php echo $statusClass; ?> status-badge px-3">
                                                        <?php echo $statusText; ?>
                                                    </span>
                                                </td>
                                                <td class="text-end">
                                                    <?php
                                                    // 檢查是否可以取消訂位：
                                                    // 1. 訂位狀態不是 "已取消"
                                                    // 2. 訂位時間還沒到（大於現在時間）
                                                    $canCancel = $reservation['status'] !== 'cancelled' &&
                                                        strtotime($reservation['reservation_date'] . ' ' . $reservation['reservation_time']) > time();

                                                    if ($canCancel):
                                                    ?>
                                                        <a href="process/cancel_reservation.php?id=<?php echo $reservation['id']; ?>"
                                                            class="btn btn-sm rounded-pill btn-cancel"
                                                            style="font-size: 0.875rem; padding: 0.25rem 1rem;"
                                                            onclick="return confirm('確定要取消這個訂位嗎？')">
                                                            <i class="bi bi-x"></i>
                                                            取消訂位
                                                        </a>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <div class="text-center text-muted py-5">
                                <i class="bi bi-calendar-x display-1 mb-3"></i>
                                <p class="mb-0">目前沒有訂位記錄</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>