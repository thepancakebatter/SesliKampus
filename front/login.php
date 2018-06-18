
<div class="alert" id="login"></div>

<input type="text" name="user_name" id="username" class="login" placeholder="Kullanıcı Adı yada Email">
<input type="password" name="password" id="password" class="login"placeholder="Şifre">
<button  id="loginbutton" class="login" >Giriş</button>

    <script>

    $(document).ready(function(){


        $('#loginbutton').click(function(){

            var authentication = {
                'userid':$('#username.login').val(),
                'password':$('#password.login').val()
            }
            var is_okay = true;
            for(var i =0; i<2; i++){
                var item = $('input.login').get(i).id;
                if($('#'+item).val() == ''){
                    $('#login.alert').text('Eksik Girdi');
                    $('#'+item).css('border-color','red');
                    is_okay = false;
                }else{
                    $('#'+item).css('border-color','blue');
                }
            }
            if(is_okay){
                $.post('back/login_db.php',authentication,function(data){

                      window.location = '/~lebigmac/seslikampus';
                        //TODO:SERVERA GÖRE DÜZENLE

                    // $('#login.alert').text(data);
                });
            }
        });

    });
    // $(document).keypress(function (e) {
    //     if(e.which == 13){
    //         var authentication = {
    //             'userid':$('#username.login').val(),
    //             'password':$('#password.login').val()
    //         }
    //         var is_okay = true;
    //         for(var i =0; i<2; i++){
    //             var item = $('input.login').get(i).id;
    //             if($('#'+item).val() == ''){
    //                 $('#login.alert').text('Eksik Girdi');
    //                 $('#'+item).css('border-color','red');
    //                 is_okay = false;
    //             }else{
    //                 $('#'+item).css('border-color','blue');
    //             }
    //         }
    //         if(is_okay){
    //             $.post('back/login_db.php',authentication,function(data){
    //
    //                 window.location.reload();
    //
    //                 // $('#login.alert').text(data);
    //             });
    //         }
    //     }
    // });
</script>
