<?php 

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

include_once('../config/db.php');
include_once('../classes/login-status.php');

$page_title = 'Info';
$product_id = $_GET['productId'];

$sql_select_restaurant = 'SELECT * FROM restaurant WHERE id = "'.$product_id.'"';
$result_select_restaurant = $conn->query($sql_select_restaurant);
if ($result_select_restaurant->num_rows == 1) {
    $row_select_restaurant = $result_select_restaurant->fetch_assoc();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <link rel="stylesheet" href="../assets/css/restaurant-info.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
</head>
<body>
    <div class="product-header">
        <i class="fas fa-arrow-left" onclick="pageBack()"></i>
    </div>

    <?php
    if ($row_select_restaurant['image'] == '') {
        ?>
        <div class="restaurant-image no-image">
        
        </div>
        <?php
    } else {
        ?>
        <div class="restaurant-image">
            <img src="../../khao-gully-restaurant/uploads/document/<?php echo $row_select_restaurant['image']; ?>" alt="" srcset="">
        </div>
        <?php
    }
    ?>

    <div class="product-description">
        <div class="description-left">
            <span class="product-name"><?php echo $row_select_restaurant['name']; ?></span>

            <div class="product-rating">
                <div class="rating-box">
                    <?php
                    for ($i = 0; $i < $row_select_restaurant['rating']; $i++) {
                        echo '<i class="fas fa-star active"></i>';
                    }
                    for ($j = 0; $j < 5 - $row_select_restaurant['rating']; $j++) {
                        echo '<i class="fas fa-star"></i>';    
                    }
                    ?>
                </div>
            </div>

            <span class="product-tag"><?php echo $row_select_restaurant['main_tag']; ?></span>

            <span class="product-avg-costing">Rs. <?php echo $row_select_restaurant['average_pricing']; ?> per person</span>
        </div>
        
        <div class="description-right">
            <img src="../assets/image/phone.svg" alt="" onclick="openCall('<?php echo $row_select_restaurant['contact']; ?>')">
        </div>
    </div>

    <div class="order-food-main" onclick="openFood()">
        <div class="order-food-left">
            <img src="../assets/image/scooter.svg" alt="">
            <div class="text-box">
                <span>Order food online</span>
                <span>Start building your cart</span>
            </div>
        </div>
        <div class="order-food-right">
            <i class="fas fa-arrow-circle-right"></i>
        </div>
    </div>

    <div class="restaurant-address">
        <span>ADDRESS</span>
        <span><?php echo $row_select_restaurant['address']; ?></span>
    </div>

    <div class="restaurant-address opening">
        <span>OPENING HOURS</span>
        <div class="opening-hours"><span>Sunday</span><span><?php echo $row_select_restaurant['sun_timing']; ?></span></div>
        <div class="opening-hours"><span>Monday</span><span><?php echo $row_select_restaurant['mon_timing']; ?></span></div>
        <div class="opening-hours"><span>Tueday</span><span><?php echo $row_select_restaurant['tue_timing']; ?></span></div>
        <div class="opening-hours"><span>Wednesday</span><span><?php echo $row_select_restaurant['wed_timing']; ?></span></div>
        <div class="opening-hours"><span>Thursday</span><span><?php echo $row_select_restaurant['thu_timing']; ?></span></div>
        <div class="opening-hours"><span>Friday</span><span><?php echo $row_select_restaurant['fri_timing']; ?></span></div>
        <div class="opening-hours"><span>Satday</span><span><?php echo $row_select_restaurant['sat_timing']; ?></span></div>
    </div>

    <div class="restaurant-details">
        <span>CUISINES</span>
        <?php
        $cuisines = explode(',', $row_select_restaurant['cuisines']);
        foreach ($cuisines as $cuisine) {
            echo '<span>' . trim($cuisine) . '</span>';
        }
        ?>
    </div>
    
    <script src="../assets/js/restaurant-info.js"></script>
</body>
</html>