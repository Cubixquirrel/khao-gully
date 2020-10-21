<?php 

include_once('../config/db.php');
include_once('../classes/login-status.php');

$page_title = 'Your Orders';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <link rel="stylesheet" href="../assets/css/your-orders.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
</head>
<body>
    <div class="your-orders-header">
        <i class="fas fa-arrow-left" onclick="openFoodPage()"></i>
    </div>

    <div class="your-orders-title">
        <span><?php echo $page_title; ?></span>
    </div>

    <?php
    $sql_select_order = 'SELECT * FROM order_id WHERE user_id = "'.$user_id.'" ORDER BY id DESC';
    $result_select_order = $conn->query($sql_select_order);

    if ($result_select_order->num_rows > 0) {
        while ($row_select_order = $result_select_order->fetch_assoc()) {
            $restaurant_id = $row_select_order['restaurant_id'];
            $food_quantity = explode('__%__', $row_select_order['food_quantity']);
            $food_name = explode('__%__', $row_select_order['food_name']);;
            $order_created_on = $row_select_order['order_created_on'];
            $order_grand_total = $row_select_order['grand_total'];
            $order_status = $row_select_order['order_status'];
            $driver_id = $row_select_order['driver_id'];

            $sql_select_restaurant = 'SELECT * FROM restaurant WHERE id = "'.$restaurant_id.'"';
            $result_select_restaurant = $conn->query($sql_select_restaurant);
            $row_select_restaurant = $result_select_restaurant->fetch_assoc();
            $restaurant_name = $row_select_restaurant['name'];
            $restaurant_address = $row_select_restaurant['address'];
            $restaurant_image = $row_select_restaurant['image'];

            $sql_select_driver = 'SELECT * FROM driver WHERE id = "'.$driver_id.'"';
            $result_select_driver = $conn->query($sql_select_driver);
            $row_select_driver = $result_select_driver->fetch_assoc();
            ?>
            <div class="your-order-list">
                <div class="list-header">
                    <?php
                    if ($restaurant_image == '') {
                        ?>
                        <div class="header-image no-image">
                        
                        </div>
                        <?php
                    } else {
                        ?>
                        <div class="header-image">
                            <img src="../../khao-gully-restaurant/uploads/document/<?php echo $restaurant_image; ?>" alt="" srcset="">
                        </div>
                        <?php
                    }
                    ?>

                    <div class="header-block">
                        <span><?php echo $restaurant_name; ?></span>
                        <span><?php echo $restaurant_address; ?></span>
                    </div>
                </div>

                <div class="list-body">
                    <div class="list-group">
                        <span>ITEMS</span>
                        <?php
                        foreach (array_intersect(array_keys($food_quantity), array_keys($food_name)) as $key) {
                            ?><span><?php echo $food_quantity[$key]; ?> x <?php echo $food_name[$key]; ?></span><?php
                        }
                        ?>
                    </div>

                    <div class="list-group">
                        <span>ORDERED ON</span>
                        <span><?php echo $order_created_on; ?></span>
                    </div>

                    <div class="list-group">
                        <span>TOTAL AMOUNT</span>
                        <span><?php echo $order_grand_total; ?></span>
                    </div>

                    <div class="list-group last">
                        <span>DRIVER</span>
                        <?php
                        if ($driver_id != '') {
                            ?>
                            <span><?php echo $row_select_driver['name']; ?></span>
                            <span>Mobile: <?php echo $row_select_driver['contact']; ?></span>
                            <?php
                        } else {
                            ?>
                            <span>No Driver</span>
                            <?php
                        }
                        ?>
                    </div>
                </div>

                <div class="list-footer">
                    <span><?php echo $order_status; ?></span>
                </div>
            </div>
            <?php
        }
    } else {
        ?><span class="empty-box">No order found.</span><?php
    }
    ?>

    <script src="../assets/js/your-orders.js"></script>
</body>
</html>