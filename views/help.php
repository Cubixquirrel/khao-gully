<?php 

include_once('../config/db.php');
include_once('../classes/login-status.php');

$page_title = 'Help';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <link rel="stylesheet" href="../assets/css/help.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
</head>
<body>
    <div class="need-help-header">
        <i class="fas fa-arrow-left" onclick="pageBack()"></i>
    </div>

    <div class="need-help-title">
        <span>Need <?php echo $page_title; ?></span>
    </div>

    <div class="need-help-input">
        <input type="text" class="help-input" placeholder="Enter message" onkeyup="checkHelpMessage()">
    </div>

    <div class="need-help-footer">
        <span>If your message is related to an order you have placed please write to us at <span>order@<?php echo $_SERVER['HTTP_HOST']; ?></span></span>
        <input type="submit" value="Submit" class="help-button" disabled onclick="sendHelpMessage('<?php echo $user_id; ?>')">
    </div>
    
    <script src="../assets/js/help.js"></script>
</body>
</html>