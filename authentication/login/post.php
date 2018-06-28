<?php
session_start();
/**
 * Created by PhpStorm.
 * User: lebigmac
 * Date: 28.06.2018
 * Time: 08:38
 */
include_once('../../head.php');
include_once('../../front/header.php');
?>

    <script>
        $(document).ready(function ($) {
            $('#container.result').css('margin-top', $('#container.header').css('height'));
        });
    </script>
    <style>
        #toggle.draggable-list {
            display: none;
        }

        #profil-icon.header {
            display: none;
        }

    </style>
    <div class="result" id="container">
<?php

include_once('../../Xquery.php');
include_once('../../config.php');
$db = new xquery($conn);
$result = false;
if ($db->Xquery('SELECT email FROM sk_users WHERE email = ?', $_POST['email'])) {

    if (password_verify($_POST['password'], $db->Xquery('SELECT password FROM sk_users WHERE email = ?', $_POST['email']))) {
        $result = true;
        $_SESSION['permission'] = $db->Xquery('SELECT permission FROM sk_users WHERE email = ?', $_POST['email']);
        $_SESSION['user'] = $db->Xquery('SELECT permission,email,name,f_name,profil_icon FROM sk_users WHERE email = ?', $_POST['email']);
//            print_r($_SESSION['user']);
    } else $result = false;

} else $result = false;



?>
        <?php if ($result): ?>
            <div>
                Sesli Kampüse Hoşgeldin<br>
                <a href="../../index.php">ana sayfa</a>

            </div>

        <?php else:?>
            <div>
                Şifren yada E-postan hatalı, lütfen tekrar dene <br>
                <a href="index.php">Giriş Yap</a>
            </div>

        <?php endif;?>
    </div>
