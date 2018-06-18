<?php session_start();
?>
<?php include_once('../../head.php'); ?>
<div class="filter search parametre" id="no-2">
    <?php

    include_once('../../Xquery.php');
    include_once('../../config.php');
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
                    "<div class='locbox-title' id='" + element[i].location_id + "'>" + element[i].name + "</div>" +
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
            var getparent = function(a) {
                if(a == 0) return ;
                for(var i =0; i<element.length; i++){
                    if(element[i].location_id === a){
                        parents.push(element[i].parent_id);
                        getparent(element[i].parent_id);
                    }
                }

            }
            $('.locbox-title').click(function () {
                if(!$('#'+$(this).get(0).id+'.locbox-title').hasClass('active')){
                    getparent($(this).get(0).id,parents,element);}
                $('#'+$(this).get(0).id+'.locbox-title').addClass('active');
                // $('#mid.header').text(parents);
                $('#'+$(this).get(0).id+'.locbox-inside').slideDown(500);
                for(var i = 0; i<element.length; i++){
                    if(element[i].location_id !== $(this).get(0).id && !parents.includes(element[i].location_id) ){
                        $('#'+element[i].location_id+'.locbox-title').removeClass('active');
                        $('#'+element[i].location_id+'.locbox-inside').slideUp(500);
                    }
                    if(parents.includes(element[i].location_id)){
                        parents.pop(element[i].location_id);
                    }
                    if(element[i].location_id !== $(this).get(0).id && element[i].parent_id === 0){
                        $('#'+element[i].location_id+'.locbox-title').removeClass('active');
                        $('#'+element[i].location_id+'.locbox-inside').slideUp(500);
                    }

                }

            });
            var findIndex = function (a) {
                for(var i = 0; i<element.length; i++ ){
                    if(element[i].location_id === a) return i;
                }
            };
            var selectedparent = 0;
            $('.locbox-title').click(function () {
                selectedparent = $(this).get(0).id;
                var index = findIndex($(this).get(0).id);
                $('#'+$(this).get(0).id+'.locbox-title').addClass('selected');
                $('#current-loc').text(element[index].name);
                for(var i =0; i<$('.locbox-title').length; i++){
                    var id = $('.locbox-title').get(i).id;
                    if(id !== $(this).get(0).id){
                        $('#'+id+'.locbox-title').removeClass('selected');
                    }
                }
            });

            $('#insert-location').click(function () {
                if($('#name.location').val() === '') return;
                var post = {
                    "parent_id":selectedparent,
                    "name":$('#name.location').val()
                };
                $.post('<?php echo $_SESSION['host']; ?>back/insertlocation.php',post,function (data) {
                    $('#alert.insertaition-loc').text(post.name+' '+data);
                    $('#name.location').val('');
                });

            });
        });


    </script>
    <style>

        .selected {
            background-color: bisque;
        }
        .location-option {
            cursor: pointer;
            border: 1px solid crimson;
        }
        #locations-out{
            padding: 20px;
        }
    </style>
    <a href="../admin.php" data-ajax="false"> Admin Panel</a>
    <?php

    ?>
    <div><h1 style="padding-left: 20px;">Konum</h1></div>
    <div class="search filter location" id="locations-out">
        <div class="search filter location" id="locations-select" data-role="none">
        </div>
        <div>Şu Konumun Altına Ekle: <div id="current-loc"></div></div>
        <div class="location-insertation" id="container">
            <input type="text" placeholder="Konum" id="name" class="input location" value="">
            <button id="insert-location">Kayıt</button>
        </div>
        <div class="insertaition-loc" id="alert"></div>
        <script>

        </script>
    </div>
</div>