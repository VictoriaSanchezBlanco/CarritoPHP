<!DOCTYPE html>
<html>
	<head>
		<title>Formulario de login</title>
		<meta charset = "UTF-8">

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
		<link rel="stylesheet" href="css/styles.css">

	</head>
	<body class="index-fondo">	
		<!-- 
			Reemplaza los caracteres con significado especial en HTML con identidades &-escapadas.
			Por ejemplo, si ponenos dentro de un texto de HTML "Así se pone en <b>negrita</b>" y queremos que estas etiquetas de '<b>'
			se muestren literalmente y no se interpreten, tendríamos que poner $lt;b>.
			Eso es lo que haría este  'htmlspecialchars', y así le añadimos seguridad a las llamadas o redirecciones.
		-->
		<header class="container">
			<div class="jumbotron p-4">
				<h1 class="display-3">Carrito de la compra</h1>
				<p class="lead">Productos para los restaurantes</p>
				<hr class="my-2">
				<p class="lead">
					<a class="btn btn-dark btn-lg mt-2 informacionDetallada" data-toggle="collapse" href="#detallesProyecto" role="button" aria-expanded="false" aria-controls="detallesProyecto">Información detallada</a>
					<div class="collapse" id="detallesProyecto">
						<div class="card card-body">
							<p>Este ejercicio engloba el funcionamiento de un carrito de compra utilizando php, y mysql. </p>
							<p>La finalidad del ejercicio es entender dicho funcionamiento del código e ir comentándolo para poder realizar mejoras y tratar de conseguir un mejor funcionamiento.</p>


							<p>
								Los cambios a realizar marcados por la profesora son: <br>
								<ul>
									<li>Al comprar un producto, que no permita comprar más productos de los que hay en el Stock.</li>
									<li>Al finalizar la comprar y darle al botón deberá aparecer un mensaje de confirmaciñon de si queremos realizar el pedido.</li>
								</ul>
							</p>						
						</div>
					</div>

				</p>
			</div>
		</header>

		<main class="container contenido-login">
			<form action = "<?php echo htmlspecialchars("controlPHP/controlSessions/login.php");?>" method = "POST">
				<h1 class="mb-4">Login</h1>
				<div class="form-row">
					<div class="form-group col-md-6">
						<label for="usuarioLogin">Usuario</label>
						<input type="text" class="form-control" id="usuarioLogin" name="usuario" value = "<?php if(isset($usuario))echo $usuario;?>" placeholder="usuario@nombre.dominio">
					</div>
					<div class="form-group col-md-6">
						<label for="passwordLogin">Clave</label>
						<input type="password" class="form-control" name="clave" id="passwordLogin">
					</div>
				</div>
				<small>
					<!-- 
						Solo se entrará por aquí si no se ha iniciado ninguna sesión y se ha intentado a acceder
						a una de las páginas que requiera acreditación 
					-->
					<?php if(isset($_GET["redirigido"])){
						echo "<p>Haga login para continuar</p>";
					}?>
					<!-- Se entrará por aquí si se ha introducido mal un usuario. -->
					<?php if(isset($_GET["error"])){
						echo "<p> Revise usuario y contraseña</p>";
					}?>
				</small>
				<button type="submit" class="btn btn-dark">Submit</button>
			</form>		
		</main>


		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	</body>
</html>