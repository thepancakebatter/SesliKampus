<?php
session_start();
include_once('../Xquery.php');
include_once('../config.php');
$db = new xquery($conn);
if (isset($_SESSION['user'])) {
    $isliked = 'SELECT sound_id FROM sk_likes WHERE user_id = "' . $_SESSION['user']['user_id'] . '" AND sound_id ="' . $_POST['sound_id'] . '"';
    $delete = 'DELETE FROM sk_likes WHERE user_id = "' . $_SESSION['user']['user_id'] . '" AND sound_id ="' . $_POST['sound_id'] . '"';
    $insert = 'INSERT INTO sk_likes SET `user_id` =' . $_SESSION['user']['user_id'] . ' ,`sound_id` =' . $_POST['sound_id'];
    if ($db->Xquery($isliked, '', false, false)) {
        //varsa
        if ($_POST['click']=='true') {
            if ($db->Xquery($delete, '', false, false)) {
                echo 'removed';
            }
        }else{
            echo 'true';
        }
    } else {
        //yoksa
        if ($_POST['click'] == 'true') {
            if ($db->Xquery($insert, '', false, false) && $_POST['click']) {
                echo 'added';
            }
        }else {
            echo 'false';
        }
    }
}