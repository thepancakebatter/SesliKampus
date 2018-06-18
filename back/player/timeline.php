<?php
include_once('../../Xquery.php');
include_once('../../config.php');
$db = new xquery($conn);
$limit = $_POST['sound_limit'];
$sublimit = $limit-10;
$soundID = $db->Xquery("SELECT * FROM sk_sounds ORDER BY date DESC,time DESC LIMIT $sublimit,$limit");
//print_r($soundID)
$y = $sublimit;
foreach ($soundID as $x){
    echo "<div class=\"song amplitude-song-container amplitude-play-pause\" amplitude-song-index=\"$y\">";
    echo "<div class='sound-timeline' id='".$x['sound_id']."'>";
    echo $x['name'].'<br>';
    echo $x['description'].'<br>';
    echo $x['duration'].'<br>';
    echo $x['date'].'<br>';
    echo $x['time'].'<br>';
    $loc = $db->Xquery('SELECT name FROM sk_location WHERE location_id = ANY(SELECT location_id FROM sk_location_relationships WHERE sound_id = ?) ',$x['sound_id']);
    echo $loc.'<br>';
    echo "</div></div>";
    $y++;
}
?>

<div id="more-sound"></div>

