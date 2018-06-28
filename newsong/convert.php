<?php
session_start();
/**
 * Created by PhpStorm.
 * User: lebigmac
 * Date: 28.06.2018
 * Time: 18:26
 */
include_once('../head.php');
include_once('../front/header.php');

?>
<style>
    #toggle.draggable-list {
        display: none;
    }

    #profil-icon.header {
        display: none;
    }
    .input.login{
        width: 100%;
        border:none;
        border-bottom: 2px solid #eb8f00;
        height: 40px;
        margin-top: 20px;
    }
    #submit.login{
        color: #c52c01;
        border:none;
        background-color: #fba634;
        cursor: pointer;
        font-size: 20px;
        width: 100%;
        height: 40px;
        margin-top: 20px;
    }

</style>
<script>
    $(document).ready(function ($) {
        $('#container.login').css('margin-top', $('#container.header').css('height'));
    });
    </script>
<div style="margin-top: 40px;">
    Lütfen Bekleyin...
<?php //echo $_SESSION['sound_id'];

$old_path = getcwd();
chdir('../media/');
$output = shell_exec('bash convert.sh '.$_SESSION['sound_id']);
chdir($old_path);
//echo $output;

?>

</div>
<script>
    window.location = '<?php echo $_SESSION['myHost']?>';
</script>
