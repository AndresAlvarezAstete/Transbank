<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">

	<title>Detalles</title>
</head>
<body>
	<a href="{{ url('/tabla') }}">
		
		<button>Inicio</button>

	</a>

	<h1>ID Transaccion: {{ $compras->id }}</h1>

    <form method="post">

        @csrf
        @method('put')
        
        <h2>Total:</h2>
        <input type="number" name="total" value="{{ $compras->total }}">

        <h2>Estado:</h2>
        <input type="text" name="status" value="{{ $compras->status }}">

        <h2>Fecha Creación:</h2>
        <input type="text" name="created_at" value="{{ $compras->created_at }}">

        <h2>Fecha Modificación:</h2>
        <input type="text" name="updated_at" value="{{ $compras->updated_at }}">

        <br><br>

    </form>
	
</body>
</html>