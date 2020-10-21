<?php 

include_once('../config/db.php');
include_once('../classes/login-status.php');

$page_title = 'About';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <link rel="stylesheet" href="../assets/css/about.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
</head>
<body>
    <div class="about-header">
        <i class="fas fa-arrow-left" onclick="pageBack()"></i>
    </div>

    <div class="about-title">
        <span><?php echo $page_title; ?></span>
    </div>

    <div class="about-menu">
        <div class="menu-first">
            <div class="about-menu-list" onclick="openTerms()"><span>Terms of Service</span><i class="fas fa-chevron-right"></i></div>
        </div>
        <div class="menu-second">
            <div class="about-menu-block"><span>App version</span><span>v20.0.1</span></div>
        </div>
    </div>
    
    <script src="../assets/js/about.js"></script>
</body>
</html>