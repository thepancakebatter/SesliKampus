<img class="map" id="main-image" src="media/map.jpg" style="display: none;">
<div class="map" id="container">
    <canvas id="main-map" class="map" width="960" height="600" style="border: 1px solid olivedrab"
            ontouchmove="myFunction(event)"></canvas>
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
</style>
<script>
    $(document).ready(function () {
        var canvas = document.getElementById('main-map');
        var ctx = canvas.getContext("2d");
        var img = document.getElementById('main-image');
        ctx.drawImage(img, 0, 0);
    });

    function draw(x, y) {
        var canvas = document.getElementById('main-map');
        var ctx = canvas.getContext("2d");
        var img = document.getElementById('main-image');
        ctx.fillStyle = "#fffb0d";
        ctx.fillRect(x, y, 10, 10);
    }

    $(document).ready(function () {
        var imgH = 600;
        var imgW = 960;
        var height = window.innerHeight;
        var width = window.innerWidth;
        var y = height - $('#container.header').innerHeight() - $('#footer-out.player-footer').innerHeight();
        // var y  = 60
        $('#container.map').css('margin-top', $('#container.header').css('height'));
        $('#container.map').css('margin-bottom', $('#footer-out.player-footer').css('height'));
        $('#container.map').css('height', y + 'px');
        $('body').css('height', height + 'px');
        $('#container.map').css('width', width + 'px');
        /// /center point
        $('#main-map.map').css('top', '-' + imgH / 4 + 'px');
        $('#main-map.map').css('left', '-' + imgW / 4 + 'px');
    });


    $(document).ready(function () {
        $("#main-map.map").draggable();

        // $('#main-map.map').mouseup(function () {
        //     var imgH = $('#main-map.map').innerHeight();
        //     var imgW = $('#main-map.map').innerWidth();
        //     var top = $('#main-map.map').offset().top;
        //     var left = $('#main-map.map').offset().left;
        //     var top_h = $('#container.header').innerHeight();
        //     var bottom_h = $('#footer-out.player-footer').innerHeight();
        //     var width = window.innerWidth;
        //     var height = window.innerHeight;
        //     var map_h = height - bottom_h - top_h;
        //     if (top >= top_h) {
        //         $('#main-map.map').css('top', '0px');
        //     }
        //     if (left >= 0) {
        //         $('#main-map.map').css('left', '0px');
        //     }
        //     if (left <= width - imgW) {
        //         $('#main-map.map').css('left', width - imgW + 'px');
        //     }
        //     if (top <= map_h + top_h - imgH) {
        //         $('#main-map.map').css('top', map_h - imgH + 'px');
        //     }
        //     // $('#mid.header').text(top);
        // });


    });

    document.getElementById("main-map").addEventListener("touchmove", zoom);
    var dis;
    var ratio = 1;
    var midpo = true;
    var midpoint = {"x": null, "y": null};
    document.getElementById('main-map').addEventListener("touchend", function (ev) {
        window.midpo = true;
    });

    function zoom(ev) {
        if (ev.targetTouches.length == 1) {
            return;
        }
        var img = {
            width: $('#main-map.map').innerWidth(),
            height: $('#main-map.map').innerHeight(),
            top: $('#main-map.map').offset().top,
            left: $('#main-map.map').offset().left
        };

        var tmp = window.dis;
        var t1 = {"x": null, "y": null};
        var t2 = {"x": null, "y": null};


        if (ev.targetTouches.length >= 2) {
            t1.x = ev.targetTouches.item(0).clientX - img.left;
            t1.y = ev.targetTouches.item(0).clientY - img.top;
            t2.x = ev.targetTouches.item(1).clientX - img.left;
            t2.y = ev.targetTouches.item(1).clientY - img.top;
        }

        var sum = Math.pow(t1.x - t2.x, 2) + Math.pow(t1.y - t2.y, 2);
        window.dis = Math.sqrt(sum);
        if (window.midpo) {
            window.midpoint.x = (t1.x + t2.x) / 2;// - img.left;
            window.midpoint.y = (t1.y + t2.y) / 2;//- img.top;
            window.midpo = false;
        }
        //todo:merkez noktaya zoomlamıyor
        // var ratio = img.width / img.height;

        // $('#mid.header').text('x:' + midpoint.x + ' y:' + midpoint.y);
        $('#mid.header').text(window.dis);
        draw(midpoint.x, midpoint.y);
        if (Math.abs(window.dis - tmp) > 5 && window.dis !== 0) {
            // if (window.dis > tmp) {
            // if (img.height / window.innerHeight <= 2) { //max büyüme oranı
            // $('#main-map.map').css('height', (img.height + a) + 'px');
            // $('#main-map.map').css('width', (img.width + a * ratio) + 'px');
            // $('#main-map.map').css('top', (img.top) + 'px');
            // $('#main-map.map').css('left', (img.left) + 'px');
            $('#main-map.map').css('transform', 'scale(' + (window.dis / 200) + ')');
            $('#main-map.map').css('transform-origin', midpoint.x + 'px ' + midpoint.y + 'px');
            // }
            // }
            //
            // if (window.dis < tmp) {
            //     // if ($('#main-map.map').innerHeight() >= window.innerHeight + $('#container.header').innerHeight()) { //max  küçülme oranı
            //     // $('#main-map.map').css('height', (img.height - a) + 'px');
            //     // $('#main-map.map').css('width', (img.width - a * ratio) + 'px');
            //     // $('#main-map.map').css('transform', 'scale('+1/a+')');
            //     $('#main-map.map').css('transform-origin', midpoint.x + 'px ' + midpoint.y + 'px');
            //     //     }
            // }
        }
    }


</script>