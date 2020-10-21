<?php

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

include_once('../config/db.php');
include_once('../classes/login-status.php');

$page_title = 'Profile';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <link rel="stylesheet" href="../assets/css/profile.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
</head>
<body>
    <?php include_once('../views/menu.php'); ?>

    <div class="profile-header">
        <div class="header-left">
            <span><?php echo $user_name; ?></span>
            <span><?php echo $user_email; ?></span>
            <span onclick="openEditProfile()">Edit profile <i class="fas fa-caret-right"></i></span>
        </div>

        <div class="header-right">
            <span><?php echo strtoupper($user_name[0]); ?></span>
        </div>
    </div>

    <div class="profile-menu">
        <div class="menu-first">
            <div class="profile-menu-list"><span>Your Orders</span><i class="fas fa-chevron-right"></i></div>
            <div class="profile-menu-list"><span>Notifications</span><i class="fas fa-chevron-right"></i></div>
            <!-- <span>Edit Address <i class="fas fa-chevron-right"></i></span> -->
        </div>
        <div class="menu-first">
            <div class="profile-menu-list"><span>Wallet</span><i class="fas fa-chevron-right"></i></div>
            <!-- <span>Edit Address <i class="fas fa-chevron-right"></i></span> -->
        </div>
        <div class="menu-second">
            <div class="profile-menu-list"><span>About</span><i class="fas fa-chevron-right"></i></div>
            <div class="profile-menu-list"><span>Send Feedback</span><i class="fas fa-chevron-right"></i></div>
            <div class="profile-menu-list"><span>Rate us on Play Store</span><i class="fas fa-chevron-right"></i></div>
            <div class="profile-menu-list"><span>Privacy Policy</span><i class="fas fa-chevron-right"></i></div>
            <div class="profile-menu-list"><span>Log Out</span><i class="fas fa-chevron-right"></i></div>
        </div>
    </div>
    
    <script src="../assets/js/profile.js"></script>
</body>
</html>