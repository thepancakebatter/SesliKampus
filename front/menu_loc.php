<?php session_start();
?>
<?php ?>

    <?php

    include_once('Xquery.php');
    //    include_once('../config.php');
    $db = new xquery($conn);

    //todo:üst konumlarda filrenelebilir
    function get_location($a, $conn)
    {
        $db = new xquery($conn);
        $loc = $db->Xquery('SELECT location_id,parent_id,name,positionX,positionY FROM sk_location ', '', true, false);
        $location = array();
        if ($loc == 0) return NULL;
//                    $location["children"] = array();
        $locup = array();
        foreach ($loc as $x) {
            $location["name"] = $x["name"];
            $location["location_id"] = $x["location_id"];
            $location["parent_id"] = $x["parent_id"];
            $location["x"] = $x["positionX"];
            $location["y"] = $x["positionY"];
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
            var element2 = <?php echo json_encode($locations, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?> ;
            if (element2 == null) return;
            for (var i = 0; i < element2.length; i++) {
                var nesne = "<div class ='locbox-container location-option-menu' id='" + element2[i].location_id + "'>" +
                    "<div class='locbox-title' data-x='"+element2[i].x+"' data-y='"+element2[i].y+"' id='" + element2[i].location_id + "'>&#9679;" + element2[i].name + "</div>" +
                    "<div class='locbox-inside-menu' id='" + element2[i].location_id + "'></div>" +
                    "</div>";
                if (element2[i].parent_id == 0) {
                    // alert('a');
                    $('#locations-select-menu').append(nesne);
                    $('#' + element2[i].location_id + '.locbox-inside-menu').css('display', 'none');
                } else {
                    $('#' + element2[i].parent_id + '.locbox-inside-menu').append(nesne);
                    $('#' + element2[i].location_id + '.locbox-inside-menu').css('display', 'none');
                }
            }
            var parents = new Array();
            var getparent = function (a) {
                if (a == 0) return;
                for (var i = 0; i < element2.length; i++) {
                    if (element2[i].location_id === a) {
                        parents.push(element2[i].parent_id);
                        getparent(element2[i].parent_id);
                    }
                }

            }
            $('.locbox-title').click(function () {
                if (!$('#' + $(this).get(0).id + '.locbox-title').hasClass('active')) {
                    getparent($(this).get(0).id, parents, element2);
                }
                $('#' + $(this).get(0).id + '.locbox-title').addClass('active');
                // $('#mid.header').text(parents);
                $('#' + $(this).get(0).id + '.locbox-inside-menu').slideDown(500);
                for (var i = 0; i < element2.length; i++) {
                    if (element2[i].location_id !== $(this).get(0).id && !parents.includes(element2[i].location_id)) {
                        $('#' + element2[i].location_id + '.locbox-title').removeClass('active');
                        $('#' + element2[i].location_id + '.locbox-inside-menu').slideUp(500);
                    }
                    if (parents.includes(element2[i].location_id)) {
                        parents.pop(element2[i].location_id);
                    }
                    if (element2[i].location_id !== $(this).get(0).id && element2[i].parent_id === 0) {
                        $('#' + element2[i].location_id + '.locbox-title').removeClass('active');
                        $('#' + element2[i].location_id + '.locbox-inside-menu').slideUp(500);
                    }

                }

            });
            var findIndex = function (a) {
                for (var i = 0; i < element2.length; i++) {
                    if (element2[i].location_id === a) return i;
                }
            };
            var selectedparent = 0;
            $('.locbox-title').click(function () {
                selectedparent = $(this).get(0).id;
                var index = findIndex($(this).get(0).id);
                $('#' + $(this).get(0).id + '.locbox-title').addClass('selected');
                $('#current-loc').text(element2[index].name);
                for (var i = 0; i < $('.locbox-title').length; i++) {
                    var id = $('.locbox-title').get(i).id;
                    if (id !== $(this).get(0).id) {
                        $('#' + id + '.locbox-title').removeClass('selected');
                    }
                }
            });
            $('.locbox-title').click(function () {

                var x =  $('#' + $(this).get(0).id + '.locbox-title').attr('data-x');
                var y =  $('#' + $(this).get(0).id + '.locbox-title').attr('data-y');

                updateSelectedPosition(x,y);
                drawArea();
                drawActiveCircle();
            });
        });


    </script>
    <style>

        .selected.locbox-title {
            background-color: whitesmoke;
        }
       .locbox-title:hover {
            background-color: whitesmoke;
        }

        .location-option-menu {
            text-shadow: none;
            padding-left: 8px;
            cursor: pointer;
            /*border-top: 1px solid whitesmoke;*/
            /*border-bottom: 1px solid whitesmoke;*/
        }


    </style>
    <div class="menu filter location" id="locations-out">
        <div class="menu filter location" id="locations-select-menu" data-role="none">
        </div>

    </div>
