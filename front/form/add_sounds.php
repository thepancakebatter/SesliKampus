<?php


?>
<audio id="audio" style="display: none"></audio>
<div class="alert" id="sound"></div>
<form enctype="multipart/form-data" method="post" action="back/soundupload.php" onsubmit="//return checkinsertation()">
    <label>Başlık:</label>
    <input type="text" class="form" id="titre" name="titre" placeholder="başlık"><br>

    <label>Yaratıcı:</label>
    <div class="sound-select" id="autor"></div>

    <label>Ses dosyası:</label>
    <input type="hidden" name="MAX_FILE_SIZE" value="8000000" id="max-size"/>
    <input type="file" class="form" id="soundfile" name="soundfile" accept=".mp3">
    <div id="soundsize"></div>
    <div id="soundduration"></div><br>

    <label>Albüm Kapağı:</label>
    <input type="file" class="form" id="soundimage" name="coverimage" accept=".jpeg, .png, .jpg"><br>
    <?//TODO: fotografları kare formata getiren ve  seçen js code eklenecek ?>
    <label>Açıklama:</label><br>

    <textarea class="form" id='description' cols="50" rows="10" placeholder="açıklama #etiket" maxlength="400"
              name="description"></textarea>
    <span id="keysmetre">400</span><br>

    <label>Saat:</label>
    <input type="time" class="form" id="time" name="time">

    <label>Tarih:</label>
    <input type="date" class="form" id="date" name="date"><br>

    <label>Konum:</label>
    <div class="sound-select" id="location"></div>
    <input type="hidden" name="location" id="value-location" value="">

    <label>Tür:</label>
    <div class="sound-select" id="genre"></div>
    <input type="hidden" name="genre" value="" id="genre-post">

<!--    <label>Etiket:</label>-->
<!--    <input type="text" class="sound-add" id="tag" placeholder="#etiket" name="tag">-->
    <?php   //todo: üst konumlar seçilemeyecek!!
                        //todo:kullanıcı konum seçerken üst başlıklarıda seçebiliyor?>
    <input type="hidden" value="" id="duration" name="duration">
    <input type="submit" value="Kaydı Tamamla"></form>

<script>
    $(document).ready(function () {
        $.get('back/select.php', {key: 'autor'}, function (data) {
            $('#autor.sound-select').html(data);
        });
    });
    $(document).ready(function () {
        $.get('back/select.php', {key: 'genre'}, function (data) {
            $('#genre.sound-select').html(data);
        });
    });
    $(document).ready(function () {
        $.post('back/location_select.php', {key: 'select', parent_id: '0'}, function (data) {
            $('#location.sound-select').html(data);
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

    $("#audio").on("canplaythrough", function(e){

        var seconds = e.currentTarget.duration;
        var duration = moment.duration(seconds, "seconds");
        soundduration = seconds;

        var time = "";
        var hours = duration.hours();
        if (hours > 0) { time = hours + ":" ; }
        time = time + duration.minutes() + ":" + duration.seconds();
        $("#duration").val(seconds);
        $('#soundduration').text('Süre: '+time);
        if(soundduration > 120){
            $('#soundduration').css('color','red');
        }
        URL.revokeObjectURL(objectUrl);
    });

    $("#soundfile").change(function(e){
        var file = e.currentTarget.files[0];
        // alert($("#soundfile").val());
        // $("#filename").text(file.name);
        // $("#filetype").text(file.type);
        soundsize = file.size;
        var new_number = Math.round(file.size/(1024*1024)).toFixed(2);
        $("#soundsize").text('Ses boyutu: '+new_number+' Mb');
        // $("#duration").val('time');
        if(soundsize > $('#max-size').val()){
            $('#soundsize').css('color','red');
        }
        objectUrl = URL.createObjectURL(file);
        $("#audio").prop("src", objectUrl);
    });
//post kontrol

    function checkinsertation() {
        if($('#titre.form').val() === ''){
            $('#sound.alert').text('Eksik Girdi:Başlık');
            return false;
        }
        if($('#autor.form').val() === 'null'){
            $('#sound.alert').text('Eksik Girdi:Yaratıcı');
            return false;
        }
        if($('#soundfile.form').val() === ''){
            $('#sound.alert').text('Eksik Girdi:Ses Dosyası');
            return false;
        }
        if($('#time.form').val() == ''){
            $('#sound.alert').text('Eksik Girdi:Saat');
            return false;
        }
        if($('#date.form').val() == ''){
            $('#sound.alert').text('Eksik Girdi:Tarih');
            return false;
        }
        if(soundsize > $('#max-size').val()) {
            $('#sound.alert').text('Dosya boyut aşımı');
            return false;
        }
        if(soundduration > 120) {
            alert(soundduration);
            $('#sound.alert').text('Ses dosyası 2 dakikanın altında olmalıdır');
            return false;
        }
        if($('#value-location').val() === '0'){
            $('#sound.alert').text('Eksik Girdi:Konum');
            return false;
        }
        if($('#genre.form').val() === 'null'){
            $('#sound.alert').text('Eksik Girdi:Tür');
            return false;
        }


    }
</script>