<footer class="footer">
    <div class="container">
        <div class="row align-items-center flex-row-reverse text-pie">
            <div class="col-lg-12 col-sm-12 mt-3 mt-lg-0 text-center">


              Estamos para ti en horario extendido: Lunes a viernes de 9:00 a 7:30pm | Sábados de 9 a 2:30pm  |  Para garantizar nuestras operaciones, solo trabajamos con transferencias interbancarias INMEDIATAS y así mantendrás el tipo de cambio al momento de la operación.

			



            </div>
        </div>
    </div>
</footer>

@if(! \Auth::User()->hasRole('Administrators'))
    <script type="text/javascript">
        var options = {
            whatsapp: "51 946 091 321", // WhatsApp number
            call_to_action: "Ayuda en línea", // Call to action
            position: "right", // Position may be 'right' or 'left'
        };
        var proto = document.location.protocol, host = "getbutton.io", url = proto + "//static." + host;
        var s = document.createElement('script');
        s.type = 'text/javascript';
        s.async = true; s.src = url + '/widget-send-button/js/init.js';
        s.onload = function () {
            WhWidgetSendButton.init(host, proto, options);
            };
        var x = document.getElementsByTagName('script')[0];
        x.parentNode.insertBefore(s, x);
    </script>
@endif
