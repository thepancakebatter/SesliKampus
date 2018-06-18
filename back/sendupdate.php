<?php
include_once('../Xquery.php');
include_once('../config.php');
$db = new xquery($conn);

switch ($_POST['key']){
    case 'sound':
        $table = 'sk_sounds';
        $identite =  'sound_id';
//        $get = 'name,author_id,description';
        break;
    case 'tag':
        $table = 'sk_tags';
        $identite =  'tag_id';
//        $get= 'name,description';
        break;
    case 'location':
        $table = 'sk_locations';
        $identite =  'location_id';
//        $get = 'name,description';
        break;
    case 'genre':
        $table = 'sk_genres';
        $identite =  'genre_id';
//        $get = 'name,description';
        break;
}

$itemID = $_POST['id'];

$update_elem = array();

$update_elem['name'] = $_POST['name'];
$update_elem['description'] = $_POST['description'];
$tag_post = taggenerator($update_elem['description']);
$tag_postid = array();
if(isset($_POST['author_id'])){
    $update_elem['author_id'] = $_POST['author_id'];
}

if($db->Xquery("UPDATE $table  SET ? WHERE $identite = $itemID",$update_elem)){
    echo 'Güncelleme tamamlandı';
}else {
    echo 'Güncelleme başarısız';
}

foreach ($tag_post as $x){
//        if($x == '') continue;
    if($db->Xquery('SELECT name FROM sk_tags WHERE name = ?',$x)){
        array_push($tag_postid,$db->Xquery('SELECT tag_id FROM sk_tags WHERE name = ?',$x));

    }else{

        if($db->Xquery("INSERT INTO sk_tags SET `name` = '$x'",'',false,false)){
            array_push($tag_postid,$db->Xquery('SELECT tag_id FROM sk_tags WHERE name = ?',$x));
        }
    }
}
if($_POST['key'] == 'sound'){
foreach ($tag_postid as $x){
    if($db->Xquery("INSERT INTO sk_tag_relationships SET `sound_id` = $itemID ,`tag_id` = '$x'",'',false,false)){
//            echo 'başarı;';
    }
}
}

//todo:tur ve konum için yapılacak tanımlamalarda kullanılacak etiketleri saklamak için veri yapsı uygulanmalı