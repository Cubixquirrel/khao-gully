<?php

include_once('../config/db.php');

if (
    ((isset($_POST['userid'])) && ($_POST['userid'] != '')) && 
    ((isset($_POST['customerlocation'])) && ($_POST['customerlocation'] != '')) && 
    ((isset($_POST['customerlatlng'])) && ($_POST['customerlatlng'] != ''))
) {
    $user_id = $_POST['userid'];
    $user_location = ucwords($_POST['customerlocation']);
    $user_latlng = $_POST['customerlatlng'];

    $sql_update_location = 'UPDATE users SET user_location = "'.$user_location.'", user_latlng = "'.$user_latlng.'" WHERE id = "'.$user_id.'"';
    $result_update_location = $conn->query($sql_update_location);

    echo ucwords($user_location);
}

?>