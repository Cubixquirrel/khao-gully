<?php 

include_once('../config/db.php');
include_once('../classes/login-status.php');
include('../assets/assets.php');

$page_title = 'Edit Profile';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <link rel="stylesheet" href="../assets/css/edit-profile.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
</head>
<body>
    <div class="edit-profile-header">
        <i class="fas fa-arrow-left" onclick="pageBack()"></i>
    </div>

    <div class="edit-profile-title">
        <span><?php echo $page_title; ?></span>
    </div>

    <div class="edit-profile-form">
        <div class="pb-10">
            <div class="label">
                Name
            </div>

            <div class="input-group">
                <div class="input-control-group">
                    <input type="text" value="<?php echo $user_name; ?>" name="" id="customer-name" onkeyup="enableButton('1')">
                </div>
            </div>
        
            <div class="label mt-25">
                Email
            </div>

            <div class="input-group">
                <div class="input-control-group">
                    <input type="text" value="<?php echo $user_email; ?>" name="" id="customer-email" onkeyup="enableButton('1')">
                </div>
            </div>
        
            <div class="label mt-25" style="display: none;">
                Location
            </div>

            <div class="input-group" style="display: none;">
                <div class="input-control-group">
                    <input type="text" value="<?php echo $user_location; ?>" name="" id="customer-location" onkeyup="enableButton('1')">
                </div>
            </div>

            <div class="label mt-25">
                Mobile no.
            </div>

            <div class="input-group">
                <?php echo $flag; ?>

                <div class="input-control-group">
                    <span>+91</span>
                    <input type="tel" minlength="10" maxlength="10" value="<?php echo $user_mobile; ?>" name="" id="mobile-number" readonly>
                </div>
            </div>
        
            <span class="mobile-desc">Mobile no. cannot be changed once set.</span>
                    
            <div class="label mt-25">
                Date of birth
            </div>

            <?php
            if ($row_select_data['date_of_birth'] != '') {
                $date_of_birth = explode('/', $row_select_data['date_of_birth']);
                $birth_date = $date_of_birth[0];
                $birth_month = $date_of_birth[1];
                $birth_year = $date_of_birth[2];
            }
            ?>

            <div class="input-group">
                <div class="input-control-group date-of-birth">
                    <select name="" id="birth-date" onchange="enableSaveChanges()">
                        <?php
                        if ($row_select_data['date_of_birth'] != '') {
                        ?>
                            <option value="<?php echo $birth_date; ?>" selected><?php echo $birth_date; ?></option>
                            <option value="" disabled>--</option>
                        <?php
                        }
                        ?>
                        <?php
                        for ($i = 1; $i < 32; $i++) {
                            echo '<option value="'.$i.'">'.$i.'</option>';
                        }
                        ?>
                    </select>

                    <select name="" id="birth-month" onchange="enableSaveChanges()">
                        <?php
                        if ($row_select_data['date_of_birth'] != '') {
                        ?>
                            <option value="<?php echo $birth_month; ?>" selected><?php echo $birth_month; ?></option>
                            <option value="" disabled>--</option>
                        <?php
                        }
                        ?>
                        <?php
                        for ($i = 1; $i < 13; $i++) {
                            echo '<option value="'.$i.'">'.$i.'</option>';
                        }
                        ?>
                    </select>

                    <select name="" id="birth-year" onchange="enableSaveChanges()">
                        <?php
                        if ($row_select_data['date_of_birth'] != '') {
                        ?>
                            <option value="<?php echo $birth_year; ?>" selected><?php echo $birth_year; ?></option>
                            <option value="" disabled>--</option>
                        <?php
                        }
                        ?>
                        <?php
                        for ($i = 2020; $i > 1919; $i--) {
                            echo '<option value="'.$i.'">'.$i.'</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="button">
                <input type="submit" value="Save Changes" id="save-button" onclick="saveChanges()" disabled>
            </div>
        </div>
    </div>
    
    <script src="../assets/js/edit-profile.js"></script>
</body>
</html>