<?php
/*listeleme işlemleri bu sayfada yapılır
    silme ve editleme sciptlerini içerir
    scriptler tabloların idlerini parametre alır.
    TODO düzenleme scriptleri yazılacak - ses için listeleme kodu eklenecek
    todo: sıralama scriptleri eklenmeli
*/
include_once('../Xquery.php');
include_once('../config.php');
$db = new xquery($conn);

$orderspan = "<span class='.list-order'><i class=\"material-icons\">swap_vertical_circle</i></span>";
switch ($_GET['key']) {
    case 'genres':
        $genres = $db->Xquery('SELECT name,description,genre_id,color FROM sk_genres ORDER BY `sk_genres`.`name` ASC ', '', true);
//        print_r($genres);
        echo '<table class="list-table" id="genres">';
        echo "<tr><th>Tür</th><th>Açıklama</th><th>Renk Kodu</th><th>İşlem</th></tr>";
        foreach ($genres as $x) {
            echo '<tr>';
            echo '<td>' . $x['name'] . '</td>';
            echo '<td>' . $x['description'] . '</td>';
            echo '<td>' . $x['color'] . '</td>';
            echo '<td>';
            addspan('edit', $x['genre_id'],'genre');
            addspan('remove', $x['genre_id'],'genre');
            echo '</td>';
            echo '</tr>';
        }
        echo '</table>';
        break;
    case 'tags':
        $tags = $db->Xquery('SELECT name,description,tag_id FROM sk_tags ORDER BY `sk_tags`.`name` ASC', '', true);
        echo '<table class="list-table" id="tags">';
        echo '<tr><th>Etiket</th><th>Açıklama</th><th>İşlem</th></tr>';
        foreach ($tags as $x) {
            echo '<tr>';
            echo '<td>' . $x['name'] . '</td>';
            echo '<td>' . $x['description'] . '</td>';
            echo '<td>';
            addspan('edit', $x['tag_id'],'tag');
            addspan('remove', $x['tag_id'],'tag');
            echo '</td>';
            echo '</tr>';
        }
        echo '</table>';
        break;
        //TODO: location listesi için üst kategorileri listeleryen bir hiyerarşi oluşturulacak
    case 'locations' :
        $locations = $db->Xquery('SELECT name,description,location_id,parent_id FROM sk_location', '', true);
//        print_r($locations);
        for ($i = 0; $i < count($locations); $i++) {
            $uplocation[$locations[$i]['location_id']] = $locations[$i]['name'];
        }
//        print_r($uplocation);
        echo '<table class="list-table" id="tags">';
        echo '<tr><th>Konum</th><th>Açıklama</th><th>Üst Konum</th><th>İşlem</th></tr>';
        foreach ($locations as $x) {
            echo '<tr>';
            echo '<td>' . $x['name'] . '</td>';
            echo '<td>' . $x['description'] . '</td>';
            echo '<td>' . $uplocation[$x['parent_id']] . '</td>';
            echo '<td>';
            addspan('edit', $x['location_id'],'location');
            addspan('remove', $x['location_id'],'location');
            echo '</td>';
            echo '</tr>';
        }
        echo '</table>';
        break;
    case 'sounds' :
        $sounds = $db->Xquery('SELECT sound_id,name,author_id,description,soundfile,photo,time,date,duration FROM sk_sounds', '', true);
        $locationquery = 'SELECT name FROM sk_location WHERE location_id = ANY(SELECT location_id FROM sk_location_relationships WHERE sound_id = ?)';
        $genrequery = 'SELECT name FROM sk_genres WHERE genre_id = ANY
(SELECT genre_id FROM sk_genre_relationships WHERE sound_id = ?)';

        echo '<table class="list-table" id="tags" style="width: 100%;">';
        echo '<tr><th>Başlık</th><th>Yaratıcı</th><th>Açıklama</th><th>Sesdosyası</th>
            <th>Kapak</th><th>Saat</th><th>Tarih</th>
            <th>Süre</th><th>Tür</th><th>Konum</th><th>İşlem</th></tr>';
        $sounds = array_reverse($sounds); //last in first out
        foreach ($sounds as $x) {
            $genre_list = $db->Xquery($genrequery,$x['sound_id']);
//            print_r($genre_list);

            echo '<tr>';
            echo '<td>' . $x['name'] . '</td>';
            echo '<td>' . $db->Xquery('SELECT username FROM sk_users WHERE user_id = ?',$x['author_id']). '</td>';
            echo '<td>' . $x['description'] . '</td>';
            echo '<td>' . $x['soundfile'] . '</td>';
            echo '<td>' . $x['photo'] . '</td>';
            echo '<td>' . $x['time'] . '</td>';
            echo '<td>' . $x['date'] . '</td>';
            echo '<td>' . $x['duration'] . '</td>';
            echo '<td>';
//            foreach ($genre_list as $y){
//                echo $y['name'].'<br>';
//            }
            echo '</td>';
            echo '<td>' . $db->Xquery($locationquery,$x['sound_id']) . '</td>';
            echo '<td>';
            addspan('edit', $x['sound_id'],'sound');
            addspan('remove', $x['sound_id'],'sound');
            echo '</td>';
            echo '</tr>';

        }
        echo '</table>';
        break;
}


?>

<script>
    $(document).ready(function () {
        $('.edit').click(function () {
            var clickUpid = $(this).parent().get(0).id;
            // $('#'+clickUpid+'.edit-selected').text(clickUpid);
            var post = {
                table:''+clickUpid,
                itemId: ''+this.id
            }
            $.post('back/edittableselected.php',post,function (data) {
                $('#'+clickUpid+'.edit-selected-outside').slideDown(500);
                $('#'+clickUpid+'.edit-selected').html(data);
                $('#'+clickUpid+'.edit-selected').slideDown(500);
            });
        });

    });

</script>
