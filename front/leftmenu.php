<?php
/**
 * Created by PhpStorm.
 * User: lebigmac
 * Date: 12.06.2018
 * Time: 14:21
 */ ?>

<div class="menu" id="container" style="display: none;">
    <div class="menu" id="inside">
        <div class="menu" id="top" style="display: flex;">
            <a href="front/admin.php" data-ajax="false" >AdminPage</a>
            <a href="admin-seslikampus/" data-ajax="false" >Super
                Admin</a>
            <span class="menu" id="leftmenuclose"><i class="material-icons">close</i></span>
        </div>
    </div>
</div>
<style>
    #container.menu {
        background-color: whitesmoke;
        position: absolute;
        z-index: 100;
        width: 35%;
    }

    #top.menu {
        justify-content: space-between;
    }
</style>
<script>
    $('#container.menu').css('height', window.innerHeight);
    $(document).ready(function () {
        $('#profil-icon.header').click(function () {
            $('#container.menu').show("slide", {direction: "left"}, 500);
        });
        $('#leftmenuclose.menu').click(function () {
            $('#container.menu').hide("slide", {direction: "left"}, 500);
        });
    });
</script>