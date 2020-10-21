<?php

include_once('../config/db.php');

function generateToken($length = 7) {
    $chars = 'abcdefghijklmnopqrstuvwxyz1234567890';
    $token = '';
    while(strlen($token) < $length) {
        $token .= $chars[mt_rand(0, strlen($chars)-1)];
    }
    return $token;
}

if (
    ((isset($_POST['mobile'])) && ($_POST['mobile'] != '')) && 
    ((isset($_POST['otp'])) && ($_POST['otp'] != '')) && 
    ((isset($_POST['customername'])) && ($_POST['customername'] != '')) && 
    ((isset($_POST['customerlocation'])) && ($_POST['customerlocation'] != '')) && 
    ((isset($_POST['customerlatlng'])) && ($_POST['customerlatlng'] != ''))
) {
    $customer_mobile = $_POST['mobile'];
    $customer_otp = $_POST['otp'];
    $customer_name = ucwords($_POST['customername']);
    $customer_email = strtolower($_POST['customeremail']);
    $customer_location = ucwords($_POST['customerlocation']);
    $customer_latlng = $_POST['customerlatlng'];

    $sql_select_user = 'SELECT * FROM users WHERE user_mobile = "'.$customer_mobile.'" ORDER BY id DESC LIMIT 1';
    $result_select_user = $conn->query($sql_select_user);

    if ($result_select_user->num_rows === 1) {
        $sql_update_user = 
        '
        UPDATE users SET 
        user_name = "'.$customer_name.'",
        user_email = "'.$customer_email.'",
        user_location = "'.$customer_location.'",
        user_latlng = "'.$customer_latlng.'"
        WHERE user_mobile = "'.$customer_mobile.'"
        ';
        $result_update_user = $conn->query($sql_update_user);

        $sql_select_id = 'SELECT id FROM users WHERE user_mobile = "'.$customer_mobile.'"';
        $result_select_id = $conn->query($sql_select_id);
        $row_select_id = $result_select_id->fetch_assoc();
        $user_id = $row_select_id['id'];

        if ($result_update_user) {        
            $user_auth = generateToken(80);
            $user_status = 'true';

            $sql_update_status = 
            '
            UPDATE users_login SET
            user_auth = "'.$user_auth.'",
            user_status = "'.$user_status.'"
            WHERE user_id = "'.$user_id.'"
            ';
            $result_update_status = $conn->query($sql_update_status);

            if ($result_update_status) {
                setcookie('user_auth', $user_auth, time() + (10 * 365 * 24 *60 * 60), '/');
                setcookie('user_status', $user_status, time() + (10 * 365 * 24 *60 * 60), '/');

                echo $user_status;
            }
        }
    } else {
        $sql_insert_user = 
        '
        INSERT INTO users (
            user_mobile,
            user_name,
            user_email,
            user_location,
            user_latlng
        ) VALUES (
            "'.$customer_mobile.'",
            "'.$customer_name.'",
            "'.$customer_email.'",
            "'.$customer_location.'",
            "'.$customer_latlng.'"
        )
        ';
        $result_insert_user = $conn->query($sql_insert_user);
        $user_id = $conn->insert_id;
        
        if ($result_insert_user) {        
            $user_auth = generateToken(80);
            $user_status = 'true';

            $sql_insert_status = 
            '
            INSERT INTO users_login (
                user_id,
                user_auth,
                user_status
            ) VALUES (
                "'.$user_id.'",
                "'.$user_auth.'",
                "'.$user_status.'"
            )
            ';
            $result_insert_status = $conn->query($sql_insert_status);

            if ($result_insert_status) {
                setcookie('user_auth', $user_auth, time() + (10 * 365 * 24 *60 * 60), '/');
                setcookie('user_status', $user_status, time() + (10 * 365 * 24 *60 * 60), '/');

                echo $user_status;
            }
        }
    }
}

?>