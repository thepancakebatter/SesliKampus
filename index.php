<?php

session_start();

/**
 * Created by PhpStorm.
 * User: lebigmac
 * Date: 17.06.2018
 * Time: 08:49
 */
//ini_set('display_errors', 1);
//error_reporting(~0);
if (!isset($_SESSION['permission'])) {
    $_SESSION['permission'] = 0;
}
if (!isset($_SESSION['myHost'])) {
    $_SESSION['myHost'] = $_SERVER['REQUEST_SCHEME'] . '://';
    $_SESSION['myHost'] .= $_SERVER['HTTP_HOST'];
    $_SESSION['myHost'] .= $_SERVER['REQUEST_URI'];
}
if (file_exists('config.php')) {
    include_once('config.php');
    $loadsite = true;
} else {
    include_once('setup.php');
    $loadsite = false;
}
if ($loadsite) {
    echo '<html>';
    include_once('head.php');
//    if ($_SESSION['permission'] == 10) {
//        include_once('admin-seslikampus/index.php');
//    }
    include_once('front/header.php');



    include_once('front/leftmenu.php');
//    include_once('front/search.php');
    include_once('front/player_main.php');

    include_once('front/map.php');
    include_once('front/player_footer.php');

}
?>
<script>
    $(document).ready(function () {
        // $.get('front/player.php',function (data) {
        //     $('#main').html(data);
        // });
        var player_limit = {
            sound_limit: 10
        };
        $.post('back/player/soundlists.php', player_limit, function (data) {
            // alert(data);
            $('#soundlist').html(data);
        });
    });
</script>
<script src="javascripts/amplitudejs-3.3.0/dist/amplitude.js"></script>


<!--<script src="jquery.ui.touch-punch.min.js"></script>-->
<div id="soundlist"></div>
<script>
    var pagelifo = new Array();
    pagelifo = ["container.map"];
    $('.pages-slider').click(function () {
        // alert(pagelifo);
        if ($(this).hasClass('open')) {
            var port = $(this).attr('data-port');
            pagelifo.push(port);
            $('#' + port).addClass('opened');
            $('#' + port).slideDown(500);
            for (var i = 0; i < $('.pages-slider').length; i++) {
                var a = $('.pages-slider').get(i).id;
                if ($('#' + a + '.pages-slider').hasClass('open')) {
                    var prt = $('#' + a + '.pages-slider').attr('data-port');
                    if (prt !== port) {
                        $('#' + prt).slideUp(500);
                        $('#' + prt).removeClass('opened');
                    }
                }
            }
        } else {
            pagelifo.pop();
            var last = pagelifo.length;
            $('#' + pagelifo[last - 1]).slideDown(500);
            $('#' + pagelifo[last - 1]).addClass('opened');
            for (var i = 0; i < $('.pages-slider').length; i++) {
                var a = $('.pages-slider').get(i).id;
                if ($('#' + a + '.pages-slider').hasClass('open')) {
                    var prt = $('#' + a + '.pages-slider').attr('data-port');
                    if (prt !== pagelifo[last - 1]) {
                        $('#' + prt).slideUp(500);
                        $('#' + prt).removeClass('opened');
                    }
                }
            }

        }
        var fh = $('#footer-out.player-footer').innerHeight();
        if($('#main.player').hasClass('opened')){
            $('#footer-out.player-footer').slideUp(500);
            $('#sound-add-button').css('bottom',20+'px');
        }else{
            $('#footer-out.player-footer').slideDown(500);
            $('#sound-add-button').css('bottom',(fh+20)+'px');
        }
    });
    // $('#sound-info.player-footer').click(function () {
    //     $('#footer-out.player-footer').slideUp(500);
    //     $('#container.map').slideUp(500);
    //     $('#toggle.draggable-list').slideUp(500);
    //     $('#container.search').slideUp(500);
    //     $('#main.player').slideDown(500);
    // });
    // $('#header.player').click(function () {
    //     $('#footer-out.player-footer').slideDown(500);
    //     $('#container.map').slideDown(500);
    //     $('#toggle.draggable-list').slideDown(500);
    //     $('#main.player').slideUp(500);
    // });
    //
    // $('#search-icon.header').click(function () {
    //    $('#container.search').slideDown(500);
    //     $('#container.map').slideUp(500);
    //     $('#toggle.draggable-list').slideUp(500);
    //     $('#footer-out.player-footer').slideDown(500);
    // });
    // $('#close.search').click(function () {
    //     if($('#main.player').css('display') !== 'none'){
    //         $('#footer-out.player-footer').slideUp(500);
    //     }
    //     $('#container.search').slideUp(500);
    //     $('#container.map').slideDown(500);
    //     $('#toggle.draggable-list').slideDown(500);
    // });



</script>
</html>