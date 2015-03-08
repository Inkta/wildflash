function mostraComentaris(e) {
    $('#commentsInv' + e.id).removeAttr('style');
    $('#' + e.id).remove();
    $('#mostraComentaris' + e.id).append('<button id="' + e.id + '"onclick="amagaComentaris(this)">Amaga Comentaris</button>');
}

function amagaComentaris(e) {
    $('#commentsInv' + e.id).attr('style', 'display:none;');
    $('#' + e.id).remove();
    $('#mostraComentaris' + e.id).append('<button id="' + e.id + '"onclick="mostraComentaris(this)">Mostra Comentaris</button>');
}
