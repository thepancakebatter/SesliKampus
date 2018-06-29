<div class="player-footer" id="footer-out">
    <progress class="amplitude-song-played-progress" amplitude-main-song-played-progress="true"
              id="song-played-progress"></progress>
    <div class="player-footer true" id="footer-container">
    <div class="player-footer" id="footer-container-inside">
        <div class="player-footer" id="sound-controller">
            <span class="amplitude-play paused player-footer" id="play-pause"><i class="material-icons">play_arrow</i></span>
        </div>
        <div class="player-footer pages-slider open" id="sound-info" data-port="main.player">
            <div id="meta-container" class="player-footer" style="overflow: hidden;">
                <script>
                    $(document).ready(function () {
                        $('#meta-container.player-footer').css('max-width',($('#footer-out.player-footer').innerWidth()-150)+'px');
                    });
                </script>
                <span amplitude-song-info="titre" amplitude-main-song-info="true" class="song-name" id="footer-titre" style="white-space:nowrap;font-family: Bungee;"></span><br>
                <span amplitude-song-info="location" amplitude-main-song-info="true" class="song-name"></span>
            </div>
        </div>
        <div class="player-footer" id="like"><span class="like-button unlike" id="player-footer"><i
                        class="material-icons">favorite_border</i></span></div>
        <script>
            // $(document).ready(function () {
            //    $('.like-button').click(function () {
            //        var song  = Amplitude.getActiveSongMetadata();
            //        // alert(JSON.stringify(song));
            //        $.post('back/liked.php',{sound_id:song.id,click:true},function (data) {
            //            if(data == 'added'){
            //                $('.like-button').children().text('favorite');
            //            }
            //            else if(data == 'removed'){
            //                $('.like-button').children().text('favorite_border');
            //            }
            //            else{
            //                alert(data+'lütfen Giriş Yapınız');
            //            }
            //        });
            //    }) ;
            // });
            //todo:like fonksiyonu düzeltilecek
        </script>
    </div>
</div>
</div>
<?php //todo:beğenme fonksiyonu eklenecek ?>
<style>
    #footer-container.player-footer {
        background: #cc3300;
        height: 60px;
        color: whitesmoke;
        max-height: 60px;
        text-shadow: none;

    }
    #footer-out.player-footer {
        position: fixed;
        width: 100%;
        bottom: 0px;
        left: 0px;
    }

    .amplitude-song-played-progress {
        width: 100%;
    }

    #footer-container-inside.player-footer {
        display: flex;
        justify-content: space-between;
        margin: 0px auto;
        padding-left: 10px;
        padding-right: 10px;
        /*font-size: 16px;*/
    }

    .amplitude-play .material-icons {
        font-size: 60px;
    }

    span#play-pause {
        display: inline-block;
        background-repeat: no-repeat;
        background-size: contain;
        width: 60px;
        height: 60px;
        color: whitesmoke;
    }

    .like-button .material-icons{
        font-size: 60px;
    }
    #like.player-footer {
        width: 60px;
        height: 60px;
    }
    #sound-info.player-footer {
        padding-top: 10px;
        padding-bottom: 10px;
        text-align: center;
    }
    progress.amplitude-song-played-progress:not([value]) {
        background-color: #313252;
    }
    progress.amplitude-song-played-progress {
        background-color: #313252;
        -webkit-appearance: none;
        appearance: none;
        width: 100%;
        height: 5px;
        display: block;
        cursor: pointer;
        border: none;
    }
    progress[value]::-webkit-progress-bar {
        background-color: #313252;
    }
    progress[value]::-moz-progress-bar {
        background-color: #00a0ff;
    }
    progress[value]::-webkit-progress-value {
        background-color: #00a0ff;
    }
    /*span#play-pause.paused {*/

    /*background: url("media/icons/round-pause-24px.svg");*/

    /*}*/
    .footer-overflow{
        position: relative;
        -webkit-animation-name: footer_overflow; /* Safari 4.0 - 8.0 */
        -webkit-animation-duration: 4s; /* Safari 4.0 - 8.0 */
        -webkit-animation-iteration-count: infinite; /* Safari 4.0 - 8.0 */
        animation-name: footer_overflow;
        animation-duration: 16s;
        animation-delay: -4s;
        animation-iteration-count: infinite;

    }
    @keyframes footer_overflow {
        0%      {left:0px; }
        50% {left:100px;}
        100% {left:-100px;}


        
    }
    @-webkit-keyframes footer_overflow {
        0%      {left:0px; }
        50% {left:100px;}
        100% {left:-100px;}
    }
</style>
<script>

    document.getElementById('song-played-progress').addEventListener('click', function( e ){
        var offset = this.getBoundingClientRect();
        var x = e.pageX - offset.left;
        Amplitude.setSongPlayedPercentage( ( parseFloat( x ) / parseFloat( this.offsetWidth) ) * 100 );
    });

    $('#footer-container').on("swipeleft", swipeLHandler);

    function swipeLHandler(event) {
        // alert('left');
        Amplitude.next();

    }

    $('#footer-container').on("swiperight", swipeRHandler);

    function swipeRHandler(event) {
        Amplitude.prev();

    }

    $('#footer-container').click(function () {
        // alert('click');
    });
</script>