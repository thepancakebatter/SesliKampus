<?php session_start();
echo $_SESSION['myHost'];?>
<script>
    var link ='<?php echo  $_SESSION['myHost']; ;?>';
</script>

<?php
$_SESSION['permission'] = 0;
unset($_SESSION['user']);
session_destroy();
?>

<script>
       window.location = link;

</script>
