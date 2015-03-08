function Comments(e) {
    $('html, body').css({
    'overflow': 'hidden',
    'height': '100%'
});
    var id = e.id;
    var top = $(window).scrollTop();
    $(".container").append('<div style="background-color:white;height:100%;width:100%;position:absolute;left:0px;top:' + top + 'px;"><div class="row"><div id="caixaComments' + id + '" class="col-xs-10 col-xs-offset-1"></div></div></div>');
    $.getJSON("news/json/" + id, function (data) {
        data.forEach(function (e) {
            console.log(e.user.name);
            $('#caixaComments' + id).append('<div class="row"><div class="col-xs-8"><img src="' + e.user.fotografiaPerfil + '" width="25" heigth="25"></img><span><a href="usuari/profile/'+ e.user.name +'">'+e.user.name+'</a></span><span>: ' + e.comentari + '</span></div></div>');
        });
        $('#caixaComments' + id).append('<div style="margin-top:50px;"><form action="comments/'+id+'" method="POST"><input type="hidden" name="_token" value="'+$('#token').attr('token')+'"><input type="submit" value="Comentar"/><textarea name="comentari" cols="25" rows="3"></textarea></form></div>');
    });
}