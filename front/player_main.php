<?php
/**
 * Created by PhpStorm.
 * User: lebigmac
 * Date: 30.05.2018
 * Time: 15:10
 */
?>

<div class="player" id="main" style="overflow: scroll;">

    <div class="player pages-slider close" id="main-player-header">
        <div class="player" id="infos"
             style="display: flex;justify-content: space-between;padding: 10px; color: whitesmoke; text-shadow: none;text-align: center;">
            <div style="width: 100%;overflow: hidden;">
                <span amplitude-song-info="titre" amplitude-main-song-info="true" class="song-name"
                      style="font-family: Bungee;white-space: nowrap;overflow: hidden;max-width: 90%;"></span><br>
                <span amplitude-song-info="location" amplitude-main-song-info="true" class="song-name"></span>-<span
                        amplitude-song-info="author" amplitude-main-song-info="true" class="song-name"></span>
            </div>
                        <div>
                            <span><i style="font-weight: bold;" class="material-icons">close</i></span>
                        </div>

        </div>
    </div>
    <div class="player" id="cover_art">
        <img id="cover_art_img" class="player" amplitude-song-info="cover_art_url"
             amplitude-main-song-info="true"/>
        <canvas id="cover_art_canvas" style="display: none;"></canvas>

    </div>
    <div id="time-container" style=" display: flex;justify-content: space-between; padding: 10px;">
								<span class="current-time">
									<span class="amplitude-current-minutes"
                                          amplitude-main-current-minutes="true"></span>:<span
                                            class="amplitude-current-seconds"
                                            amplitude-main-current-seconds="true"></span>
								</span>
        <input style="width: 100%;" type="range" class="amplitude-song-slider" amplitude-main-song-slider="true"
               step=".1" data-role="none"/>
        <span class="duration">
									<span class="amplitude-duration-minutes"
                                          amplitude-main-duration-minutes="true"></span>:<span
                    class="amplitude-duration-seconds" amplitude-main-duration-seconds="true"></span>
								</span>
    </div>
    <div class="player" id="control-container"
         style="display: flex;justify-content: center; padding:0px 20px 0px 20px;">
        <div class="control-container" id="left" style="display: flex; margin: auto;">
            <script>
                $(document).ready(function () {
                    $('.volume-controls').innerWidth(window.innerWidth * 20 / 100);
                    $('#left.control-container').innerWidth(window.innerWidth * 20 / 100)
                });
            </script>
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
        <div class="control-container" id="mid">
            <div class="mid" id="control" style="display:flex; margin: auto; justify-content: space-between;">
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
        <div class="control-container" id="right" style="margin: auto; ">
            <div style="display: flex;justify-content: center;">
                <div class="volume-controls" style="display: flex; max-width: 85%;justify-content: center;">
                    <div id="volume-slider" class="amplitude-mute amplitude-not-muted"><i class="material-icons">
                            volume_up
                        </i></div>
                    <script>
                        $('body').mousemove(function () {
                            if ($('#volume-slider').hasClass('amplitude-not-muted')) {
                                $('#volume-slider').children().text('volume_up');
                            } else {
                                $('#volume-slider').children().text('volume_off');
                            }
                            if ($('#shuffle.amplitude-shuffle').hasClass('amplitude-shuffle-off')) {
                                $('#shuffle.amplitude-shuffle').children().css('color', '#000');
                            } else {
                                $('#shuffle.amplitude-shuffle').children().css('color', '#cc3300');
                            }
                            if ($('#repeat.amplitude-repeat').hasClass('amplitude-repeat-off')) {
                                $('#repeat.amplitude-repeat').children().css('color', '#000');
                            } else {
                                $('#repeat.amplitude-repeat').children().css('color', '#cc3300');
                            }

                        });
                        document.getElementsByTagName("body")[0].addEventListener("touchmove", function (e) {
                            if ($('#volume-slider').hasClass('amplitude-not-muted')) {
                                $('#volume-slider').children().text('volume_up');
                            } else {
                                $('#volume-slider').children().text('volume_off');
                            }
                            if ($('#shuffle.amplitude-shuffle').hasClass('amplitude-shuffle-off')) {
                                $('#shuffle.amplitude-shuffle').children().css('color', '#000');
                            } else {
                                $('#shuffle.amplitude-shuffle').children().css('color', '#cc3300');
                            }
                            if ($('#repeat.amplitude-repeat').hasClass('amplitude-repeat-off')) {
                                $('#repeat.amplitude-repeat').children().css('color', '#000');
                            } else {
                                $('#repeat.amplitude-repeat').children().css('color', '#cc3300');
                            }
                        });
                    </script>
                    <input type="range" class="amplitude-volume-slider" data-role="none">
                    <div class="ms-range-fix"></div>
                </div>
            </div>

        </div>


    </div>
    <div class="player" id="description" style="margin-top:20px; ">
        <div class="description" id="title"
             style="display: flex; justify-content: space-between; color:whitesmoke; text-shadow:none;background-color: #cc3300;font-family: Bungee;padding: 10px;">
        <span amplitude-song-info="titre" amplitude-main-song-info="true" class="song-name"
              style="font-size:14px;font-family: Bungee;white-space: normal;max-width: 80%;"></span><br>

            <span class="description" id="add-comment"><i class="material-icons" style="color: whitesmoke">
add_comment
</i></span>
        </div>
        <div class="description" id="description-text" style="font-family: Helvetica; text-shadow: none;padding: 10px;">
            <span amplitude-song-info="date" amplitude-main-song-info="true"
                  class="song-name"
                  style="font-family: Helvetica;float: right;"></span>
            <span amplitude-song-info="time" amplitude-main-song-info="true"
                  class="song-name"
                  style="font-family: Helvetica;float: left;"></span><br>
            <span amplitude-song-info="description" amplitude-main-song-info="true"
                                                 class="song-name"
                                                 style="font-family: Helvetica;"></span><br></div>
    </div>
    <div class="comments" style="border-top:2px solid #cc3300 "></div>
</div>
<style>
    #main.player {
        background-color: whitesmoke;
        display: none;
    }

    #main-player-header.player {
        background-color: coral;
        height: 60px;
    }

    .ui-slider-track .ui-btn.ui-slider-handle {
        display: none;
    }

    #play-pause.player {
        background-color: coral;
        width: 80px;
        height: 80px;
        border-radius: 40px;
    }

    #next.player {
        background-color: coral;
        width: 30px;
        height: 30px;
        border-radius: 30px;
        margin-top: auto;
        margin-bottom: auto;
    }

    #previous.player {
        background-color: coral;
        width: 30px;
        height: 30px;
        border-radius: 30px;
        margin-top: auto;
        margin-bottom: auto;
    }

    #cover_art.player {
        /*width: 75%;*/
        margin: auto;
        border: 5px solid #cc3300;
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

    .amplitude-volume-slider {
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
        var h;
        if (window_w < 720) {
            h = window_w * 0.8;
        } else {
            h = window_w * 0.2
        }
        // var h = $('img.player').innerWidth();
        // var h  = '500px';
        //  alert(h);
        $('#cover_art.player').css('height', h + 'px');
        $('#cover_art.player').css('width', h + 'px');
    });
    $('.amplitude-mute').click(function () {

    });
</script>