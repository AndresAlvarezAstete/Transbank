<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">

	<title>Tabla</title>
</head>
<body>
	
	<table border="1">
		
		<tr>
			<th>Numero de Transaccion</th>
			<th>Detalles</th>
		</tr>
		<thead>
			
			<tbody>
				
				@foreach($compras as $item)

				<tr>
					<td>{{  $item->id }}</td>
					
					<td>
						<a href="{{ url('/detalle_compra', ['id' => $item->id])}}">
							
							<button>Ver</button>

						</a>
                        
                    </td>

				</tr>

				@endforeach	

			</tbody>

		</thead>
		
	</table>
	
</body>
</html>