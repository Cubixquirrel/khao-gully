<?php 

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

include_once('../config/db.php');
include_once('../classes/login-status.php');

$page_title = 'Order Failed';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <link rel="stylesheet" href="../assets/css/order-failed.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
</head>
<body>
    <div class="order-failed-main">
        <div class="card-main-inner">
            <i class="fas fa-times-circle"></i>
            <span class="order-title">Order Failed</span>
            <span class="order-subtitle">Please try later.</span>
            <button class="order-button" onclick="retryOrder()">Retry order</button>
            <button class="order-sub-button" onclick="openFoodPage()">Back to food</button>
        </div>
    </div>

    <script src="../assets/js/order-failed.js"></script>
</body>
</html>