<?php

include_once('../config/db.php');

if (
    ((isset($_POST['userid'])) && ($_POST['userid'] != '')) && 
    ((isset($_POST['helpMessage'])) && ($_POST['helpMessage'] != ''))
) {
    $customer_userid = $_POST['userid'];
    $customer_help_message = $_POST['helpMessage'];

    $sql_insert_help_message = 
    '
    INSERT INTO help_message (
        user_id,
        user_help_message  
    ) VALUES (
        "'.$customer_userid.'",
        "'.$customer_help_message.'"
    )
    ';
    $result_insert_help_message = $conn->query($sql_insert_help_message);

    if ($result_insert_help_message) {
        echo 'Help message submitted';
    }
}

?>