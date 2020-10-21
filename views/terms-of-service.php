<?php 

include_once('../config/db.php');
// include_once('../classes/login-status.php');

$page_title = 'Terms of Service';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <link rel="stylesheet" href="../assets/css/terms-of-service.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
</head>
<body>
    <div class="terms-header">
        <i class="fas fa-arrow-left" onclick="pageBack()"></i>
    </div>

    <div class="terms-title">
        <span><?php echo $page_title; ?></span>
    </div>

    <div class="terms-content">
        1. Terms<br>
        By accessing this Website, accessible from Khao Gully, you are agreeing to be bound by these Website Terms and Conditions of Use and agree that you are responsible for the agreement with any applicable local laws. If you disagree with any of these terms, you are prohibited from accessing this site. The materials contained in this Website are protected by copyright and trade mark law. These Terms of Service has been created with the help of the Terms of Service Generator and the Terms & Conditions Example.
        <br><br>
        2. Use License<br>
        Permission is granted to temporarily download one copy of the materials on Khao Gully's Website for personal, non-commercial transitory viewing only. This is the grant of a license, not a transfer of title, and under this license you may not:
        modify or copy the materials;
        use the materials for any commercial purpose or for any public display;
        attempt to reverse engineer any software contained on Khao Gully's Website;
        remove any copyright or other proprietary notations from the materials; or
        transferring the materials to another person or "mirror" the materials on any other server.
        This will let Khao Gully to terminate upon violations of any of these restrictions. Upon termination, your viewing right will also be terminated and you should destroy any downloaded materials in your possession whether it is printed or electronic format.
        <br><br>
        3. Disclaimer<br>
        All the materials on Khao Gully’s Website are provided "as is". Khao Gully makes no warranties, may it be expressed or implied, therefore negates all other warranties. Furthermore, Khao Gully does not make any representations concerning the accuracy or reliability of the use of the materials on its Website or otherwise relating to such materials or any sites linked to this Website.
        <br><br>
        4. Limitations<br>
        Khao Gully or its suppliers will not be hold accountable for any damages that will arise with the use or inability to use the materials on Khao Gully’s Website, even if Khao Gully or an authorize representative of this Website has been notified, orally or written, of the possibility of such damage. Some jurisdiction does not allow limitations on implied warranties or limitations of liability for incidental damages, these limitations may not apply to you.
        <br><br>
        5. Revisions and Errata<br>
        The materials appearing on Khao Gully’s Website may include technical, typographical, or photographic errors. Khao Gully will not promise that any of the materials in this Website are accurate, complete, or current. Khao Gully may change the materials contained on its Website at any time without notice. Khao Gully does not make any commitment to update the materials.
        <br><br>
        6. Links<br>
        Khao Gully has not reviewed all of the sites linked to its Website and is not responsible for the contents of any such linked site. The presence of any link does not imply endorsement by Khao Gully of the site. The use of any linked website is at the user’s own risk.
        <br><br>
        7. Site Terms of Use Modifications<br>
        Khao Gully may revise these Terms of Use for its Website at any time without prior notice. By using this Website, you are agreeing to be bound by the current version of these Terms and Conditions of Use.
        <br><br>
        8. Your Privacy<br>
        Please read our Privacy Policy.
        <br><br>
        9. Governing Law<br>
        Any claim related to Khao Gully's Website shall be governed by the laws of in without regards to its conflict of law provisions.
    </div>
    
    <script src="../assets/js/terms-of-service.js"></script>
</body>
</html>