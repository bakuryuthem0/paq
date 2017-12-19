<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Recuperar contraseña | nombredelapagina</title>
	<link rel="stylesheet" href="">
</head>
<body>
	<table class="table">
		<thead>
			<tr>
				<td>Logo</td>
				<td>Nombre de la pagina</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td colspan="2">
					Usted ha recibido este correo para recuperar su contraseña a traves del portal nombredelapagina, si usted no solicito este cambio ignore este email, de lo contrario haga clic <a target="_blank" href="{{ URL::to('recuperar-password/'.$hash) }}">aqui</a> o visite el siguiente link:
					<br>
					{{ URL::to('recuperar-password/'.$hash) }}
					<br>
					Este correo tiene una caducidad de 2 horas, luego de este tiempo debera volver a solicitar el enlace.
				</td>
			</tr>
			<tr>
				<td colspan="2">
					Todos los derechos reservados | nombredelapagina 2017
				</td>
			</tr>
		</tbody>
	</table>
</body>
</html>