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
$result;
$cas=array("1"=>"Geçersiz E-posta","2" =>"Hatalı Kayıt, Daha Sonra Tekrar Deneyin");
$cas_no;
$_POST['password'] = password_hash($_POST['password'],PASSWORD_DEFAULT);
$trig =1;
//print_r($_POST);
if($db->Xquery('SELECT email FROM sk_users WHERE email = ?',$_POST['email'],true,false)){
    echo 'Geçersiz e-posta';
    $result = false;
    $cas_no = 1;
    $trig = 0;
}

//        else if ($db->Xquery('SELECT username FROM sk_users WHERE username = ?',$_POST['username'])){
//        echo 'Geçersiz kullanıcı adı';
//            $trig =0;
//        }

else {
    if ($trig && $db->Xquery('INSERT INTO sk_users SET `inscription_date` = NOW(), ?;', $_POST,false,false)) {
        echo 'Kayıt başarılı';
        $result= true;
    } else {
        $result=false;
        $cas_no = 2;
        echo 'Kayıt tamamlanamadı';
    }
}
?>
</div>

<?php if ($result): ?>
<div>
    Başarılı
    <a href="../../index.php">ana sayfa</a>
    <a href="../login/index.php">Giriş Yap</a>
</div>

<?php else:?>
    <div>
        Başarısız
        <a href="index.php">Kayıt Ekranı</a>
        <?php echo $cas[$cas_no]; ?>
    </div>

<?php endif;?>
