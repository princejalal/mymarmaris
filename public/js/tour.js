//Tour Tag Clouds
$(document).ready(function () {
    $('#islem').get(0).outerHTML = ('<a href="#">' + $('#islem').text().split(',').join(' </a> <a  href="#">') + ' </a> ');
    var classes = ["teg-1", "teg-2", "teg-3", "teg-4", "teg-5"];
    $("#tegcloud a").each(function () {
        $(this).addClass(classes[~~(Math.random() * classes.length)]);
    });
});
//Tour googlemap Autocomplete
$(document).ready(function () {
    harita();
});
function harita() {
    input = document.getElementById('respickupplace');
    var options = { componentRestrictions: { country: 'tr' } };
    myautocomplete = new google.maps.places.Autocomplete(input, options);
}
