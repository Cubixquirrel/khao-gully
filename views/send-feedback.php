<?php 

include_once('../config/db.php');
include_once('../classes/login-status.php');

$page_title = 'Send Feedback';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <link rel="stylesheet" href="../assets/css/send-feedback.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
</head>
<body>
    <div class="send-feedback-header">
        <i class="fas fa-arrow-left" onclick="pageBack()"></i>
    </div>

    <div class="send-feedback-title">
        <span><?php echo $page_title; ?></span>
        <span>Tell us what you love about the app, or what we could be doing better.</span>
    </div>

    <div class="send-feedback-input">
        <input type="text" class="feedback-input" placeholder="Enter feedback" onkeyup="checkFeedback()">
    </div>

    <div class="send-feedback-footer">
        <span>If your feedback is related to an order you have placed please write to us at <span>order@<?php echo $_SERVER['HTTP_HOST']; ?></span></span>
        <input type="submit" value="Submit" class="feedback-button" disabled onclick="sendFeedback('<?php echo $user_id; ?>')">
    </div>
    
    <script src="../assets/js/send-feedback.js"></script>
</body>
</html>