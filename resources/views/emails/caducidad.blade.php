<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>
	<p>
		<strong>Hola {!! $service->cliente->nombre !!}</strong> 
	</p>
	<p>
		Tu servicio tiene cantidades que estan por vencer 
	</p>
	<p>

		<table border="1">
			<thead>
				<th>
					Gasto
				</th>
				<th>
					Comision
				</th>
				<th>
					Beneficio
				</th>
				<th>
					Fecha Inicio
				</th>
				<th>
					Fecha Fin
				</th>
			</thead>
			<tbody>
				@foreach($service->monto as $monto)

				<tr @if(isset($monto->dias)) @if($monto->dias <= 30) style="background:red"@endif @endif>
					<th >{{$monto->gasto}}</th>
					<th>{{$monto->comision}}</th>
					<th>{{$monto->beneficio}}</th>
					<th>{{$monto->fecha}}</th>
					<th>{{$monto->aviso_permanencia}}</th>
				</tr>
				@endforeach
			</tbody>
		</table>
		



		
	</p>
	<p>
		<a href="{{ Request::url() . '/#/dashboard' }}" style="color: #fff; text-decoration: none;">Panel de Control</a>
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