var myInterval;
var SeciliCard;
var SeciliEtiket;
var SeciliResim;

function etiketle() {

    if ($(SeciliEtiket + ' li').length > 1) {
        $(SeciliEtiket + ' li:gt(0)').hide();
        $(SeciliEtiket).css("display", "block");
        $(SeciliEtiket + ' li:first-child').hide()
            .next('li').show()
            .end().appendTo(SeciliEtiket);
    }
    if ($(SeciliEtiket + ' li').length == 1) {
        $(SeciliEtiket + ' li:gt(0)').show().appendTo(SeciliEtiket);
        $(SeciliEtiket).css("display", "block");
    }
}
function etiketKaldir() {
    $(SeciliEtiket).hide();
    clearInterval(myInterval);
}
function resimDegistir() {
    SeciliCard = $("#" + this.id).find('.etiket');
    SeciliEtiket = "#" + SeciliCard.attr('id');
    var HiddenGif = $("#" + this.id).find('input:hidden');
    try {
        SeciliResim = "#" + $("#" + this.id).find('.gif').attr('id');
        var src = $(SeciliResim).attr("src");
        $(SeciliResim).attr('src', HiddenGif.val());
        HiddenGif.val(src);
    } catch (e) {

    }
    etiketle();
    myInterval = setInterval(etiketle, 900);
}
function eskiresim() {
    SeciliCard = $("#" + this.id).find('.etiket');
    SeciliEtiket = "#" + SeciliCard.attr('id');
    var HiddenGif = $("#" + this.id).find('input:hidden');
    try {
        SeciliResim = "#" + $("#" + this.id).find('.gif').attr('id');
        var src = $(SeciliResim).attr("src");
        $(SeciliResim).attr('src', HiddenGif.val());
        HiddenGif.val(src);
    } catch (e) {

    }
    etiketKaldir();
}
$('.etiket').hover(function ()
{
    clearInterval(myInterval);
}, function ()
    {
        myInterval = setInterval(etiketle, 900);
    });
$(window).on("load resize", function () {
    if ($(this).width() > 576) {
        $('.mycard').hover(resimDegistir, eskiresim)
    } else {
        $(function () {
            $('.lazy').Lazy();
        });
    }
})
