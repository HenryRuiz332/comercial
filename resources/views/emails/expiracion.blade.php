<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>
	<p>
		<strong>Hola </strong>{!! $servicio->cliente->nombre !!}
	</p>
	<p>
		Te informamamos que tu servicio {!! $servicio->servicio->nombre !!} le resta 1 mes de permanencia
	</p>

	<p>
		<strong>
			Gracias;
		</strong>
	</p>
	<p>
		<strong>
			Saludos de parte del equipo de {{ env('APP_NAME') }}
		</strong>
	</p>
</body>
</html>