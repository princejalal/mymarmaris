<script defer type="text/javascript">
    window.onload = function () {
        setTimeout(function () {
            loadScripts()
        }, 4100);
        setTimeout(function () {
            loadCaptcha()
        }, 4120);
    }

    function loadScripts() {
        var scr = document.createElement('script');
        scr.type = 'text/javascript';
        scr.src = 'https://www.google.com/recaptcha/api.js';
        // document.body.appendChild(scr);
        $('#script').append(scr);

        var script = document.createElement('script');
        script.type = 'text/javascript';
        script.src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyBRseiu_2fUbeoaWWubyDQUm5oyuEhLTyI&sensor=false&language=en&libraries=places';
        $('#script').append(script);
    }

    function loadCaptcha() {
        setTimeout(function () {
            var interval = setInterval(function () {
                if (window.grecaptcha) {
                    var widget = document.getElementById('rec');
                    var widgetId1 = grecaptcha.render(widget, {
                        'sitekey': '6LfufFkaAAAAAI99VM5fS3AbYVEQ76c11yDvUdKH',
                        'theme': 'light',
                        'hl': '{{ app()->getLocale() }}'
                    });
                    clearInterval(interval);
                }
            }, 50);
        }, 350);
        setTimeout(function () {
            var intervals = setInterval(function () {
                if (google.maps) {
                    input = document.getElementById('respickupplace');
                    var options = {componentRestrictions: {country: 'tr'}};
                    myautocomplete = new google.maps.places.Autocomplete(input, options);
                }
                clearInterval(intervals);
            }, 100);
        }, 400);
    }

    $(function () {
        $(function () {
            $('.jqueryui-marker-datepicker').datetimepicker({
                showSecond: false,
                dateFormat: 'dd/MM/yyyy',
                timeFormat: 'HH:mm'
            });
        });
    });
</script>