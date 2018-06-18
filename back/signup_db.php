<?php

include_once('../Xquery.php');
include_once('../config.php');
$db = new xquery($conn);
        $_POST['password'] = password_hash($_POST['password'],PASSWORD_DEFAULT);
        $trig =1;
        if($db->Xquery('SELECT email FROM sk_users WHERE email = ?',$_POST['email'])){
            echo 'Geçersiz e-posta';
            $trig = 0;
        }
//        else if ($db->Xquery('SELECT username FROM sk_users WHERE username = ?',$_POST['username'])){
//        echo 'Geçersiz kullanıcı adı';
//            $trig =0;
//        }

            else {
                if ($trig && $db->Xquery('INSERT INTO sesli_kampus.sk_users SET `inscription_date` = NOW(), ?;', $_POST)) {
                    echo 'Kayıt başarılı';
                } else echo 'Kayıt tamamlanamadı';
            }


