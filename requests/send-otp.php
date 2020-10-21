<?php

include_once('../config/db.php');

if ((isset($_POST['mobile'])) && ($_POST['mobile'] != '')) {
    $otp = rand('100000', '999999');

    $sql_insert_otp = 'INSERT INTO otp (mobile, otp) VALUES ("'.$_POST['mobile'].'", "'.$otp.'")';
    $result_insert_otp = $conn->query($sql_insert_otp);
    
    if ($result_insert_otp) {
        $post = [
            'authkey'   => '', // key
            'mobiles'   => $_POST['mobile'],
            'message'   => ''.$otp.' is your Khao Gully verification code. Enjoy :-)',
            'sender'    => 'KHGULY',
            'route'     => '1',
            'country'   => '+91'
        ];

        $ch = curl_init('http://mysms.insightinfosystem.com/api/sendhttp.php');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        $response = curl_exec($ch);
        curl_close($ch);
    }
}

?>