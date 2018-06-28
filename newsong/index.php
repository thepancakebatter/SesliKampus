<?php
session_start();
/**
 * Created by PhpStorm.
 * User: lebigmac
 * Date: 28.06.2018
 * Time: 00:09
 */
include_once('../head.php');
include_once('../front/header.php');

?>
<style>
    #toggle.draggable-list {
        display: none;
    }
    .inputfile {
        width: 0.1px;
        height: 0.1px;
        opacity: 0;
        overflow: hidden;
        position: absolute;
        z-index: -1;
    }
    #addsounds{
        background-color: #CC3300;
        color: whitesmoke;
        width: 100px;
        height: 100px;
        border-radius: 110px;
        font-size: 120px;
    }
    .input.addsound{
        width: 100%;
        border:none;
        border-bottom: 2px solid #eb8f00;
        height: 40px;
        margin-top: 20px;
    }
    #submit.addsound{
        color: #c52c01;
        border:none;
        background-color: #fba634;
        cursor: pointer;
        font-size: 20px;
        width: 100%;
        height: 40px;
        margin-top: 20px;
    }
    .radio{
        color: #CC3300;
    }
</style>
<script>
    $(document).ready(function ($) {
        $('#container.add-audio').css('margin-top', $('#container.header').css('height'));
        $('#container.add-audio').innerHeight(window.innerHeight);
    });
</script>
<?php if(isset($_SESSION['user'])): ?>
<div class="add-audio" id="container"style="overflow: scroll;" >
    <form>
    <div>
    <div class="add-audio stepper" id="container2" style="padding: 30px; margin: auto;margin-top: 10px; display: flex;justify-content: space-between;">
        <div class="circle viewer open" id="step1">
            <div id="step1" clas>Ses Kaydı</div>
        </div>
        <div class="rect viewer" id="step1-done"></div>
        <div class="circle viewer" id="step2">
        </div>

        <div class="rect viewer" id="step2-done"></div>
        <div class="circle viewer" id="step3">
        </div>

        <div class="rect viewer" id="step3-done"></div>
        <div class="circle viewer" id="step4">
        </div>

    </div>
        <style>
            .circle.viewer{
                width: 20px;
                height: 20px;
                border-radius: 20px;
                background-color: #CC3300;
            }
            .open.viewer{
                border:5px solid #fb9c2e;
                width: 15px;
                height: 15px;
            }
        </style>
    <div class="add-audio open" id="step1">
        <div style="margin: auto; margin-top: 20px;width: 100px;">
        <input type="file" id="addsound" class="inputfile" accept="audio/*;capture=microphone">
        <label for="addsound" id="addsounds"><i style="font-size: 100px;" class="material-icons">
                mic
            </i></label><br>
            <div style="text-align: center;color: #CC3300;margin-top: 10px;">Kayda Başla</div>
        </div>
    </div>
<!--    <div class="add-audio " id="step2">-->
<!--        <script>-->
<!--            // input.onchange = function(e){-->
<!--            //     var sound = document.getElementById('sound');-->
<!--            //     sound.src = URL.createObjectURL(this.files[0]);-->
<!--            //     // not really needed in this exact case, but since it is really important in other cases,-->
<!--            //     // don't forget to revoke the blobURI when you don't need it-->
<!--            //     sound.onend = function(e) {-->
<!--            //         URL.revokeObjectURL(this.src);-->
<!--            //     }-->
<!--            // }-->
<!--            document.getElementById('addsound').onchange = function(){-->
<!--                var sound = document.getElementById('sound');-->
<!--                var reader = new FileReader();-->
<!--                reader.onload = function(e) {-->
<!--                    sound.src = this.result;-->
<!--                    sound.controls = true;-->
<!--                    sound.play();-->
<!--                };-->
<!--                reader.readAsDataURL(this.files[0]);-->
<!--            }-->
<!--        </script>-->
<!--        <audio id="sound" controls></audio>-->
<!--    </div>-->
    <div class="add-audio " id="step3" >
        <div style="padding: 20px;">
        <input name="title" class='input addsound' type="text" placeholder="Başlık" id="title">
        <div class="sound-select" id="genre" style="margin-top: 20px;margin-bottom:20px;display:flex;justify-content:space-between;"></div>
        <script>
            $(document).ready(function () {
                $.get('../back/select.php', {key: 'genre'}, function (data) {
                    $('#genre.sound-select').html(data);
                });
            });
        </script>
            <label style="color: #CC3300;margin-top: 20px;">Konum:<span id="current-loc" style="color: #CC3300;" ></span></label>
            <div class="sound-select" id="location">
                <?php
                include_once('../Xquery.php');
                include_once('../config.php');
                $db = new xquery($conn);
                //todo:üst konumlarda filrenelebilir
                function get_location($a, $conn)
                {
                    $db = new xquery($conn);
                    $loc = $db->Xquery('SELECT location_id,parent_id,name FROM sk_location ', '', true, false);
                    $location = array();
                    if ($loc == 0) return NULL;
//                    $location["children"] = array();
                    $locup = array();
                    foreach ($loc as $x) {
                        $location["name"] = $x["name"];
                        $location["location_id"] = $x["location_id"];
                        $location["parent_id"] = $x["parent_id"];
//                        array_push($location["children"],get_location($x["location_id"], $conn));
                        array_push($locup, $location);
                    }
//                    print_r($loc);
                    return $locup;
                }

                $locations = get_location(0, $conn);
                //               echo json_encode($locations, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                ?>
                <script>
                    $(document).ready(function () {
                        var element = <?php echo json_encode($locations, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?> ;
                        if(element == null) return;
                        for (var i = 0; i < element.length; i++) {
                            var nesne = "<div class ='locbox-container location-option' id='" + element[i].location_id + "'>" +
                                "<div class='locbox-title' id='" + element[i].location_id + "' style='color: #CC3300;'>&#9679;" + element[i].name + "</div>" +
                                "<div class='locbox-inside' id='" + element[i].location_id + "'></div>" +
                                "</div>";
                            if (element[i].parent_id == 0) {
                                // alert('a');
                                $('#locations-select').append(nesne);
                                $('#' + element[i].location_id + '.locbox-inside').css('display', 'none');
                            } else {
                                $('#' + element[i].parent_id + '.locbox-inside').append(nesne);
                                $('#' + element[i].location_id + '.locbox-inside').css('display', 'none');
                            }
                        }
                        var parents = new Array();
                        var getparent = function (a) {
                            if (a == 0) return;
                            for (var i = 0; i < element.length; i++) {
                                if (element[i].location_id === a) {
                                    parents.push(element[i].parent_id);
                                    getparent(element[i].parent_id);
                                }
                            }

                        }
                        $('.locbox-title').click(function () {
                            if (!$('#' + $(this).get(0).id + '.locbox-title').hasClass('active')) {
                                getparent($(this).get(0).id, parents, element);
                            }
                            $('#' + $(this).get(0).id + '.locbox-title').addClass('active');
                            // $('#mid.header').text(parents);
                            $('#' + $(this).get(0).id + '.locbox-inside').slideDown(500);
                            for (var i = 0; i < element.length; i++) {
                                if (element[i].location_id !== $(this).get(0).id && !parents.includes(element[i].location_id)) {
                                    $('#' + element[i].location_id + '.locbox-title').removeClass('active');
                                    $('#' + element[i].location_id + '.locbox-inside').slideUp(500);
                                }
                                if (parents.includes(element[i].location_id)) {
                                    parents.pop(element[i].location_id);
                                }
                                if (element[i].location_id !== $(this).get(0).id && element[i].parent_id === 0) {
                                    $('#' + element[i].location_id + '.locbox-title').removeClass('active');
                                    $('#' + element[i].location_id + '.locbox-inside').slideUp(500);
                                }

                            }

                        });
                        var findIndex = function (a) {
                            for (var i = 0; i < element.length; i++) {
                                if (element[i].location_id === a) return i;
                            }
                        };
                        var selectedparent = 0;
                        $('.locbox-title').click(function () {
                            selectedparent = $(this).get(0).id;
                            $('#value-location').val(selectedparent);
                            var index = findIndex($(this).get(0).id);
                            $('#' + $(this).get(0).id + '.locbox-title').addClass('selected');
                            $('#current-loc').text(element[index].name);
                            for (var i = 0; i < $('.locbox-title').length; i++) {
                                var id = $('.locbox-title').get(i).id;
                                if (id !== $(this).get(0).id) {
                                    $('#' + id + '.locbox-title').removeClass('selected');
                                }
                            }
                        });


                    });


                </script>
                <style>

                    .selected {
                        background-color: #fba634;
                    }

                    .location-option {
                        cursor: pointer;
                        /*border: 1px solid crimson;*/
                        padding-left:5px;
                    }

                    #locations-out {
                        margin-top: 20px;
                    }
                </style>

                <div class="search filter location" id="locations-out">
                    <div class="search filter location" id="locations-select" data-role="none">

                    </div>
                </div>
            </div>
            <input type="hidden" name="location" id="value-location" value="" data-role="none">
        </div>
    </div>
    <div class="add-audio " id="step4">
        <div style="padding: 20px;">
        <textarea class="form" id='description' rows="10" placeholder="açıklama #etiket" maxlength="400"
                                                 name="description" style="border: 2px solid #CC3300;width: 80%;"></textarea>
        <span id="keysmetre" style="color: #CC3300;">400</span><br><button class="addsound" id="submit">Kaydı Tamamla</button></div>


    </div>
    </div>
    </form>
</div>
<?php endif; ?>