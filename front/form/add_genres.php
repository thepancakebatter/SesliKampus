<input type="text" class="form" id="genres" placeholder='Tür' maxlength="50">
<button id="button" class="form">Kayıt</button>
<div class="alert" id="genre"></div>

<script>
    $('#button.form').click(function () {
        var val = {
            'name' : $('#genres.form').val()
    }
        $.post('back/genresdb.php',val,function (data) {
            $('#genre.alert').text(data);
        });

    });

</script>
