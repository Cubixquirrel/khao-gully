<?php

include_once('../config/db.php');

// print_r($_POST);
// $search_tag = $_POST['searchTag'];
$search_text = $_POST['searchText'];

$sql_select_food = 'SELECT * FROM food WHERE food_name like "%'.$search_text.'%" AND stock != "out" AND food_status = "true" GROUP BY food_name';
$result_select_food = $conn->query($sql_select_food);
if ($result_select_food->num_rows > 0) {
    while ($row_select_food = $result_select_food->fetch_assoc()) {
        $restaurnant_id = $row_select_food['restaurant_id'];
        $food_name = $row_select_food['food_name'];

        $sql_select_restaurant = 'SELECT * FROM restaurant WHERE restaurant_status = "true" AND restaurant_login_status = "" AND id = "'.$restaurnant_id.'"';
        $result_select_restaurant = $conn->query($sql_select_restaurant);
        if ($result_select_restaurant->num_rows > 0) {
            echo 
            $restaurnant_id . "__%__" . 
            $food_name . "__%%__"
            ;
        } else {
            echo 'Nothing found.';
        }
    }
}
else if ($result_select_food->num_rows == 0) {
    $sql_select_restaurant = 'SELECT * FROM restaurant WHERE restaurant_status = "true" AND restaurant_login_status = "" AND name like "%'.$search_text.'%" GROUP BY name';
    $result_select_restaurant = $conn->query($sql_select_restaurant);
    if ($result_select_restaurant->num_rows > 0) {
        while ($row_select_restaurant = $result_select_restaurant->fetch_assoc()) {
            $restaurnant_id = $row_select_restaurant['id'];
            $restaurant_name = $row_select_restaurant['name'];

            echo 
            $restaurnant_id . "__%__" . 
            $restaurant_name . "__%%__"
            ;
        }
    } else {
        echo 'Nothing found.';
    }
}
?>