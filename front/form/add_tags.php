<?php
//tagları kayır altına alır // aşağıdaki kodlar kayıt ilemi bitince düzeltme işleminde eklenecek
/*
 * <textarea class="form" id='description' cols="50" rows="10" placeholder="açıklama" maxlength="400"></textarea><span id="keysmetre">400</span>
    $('#description.form').keyup(function () {
        var len = $('#description.form').val();
        $('#keysmetre').text(''+400-len.length+'');
    });

 */
?>

<input type="text" class="form" id="name" placeholder="#etiket" maxlength="50">
<button id="button" class="form">Kayıt</button>
<div class="alert" id="tag"></div>
<script>
    $('#button.form').click(function () {
        var val = {
            'name' : $('#name.form').val()
        }
        $.post('back/tagdb.php',val,function (data) {
            $('#tag.alert').text(data);
        });

    });

</script>
