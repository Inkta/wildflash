function mostraComentaris(e) {
    $('#commentsInv' + e.id).removeAttr('style');
    $('#' + e.id).remove();
    $('#mostraComentaris' + e.id).append('<a style="cursor:pointer" id="' + e.id + '"onclick="amagaComentaris(this)">Amaga Comentaris</a>');
}

function amagaComentaris(e) {
    $('#commentsInv' + e.id).attr('style', 'display:none;');
    $('#' + e.id).remove();
    $('#mostraComentaris' + e.id).append('<a style="cursor:pointer" id="' + e.id + '"onclick="mostraComentaris(this)">Mostra Comentaris</a>');
}
