<?php
include_once('../Xquery.php');
include_once('../config.php');
$db = new xquery($conn);

switch ($_GET['key']){
    case 'autor':
        $listeddata = $db->Xquery('SELECT name,user_id FROM sk_users','',true);
        echo '<select class="form" id="'.$_GET['key'].'" name="'.$_GET['key'].'">';
        echo '<option value="null">..</option> ';
        foreach ($listeddata as $x){
            echo "<option value=".$x['user_id'].">";
            echo $x['name'];
            echo '</option>';
        }

        echo '</select>';
        break;
    case 'genre':
        $listeddata = $db->Xquery('SELECT name,genre_id FROM sk_genres','',true);
//        echo '<select class="form" id="'.$_GET['key'].'" name="'.$_GET['key'].'">';
//        echo '<option value="null">..</option> ';
        echo '<div style="display: flex;">';
        foreach ($listeddata as $x){
            echo "<div style='display:flex;'><input type=\"radio\" class='genre-box' name='genre_id' value=".$x['genre_id']." id=".$x['genre_id'].">";
            echo $x['name'];
            echo '</div>';
        }

        echo '</div>';

        break;

}

