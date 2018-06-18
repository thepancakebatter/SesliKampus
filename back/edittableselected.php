<?php
include_once('../Xquery.php');
include_once('../config.php');
$db = new xquery($conn);


switch ($_POST['table']){
    case 'sound':
        $table = 'sk_sounds';
        $identite =  'sound_id';
        $get = 'name,author_id,description';
        break;
    case 'tag':
        $table = 'sk_tags';
        $identite =  'tag_id';
        $get= 'name,description';
        break;
    case 'location':
        $table = 'sk_locations';
        $identite =  'location_id';
        $get = 'name,description';
        break;
    case 'genre':
        $table = 'sk_genres';
        $identite =  'genre_id';
        $get = 'name,description';
        break;
}

$getItem = $db->Xquery("SELECT $get FROM $table WHERE $identite = ? ",$_POST['itemId'],false);

print_r($getItem);

?>

<div class="edit-area">
    <label>Başlık:</label>
    <input type="text" class="form" id="titre" name="titre" value="<?php echo $getItem['name'];?>"><br>

    <textarea class="form" id='description' cols="50" rows="10"  maxlength="400"
              name="description"><?php echo $getItem['description'];?></textarea>
    <span id="keysmetre">400</span><br>
    <script>
        var len = $('#description.form').val();
        $('#keysmetre').text('' + 400 - len.length + '');
    $('#description.form').keyup(function () {
         len = $('#description.form').val();
        $('#keysmetre').text('' + 400 - len.length + '');

    });
        $(document).ready(function () {
            $.get('back/select.php', {key: 'autor'}, function (data) {
                $('#autor.sound-select').html(data);
                $('#autor.form').val('<?php echo $getItem['author_id']; ?>');
            });
        });
        $('.close-edit').click(function () {
            // alert('close');
            $('.edit-selected-outside').fadeOut(500);

        });
    </script>

    <?php if($_POST['table'] == 'sound'): ?>
    <label>Yaratıcı:</label>
    <div class="sound-select" id="autor"></div>

    <?php endif; ?>

    <button class="button" id="update">Güncelle</button>

    <script>
        $(document).ready(function () {
            $('#update.button').click(function () {


                var update =  {
              name: $('#titre.form').val(),
              description: $('#description.form').val(),
                    key: '<?php echo $_POST['table']; ?>',
                    id: '<?php echo $_POST['itemId']; ?>'
                    <?php if($_POST['table'] == 'sound'):?>
                    ,author_id: $('#autor.form').val()
                    <?php endif; ?>
                };
                 $.post('back/sendupdate.php',update,function (data) {
                    alert(data);
                    $('.edit-selected-outside').fadeOut(200);
                     $.get('back/list.php',{key:'<?php echo $_POST['table']; ?>'+'s'},function (data) {
                         $('#main-down-list').html(data);
                     });
                 });

            });
        });

    </script>

</div>
<? //TOdo: renk kodu güncellemesi yapılacak?>