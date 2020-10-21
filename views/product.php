<?php 

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

include_once('../config/db.php');
include_once('../classes/login-status.php');

$page_title = 'Product';
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
    <link rel="stylesheet" href="../assets/css/product.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
</head>
<body>
    <div class="product-header">
        <i class="fas fa-arrow-left" onclick="pageBack()"></i>

        <span class="product-text" onclick="openRestaurantInfo('<?php echo $row_select_restaurant['id']; ?>')">
            about restaurant
        </span>
    </div>

    <div class="product-description">
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

    <div class="address-main">
        <div class="icon">
            <i class="fas fa-check-circle"></i>
        </div>

        <div class="text">
            <span>Delivering to Home</span>
            <span class="user-location">(<?php echo $user_location; ?>)</span>
        </div>
    </div>

    <div class="coupon-main">
        <?php
        $sql_select_coupon = 'SELECT * FROM coupon ORDER BY id DESC';
        $result_select_coupon = $conn->query($sql_select_coupon);
        while($row_select_coupon = $result_select_coupon->fetch_assoc()) {
            $coupon_code = $row_select_coupon['coupon_code'];
            $coupon_description = $row_select_coupon['coupon_description'];
            $coupon_expiry = $row_select_coupon['coupon_expiry'];

            if ($coupon_expiry == 'false') {
            ?>
            <div class="coupon-card">
                <span><?php echo $coupon_code; ?></span>
                <span><?php echo $coupon_description; ?></span>
            </div>
            <?php
            }
        }
        ?>
    </div>

    <!-- food-main -->
    <?php
    $sql_select_category = 'SELECT * FROM category WHERE restaurant_id = "'.$row_select_restaurant["id"].'" ORDER BY category_name ASC';
    $result_select_category = $conn->query($sql_select_category);

    if ($result_select_category->num_rows > 0) {
        while ($row_select_category = $result_select_category->fetch_assoc()) {            
            $sql_select_food = 'SELECT * FROM food WHERE restaurant_id = "'.$row_select_restaurant["id"].'" AND category_id = "'.$row_select_category["id"].'" AND stock != "out" AND food_status = "true" ORDER BY food_name ASC';
            $result_select_food = $conn->query($sql_select_food);
        
            if ($result_select_food->num_rows > 0) {
                ?><div class="food-main"><?php
                $sql_select_food_count = 'SELECT COUNT(*) FROM food WHERE restaurant_id = "'.$row_select_restaurant["id"].'" AND category_id = "'.$row_select_category["id"].'" AND stock != "out" AND food_status = "true"';
                $result_select_food_count = $conn->query($sql_select_food_count);
                $row_select_food_count = $result_select_food_count->fetch_row();
                ?>
                <!-- food list heading -->
                <div class="food-header">
                    <i class="fas fa-sort-down"></i>

                    <div class="header-text-block">
                        <span><?php echo $row_select_category['category_name']; ?></span>
                        <span><?php echo $row_select_food_count[0]; ?> items</span>
                    </div>
                </div>
                <?php
                while ($row_select_food = $result_select_food->fetch_assoc()) {
                ?>
                <!-- food single list -->
                <div class="food-card">
                    <div class="card-left">
                        <?php
                        if ($row_select_food['veg_non_veg'] == 'veg') {
                            ?>
                            <div class="icon veg">
                                <span class="circle"></span>
                            </div>
                            <?php
                        } else {
                            ?>
                            <div class="icon non-veg">
                                <span class="circle"></span>
                            </div>
                            <?php
                        }
                        ?>
                        <div class="text-box">
                            <span class="food-name"><?php echo $row_select_food['food_name']; ?></span>
                            <span class="food-price">Rs. <?php echo $row_select_food['price']; ?></span>
                            <span class="food-description"><?php echo $row_select_food['description']; ?></span>
                        </div>
                    </div>
                    
                    <span class="food-add-button add-button" data-name="<?php echo $row_select_food['food_name']; ?>" data-price="<?php echo $row_select_food['price']; ?>" data-id="<?php echo $row_select_food['id']; ?>" data-quantity="0">
                        <span class="minus"></span>
                        <span class="display">ADD</span>
                        <span class="plus">+</span>
                    </span>
                </div>
                <?php
                }
                ?></div><?php
            }
        }
    }

    $sql_select_food_count = 'SELECT * FROM food WHERE restaurant_id = "'.$row_select_restaurant["id"].'" AND stock != "out" AND food_status = "true"';
    $result_select_food_count = $conn->query($sql_select_food_count);
    if ($result_select_food_count->num_rows == 0) {
        ?><div class="empty-food">Nothing to choose</div><?php
    }
    ?>

    <div class="space"></div>
    
    <!-- cart button -->
    <div class="cart-box">
        <div class="cart-container" onclick="openCart('<?php echo $row_select_restaurant['id']; ?>'); updatePromo()">
            <div class="cart-left">
                <span class="left-top"><span id="cart-item">0</span> ITEM</span>
                <span class="left-bottom">Rs. <span id="cart-price">0</span> plus taxes</span>
            </div>

            <div class="cart-right">
                <span>View Cart</span>
                <i class="fas fa-caret-right"></i>
            </div>
        </div>
    </div>

    <!-- cart page -->
    <div class="shadow-main" onclick="hideCart()">
    </div>
    <div class="cart-page">
        <div class="cart-address-main">
            <div class="cart-icon">
                <i class="fas fa-check-circle"></i>
            </div>

            <div class="cart-text">
                <span>Delivering to Home</span>
                <span class="cart-user-location">(<?php echo $user_location; ?>)</span>
            </div>
        </div>

        <div class="cart-scroll">
            <div class="cart-food-list">
            </div>

            <div class="rider-tips-box">
                <span class="tips-header">SUPPORT YOUR RIDER</span>
                <span class="tips-description">
                    Our riders are risking their lives to serve the nation. 
                    While we're doing our best to support them, we'd request you to 
                    tip them generously in these difficult times, if you can afford it.
                </span>
                <div class="tips-amount-box">
                    <img class="tip-icon" src="../assets/image/cup.svg" alt="">
                    <span onclick="addTips('5')">+ Rs. 5</span>
                    <span onclick="addTips('10')">+ Rs. 10</span>
                    <span onclick="addTips('15')">+ Rs. 15</span>
                </div>
            </div>

            <div class="total-box">
                <div class="promo-box">
                    <input type="text" placeholder="Enter promo code" name="promo-input" maxlength="6" onkeyup="capitalLetter()">
                    <input type="submit" value="Apply" class="promo-button" onclick="applyPromo()">
                </div>

                <div class="item-box">
                    <span>Item Total</span>
                    <span>Rs. <span class="item-total">0</span>.00</span>
                </div>

                <div class="taxes-box">
                    <span>Taxes & Charges</span>
                    <span>Rs. <span class="taxes-charges">0</span></span>
                </div>

                <div class="delivery-box">
                    <span>Delivery Charges</span>
                    <span>Rs. <span class="delivery-charges">0</span>.00</span>
                </div>

                <div class="safety-box">
                    <span>Safety Packaging</span>
                    <span>Rs. <span class="safety-packaging">0</span>.00</span>
                </div>

                <div class="rider-tip-box">
                    <span>Rider Tip<span class="remove-tip" onclick="removeTips()">Remove</span></span>
                    <span>Rs. <span class="rider-tip">0</span>.00</span>
                </div>

                <div class="coupon-code-box">
                    <span>Promo - (<span class="coupon-code-name"></span>)<span class="remove-coupon-code" onclick="removePromo()">Remove</span></span>
                    <span>- Rs. <span class="coupon-code-value">0</span></span>
                </div>

                <div class="your-savings-box">
                    <span>YOUR TOTAL SAVINGS</span>
                    <span>Rs. <span id="total-savings"></span></span>
                </div>

                <div class="your-wallet-box">
                    <span>YOUR TOTAL SAVINGS <span class="wallet-to-from"></span> WALLET</span>
                    <span>Rs. <span id="wallet-savings"></span></span>
                    <input type="hidden" id="wallet-cash" value="<?php echo $wallet_cash; ?>">
                </div>

                <div class="grand-total-box">
                    <span>Grand Total</span>
                    <span>Rs. <span class="grand-total">0</span></span>
                </div>
            </div>

            <div class="ordering-box">
                <span>ORDERING FOR</span>
                <span><?php echo $user_name; ?>, <?php echo $user_mobile; ?></span>
            </div>
        </div>

        <div class="cart-footer">
            <div class="payment-mode-box" onclick="openPaymentPage()">
                <div class="payment-top">
                    <!-- <img src="../assets/image/razorpay.svg" class="tip-icon"> -->
                    <span>PAY USING</span>                    
                    <i class="fas fa-caret-up"></i>
                </div>
                <span class="payment-type">Card</span>
            </div>
            
            <?php 
                $restaurantId = $_GET['productId'];
            ?>

            <div class="cart-footer-button" onclick="createOrder('<?php echo $restaurantId; ?>', '<?php echo $user_id; ?>', '<?php echo $user_location; ?>', '<?php echo $user_name; ?>', '<?php echo $user_mobile; ?>')">
                <div class="cart-footer-left">
                    <span class="cart-left-top">Rs. <span class="cart-footer-total">0</span></span>
                    <span class="cart-left-bottom">TOTAL</span>
                </div>
                <div class="cart-footer-right">
                    <span>Place Order</span>
                    <i class="fas fa-caret-right"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="payment-page">
        <div class="payment-page-header" onclick="closePaymentPage()">
            <i class="fas fa-arrow-left"></i>

            <span>
                Select Payment Method
            </span>
        </div>

        <div class="payment-page-body">
            <div class="list-main" onclick="setPaymentType('Card')">
                <div class="payment-list">
                    <img src="../assets/image/card.svg" class="card-icon">
                    <span>Credit, Debit & ATM Cards</span>
                </div>
                <i class="fas fa-chevron-right"></i>
            </div>
            
            <div class="list-main" onclick="setPaymentType('Cash')">
                <div class="payment-list">                
                    <img src="../assets/image/rupee.svg" class="card-icon">
                    <span>Cash On Delivery</span>
                </div>
                <i class="fas fa-chevron-right"></i>
            </div>
        </div>
    </div>
    
    <script src="../assets/js/backfix.min.js"></script>
    <script src="../assets/js/product.js"></script>
</body>
</html>