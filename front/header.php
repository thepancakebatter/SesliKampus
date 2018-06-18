<div class="header" id="container">
    <div class="header" id="in-container">
        <div class="header" id="left"><span class="header" id="profil-icon"><i class="material-icons">account_circle</i></span>
        </div>
        <div class="header" id="mid"><a href="/seslikampus/test.php">Sesli Kampus</a></div>
        <div class="header" id="right">
            <div class="header" id="search-box" style="display: flex;">
                <span class="header pages-slider open" id="search-icon" data-port="container.search"><i class="material-icons">search</i></span>
            </div>
        </div>
    </div>
</div>
<div class="draggable-list ui-widget-content" id="container">
    <div class="draggable-list" id="inside" ></div>
    <div class="draggable-list" id="toggle"></div>
</div>


<style>
    .header input[type=text] {
        background-color: rgba(255,251,13,0);
        color: whitesmoke;
        display: none;
    }
    #container.header {
        width: 100%;
        height: 40px;
        background: #0c3d5d;
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
        top: 40px;
        width: 100%;
        height: 0px;
        background-color: rgba(245, 245, 245, 0.65);
        margin: auto;
        transition: 1s;
        /*overflow:scroll;*/
        z-index: 99;
    }

    #toggle.draggable-list {
        position: absolute;
        margin: auto;
        width: 60px;
        height: 15px;
        top: 100%;
        bottom: -15px;
        left: 0px;
        right: 0px;
        background-color: #cc4b37;
        /*border-radius: 30px;*/
        border-bottom-left-radius: 30px;
        border-bottom-right-radius: 30px;;
    }
    #inside.draggable-list{
        /*border: 2px solid red;*/
        padding: 0px;
        height: 0%;
        margin: 0px;
        overflow-y: scroll;
    overflow-x: hidden ;
        transition: 2s;
    }

    .sound-itemlist-container{
        background-color: #f7e4e1;
        border-bottom: 1px solid #3adb76;
    }
    .sound-itemlist-container.playing{
        background-color:#cc4b37;
    }

    #cover.sound-itemlist{
        width: 50px;
        height: 50px;

    }
    #meta.sound-itemlist{
        display: block;
        padding: 5px;
        width: 100%;
    }
    #row1.sound-itemlist{
        display: flex;
        justify-content: space-between;
    }

    #row2.sound-itemlist{
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
        $('#toggle').click(function () {
            if (time_line == false) {
                $('#container.draggable-list').css('height', '75%');
                // $('#toggle').css('bottom','-15px');
                // $('#toggle').css('top','100%');
                $('#inside.draggable-list').css('height','98%');
                // $('#container.draggable-list').css('opacity', '1');
                $('#inside.draggable-list').css('opacity','1');


                time_line = true;
            }
            else {
                $('#container.draggable-list').css('height', '0%');
                $('#inside.draggable-list').css('height','0%');
                // $('#container.draggable-list').css('opacity', '0');
                $('#inside.draggable-list').css('opacity','0');

                time_line = false;
            }
        });

    });
// $(document).ready(function () {
//    $('body').click(function () {
//        alert(JSON.stringify(song));
//    }) ;
// });
</script>