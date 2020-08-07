<?php 
	/*comprueba que el usuario haya abierto sesión o redirige*/
	require 'controlPHP/controlEmail/correo.php';
	require_once 'controlPHP/controlSessions/sesiones.php';
	require_once 'controlPHP/controlBD/bd.php';
	comprobar_sesion();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset = "UTF-8">
		<title>Carrito de la compra</title>		

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
		<link rel="stylesheet" href="css/styles.css">
	</head>
	<body class="fondoCategoria">
		
		<?php 
			require 'plantillas/cabecera.php';		
			/**
			 * $productos almacenará todos los productos que nos devolverá la función 'cargar_productos($codigosProductos).
			 * El modo de hacerlo es pasándole a esta función por parámetro códigos de productos. Esos códigos son las claves del array $_SESSION['carrito'];
			 * 
			 * $_SESSION['carrito'] es un array que irá cambiando su contenido a medida que se va añadiendo productos en 'productos.php' por medio de 'anadir.php'.
			 * Por eso es que $_SESSION['carrito'] tiene como claves el código de los productos, porque 'anadir.php' se encarga de ello.
			**/	
			$productos = cargar_productos(array_keys($_SESSION['carrito']));


			if($productos === FALSE){
		?>
			<div class="container carrito-sinCompra">
				<h1>No hay productos en el pedido 😢😭</h1>
				<?php print_r($_SESSION['carrito']) ?>		

				<a class="btn btn-outline-dark btn-block mt-4" href="categorias.php?categoria=3">Volver</a>
			</div>
		<?php
				exit;
			}
		?>


		<div class="container-fluid contenido-carrito" >

		<?php if (!isset($_GET['confirmar'])) { ?>

			<!-- En el caso de que aún no se haya confirmado ningún pedido se irán añadiendo productos al carrito y mostrando todos los productos en pantalla con posibilidad de remover aquellos que ya no interesen -->
			<h1>Carrito de la compra</h1>
			<?php print_r($_SESSION['carrito']) ?>		

			<div class="row">
				<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
			
						<table class="table table-striped contenido-tabla-carrito">
							<thead class="thead-dark">
								<tr>
									<th>CodProd</th>
									<th>Nombre</th>
									<th>Descripción</th>
									<th>Peso</th>
									<th>Unidades</th>
									<th>Eliminar</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									foreach($productos as $producto) { 
										$unidades = $_SESSION['carrito'][$producto['CodProd']]; 
								?>
								
								<tr>
									<td><?php echo $producto['CodProd'] ?> </td>
									<td><?php echo $producto['Nombre'] ?></td>
									<td><?php echo $producto['Descripcion'] ?></td>
									<td><?php echo $producto['Peso'] ?></td>
									<td><?php echo $unidades ?></td>
									<td>
										<form action="controlCarrito/eliminar.php" method='POST'>
											<div class="form-row">
												<div class="form-group col-md-4">
													<input type="number" class="form-control" name="unidades" min="1" max="<?php echo $unidades ?>" value="1">
												</div>
												<div class="form-group col-md-8">
													<button type="submit" class="form-control btn btn-outline-danger btn-block">Eliminar</button>
												</div>
											</div>
											<input name='codigoDelProducto' type='hidden' value='<?php echo $producto['CodProd']?>'>
										</form>
									</td>
								</tr>
				
								<?php } ?>
								
							</tbody>
						</table>
						
						<a class="btn btn-dark btn-block mt-4" href="categorias.php?categoria=3">Seguir comprando</a>
				</div>			
				<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
					<div class="container contenido-carrito-procesarPedido">
						<h3 class="text-center">Realizar pedido</h3>
						<button type="button" class="btn btn-outline-dark btn-block botonProcesarPedido" data-toggle="modal" data-target="#procesarPedido">Comprar</button>
						<?php include "plantillas/procesar_pedido.php" ?>
						
						
					</div>
					
				</div>			
			</div>

			
		</div>

		<!-- En el caso de que haya realizado el pedido, en su lugar saldrá este mensaje -->
		<?php } else { ?>

		<div class="container carrito-sinCompra">
			<?php 
			
				$resul = insertar_pedido($_SESSION['carrito'], $_SESSION['usuario']['codRes']);
				if($resul === FALSE) {
					echo "<h1>¡Algo ha fallado con la solicitud del pedido! 😅😱</h1>";	
				}else{
					$correo = $_SESSION['usuario']['correo'];
					
					if (isset($_GET['confirmar'])) {
						$conf = enviar_correos($_SESSION['carrito'], $resul, $correo);	
												
						if($conf !== TRUE){
							print_r($resul);
							echo "<h1>No se ha podido realizar el pedido 😅😱</h1>";	
							echo "<p>Error al enviar: $conf <br></p>";
						} else {
							echo "<h1>Pedido procesado 😁😁</h1>";
							echo "<p>Se ha enviado un correo a <b>$correo</b> confirmando el pedido.</p>";
						}		
						//vaciar carrito	
						$_SESSION['carrito'] = [];

						}
					}				
			?>
			
			<a class="btn btn-outline-dark btn-block mt-4" href="categorias.php?categoria=3">Volver</a>
		</div>
			
		<?php } ?>
		
		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	</body>
</html>
