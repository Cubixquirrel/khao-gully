<?php

include_once('../config/db.php');

if (isset($_COOKIE['user_status']) && $_COOKIE['user_status'] == 'true') {
    $sql_select_user = 
    '
    SELECT user_id FROM users_login WHERE user_auth = "'.$_COOKIE["user_auth"].'" 
    ';
    $result_select_user = $conn->query($sql_select_user);
    
    if ($result_select_user->num_rows === 1) {
        $row_select_user = $result_select_user->fetch_assoc();

        $sql_select_data = 'SELECT * FROM users WHERE id = "'.$row_select_user["user_id"].'"';
        $result_select_data = $conn->query($sql_select_data);
        $row_select_data = $result_select_data->fetch_assoc();
        $user_id = $row_select_data['id'];
    } else {
        header ('location: ../views/get-started.php');
    }        
}

if (
    ((isset($_POST['customername'])) && ($_POST['customername'] != '')) && 
    ((isset($_POST['customerlocation'])) && ($_POST['customerlocation'] != ''))
) {
    $customer_name = ucwords($_POST['customername']);
    $customer_email = strtolower($_POST['customeremail']);
    $customer_location = ucwords($_POST['customerlocation']);

    $date_of_birth = $_POST['birthDate'].'/'.$_POST['birthMonth'].'/'.$_POST['birthYear'];

    $sql_update_user = 
    '
    UPDATE users SET 
    user_name = "'.$customer_name.'",
    user_email = "'.$customer_email.'",
    user_location = "'.$customer_location.'", 
    date_of_birth = "'.$date_of_birth.'" 
    WHERE id = "'.$user_id.'"
    ';
    $result_update_user = $conn->query($sql_update_user);

    if ($result_update_user) {
        $sql_select_user = 'SELECT * FROM users WHERE id = "'.$user_id.'"';
        $result_select_user = $conn->query($sql_select_user);
        $row_select_user = $result_select_user->fetch_assoc();

        echo $row_select_user['user_name'] . '__%__';
        echo $row_select_user['user_email'] . '__%__';
        echo $row_select_user['user_location'] . '__%__';
        echo 'found' . '__%__';
    }
}

?>