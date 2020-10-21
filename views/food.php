<?php 

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

include_once('../config/db.php');
include_once('../classes/login-status.php');

$page_title = 'Food';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <link rel="stylesheet" href="../assets/css/food.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
</head>
<body>
    <?php include_once('../views/menu.php'); ?>
    
    <div class="header-main" onclick="editAddress();">
        <div class="icon">
            <i class="fas fa-home"></i>
        </div>

        <div class="text">
            <span>Home</span>
            <span class="user-location"><?php echo $user_location; ?></span>
        </div>
    </div>

    <div class="shadow-main"></div>

    <div class="address-main">
        <div class="address-group fl-sb">
            <span class="address-title">Edit Location</span>
            <i class="fas fa-times close-button" onclick="closeAddress()"></i>
        </div>

        <span class="address-input" onclick="openMap()"></span>
        <input type="hidden" name="" id="customer-location" value="<?php echo $user_location; ?>">
        <input type="hidden" name="" id="customer-latlng" value="<?php echo $user_latlng; ?>">
        
        <input type="submit" value="Save" class="address-button" onclick="saveAddress('<?php echo $user_id; ?>')">
    </div>

    <div class="search-main">
        <div class="search-bar" onclick="openSearchPage()">
            <i class="fa fa-search"></i>
            <span class="text">Search for restaurants, cuisines...</span>
        </div>
    </div>

    <div class="tag-main">
        <span class="active-link">veg</span>
        <span>non veg</span>
        <span>beverages</span>
        <span>snacks</span>
        <span>sweets</span>
    </div>

    <div class="banner-main">
        <?php
        $sql_select_banners = 'SELECT * FROM banners WHERE id = "1"';
        $result_select_banners = $conn->query($sql_select_banners);
        $row_select_banners = $result_select_banners->fetch_assoc();
        ?>

        <img src="../../khao-gully-admin/uploads/banner/<?php echo $row_select_banners['usersBanner1']; ?>">
        <img src="../../khao-gully-admin/uploads/banner/<?php echo $row_select_banners['usersBanner2']; ?>">
        <img src="../../khao-gully-admin/uploads/banner/<?php echo $row_select_banners['usersBanner3']; ?>">
        <img src="../../khao-gully-admin/uploads/banner/<?php echo $row_select_banners['usersBanner4']; ?>">
        <img src="../../khao-gully-admin/uploads/banner/<?php echo $row_select_banners['usersBanner5']; ?>">
        <img src="../../khao-gully-admin/uploads/banner/<?php echo $row_select_banners['usersBanner6']; ?>">
    </div>

    <div class="category-main">
        <?php
        $sql_select_restaurant = 'SELECT * FROM restaurant WHERE restaurant_status = "true" ORDER BY rating DESC';
        $result_select_restaurant = $conn->query($sql_select_restaurant);
        if ($result_select_restaurant->num_rows > 0) {
            while ($row_select_restaurant = $result_select_restaurant->fetch_assoc()) {
                if ($row_select_restaurant['restaurant_login_status'] == 'false') {
                    ?>                    
                    <div class="product-card">
                        <?php
                        if ($row_select_restaurant['image'] == '') {
                            ?>
                            <div class="product-image no-image">
                            
                            </div>
                            <?php
                        } else {
                            ?>
                            <div class="product-image">
                                <img src="../assets/image/<?php echo $row_select_restaurant['image']; ?>" alt="" srcset="">
                            </div>
                            <?php
                        }
                        ?>

                        <span class="product-name"><?php echo $row_select_restaurant['name']; ?></span>

                        <span class="product-offline">Currently not accepting any orders</span>

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
                    <?php
                } else {
                    ?>                    
                    <div class="product-card" onclick="openProduct('<?php echo $row_select_restaurant['id']; ?>')">
                        <?php
                        if ($row_select_restaurant['image'] == '') {
                            ?>
                            <div class="product-image no-image">
                            
                            </div>
                            <?php
                        } else {
                            ?>
                            <div class="product-image">
                                <img src="../../khao-gully-restaurant/uploads/document/<?php echo $row_select_restaurant['image']; ?>" alt="" srcset="">
                            </div>
                            <?php
                        }
                        ?>

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
                    <?php
                }
            }
        } else {
            ?><div class="empty-food">No restaurant available</div><?php
        }
        ?>
    </div>

    <div class="map-container">
        <div id="map" class="map"></div>
        <div class="button map-button">
            <input type="submit" class="address-button" value="Save Address" id="save-address-button">
        </div>
        <div class="button map-button secondary">
            <input type="submit" value="Close" id="close-address-button">
        </div>
    </div>

    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCWh--A2qe-yWC2AOuC3J6ZiuxtXFUCh24&libraries=&v=weekly"
      defer
    ></script>
    <script src="../assets/js/food.js"></script>
</body>
</html>