<?php
//harita tam  anlamıyla ütn konumları karşılamadığı için eldeki alt konumları göstermek içien geçici bir alt script
include_once('Xquery.php');
$db = new xquery($conn);
//$myLocID = array(0,18,19,20,21,22,23,24,25,26,27,29,30,31,32,62,66,67,69,71);
function findParent($Id,$con){
    $db = new xquery($con);
    $loc_obj = $db->Xquery('SELECT * FROM sk_location WHERE location_id = ?',$Id);
//    print_r($loc_obj);
}

?>
<img class="Xmap" id="main-image" src="media/Map.jpg" style="display: none;">
<div class="Xmap" id="container" >

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
        var obj = [{
            "title": "a",
            x: 600,
            y: 300,
            r: 34,
            items: {
                count: 4,
                id: [45,5,6,4]
            }
            ,
            color: "red"

        }];
    var Xmap_width = window.innerWidth;
    var Xmap_height = window.innerHeight - $('#container.header').innerHeight() - $('#footer-out.player-footer').innerHeight();
    setupXmap('main-image',Xmap_width, Xmap_height, function () {
        //css declaration..
        $('body').css('overscroll-behavior-y','contain');
        $('#container.Xmap').css('margin-top',$('#container.header').css('height'));
        $('#Zoom.Xmap').css('margin-bottom',($('#footer-out.player-footer').innerHeight()+10)+'px');
        $('#Zoom.Xmap').css('margin-left',(window.innerWidth - $('#Zoom.Xmap').innerWidth())/2+'px');
        $('img.Xmap').load(function () {
        init( obj, function () {
            fulldrawMap();
            if (config.mobile) {
                rePositionMobile();
            } else {
                rePosition();
                ZoomMap();
            }
            config.clickCallback = function (a) {
                // alert('a');
            }
        });
        });
    });
    });
</script>