<?php
session_start();
include_once('../Xquery.php');
include_once('../config.php');
$db = new xquery($conn);
// 4.1.0'dan önceki PHP sürümlerinde, $_FILES yerine
// $HTTP_POST_FILES kullanılmalıdır.
//TODO: yüklenecek serverin php.ini ve dosya izinleri verilmeli
//TODO: görüntü dosyaları için kırpıcı, çerçeve eklenecek
//todo: sesdosyaları içinconverter buluna bilir

$error = array(
    "1" => "Ses Kayıt Hatası",
    "2" => "Konum-Ses eşleşme Hatası",
    "3" => "Etiket-Ses eşleşme Hatası",
    "4" => "Etiket Oluşturma Hatası",
    "5" => "Dosya Yükleme Hatası",
    "6" => "Fotoğraf Yükleme Hatası"
);
$success = true;
print_r($_POST);
$dizinSound = SK_PATH . '/media/tmp/';
$dizinImage = SK_PATH . '/media/sounds/coverImage/';
$soundtype = $_FILES['soundfile']['type'];
$imagetype = $_FILES['coverimage']['type'];
$type_s = '.amr';
$type_i = '.';

//for ($i = strpos($soundtype, '/') + 1; $i < strlen($soundtype); $i++) {
//    $type_s .= $soundtype[$i];
//}
for ($i = strpos($imagetype, '/') + 1; $i < strlen($imagetype); $i++) {
    $type_i .= $imagetype[$i];
}
$unique_s_tmp = uniqid();

$_SESSION['sound_id'] = $unique_s_tmp;
$unique_s = $unique_s_tmp.$type_s;

$unique_i = uniqid() . $type_i;
//echo $_FILES['soundfile']['name'];
$sound = $dizinSound . $unique_s;
//$yuklenecek_dosya2 = $dizinImage . basename($_FILES['coverimage']['name']);
$coverimage = $dizinImage . $unique_i;
$proces = true;
echo '<pre>';

if (move_uploaded_file($_FILES['soundfile']['tmp_name'], $sound)) {
    //    echo "Ses dosyası geçerli ve başarıyla yüklendi.\n";
    $upload_sound = true;
} else {
    //    echo "Olası dosya yükleme saldırısı!\n";
    ErrorPost(5, $error);
    $proces = false;
    $success = false;

}

//if (move_uploaded_file($_FILES['coverimage']['tmp_name'], $coverimage)&&$success) {
//    //    echo "Albüm kapağı geçerli ve başarıyla yüklendi.\n";
//    $imagesettings = array("x" => $_POST["x"],"y" => $_POST["y"],"width" => $_POST["width"],"height" => $_POST["height"],
//        "photo_id"=>$unique_i);
//    if($db -> Xquery("INSERT INTO sk_photosoptions SET ? ",$imagesettings,false,false)){
//
//    }else{ErrorPost(6,$error);
//
//    }
//
//} else {
//    //    echo "Olası dosya yükleme saldırısı!\n";
////    ErrorPost(6, $error);
//
//}
//echo 'Diğer hata ayıklama bilgileri:';
//print_r($_FILES);
$unique_i = 'default-' . $_POST['genre_id'] . '.png'; //todo:fotograf ekleme özelliği2.faz
print "</pre>";
$type_s ='.mp3';
$unique_s = $unique_s_tmp.$type_s;
if ($proces) {
    $sound_post = array(
        'name' => $_POST['title'],
        'author_id' => $_POST['author'],
        'description' => $_POST['description'],//tarih zman oto giricek
        'duration' => $_POST['duration'], //süre bilgisi databasede dakika bilgisine çevrilir
        'soundfile' => $unique_s,
        'genre_id' => $_POST['genre_id'],
        'photo' => $unique_i
    );

    if ($db->Xquery('INSERT INTO sk_sounds SET `date`=NOW(),`time`=NOW(),  ?', $sound_post, false, true)) {
        $sound_id = $db->Xquery('SELECT sound_id FROM sk_sounds WHERE soundfile = ?', $sound_post['soundfile']);
        //        echo 'sound_id:' . $sound_id;
    } else {
        //        echo 'Sound TAble insertation error!!';
        //todo:keseme işaretleri insertation error yaratıyor
        //todo:etiketlerden sonraki tırnağı alma
        $sound_id = null;
        ErrorPost(3, $error);
        $success = false;
    }
    /*
     * Kayıtlı etiketler ile etiket id listesi oluşturur
     * kayıtlı olmayan etiketleri kayddeder.
     * */
    $tag_postid = array();
    $tag_post = taggenerator($_POST['description']);
    //    print_r($tag_post);
    foreach ($tag_post as $x) {
        //        if($x == '') continue;
        if ($db->Xquery('SELECT name FROM sk_tags WHERE name = ?', $x)) {
            array_push($tag_postid, $db->Xquery('SELECT tag_id FROM sk_tags WHERE name = ?', $x));

        } else {

            if ($db->Xquery("INSERT INTO sk_tags SET `name` = '$x'", '', false, false)) {
                array_push($tag_postid, $db->Xquery('SELECT tag_id FROM sk_tags WHERE name = ?', $x));
            } else {
                ErrorPost(4, $error);
                $success = false;
            }
        }
    }
    foreach ($tag_postid as $x) {
        if ($db->Xquery("INSERT INTO sk_tag_relationships SET `sound_id` = '$sound_id',`tag_id` = '$x'", '', false, false)) {
            //            echo 'başarı;';
        } else {
            ErrorPost(3, $error);
            $success = false;
        }
    }
    //    print_r($tag_postid);
    //    genre unique olduğundan kapandı;
    //    $genre_post = genregenerator($_POST['genre']);
    //    foreach ($genre_post as $x){
    //        if($db->Xquery("INSERT INTO sk_genre_relationships SET `sound_id` = '$sound_id',`genre_id` = '$x'",'',false,false)){
    ////            echo 'başarı;';
    //        }
    //    }
    $location_post = $_POST['location'];
    if ($db->Xquery("INSERT INTO sk_location_relationships SET `sound_id` = '$sound_id',`location_id` = '$location_post'", '', false, false)) {
        //            echo 'başarı;';
    } else {
        ErrorPost(2, $error);
        $success = false;
    }
}
if ($success) {

    echo "Kayıt Tamamlandı";
    echo "<script>
window.location = 'convert.php';
</script>";
} else {
    if ($upload_sound) {
        unlink($sound);
    }
}
?>
