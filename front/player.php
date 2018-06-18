<div class="player" id="player">player<br>

    <div id="time-container">
								<span class="current-time">
									<span class="amplitude-current-minutes" amplitude-main-current-minutes="true"></span>:<span class="amplitude-current-seconds" amplitude-main-current-seconds="true"></span>
								</span>
        <input type="range" class="amplitude-song-slider" amplitude-main-song-slider="true" step=".1"/>
        <span class="duration">
									<span class="amplitude-duration-minutes" amplitude-main-duration-minutes="true"></span>:<span class="amplitude-duration-seconds" amplitude-main-duration-seconds="true"></span>
								</span>
    </div>

    <div class="player" id="sound-control">
        <div id="repeat-container">
            <div class="amplitude-repeat" id="repeat">repeat</div>
        </div>
        <span class="amplitude-prev">Prev</span>
        <span class="amplitude-play paused" id="play-pause"><i class="material-icons">play_arrow</i></span>
        <span class="amplitude-next">Next</span>
        <div id="shuffle-container">
            <div class="amplitude-shuffle amplitude-shuffle-off" id="shuffle">shuffle</div>
        </div>
    </div>
    <div id="meta-container">
        <span amplitude-song-info="titre" amplitude-main-song-info="true" class="song-name"></span>

    </div>
    <span class="player" id="titre"></span>
</div>


<center>
    <div class="player" id="container">
    <div class="player" id="header">logo//menu</div>
    <div class="player" id="search">search</div>

    <div class="player" id="timeline">timeline</div>
        <span class="more-sound">daha fazla ses</span>

    </div>
</center>
<style>
    #container.player{
        width: 40%;
        background: #cacaca;
    }
    .sound-timeline{
        background: #fff3d9;
        border: 2px solid #0c3d5d;
    }
    span.more-sound{
        cursor: pointer;
    }
    span.player{
        cursor: pointer;
    }
    #player.player{
        /*position: fixed;*/
    }
</style>
<script>

    <?php
        // limit global degiskeni timeline genisletildiğinde daha fazla parca yükleyecektir.
        //defautl limit 10sounds;
    ?>
    // $(document).ready(function () {
    //     var player_limit = {
    //         sound_limit: 10
    //     };
    //     $.post('back/player/timeline.php',player_limit,function (data) {
    //         // alert(data);
    //         $('#timeline.player').html(data);
    //     });
    //
    //     $('span.more-sound').click(function () {
    //
    //         player_limit.sound_limit += 10;
    //         // alert(player_limit.sound_limit);
    //         $.post('back/player/timeline.php',player_limit,function (data) {
    //             // alert(data);
    //             $('#more-sound').html(data);
    //         });
    //         $.post('back/player/soundlists.php',player_limit,function (data) {
    //             // alert(data);
    //             $('#soundlist').html(data);
    //         });
    //     });
    // });
    // ///////////////////////////////////////////////
    //


</script>
