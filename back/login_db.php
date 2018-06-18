<?php
session_start();
include_once('../Xquery.php');
include_once('../config.php');
$db = new xquery($conn);

if ($db->Xquery('SELECT email FROM sk_users WHERE email = ?', $_POST['userid'])) {

    if (password_verify($_POST['password'], $db->Xquery('SELECT password FROM sk_users WHERE email = ?', $_POST['userid']))) {
        echo 'true';
        $_SESSION['permission'] = $db->Xquery('SELECT permission FROM sk_users WHERE email = ?', $_POST['userid']);
        $_SESSION['user'] = $db->Xquery('SELECT permission,email,name,f_name,profil_icon FROM sk_users WHERE email = ?', $_POST['userid']);
//            print_r($_SESSION['user']);
    } else echo 'false';

} else echo 'Kullanıcı adı yada E-posta bulunamadı';