<?php
/**
 * Created by PhpStorm.
 * User: lebigmac
 * Date: 12.06.2018
 * Time: 14:21
 */ ?>
<!--todo:menudeki mekanlar harita üzerine konumlasın-->
<div class="menu" id="container" style="display: none;">
    <div class="menu" id="inside">
        <div class="menu" id="top" style="display: flex;">
<!--                        <a href="front/admin.php" data-ajax="false" >AdminPage</a>-->
<!--                        <a href="admin-seslikampus/" data-ajax="false" >Super-->
            <!--                Admin</a>-->
            <span class="menu" id="language">Tr</span>
            <span class="menu" id="leftmenuclose"><i class="material-icons">close</i></span>
        </div>
        <div class="menu" id="mid-top">
            <div id="profil-image" class="menu" style="padding-bottom: 3px; margin-right: 10px;"><i class="material-icons" style="font-size: 30px;text-shadow: none;">account_circle</i></div>
            <div id="authentication" class="menu">
                <?php if(!isset($_SESSION['user'])):?>
                <a id="login" class="menu" data-ajax="false" href="<?php echo  $_SESSION['myHost'].'authentication/login/index.php' ;?>" >Giriş Yap</a>
                <span class='menu' style="font-size: 20px;font-weight: lighter;cursor: default;text-shadow: none;">|</span>
                <a id="signup" class="menu" data-ajax="false" href="<?php echo  $_SESSION['myHost'].'authentication/signup/index.php' ;?>">Kaydol</a>
                <?php else: ?>
                <a><?php echo $_SESSION['user']['name'].' '.$_SESSION['user']['f_name'];?></a>
                <?php endif;?>
            </div>
        </div>
        <div class="menu" id="mid-bottom">
            <div id="locations" class="menu top-title">MEKANLAR</div>
            <div id="locations" class="menu sub-container" ><?php include('front/menu_loc.php'); ?></div>
<!--            <div id="genres" class="menu top-title">TÜRLER</div>-->
<!--            <div id="genres" class="menu sub-container"></div>-->
            <div id="about" class="menu top-title last">HAKKINDA</div>
            <div id="about" class="menu sub-container"></div>

            <!--            <div id="locations" class="menu top-title">AYARLAR</div>-->
        </div>
    </div>
</div>

<style>
    #container.menu {
        background-color: #fba634;
        position: absolute;
        color: #00002d;
        z-index: 100;
        border-right: 15px solid whitesmoke;
        overflow: scroll;

    }

    #top.menu {
        justify-content: space-between;
        padding: 10px;
    }
    .sub-container
    {
        display: none;
    }
    #mid-top.menu {
        padding: 10px;
        display: flex;
        justify-content: center;
        margin-top: 40px;
        border-bottom: 1px solid whitesmoke;
    }
    #mid-bottom.menu{
        transition: 0.5s;
    }

    #login.menu {
        color: #00002d;
        font-weight: lighter;
        text-shadow: none;
        text-decoration: none;
    }

    #login.menu:hover {
        color: whitesmoke;
    }

    #signup.menu {

        text-decoration: none;
        color: #00002d;
        font-weight: bolder;
        text-shadow: none;
        font-size: 20px;
    }

    #signup.menu:hover {
        color: whitesmoke;
    }

    div.top-title {
        padding: 5px;
        border-bottom: 1px solid whitesmoke;
        border-top: 1px solid whitesmoke;
        font-weight: normal;
        font-size: 18px;
        font-family: Bungee;
        text-shadow: none;

    }

    div.top-title:hover {
        cursor: pointer;
        background-color: whitesmoke;
    }

    div.last {
        border-bottom: 2px solid whitesmoke;
    }

    div.selected.top-title {
        border-left: 10px solid whitesmoke;
        padding: 10px;
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
        $('#Map.Xmap').click(function () {
           $('#container.menu').hide("slide", {direction: "left"}, 500);

        });
        if (window.innerWidth < 720) {
            $('#container.menu').css('width', '60%');
        } else {
            $('#container.menu').css('width', '35%');
        }

    });

    $('.top-title').click(function () {

        var id = $(this).get(0).id;
        for (var i = 0; i < $('.top-title').length; i++) {
            if ($('.top-title').get(i).id === id) {
                $('#' + $('.top-title').get(i).id + '.top-title').addClass('selected');
                $('#'+$('.top-title').get(i).id+'.sub-container').slideDown(500);
            } else {

                $('#' + $('.top-title').get(i).id + '.top-title').removeClass('selected');
                $('#'+$('.top-title').get(i).id+'.sub-container').slideUp(500);
            }
        }

    });
</script>