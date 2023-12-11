<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/cliente.css')}}">
    <title>ClinicaSonrisitas</title>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap"></script>
</head>
<body class="container">
    <div class="men">
        <nav>
            <div class="imagen">
                <img src="{{ asset('images/diente.png ')}}" alt="">
                <p>CLÍNICA DENTAL SONRISITAS</p>
            </div>
            <a href="#inicio">INICIO</a>
            <a href="{{ route('misreservas') }}">REALIZAR RESERVAS</a>
            @can('Admin.index')
                <a href="{{ route('home') }}">GESTIONAR</a>
            @endcan
            <!-- <a href="{{ route('reservasCliente.index') }}">RESERVAS</a> -->
            <!-- <a href="{{ route('misreservas') }}">MIS RESERVAS</a> -->
            <a href="#servicios">SERVICIOS</a>
            @auth
                <a href="{{ route('perfil.editar') }}">Perfil</a>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">LOG OUT</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @else
                <a href="{{ route('login') }}">LOGIN</a>
                <a href="{{ route('register') }}">SIGN IN</a>
            @endauth
        </nav>
    </div>
    <div id="inicio" class="pri">
        <div class="fondo">
            <h1>CLINICA SONRISITAS</h1><br>
            <h3>
                Mejora tu sonrisa hoy. <br>
                Confía en nosotros para obtener el mejor Cuidado dental en Potosí.
            </h3>    
        </div>
    </div>
    <div class="texto">
        <h2>Sobre nosotros</h2><br>
        <p>            
            En Clinica Dental Sonrisitas, nos enorgullece ofrecer servicios dentales de calidad en Potosí, Villa Imperial de Potosí, Bolivia. 
            Nuestro equipo de dentistas altamente capacitados y amables se dedica a brindarle una experiencia dental excepcional. <br>
            Con un enfoque en la atención personalizada y la última tecnología dental, nos esforzamos por superar las expectativas de nuestros pacientes. 
            Ya sea que necesite un simple chequeo dental o un tratamiento dental más complejo, estamos aquí para cuidar de su salud bucal. 
            Confie en nosotros para brindarle una sonrisa saludable y radiante.
        </p>
    </div>
    <div id="servicios" class="seg">
        <h2>Servicios</h2><br>
        <div class="ser">
            <div class="lim">
                <div class="textos">
                    <h6 for="">Limpieza</h6> <br>
                    <label for="">Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe, mollitia aliquid qui quis reprehenderit aut temporibus obcaecati nobis magni, quibusdam ea officiis? Soluta velit quisquam inventore deleniti officiis et alias!</label><br>
                </div>
            </div>
            <div class="bla">
                <div class="textos">
                    <h6 for="">Blanqueo</h6> <br>
                    <label for="">Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe, mollitia aliquid qui quis reprehenderit aut temporibus obcaecati nobis magni, quibusdam ea officiis? Soluta velit quisquam inventore deleniti officiis et alias!</label><br>
                </div>
            </div>
            <div class="car">
                <div class="textos">
                    <h6 for="">Carillas</h6> <br>
                    <label for="">Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe, mollitia aliquid qui quis reprehenderit aut temporibus obcaecati nobis magni, quibusdam ea officiis? Soluta velit quisquam inventore deleniti officiis et alias!</label><br>
                </div>
            </div>
            <div class="cor">
                <div class="textos">
                    <h6 for="">Coronas</h6>  <br>
                    <label for="">Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe, mollitia aliquid qui quis reprehenderit aut temporibus obcaecati nobis magni, quibusdam ea officiis? Soluta velit quisquam inventore deleniti officiis et alias!</label><br>
                </div>
            </div>
            <div class="imp">
                <div class="textos">
                    <h6 for="">Implantes</h6>  <br>
                    <label for="">Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe, mollitia aliquid qui quis reprehenderit aut temporibus obcaecati nobis magni, quibusdam ea officiis? Soluta velit quisquam inventore deleniti officiis et alias!</label><br>
                </div>
            </div>
            <div class="pro">
                <div class="textos">
                    <h6 for="">Protesis</h6> <br>
                    <label for="">Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe, mollitia aliquid qui quis reprehenderit aut temporibus obcaecati nobis magni, quibusdam ea officiis? Soluta velit quisquam inventore deleniti officiis et alias!</label><br>
                </div>
            </div>           
        </div>
    </div>

    <div class="testimonio">
        <p>
            "Estoy muy agradecida con la Clínica Dental Sonrisitas. El equipo de dentistas es profesional y amable, y me hicieron sentir cómoda durante mi visita. 
            El servicio fue excelente y estoy muy contenta con los resultados. ¡Recomendaría esta clínica a todos! <br>
            - María González
        </p>
    </div>

    <div class="slider">
        <h3>Galeria</h3><br>
        <div class="slide-track">
           <div class="slide"><img src="{{ asset('images/carrusel/d1.jpg')}}" alt=""></div>
           <div class="slide"><img src="{{ asset('images/carrusel/d2.jpg')}}" alt=""></div>
           <div class="slide"><img src="{{ asset('images/carrusel/d3.jpg')}}" alt=""></div>
           <div class="slide"><img src="{{ asset('images/carrusel/d4.jpg')}}" alt=""></div>
           <div class="slide"><img src="{{ asset('images/carrusel/d5.jpg')}}" alt=""></div>
        </div>
    </div>

    <div class="testimonio2">
        <p>
            "Estoy encantado con la clínica Cloe, son unos grandes profesionales, el trato es inmejorable y hacen un magnífico trabajo. Un millón de gracias !!!"<br>
            - Victor Ullate
        </p>
    </div>

    <div class="ubi">
        <h2>Nuestra Ubicacion</h2><br>
        <p>Dirección: Calle Principal, Ciudad, País</p>
        <p>Teléfono: +123 456 789</p>
        <p>Correo Electrónico: info@clinicasonrisitas.com</p>
        <p>Horario: Lunes a Viernes - 8am a 6pm</p>
    </div>
    <div class="map" id="wrapper-9cd199b9cc5410cd3b1ad21cab2e54d3">
		<div id="map-9cd199b9cc5410cd3b1ad21cab2e54d3"></div><script>(function () {
        var setting = {"query":"Universidad Autónoma Tomas Frias Central, Potosí, Bolivia","height":500,"satellite":false,"zoom":16,"placeId":"ChIJgb2mhHZO-ZMRGMvZYny4P_Q","cid":"0xf43fb87c62d9cb18","coords":[-19.5841591,-65.756678],"lang":"es","queryString":"Universidad Autónoma Tomas Frias Central, Potosí, Bolivia","centerCoord":[-19.5841591,-65.756678],"id":"map-9cd199b9cc5410cd3b1ad21cab2e54d3","embed_id":"1029676"};
        var d = document;
        var s = d.createElement('script');
        s.src = 'https://1map.com/js/script-for-user.js?embed_id=1029676';
        s.async = true;
        s.onload = function (e) {
          window.OneMap.initMap(setting)
        };
        var to = d.getElementsByTagName('script')[0];
        to.parentNode.insertBefore(s, to);
      })();</script><a href="https://1map.com/es/map-embed">1 Map</a></div>
</body>
</html>