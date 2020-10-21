<?php

include_once('../config/db.php');
include('../assets/assets.php');

if (isset($_COOKIE['user_status']) && $_COOKIE['user_status'] == 'true') {
    $sql_select_user = 
    '
    SELECT user_id FROM users_login WHERE user_auth = "'.$_COOKIE["user_auth"].'" 
    ';
    $result_select_user = $conn->query($sql_select_user);
    
    if ($result_select_user->num_rows === 1) {
        header ('location: ../views/food.php');
    }        
}

$page_title = 'Get started';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <link rel="stylesheet" href="../assets/css/get-started.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
</head>
<body>
    <div id="main-box">
        <div class="heading-group">
            <h1 class="title">
                <?php echo $page_title; ?>
            </h1>

            <h2 class="sub-title">
                Enter your phone number and we will send an "OTP" to continue
            </h2>
        </div>

        <div>
            <div class="label">
                Mobile no.
            </div>

            <div class="input-group">
                <?php echo $flag; ?>

                <div class="input-control-group">
                    <span>+91</span>
                    <input type="tel" minlength="10" maxlength="10" name="" id="mobile-number" onkeyup="enableButton('10')">
                </div>
            </div>

            <div class="button">
                <input type="submit" value="Send OTP" id="send-button" onclick="sendOTP()" disabled>
            </div>
        </div>

        <div class="terms-group">
            <span class="line-1">By continuing, you agree to our</span>
            <span class="line-2">
                <a onclick="openPage('terms-of-service')">Terms of Service</a>
                <a onclick="openPage('privacy-policy')">Privacy Policy</a>
            </span>
        </div>
    </div>

    <div id="otp-box">
        <div class="heading-group">
            <div class="title-group">
                <i class="fas fa-arrow-left" id="close-button" onclick="closeOTP()"></i>
                <h1 class="title">
                    Enter Verification Code
                </h1>
            </div>

            <h2 class="sub-title">
                We have sent an OTP to +91-<span id="display-mobile"></span>
            </h2>
        </div>

        <div>
            <div class="input-control-group">
                <input type="tel" minlength="6" maxlength="6" name="" id="otp" onkeyup="enableButton('6')" onclick="enableClickButton()">
            </div>

            <div class="button">
                <input type="submit" value="Confirm" id="confirm-button" onclick="confirmOTP()" disabled>
            </div>

            <div class="resend-group">
                <span>Didn't receive the code?</span><input type="submit" id="resend-button" onclick="resendOTP()" value="Resend now">
            </div>
        </div>
    </div>

    <div id="personal-box">
        <div class="heading-group">
            <h1 class="title">
                Personal Details
            </h1>

            <h2 class="sub-title">
                Tell us a bit more about yourself
            </h2>
        </div>

        <div class="pb-10">
            <div class="label">
                Name
            </div>

            <div class="input-group">
                <div class="input-control-group">
                    <input type="text" name="" id="customer-name" onkeyup="enableButton('1')">
                </div>
            </div>
        
            <div class="label mt-25">
                Email
            </div>

            <div class="input-group">
                <div class="input-control-group">
                    <input type="text" name="" id="customer-email">
                </div>
            </div>
        
            <div class="label mt-25">
                Location
            </div>

            <div class="input-group">
                <div class="input-control-group">
                    <span class="open-map-button" onclick="openMap()">Live Location</span>
                    <input type="hidden" name="" id="customer-location">
                    <input type="hidden" name="" id="customer-latlng">
                </div>
            </div>

            <div class="button">
                <input type="submit" value="Finish" id="finish-button" onclick="finishPersonal()" disabled>
            </div>
        </div>
    </div>

    <div class="map-container">
        <div id="map" class="map"></div>
        <div class="button map-button">
            <input type="submit" value="Save Address" id="save-address-button">
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
    <script src="../assets/js/get-started.js"></script>
</body>
</html>