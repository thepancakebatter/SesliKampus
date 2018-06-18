<?php
include_once('../Xquery.php');
include_once('../config.php');
$db = new xquery($conn);
if($db->Xquery('INSERT INTO sk_location SET ?',$_POST)) echo 'Kayıt Tamamlandı';