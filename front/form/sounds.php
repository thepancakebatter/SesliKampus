<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="https://rawgithub.com/moment/moment/2.2.1/min/moment.min.js"></script>
<link rel="stylesheet" href="../../javascripts/cropphoto/rcrop.min.css" type="text/css"/>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
<script src="../../javascripts/cropphoto/rcrop.min.js"></script>
<a href="../admin.php">Admin Panel</a>
<div><h1 style="padding-left: 20px;">Ses</h1></div>
<div class="search filter location" id="sound-out" style="overflow: auto;">
    <div class="search filter location" id="sound-select" data-role="none">
    </div>
    <div class="sound-insertation" id="container">
        <!--        <input type="file" accept="audio/*;capture=microphone">-->
        <audio id="audio" style="display: none"></audio>
        <div class="alert" id="sound"></div>
        <form enctype="multipart/form-data" method="post" action="../../back/soundupload.php"
              onsubmit="return checkinsertation()">
            <label>Başlık:</label>
            <input type="text" class="form" id="titre" name="titre" placeholder="başlık" data-role="none"><br>

            <label>Yaratıcı:</label>
            <div class="sound-select" id="autor"></div>

            <label>Ses dosyası:</label>
            <input type="hidden" name="MAX_FILE_SIZE" value="8000000" id="max-size"/>
            <input type="file" class="form" id="soundfile" name="soundfile" accept=".mp3" data-role="none">
            <div id="soundsize"></div>
            <div id="soundduration"></div>
            <br>

            <label>Albüm Kapağı</label>

            <div class="addsound-coverart" style=" max-width: 80%; min-width: 200px;" id="container">
                <input type="file" class="form" id="soundimage" name="coverimage" accept=".jpeg, .png, .jpg"
                       data-role="none"><br>
                <span id="image-size" class="addphoto"></span>
                <img id="image-prewiev" src="" style="max-width: 100%">
                <span id="image-edit" style="cursor: pointer;display: none;"><i class="material-icons" style="color: #81db96;">mode_edit</i></span>
<!--                <span id="image-confirm" style="cursor: pointer"><i class="material-icons"-->
<!--                                                                    style="color: #cd0a0a;">done</i></span>-->
                <input type="hidden" class="photo-data" id="width" name="width" value="100">
                <input type="hidden" class="photo-data" id="height" name="height" value="100">
                <input type="hidden" class="photo-data" id="x" name="x" value="100">
                <input type="hidden" class="photo-data" id="y" name="y" value="100">
                <style>
                    label {
                        display: inline-block;
                        width: 60px;
                        margin-top: 10px;
                    }

                    #update {
                        margin: 10px 0 0 60px;
                        padding: 10px 20px;
                    }

                    #cropped-original, #cropped-resized {
                        padding: 20px;
                        border: 4px solid #ddd;
                        min-height: 60px;
                        margin-top: 20px;
                    }

                    #cropped-original img, #cropped-resized img {
                        margin: 5px;
                    }
                </style>
                <script>
                    $(document).ready(function () {

                        var $image2;
                        $('#image-edit').click(function () {
                            $image2 = $('#image-prewiev');
                            $image2.rcrop({
                                minSize: [150, 150],
                                preserveAspectRatio: true,
                                preview: {
                                    display: true,
                                    size: [100, 100]
                                }
                            });
                            var inputs = {
                                x: $('#x.photo-data'),
                                y: $('#y.photo-data'),
                                width: $('#width.photo-data'),
                                height: $('#height.photo-data')
                            };

                            var fill = function () {
                                $image2.rcrop('updateCropData');
                                var values = $image2.rcrop('getValues');
                                // alert(values);
                                for (var coord in inputs) {
                                    inputs[coord].val(values[coord]);
                                }
                            };

                            $image2.on('rcrop-change rcrop-ready', fill);

                        });


                    });


                    function readURL(input) {

                        if (input.files && input.files[0]) {
                            var reader = new FileReader();

                            reader.onload = function (e) {
                                $('#image-prewiev').attr('src', e.target.result);
                            }

                            reader.readAsDataURL(input.files[0]);
                        }
                    }

                    $("#soundimage").change(function () {
                        readURL(this);

                    });

                </script>
            </div>
            <label>Açıklama:</label><br>

            <textarea class="form" id='description' cols="50" rows="10" placeholder="açıklama #etiket" maxlength="400"
                      name="description"></textarea>
            <span id="keysmetre">400</span><br>

            <label>Saat:(ss:dd)</label>
            <input type="time" class="form" id="time" name="time" data-role="none">

            <label>Tarih:(yyyy/aa/gg)</label>
            <input type="date" class="form" id="date" name="date" data-role="none"><br>

            <label>Konum:<span id="current-loc"></span></label>
            <div class="sound-select" id="location">
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
                        background-color: bisque;
                    }

                    .location-option {
                        cursor: pointer;
                        border: 1px solid crimson;
                    }

                    #locations-out {
                        padding: 20px;
                    }
                </style>

                <div class="search filter location" id="locations-out">
                    <div class="search filter location" id="locations-select" data-role="none">

                    </div>
                </div>
            </div>
            <input type="hidden" name="location" id="value-location" value="" data-role="none">

            <label>Tür:</label>
            <div class="sound-select" id="genre"></div>

            <!--    <label>Etiket:</label>-->
            <!--    <input type="text" class="sound-add" id="tag" placeholder="#etiket" name="tag">-->
            <?php //todo: üst konumlar seçilemeyecek!!
            //todo:kullanıcı konum seçerken üst başlıklarıda seçebiliyor?>
            <input type="hidden" value="" id="duration" name="duration">
            <input type="submit" value="Kaydı Tamamla"></form>

        <script>
            $(document).ready(function () {
                $.get('../../back/select.php', {key: 'autor'}, function (data) {
                    $('#autor.sound-select').html(data);
                });
            });
            $(document).ready(function () {
                $.get('../../back/select.php', {key: 'genre'}, function (data) {
                    $('#genre.sound-select').html(data);
                });
            });


            //metin sınırı
            $('#description.form').keyup(function () {
                var len = $('#description.form').val();
                $('#keysmetre').text('' + 400 - len.length + '');
            });
            //konum seçici

            //süre hesaplama
            var objectUrl;
            var soundsize;
            var soundduration;

            $("#audio").on("canplaythrough", function (e) {

                var seconds = e.currentTarget.duration;
                var duration = moment.duration(seconds, "seconds");
                soundduration = seconds;

                var time = "";
                var hours = duration.hours();
                if (hours > 0) {
                    time = hours + ":";
                }
                time = time + duration.minutes() + ":" + duration.seconds();
                $("#duration").val(seconds);
                $('#soundduration').text('Süre: ' + time);
                if (soundduration > 120) {
                    $('#soundduration').css('color', 'red');
                }
                URL.revokeObjectURL(objectUrl);
            });

            $("#soundfile").change(function (e) {
                var file = e.currentTarget.files[0];
                // alert($("#soundfile").val());
                // $("#filename").text(file.name);
                // $("#filetype").text(file.type);
                soundsize = file.size;
                var new_number = Math.round(file.size / (1024 * 1024)).toFixed(2);
                $("#soundsize").text('Ses boyutu: ' + new_number + ' Mb');
                // $("#duration").val('time');
                if (soundsize > $('#max-size').val()) {
                    $('#soundsize').css('color', 'red');
                }
                objectUrl = URL.createObjectURL(file);
                $("#audio").prop("src", objectUrl);
            });
            var imagesize = true;
            $("#soundimage").change(function (e) {
                var file = e.currentTarget.files[0];
                var new_number = Math.round(file.size / (1024)).toFixed(2);

                $('#image-size.addphoto').text('image-size(max:500Kb):'+new_number+'Kb');
                if (file.size > 500000) {
                    $('#image-size').css('color', 'red');
                       imagesize = false;
                }else{
                    $('#image-edit').slideDown(500);
                    imagesize=true;
                }
            });
            //post kontrol

            function checkinsertation() {
                if ($('#titre.form').val() === '') {
                    $('#sound.alert').text('Eksik Girdi:Başlık');
                    return false;
                }
                if ($('#autor.form').val() === 'null') {
                    $('#sound.alert').text('Eksik Girdi:Yaratıcı');
                    return false;
                }
                if ($('#soundfile.form').val() === '') {
                    $('#sound.alert').text('Eksik Girdi:Ses Dosyası');
                    return false;
                }
                if ($('#time.form').val() == '') {
                    $('#sound.alert').text('Eksik Girdi:Saat');
                    return false;
                }
                if ($('#date.form').val() == '') {
                    $('#sound.alert').text('Eksik Girdi:Tarih');
                    return false;
                }
                if (soundsize > $('#max-size').val()) {
                    $('#sound.alert').text('Dosya boyut aşımı');
                    return false;
                }
                if (imagesize) {
                    $('#sound.alert').text('Fotoğraf Dosya boyut aşımı');
                    return false;
                }
                if (soundduration > 120) {
                    alert(soundduration);
                    $('#sound.alert').text('Ses dosyası 2 dakikanın altında olmalıdır');
                    return false;
                }
                if ($('#value-location').val() === '0') {
                    $('#sound.alert').text('Eksik Girdi:Konum');
                    return false;
                }
                if ($('#genre.form').val() === 'null') {
                    $('#sound.alert').text('Eksik Girdi:Tür');
                    return false;
                }


            }
        </script>
    </div>
    <div class="insertaition-sound" id="alert"></div>
    <script>

    </script>
</div>