
<div class="alert" id="signup"></div>
<div class="inscription" id="inside">
    <center>

        <input type="text" name="name" id="u_name" class="inscription" placeholder="Ad">
        <input type="text" name="f_name" id="f_name" class="inscription" placeholder="Soyad">
        <input type="email" name="email" id="email"class="inscription"placeholder="E-Posta">
        <input type="password" name="password" id="password"class="inscription"placeholder="Şifre">
        <input type="password" name="confirmpassword" id="confirmpassword"class="inscription"placeholder="Şifre Tekrarı">
        <button  id="button" class="inscription">Kaydol</button>
    </center>
</div>
<script>
    $(document).ready(function(){
        $('#button.inscription').click(function(){
            // alert('hellowrld');
            //kullanıcının  ', < " gibi karekterleri girmemesi lazım.
            var confirmpassword = $('#confirmpassword').val();
            // "username": $('#username').val(),
            var new_user = {
                "name": $('#u_name').val(),
                "f_name":$('#f_name').val(),
                "email":$('#email').val(),
                "password": $('#password').val()
            }
            // alert(new_user.name);
            var is_okay = true;
            for(var i =0; i<5; i++){
                var item = $('input.inscription').get(i).id;
                if($('#'+item).val() == ''){
                    $('#signup.alert').text('Eksik Girdi');
                    $('#'+item).css('border-color','red');
                    is_okay = false;
                }else{
                    $('#'+item).css('border-color','blue');
                }
            }
            if(new_user.password != confirmpassword){
                $('#signup.alert').text('Yanlış şifre eşleşmesi.');
                $('#confirmpassword').css('border-color','red');
                $('#password').css('border-color','red');
                is_okay = false;
            }

            if(new_user.password.length < 8){
                // alert('hellowrld  ');
                $('#signup.alert').text('Şifre en az 8 karakterli olmalıdır.');
                $('#password').css('border-color','red');
                is_okay = false;
            }
            if(is_okay){
                $.post('back/signup_db.php',new_user,function(data){
                    $('#signup.alert').text(data);
                });
            }



        });
    });

</script>