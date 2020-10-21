<?php 

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

include_once('../config/db.php');
include_once('../classes/login-status.php');

$page_title = 'Order Success';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <link rel="stylesheet" href="../assets/css/order-success.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
</head>
<body>
    <div class="order-success-main">
        <div class="card-main-inner">
            <i class="fas fa-check-circle"></i>
            <span class="order-title">Placed Successfully</span>
            <span class="order-subtitle">Your order is in queue.</span>
            <button class="order-button" onclick="openOrderPage()">Order Summary</button>
            <button class="order-sub-button" onclick="openFoodPage()">Back to food</button>
        </div>
    </div>

    <script src="../assets/js/order-success.js"></script>
</body>
</html>