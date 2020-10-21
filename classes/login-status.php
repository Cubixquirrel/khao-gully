<?php

if (isset($_COOKIE['user_status']) && $_COOKIE['user_status'] == 'true') {
    $sql_select_user = 'SELECT user_id FROM users_login WHERE user_auth = "'.$_COOKIE["user_auth"].'"';
    $result_select_user = $conn->query($sql_select_user);
    
    if ($result_select_user->num_rows === 1) {
        $row_select_user = $result_select_user->fetch_assoc();

        $sql_select_data = 'SELECT * FROM users WHERE id = "'.$row_select_user["user_id"].'"';
        $result_select_data = $conn->query($sql_select_data);
        $row_select_data = $result_select_data->fetch_assoc();

        $user_id       = $row_select_data['id'];
        $user_name     = $row_select_data['user_name'];
        $user_mobile   = $row_select_data['user_mobile'];
        $user_email    = $row_select_data['user_email'];
        $user_location = $row_select_data['user_location'];
        $user_latlng   = $row_select_data['user_latlng'];
        $wallet_cash   = $row_select_data['wallet_cash'];
    } else {
        header ('location: ../views/get-started.php');
    }        
} else {
    header ('location: ../views/get-started.php');
}

?>