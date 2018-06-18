<h3 class="inputs" id="tags">Yeni etiket</h3>
<div class="edit-selected-outside" id="tag"><span class="close-edit"><i class="material-icons">close</i></span><div class="edit-selected" id="tag"></div></div>
<div id ='main-down'></div>
<div id ='main-down-list'></div>

<script>
    $(document).ready(function () {
        $.get('back/list.php',{key:'tags'},function (data) {
            $('#main-down-list').html(data);
        });
    });
    $('.inputs').click(function () {
        var id = $(this).get(0).id;
        $.get('front/form/add_'+id+'.php',function (data) {
            $('#main-down').html(data);
        });
    });
</script>