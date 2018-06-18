<?php
include_once('../Xquery.php');
include_once('../config.php');
$db = new xquery($conn);

$location = $db->Xquery('SELECT name,location_id FROM sk_location WHERE parent_id = ?', $_POST['parent_id'], true);
//print_r($location);
if ($_POST['parent_id'] != 0) {
    $upmenu = $db->Xquery('SELECT parent_id FROM sk_location WHERE location_id = ?', $_POST['parent_id']);
} else $upmenu = 0;

echo '<select class="select_location" id="' . $_POST['parent_id'] . '">';
echo '<option value="NULL">..</option>';
//echo '<option value="'.$upmenu.'">Üst konum</option>';

foreach ($location as $x) {
    echo '<option value="' . $x['location_id'] . '">';
    echo $x['name'];
    echo '</option>';
}


echo '</select>';

?>
<div class="select-area" id="<?php echo $_POST['parent_id']; ?>">
    <?php if ($_POST['key'] != 'select'): ?>
        <input type="text" id="location-titre">
        <button id="add_location">Ekle</button>
    <?php endif; ?>
</div>

<script>

    $('#<?php echo $_POST['parent_id'];?>.select_location').change(function () {
        var post = {
            parent_id: $('#<?php echo $_POST['parent_id'];?>.select_location').val()
            <?php if($_POST['key'] == 'select'): ?>
            , key: '<?php echo $_POST['key'];?>'

            <?php endif; ?>
        };
        $('#value-location').val($('#<?php echo $_POST['parent_id'];?>.select_location').val());
        $.post('back/location_select.php', post, function (data) {

            $('#<?php echo $_POST['parent_id'];?>.select-area').html(data);
        });
    });
    <?php if($_POST['key'] != 'select'): //seçim anahtarıyla çağırılan scriptlerde ekleme datası bulunmaz ?>
    $('#add_location').click(function () {
        var post = {
            name: $('#location-titre').val(),
            parent_id:<?php echo $_POST['parent_id'];?>,

        }
        if (post.name === '') {
            $('#location.alert').text('Geçersiz Konum');
        } else {
            $.post('back/insertlocation.php', post, function (data) {
                var da = data;
                // window.location.reload();
                $.get('front/form/locations.php', function (data) {
                    $('#main').html(data);
                    $('#location.alert').text('Kayıt Tamamlandı');
                });

            });
        }
    });
    <?php endif; ?>
</script>
