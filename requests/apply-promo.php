<?php

include_once('../config/db.php');

$coupon_code = $_POST['couponCode'];
$item_total = $_POST['itemTotal'];

$sql_select_coupon = 'SELECT * FROM coupon WHERE coupon_code = "'.$coupon_code.'"';
$result_select_coupon = $conn->query($sql_select_coupon);

if ($result_select_coupon->num_rows == 1) {
    $row_select_coupon = $result_select_coupon->fetch_assoc();
    if ($row_select_coupon['coupon_expiry'] == 'false') {
        $min_value = $row_select_coupon["min_value"];

        if ($min_value < $item_total) {
            $coupon_code = $row_select_coupon['coupon_code'];
            $coupon_type = $row_select_coupon['coupon_type'];
            $coupon_value = $row_select_coupon['coupon_value'];

            echo $coupon_code . '__%__' . $coupon_type . '__%__' . $coupon_value . '__%__' . $min_value;
        } else {
            echo 'false__%__Rs. '.$min_value.' Required';
        }
    } else {
        echo 'false__%__Coupon Expired';
    }
} else {
    echo 'false__%__Wrong Coupon';
}

?>