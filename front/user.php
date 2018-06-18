<?php

//TODO: kişilsel sayfaların veri tasarımı ve görsel tasarımı
?>


<img src="media/profil-image/<?php echo $_SESSION['user']['profil_icon']; ?> " style="width: 50px;height: 50px;"> </img>
<h4><?php echo $_SESSION['user']['name'].' '.$_SESSION['user']['f_name']; ?></h4>
<h4>Etkinliklerim</h4>
