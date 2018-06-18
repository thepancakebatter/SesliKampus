<?php
/**
 * Created by PhpStorm.
 * User: lebigmac
 * Date: 30.05.2018
 * Time: 15:10
 */
?>

<div class="player" id="main">

    <div class="player pages-slider close" id="main-player-header">
        <div class="player" id="infos">
            <span amplitude-song-info="titre" amplitude-main-song-info="true" class="song-name"></span><br>
            <span amplitude-song-info="location" amplitude-main-song-info="true" class="song-name"></span>
            <span amplitude-song-info="genre" amplitude-main-song-info="true" class="song-name"></span>
        </div>
    </div>
    <div class="player" id="cover_art">
        <img class="player" amplitude-song-info="cover_art_url" amplitude-main-song-info="true"/>
    </div>
    <div class="player" id="control-container" style="display: flex;">
        <div class="control-container" id="left" style="display: flex;">
            <div id="repeat-container">
                <div class="amplitude-repeat" id="repeat"><i class="material-icons">
                        repeat
                    </i></div>
            </div>
            <div id="shuffle-container">
                <div class="amplitude-shuffle amplitude-shuffle-off" id="shuffle"><i class="material-icons">
                        shuffle
                    </i></div>
            </div>
        </div>
        <div class="control-container" id="mid" style="width: 100%">
            <div class="mid" id="control" style="display:flex; margin: auto;">
                <div class="amplitude-prev player" id="previous"><i class="material-icons">
                        fast_rewind
                    </i></div>
                <div class="amplitude-play-pause player" amplitude-main-play-pause="true" id="play-pause"><i
                            class="material-icons">
                        play_arrow
                    </i></div>
                <div class="amplitude-next player" id="next"><i class="material-icons">
                        fast_forward
                    </i></div>
            </div>
        </div>
        <div class="control-container" id="right">

            <div class="volume-controls" style="display: flex;">
                <div class="amplitude-mute amplitude-not-muted"><i class="material-icons">
                        volume_up
                    </i></div>
                <input type="range" class="amplitude-volume-slider" data-role="none">
                <div class="ms-range-fix"></div>
            </div>

        </div>
    </div>

    <div id="time-container">
								<span class="current-time">
									<span class="amplitude-current-minutes"
                                          amplitude-main-current-minutes="true"></span>:<span
                                            class="amplitude-current-seconds"
                                            amplitude-main-current-seconds="true"></span>
								</span>
        <input type="range" class="amplitude-song-slider" amplitude-main-song-slider="true" step=".1" data-role="none"/>
        <span class="duration">
									<span class="amplitude-duration-minutes"
                                          amplitude-main-duration-minutes="true"></span>:<span
                    class="amplitude-duration-seconds" amplitude-main-duration-seconds="true"></span>
								</span>
    </div>

</div>
<style>
    #main.player {
        background-color: #f7e4e1;
        display: none;
    }

    #main-player-header.player {
        background-color: coral;
        height: 50px;
    }

    .ui-slider-track .ui-btn.ui-slider-handle {
        display: none;
    }

    #play-pause.player {
        background-color: lightcoral;
        width: 80px;
        height: 80px;
        border-radius: 40px;
    }

    #next.player {
        background-color: lightcoral;
        width: 30px;
        height: 30px;
        border-radius: 30px;
        margin-top: auto;
        margin-bottom: auto;
    }

    #previous.player {
        background-color: lightcoral;
        width: 30px;
        height: 30px;
        border-radius: 30px;
        margin-top: auto;
        margin-bottom: auto;
    }

    #cover_art.player {
        /*width: 75%;*/
        margin: auto;
        border: 2px solid blue;
        margin-top: 10px;
        margin-bottom: 10px;
    }

    img.player {
        background-size: contain;
        width: 100%;
    }

    #play-pause.player .material-icons {
        font-size: 80px;
        color: whitesmoke;
    }

    #next.player .material-icons {
        font-size: 30px;
        color: whitesmoke;
    }

    #previous.player .material-icons {
        font-size: 30px;
        color: whitesmoke;
    }
    .amplitude-volume-slider{
        width: 100%;
    }
</style>

<script>
    $(document).ready(function () {
        var height = window.innerHeight;
        var width = window.innerWidth;
        var h_height = $('#container.header').height();

        var y = height - h_height;
        $('#main.player').css('height', y + 'px');
        $('#main.player').css('margin-top', h_height + 'px');
        $('body').css('height', height + 'px');
        $('#main.player').css('width', width + 'px');

    });
    //cover_art dikey uzunluk
    $(document).ready(function () {
        var window_w = window.innerWidth;
        var h = window_w * 0.8;
        // var h = $('img.player').innerWidth();
        // var h  = '500px';
        //  alert(h);
        $('#cover_art.player').css('height', h + 'px');
        $('#cover_art.player').css('width', h + 'px');
    });
    $('.amplitude-mute').click(function () {

    });
</script>