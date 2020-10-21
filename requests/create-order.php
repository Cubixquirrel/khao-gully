<?php

include_once('../config/db.php');
include_once('../classes/login-status.php');

date_default_timezone_set('Asia/Kolkata');
$current_time = date("d-m-Y H:i:s");

function getToken($length){
    $token = "";
    $codeAlphabet  = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $codeAlphabet .= "abcdefghijklmnopqrstuvwxyz";
    $codeAlphabet .= "0123456789";
    $max = strlen($codeAlphabet);

    for ($i = 0; $i < $length; $i++) {
        $token .= $codeAlphabet[random_int(0, $max - 1)];
    }
    return $token;
}

// print_r($_POST);
$restaurant_id = $_POST['restaurantId'];
$food_id = $_POST['foodId'];
$food_name = $_POST['foodName'];
$food_quantity = $_POST['foodQuantity'];
$food_price = $_POST['foodPrice'];
$item_total = $_POST['itemTotal'];
$taxes_charges = $_POST['taxesCharges'];
$delivery_charges = $_POST['deliveryCharges'];
$safety_packaging = $_POST['safetyPackaging'];
$rider_tip = $_POST['riderTip'];
$coupon_code_name = $_POST['couponCodeName'];
$coupon_code_value = $_POST['couponCodeValue'];
$wallet_to_from = $_POST['walletToFrom'];
$wallet_savings = $_POST['walletSavings'];
$grand_total = $_POST['grandTotal'];
$payment_type = $_POST['paymentType'];
$user_id = $_POST['userId'];
$user_location = $_POST['userLocation'];
$user_name = $_POST['userName'];
$user_mobile = $_POST['userMobile'];
$order_id = 'KHAO-2020-' . strtoupper(getToken(16));
$order_created_on = $current_time;

$sql_select_restaurant = 'SELECT * FROM restaurant WHERE id = "'.$restaurant_id.'"';
$result_select_restaurnat = $conn->query($sql_select_restaurant);
$row_select_restaurant = $result_select_restaurnat->fetch_assoc();
$restaurant_name = $row_select_restaurant['name'];
$restaurant_lat = $row_select_restaurant['restaurant_lat'];
$restaurant_lng = $row_select_restaurant['restaurant_lng'];

$sql_select_driver = 
"
SELECT * FROM `driver` WHERE 
driver_status = 'true' AND 
driver_login_status != 'false' AND 
driver_delivery_status != 'true'
";
$result_select_driver = $conn->query($sql_select_driver);

if ($result_select_driver->num_rows > 0) {
    $drivers = array();
    $distances = array();

    while($row_select_driver = $result_select_driver->fetch_assoc()) {
    
        $driver_id = $row_select_driver['id'];
        $driver_lat = $row_select_driver['driver_lat'];
        $driver_lng = $row_select_driver['driver_lng'];

        $sum_lat = $restaurant_lat - $driver_lat;
        $sum_lng = $restaurant_lng - $driver_lng;
        $distance = sqrt(($sum_lat**2) + ($sum_lng**2));

        $drivers[] = array(
            'id' => $driver_id,
            'distance' => $distance
        );
        $distances[] = $distance;
    }
    $nearest_distance = min($distances);
    $nearest_driver_key = array_search($nearest_distance, array_column($drivers, 'distance'));
    $nearest_driver_id = $drivers[$nearest_driver_key]['id'];
    $driver_id = $nearest_driver_id;
}

else {    
    $sql_select_driver = 
    "
    SELECT * FROM `driver` WHERE 
    driver_status = 'true' AND 
    driver_login_status != 'false' AND 
    driver_delivery_status = 'true'
    ";
    $result_select_driver = $conn->query($sql_select_driver);

    if ($result_select_driver->num_rows > 0) {
        $drivers = array();
        $distances = array();
    
        while($row_select_driver = $result_select_driver->fetch_assoc()) {
        
            $driver_id = $row_select_driver['id'];
            $driver_lat = $row_select_driver['driver_lat'];
            $driver_lng = $row_select_driver['driver_lng'];
    
            $sum_lat = $restaurant_lat - $driver_lat;
            $sum_lng = $restaurant_lng - $driver_lng;
            $distance = sqrt(($sum_lat**2) + ($sum_lng**2));
    
            $drivers[] = array(
                'id' => $driver_id,
                'distance' => $distance
            );
            $distances[] = $distance;
        }
        $nearest_distance = min($distances);
        $nearest_driver_key = array_search($nearest_distance, array_column($drivers, 'distance'));
        $nearest_driver_id = $drivers[$nearest_driver_key]['id'];
        $driver_id = $nearest_driver_id;
    }
    
    else {
        $driver_id = '';
    }
}

if ($payment_type == 'Cash') {
    if ($driver_id == '') {
        $order_status = 'Order Failed';
        $order_description = 'We cannot receive your order now.';
    } else {
        $order_status = 'Order Placed';
        $order_description = $restaurant_name . ' has accepted your order.';

        if ($wallet_to_from == 'TO') {
            $new_wallet_cash = (int)$wallet_cash + 40; 
            $sql_update_users = 'UPDATE users SET wallet_cash = "'.$new_wallet_cash.'" WHERE id = "'.$user_id.'"';
            $result_update_users = $conn->query($sql_update_users);
        } else if ($wallet_to_from == 'FROM') {
            if ($wallet_cash >= $wallet_savings) {
                $new_wallet_cash = $wallet_cash - $wallet_savings; 
                $sql_update_users = 'UPDATE users SET wallet_cash = "'.$new_wallet_cash.'" WHERE id = "'.$user_id.'"';
                $result_update_users = $conn->query($sql_update_users);
            }
        }
    }
} else if ($payment_type == 'Card') {
    $order_status = 'Order Failed';
    $order_description = 'We cannot receive your order now.';
}

$sql_insert_order = 
'
INSERT INTO order_id (
    restaurant_id, driver_id, 
    food_id, food_name, food_quantity, food_price, 
    item_total, taxes_charges, delivery_charges, safety_packaging, rider_tip, coupon_code_name, coupon_code_value, grand_total, 
    payment_type, 
    user_id, user_location, user_name, user_mobile, 
    order_id, order_status, order_created_on
) VALUES (
    "'.$restaurant_id.'", "'.$driver_id.'", 
    "'.$food_id.'", "'.$food_name.'", "'.$food_quantity.'", "'.$food_price.'", 
    "'.$item_total.'", "'.$taxes_charges.'", "'.$delivery_charges.'", "'.$safety_packaging.'", "'.$rider_tip.'", "'.$coupon_code_name.'", "'.$coupon_code_value.'", "'.$grand_total.'", 
    "'.$payment_type.'", 
    "'.$user_id.'", "'.$user_location.'", "'.$user_name.'", "'.$user_mobile.'", 
    "'.$order_id.'", "'.$order_status.'", "'.$order_created_on.'"
)
';
$result_insert_order = $conn->query($sql_insert_order);

if ($result_insert_order) {

    $notification_name = $order_status;
    $notification_description = $order_description;
    $notification_created_on = $order_created_on;
    
    $sql_insert_notification = 
    '
    INSERT INTO notification (
        user_id, 
        notification_name, notification_description, notification_created_on
    ) VALUES (
        "'.$user_id.'", 
        "'.$notification_name.'", "'.$notification_description.'", "'.$notification_created_on.'"
    )
    ';
    $result_insert_notification = $conn->query($sql_insert_notification);

    setcookie('order_id', $order_id, time() + (10 * 365 * 24 *60 * 60), '/');
    echo $order_status;
}
?>