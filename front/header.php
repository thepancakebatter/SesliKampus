<div class="header" id="container">
    <div class="header" id="in-container">
        <div class="header" id="left"><span class="header" id="profil-icon"><i class="material-icons">account_circle</i></span>
        </div>
        <div class="header" id="mid"><a
                    href="/seslikampus/test.php">Sesli Kampus</a></div>
        <div class="header" id="right">
            <div class="header" id="search-box" style="display: flex;">
                <span class="header pages-slider open" id="search-icon" style="display: none;" data-port="container.search"><i
                            class="material-icons">search</i></span><span class="draggable-list" id="toggle" style="margin-left: 10px;"><i
                            class="material-icons">playlist_play</i></span>
            </div>
        </div>
    </div>
</div>
<div class="draggable-list ui-widget-content" id="container">
    <div class="draggable-list" id="inside"></div>
    <div class="draggable-list" id="callback">Sesli Kampus</div>
</div>


<style>
    .header input[type=text] {
        background-color: rgba(255, 251, 13, 0);
        color: whitesmoke;
        display: none;
    }

    #container.header {
        width: 100%;
        height: 40px;
        background: #CC3300;
        color: whitesmoke;
        position: fixed;
        top: 0px;
        left: 0px;
        max-height: 40px;
        text-shadow: none;
        z-index: 99;

    }

    #in-container.header {

        margin: 10px auto;
        padding-left: 10px;
        padding-right: 10px;
        display: flex;
        justify-content: space-between;

    }

    #container.draggable-list {
        position: fixed;
        top: 0px;
        width: 100%;
        height: 0px;
        background-color: rgba(245, 245, 245, 0.65);
        margin: auto;

        /*overflow:scroll;*/
        z-index: 99;
    }
    #callback.draggable-list:hover{
        cursor: pointer;
    }
    #callback.draggable-list {
        text-align: center;
        font-size: 13px;
        color: whitesmoke;
        text-shadow: none;
        padding-top: 4px;
    margin: auto;
    width: 100%;
    height: 25px;
    top: 100%;
    left: 0px;
    right: 0px;
        display: none;
    background-color: #cc4b37;
    /*border-radius: 30px;*/

        z-index: 98;
    }
    #inside.draggable-list {
        /*border: 2px solid red;*/
        padding: 0px;
        height: 0%;
        margin: 0px;
        overflow-y: scroll;
        overflow-x: hidden;
        transition: 2s;
        z-index: 99;
    }

    .sound-itemlist-container {
        background-color: #f7e4e1;
        border-bottom: 1px solid #3adb76;
    }

    .sound-itemlist-container.playing {
        background-color: #cc4b37;
    }

    #cover.sound-itemlist {
        width: 50px;
        height: 50px;

    }

    #meta.sound-itemlist {
        display: block;
        padding: 5px;
        width: 100%;
    }

    #row1.sound-itemlist {
        display: flex;
        justify-content: space-between;
    }

    #row2.sound-itemlist {
        display: flex;
        justify-content: space-between;
    }

</style>
<script>
    // //style script
    // $(document).ready(function () {
    //
    //     $('#toggle').draggable({axis: "y"});
    //     $('body').mousemove(function () {
    //         var top = $('#toggle').css('top');
    //         var top_numerique = parseInt(top);
    //
    //         $('#container.draggable-list').css('height',top);
    //
    //         // $('#container.draggable-list').css('height',top+'px');
    //     });
    // });
    $(document).ready(function () {
        var time_line = false;
        var h = (window.innerHeight*75/100);
        $('#container.draggable-list').css('height',h+'px');
        // $('#toggle').css('bottom','-15px');
        // $('#toggle').css('top','100%');
        $('#inside.draggable-list').css('height', h+'px');
        // $('#container.draggable-list').css('opacity', '1');
        $('#inside.draggable-list').css('opacity', '1');
        $('#container.draggable-list').slideUp(0);
        $('#toggle').click(function () {
            if (time_line == false) {

                $('#container.draggable-list').slideDown(500);
                $('#callback.draggable-list').slideDown(500);

                time_line = true;
            }
            else {
                $('#container.draggable-list').slideUp(500);

                time_line = false;
            }
        });
        $('#callback.draggable-list').click(function () {
            $('#container.draggable-list').slideUp(500);

            time_line = false;
        });
    });
    // $(document).ready(function () {
    //    $('body').click(function () {
    //        alert(JSON.stringify(song));
    //    }) ;
    // });
</script>