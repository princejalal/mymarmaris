$(document).ready(function () {
    $('li').each(function () {
        $(this).removeClass('active');
    });
    $('.navbar-nav ').find('a[href="' + location.pathname + '"]').closest('li').addClass('active');

});