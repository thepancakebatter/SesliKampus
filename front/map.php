<?php
//harita tam  anlamıyla ütn konumları karşılamadığı için eldeki alt konumları göstermek içien geçici bir alt script
include_once('Xquery.php');
$db = new xquery($conn);
$myLocID = array("0","18","19","20","21","22","23","24","25","26","27","29","30","31","32","62","66","67","69","71");
function findParent($Id,$con){
    $db = new xquery($con);
    $loc_obj = $db->Xquery('SELECT positionX,parent_id FROM sk_location WHERE location_id = ?',$Id,false,false);
    if($loc_obj['positionX'] == 0){
        return findParent($loc_obj['parent_id'],$con);
    }else{
        return $Id;
    }
}
$Mapobject = array();
$obj;
foreach ($myLocID as $x){
    $Loc =  $db ->Xquery('SELECT name,positionX,positionY,radius,color FROM sk_location WHERE location_id = ?',$x);
    $obj['title'] = $Loc['name'];
    $obj['x'] = $Loc['positionX'];
    $obj['y'] = $Loc['positionY'];
    $obj['r'] = $Loc['radius'];
    $obj['color'] = $Loc['color'];
    $obj['items'] = array('count'=>0,'ids' => array());
    $Mapobject[$x] = $obj;
 }
$sounds = $db->Xquery('SELECT sound_id,location_id FROM sk_location_relationships','',true,false);
//print_r($sounds);
foreach ($sounds as $x){
    $color = $db->Xquery('SELECT color FROM sk_genres WHERE genre_id = ANY(SELECT genre_id FROM sk_sounds WHERE sound_id = ?)',$x['sound_id']);
//    echo 'aa'.$x['location_id'].'<br>';
    $parent = findParent($x['location_id'],$conn);
    $point = array('id'=>$x['sound_id'],'color'=>$color);
    array_push($Mapobject[$parent]['items']['ids'],$point);
    $Mapobject[findParent($x['location_id'],$conn)]['items']['count']++;
}
$jsonobj = array();
foreach ($myLocID as $x){
    array_push($jsonobj,$Mapobject[$x]);
}

?>
<img class="Xmap" id="main-image" src="media/Map.jpg" style="display: none;">
<div class="Xmap" id="container" >
<?php   include_once ('addbutton.php'); ?>
    <input id="Zoom" type="range" class="Xmap" data-role="none"  style="opacity: 0" min="1" max="2" step="0.02" value="1">
    <canvas id="Map" class="XMap" style="border: 1px solid olivedrab"></canvas>
</div>

<style>
    #container.map {
        overflow: hidden;
    }

    #main-map.map {
        position: relative;
        z-index: 50;
        /*transition: 0.1s;*/
        transform-origin: center;
    }
    #Zoom{
        position: absolute;
        z-index: 100;
        width: 80%;
        margin: auto;
        bottom: 10px;

    }

</style>
<script>
    $('#main-image.Xmap').ready(function () {
        var obj = <?php echo json_encode($jsonobj, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>;
    var Xmap_width = window.innerWidth;
    var Xmap_height = window.innerHeight - $('#container.header').innerHeight() - $('#footer-out.player-footer').innerHeight();
        if (/Android/i.test(navigator.userAgent)) {
            Xmap_height = window.innerHeight - $('#container.header').innerHeight();

        }else{
            Xmap_height = window.innerHeight - $('#container.header').innerHeight() - $('#footer-out.player-footer').innerHeight();

        }

    setupXmap('main-image',Xmap_width, Xmap_height, function () {
        //css declaration..
        $('body').css('overscroll-behavior-y','contain');
        $('#container.Xmap').css('margin-top',$('#container.header').css('height'));
        $('#Zoom.Xmap').css('margin-bottom',($('#footer-out.player-footer').innerHeight()+10)+'px');
        $('#Zoom.Xmap').css('margin-left',(window.innerWidth - $('#Zoom.Xmap').innerWidth())/2+'px');
        $('img.Xmap').load(function () {
        init( obj, function () {
            setActivePoint(points[0],function () {

            });
            fulldrawMap();
            if (config.mobile) {
                rePositionMobile();
            } else {
                rePosition();
                ZoomMap();
            }
            config.clickCallback = function (a) {
                // alert(a.titre);
                var index = findIndexAMP(a.titre);
                // Amplitude.playSongAtIndex(index);
                Amplitude.playSongAtIndex(index);
                // setActivePoint(a,function () {
                //    drawActiveCircle();
                // });

            }
        });
        });
    });
    var findIndexAMP = function (a) {
      var sounds = Amplitude.getSongs();
      for(var i = 0; i<sounds.length ; i++){
          if(a === sounds[i].id){
              // alert(i);
              // alert(JSON.stringify(sounds));
              return i;
          }
      }
    };
    });
</script>