<?php 

include_once('../config/db.php');
include_once('../classes/login-status.php');

$page_title = 'Notifications';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <link rel="stylesheet" href="../assets/css/notifications.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
</head>
<body>
    <div class="notifications-header">
        <i class="fas fa-arrow-left" onclick="pageBack()"></i>
    </div>

    <div class="notifications-title">
        <span><?php echo $page_title; ?></span>
    </div>

    <?php
    $sql_select_notification = 'SELECT * FROM notification WHERE user_id = "'.$user_id.'" ORDER BY id DESC';
    $result_select_notification = $conn->query($sql_select_notification);
    if ($result_select_notification->num_rows > 0) {
        while ($row_select_notification = $result_select_notification->fetch_assoc()) {
            $notification_name = $row_select_notification['notification_name'];
            $notification_description = $row_select_notification['notification_description'];
            $notification_created_on = $row_select_notification['notification_created_on'];
            $notification_date = explode(' ', $notification_created_on);
            ?>
            <div class="list">
                <span><?php echo $notification_name; ?></span>
                <span><?php echo $notification_description; ?></span>
                <span><?php echo $notification_date[0]; ?></span>
            </div>
            <?php
        }
    } else {
        ?><span class="empty-box">No new notification.</span><?php
    }
    ?>
    
    <script src="../assets/js/notifications.js"></script>
</body>
</html>