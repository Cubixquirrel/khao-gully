<?php 

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

include_once('../config/db.php');
include_once('../classes/login-status.php');

$page_title = 'Search';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <link rel="stylesheet" href="../assets/css/search.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
</head>
<body>
    <div class="search-header">
        <i class="fas fa-arrow-left" onclick="pageBack()"></i>
    </div>

    <div class="search-box">
        <input type="text" name="search-input">
        <input type="submit" value="Search" class="search-button" onclick="search()">
    </div>

    <div class="category-main">
    </div>

    <script src="../assets/js/search.js"></script>
</body>
</html>