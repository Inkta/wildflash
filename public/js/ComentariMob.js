function Comments(e) {
    $('body','html').css({
        'overflow': 'hidden',
        'height': '100%'
    });
    var id = e.id;
    var top = $(window).scrollTop();
    $(".container").append('<div id="temporal" style="background-color:white;height:100%;width:100%;position:absolute;left:0px;top:' + top + 'px;"><div class="row"><div id="caixaComments' + id + '" class="col-xs-10 col-xs-offset-1"></div></div></div>');
    $('#caixaComments' + id).append('<div style="margin-bottom:20px;"class="row"><div class=col-xs-12"><button class="btn btn-default" style="width:100%;"onclick="desfes()"><span class="glyphicon glyphicon-arrow-left"></span></button></div></div>');
    $('#caixaComments' + id).append('<nav id="comentaris'+id+'"><ul id="comentarisul'+id+'"></ul></nav>');
    $('#comentaris'+id).css({
        'height':'250px',
        'overflow':'hidden',
        'overflow-y':'scroll'
    });
    
    
    
    $.getJSON("news/json/" + id, function (data) {
        data.forEach(function (e) {
            $('#comentarisul'+id).append('<li style="margin-top:30px;"role="presentation"><img src="' + e.user.fotografiaPerfil + '" width="25" heigth="25"></img><span><a href="usuari/profile/' + e.user.name + '">' + e.user.name + '</a></span><span>: ' + e.comentari + '</span></li>');
        });
        $('#temporal').append('<div style="position:fixed;bottom:0px;left:0px;margin-top:20px;"><form action="comments/' + id + '" method="POST"><input type="hidden" name="_token" value="' + $('#token').attr('token') + '"><button class="btn btn-default>"<input type="submit" value="Comentar"/>Comenta</button><textarea name="comentari" cols="25" rows="3"></textarea></form></div>');
        
        
    });
}

function desfes() {
    $('html, body').css({
        'overflow': 'visible',
        'height': '100%'
    });
    $('#temporal').remove();
}