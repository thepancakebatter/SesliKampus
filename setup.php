<?php
/**
 * Created by PhpStorm.
 * User: lebigmac
 * Date: 17.06.2018
 * Time: 08:59
 */

/*
 * if your config file is not exist,setup.php will create new config.php on your server.
 *  config file contain base informations about your web site and your data base
 *
 * TODO:add script for initialise database table.
 */
session_start();
?>


<?php if (!file_exists('config.php')): ?>
    <div class="setup">
        <h2>Config.php doesn't exists</h2>
        <form method="post">
            <div>Database_host:</div>
            <input type="text" name="database_host" value="localhost">
            <div>User:</div>
            <input type="text" name="user" value="root">
            <div>Password:</div>
            <input type="text" name="password"value="jarrive33">
            <div>Db Name:</div>
            <input type="text" name="dbname"value="sesli_deneme">
            <button>Submit</button>
        </form>
    </div>
<?php endif; ?>

<?php
if (isset($_POST['database_host']) && isset($_POST['user']) && isset($_POST['password']) && isset($_POST['dbname'])) {
    $host = $_POST['database_host'];
    $user = $_POST['user'];
    $password = $_POST['password'];
    $dbname = $_POST['dbname'];
    $key = true;
} else {
    $key = false;
}
if (!file_exists('config.php') && $key) {
    $txt = "<?php \$conn = array('$host','$user','$password','$dbname'); 
    \$host = \$_SERVER['REQUEST_SCHEME'].'://';
    \$host .= \$_SERVER['HTTP_HOST'];
    \$host .= \$_SERVER['REQUEST_URI'];
      define('SK_PATH',dirname(__FILE__));
    include_once ('myfunction.php');
    ?>";

//    include_once ('setup/database-instalation.php');

    $file = fopen('config.php', 'w');
    fwrite($file, $txt);
    fclose($file);


    unset($host);unset($user);unset($password);unset($dbname);unset($key);

    echo "<script>window.location.href = '".$_SESSION['host']."/admin-seslikampus/'; </script>";
}
?>

