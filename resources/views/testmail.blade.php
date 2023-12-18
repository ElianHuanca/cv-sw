<p>Fecha de la entrevista: {{ $entrevista['fecha'] }}</p>
<p>Hora de la entrevista: {{ $entrevista['hora'] }}</p>
<p>Nombre del entrevistador: {{ $entrevista['entrevistador'] }}</p>
<p>Direccion: {{$entrevista['direccion']}}</p>
<p>Ciudad: {{$entrevista['ciudad']}}</p>
<p>Url De La Direccion Por Google Maps: <a href="https://www.google.com/maps?q={{$entrevista['latitud']}},{{$entrevista['longitud']}}">Click Aqui</a></p>
<!-- Otros campos de la entrevista -->
