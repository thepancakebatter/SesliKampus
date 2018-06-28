<?php
/**
 * Created by PhpStorm.
 * User: lebigmac
 * Date: 28.06.2018
 * Time: 10:28
 */

?>

<span id="sound-add-button">
    <i style="font-size: 60px;text-shadow:0px 0px 3px #0c3d5d" class="material-icons" >
        add_circle
    </i>
</span>
<script>
    $(document).ready(function () {
        if (/Android/i.test(navigator.userAgent)) {

        }else {
            // $('#sound-add-button').css('display','none');
        }
       $('#sound-add-button').css('bottom',($('#footer-out.player-footer').innerHeight()+20)+'px');
        $('#sound-add-button').click(function () {
            var isUser = <?php if(isset($_SESSION['user'])){echo 'true';}else{echo 'false';} ?>;
            if(isUser){
                window.location = '<?php echo $_SESSION['myHost']; ?>newsong/index.php';
            }else{
                window.location = '<?php echo $_SESSION['myHost']; ?>authentication/login/index.php';
            }
        });
    });

</script>
<style>
    #sound-add-button{
        position: absolute;
        color: #CC3300;
        text-align: center;
        cursor:pointer;
        right: 20px;
    }

</style>