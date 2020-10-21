<?php

include_once('../config/db.php');
include('../assets/assets.php');
$page_title = 'Splash';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <link rel="stylesheet" href="../assets/css/splash.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body class="splash">
</body>
</html>
<?php
    if (isset($_COOKIE['user_status']) && $_COOKIE['user_status'] == 'true') {
        $sql_select_user = 
        '
        SELECT user_id FROM users_login WHERE user_auth = "'.$_COOKIE["user_auth"].'" 
        ';
        $result_select_user = $conn->query($sql_select_user);
        
        if ($result_select_user->num_rows === 1) {
            header ('refresh: 5; url=../views/food.php');
        } else {
            header ('refresh: 5; url=../views/get-started.php');
        }        
    } else {
        header ('refresh: 5; url=../views/get-started.php');
    }
?>