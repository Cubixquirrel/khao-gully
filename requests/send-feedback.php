<?php

include_once('../config/db.php');

if (
    ((isset($_POST['userid'])) && ($_POST['userid'] != '')) && 
    ((isset($_POST['feedback'])) && ($_POST['feedback'] != ''))
) {
    $customer_userid = $_POST['userid'];
    $customer_feedback = $_POST['feedback'];

    $sql_insert_feedback = 
    '
    INSERT INTO feedback (
        user_id,
        user_feedback  
    ) VALUES (
        "'.$customer_userid.'",
        "'.$customer_feedback.'"
    )
    ';
    $result_insert_feedback = $conn->query($sql_insert_feedback);

    if ($result_insert_feedback) {
        echo 'Feedback submitted';
    }
}

?>