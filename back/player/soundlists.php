<?php
include_once('../../Xquery.php');
include_once('../../config.php');
$db = new xquery($conn);
$limit = $_POST['sound_limit'];
$sublimit = $limit - 10;
$soundID = $db->Xquery("SELECT * FROM sk_sounds ORDER BY date DESC,time DESC ");
//print_r($soundID);
$soundjson = array();
$sound = array();


foreach ($soundID as $x) {
    $sound['id'] = $x['sound_id'];
    $sound['titre'] = $x['name'];
    $sound['url'] = 'media/sounds/' . $x['soundfile'];
    $sound['cover_art_url'] = 'media/sounds/coverImage/' . $x['photo'];
    // Todo: genre_unique işlenecek.
//    $sound['genre'] = $db->Xquery('SELECT name FROM sk_genres WHERE genre_id = ANY(SELECT genre_id FROM sk_genre_relationships WHERE sound_id = ?) ',$x['sound_id']);
    $sound['location'] = $db->Xquery('SELECT name FROM sk_location WHERE location_id = ANY(SELECT location_id FROM sk_location_relationships WHERE sound_id = ?) ', $x['sound_id']);;
    $name = $db->Xquery("SELECT name,f_name FROM sk_users WHERE user_id = ?", $x['author_id']);
//    print_r($name);
    $sound['author'] = $name['name'] . ' ' . $name['f_name'];

    $sound['date'] = $x['date'];
    for ($i = 7; $i > 4 ; $i--) {
        $x['time'][$i] = '';
    }
    $sound['time'] = $x['time'];
    $sound['description'] = $x['description'];

    for ($i = 0; $i < 3; $i++) {
        $x['duration'][$i] = '';
    }
    $sound['duration'] = $x['duration'];
    array_push($soundjson, $sound);
}

?>
<script>
    $(document).ready(function () {
        var playCount = 0;
        var prev_song;
        Amplitude.init({
            "songs":
            <?php echo json_encode($soundjson, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>
            ,
            "autoplay": false
            ,
            "callbacks": {
                'after_play': function () {
                    playCount++;

                    var index = Amplitude.getActiveIndex();
                    $('#'+index+'.sound-itemlist-container').addClass('playing');
                    $('#'+index+'.sound-itemlist-container').removeClass('paused');
                    $('#play-pause.player').addClass('playing');
                    $('#play-pause.player').removeClass('paused');
                    $('#play-pause.player-footer').addClass('playing');
                    $('#play-pause.player-footer').removeClass('paused');
                    $('#play-pause.playing').children().text('pause');
                    cover_draw(100,100,280,280);
                    setActivePoint(findActivePoint(),function () {
                        updateActivePosition();
                        drawArea();
                        drawActiveCircle();
                    }); //XMAP.js

                },
                'before_play':function () {
                    prev_song = Amplitude.getActiveIndex();
                },
                'after_pause': function () {
                    $('#play-pause.player').addClass('paused');
                    $('#play-pause.player').removeClass('playing');
                    $('#play-pause.player-footer').addClass('paused');
                    $('#play-pause.player-footer').removeClass('playing');
                    $('#play-pause.paused').children().text('play_arrow');
                    // alert('durdu');
                },
                'song_change':function () {
                    var index = Amplitude.getActiveIndex();
                    $('#'+index+'.sound-itemlist-container').addClass('playing');
                    $('#'+index+'.sound-itemlist-container').removeClass('paused');
                    $('#'+prev_song+'.sound-itemlist-container').addClass('paused');
                    $('#'+prev_song+'.sound-itemlist-container').removeClass('playing');
                    $('#inside.draggable-list').scrollTop(40*index);

                }
            }
        });
        var findActivePoint = function () {
            var ampIndex = Amplitude.getActiveSongMetadata();
            var id = ampIndex.id;
            for(var i =0; i<points.length;i++){
                if(points[i].titre === id){
                    return points[i];
                }
            }
        };
        var cover_draw = function (x,y,w,h) {
            var canvas = document.getElementById('cover_art_canvas');
            var ctx = canvas.getContext("2d");
            var img = document.getElementById('cover_art_img');
            canvas.height = $('#cover_art.player').innerHeight();
            canvas.width = $('#cover_art.player').innerWidth();
            ctx.drawImage(img,x,y,w,h,0,0,canvas.width,canvas.width);
        };
        cover_draw(100,100,50,50);
        //todo:data base üzerinden çekilcek x,y,w,h
    });
    // var song = Amplitude.getSongs();
    $(document).ready(function () {

        createtimelist();
        $('.sound-itemlist-container').click(function () {
           // alert($(this).get(0).id);
            Amplitude.skipTo(0,$(this).get(0).id);
        });
    });


    function createtimelist() {
        var song = Amplitude.getSongs();
        for (var i = 0; i < song.length; i++) {
            // $('#inside.draggable-list').append(JSON.stringify(song[i]));
            var titre = song[i].titre;
            var author = song[i].author;
            var cover_art = song[i].cover_art_url;
            var date = song[i].date;
            var time = song[i].time;
            var location = song[i].location;
            var dura = song[i].duration;
            // $('#inside.draggable-list').append(dura);
            // button amplitude-play-pause amplitude-paused
            var dom = "<span class ='sound-itemlist-container' id='"+i+"' amplitude-song-index='"+i+"' style='display: flex;'>" +
                "<div class ='sound-itemlist'id='cover' style='background: url(\""+cover_art+"\");background-size: cover'></div>" +
                "<div class ='sound-itemlist'id='meta'>" +
                "<div class ='sound-itemlist' id=row1>" +
                "<div class ='sound-itemlist' id=titre>" + titre + "</div><div class ='sound-itemlist' id='duration'>" + dura + "</div> " +
                "</div>" +
                "<div class ='sound-itemlist' id=row2>" +
                "<div class ='sound-itemlist' id=author>" + author + "</div><div class ='sound-itemlist' id='location'>" + location + "</div> " +
                "<div class ='sound-itemlist' id='date'>" + time + '/' + date + "</div>" +
                "</div>" +
                "</div>" +
                "</span>";
            $('#inside.draggable-list').append(dom);
        }
    }


</script>
