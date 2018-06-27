<?php session_start(); ?>
<?php
/**
 * Created by PhpStorm.
 * User: lebigmac
 * Date: 17.06.2018
 * Time: 17:50
 */
include_once ('../head.php');
include_once ('../Xquery.php');
include_once ('../config.php');
$db = new xquery($conn);

if($db->Xquery('SELECT * FROM sk_users WHERE permission =11')){
   //herhangi admin yok ise setup çalışır 2.faz
    include_once ('setup.php');
}
else{
    //controlpanel 2.fazda kurulacak
//    include_once ('control-panel.php');
}