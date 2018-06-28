<?php
session_start();
/**
 * Created by PhpStorm.
 * User: lebigmac
 * Date: 28.06.2018
 * Time: 00:09
 */
include_once('../../head.php');
include_once('../../front/header.php');

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
<div class="signup" id="container">
    <div class="login" id="logo" style="width: 75px;height: 75px;margin: auto; margin-top: 100px; background-color: red;"></div>
    <div class="login" id="form" style="margin: auto; margin-top: 60px; width: 80%;">
        <form method="post" action="post.php" style="display: block;" >
            <div id="alert"></div>
            <div style="display: block;">
                <input type="email" name="email" class="login input" id="email" placeholder="E-posta:" data-role="none">
                <input type="password" name="password" class="login input" id="password" placeholder="Şifre:" data-role="none">
                <button data-role="none" data-ajax="false" class="login" id="submit">Giriş</button>
            </div>
        </form>
    </div>
</div>
<script>

</script>