<?php

include_once('../config/db.php');

if (
    ((isset($_POST['mobile'])) && ($_POST['mobile'] != '')) && 
    ((isset($_POST['otp'])) && ($_POST['otp'] != ''))
) {
    $customer_mobile = $_POST['mobile'];
    $customer_otp = $_POST['otp'];
    
    $sql_select_otp = 'SELECT * FROM otp WHERE mobile = "'.$customer_mobile.'" ORDER BY id DESC LIMIT 1';
    $result_select_otp = $conn->query($sql_select_otp);

    if ($result_select_otp->num_rows === 1) {
        $row_select_otp = $result_select_otp->fetch_assoc();

        if ($row_select_otp['otp'] == $customer_otp) {
            $status = 'true';

            $sql_select_user = 'SELECT * FROM users WHERE user_mobile = "'.$customer_mobile.'" ORDER BY id DESC LIMIT 1';
            $result_select_user = $conn->query($sql_select_user);

            if ($result_select_user->num_rows === 1) {
                $row_select_user = $result_select_user->fetch_assoc();

                echo $row_select_user['user_name'] . '__%__';
                echo $row_select_user['user_email'] . '__%__';
                echo $row_select_user['user_location'] . '__%__';
                echo $row_select_user['user_latlng'] . '__%__';
                echo 'found' . '__%__';
            }

            echo $status;
        } else {
            $status = 'false';
            echo $status;
        }
    }
}

?>