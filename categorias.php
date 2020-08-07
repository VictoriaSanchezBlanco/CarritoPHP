<?php 
	/*comprueba que el usuario haya abierto sesión o redirige*/
	require 'controlPHP/controlSessions/sesiones.php';
	require_once 'controlPHP/controlBD/bd.php';
	comprobar_sesion();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset = "UTF-8">
		<title>Lista de categorías</title>

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
		<link rel="stylesheet" href="css/styles.css">
	</head>
	<body class="fondoCategoria">
		<?php require 'plantillas/cabecera.php';?>

		<div class="container contenido-categorias">
		<?php print_r($_SESSION['carrito']) ?>		

			<h1>Lista de categorías</h1>		
			<!--lista de vínculos con la forma 
			productos.php?categoria=1-->
			<?php
			// 'cargar_categorias()': Función que se encuentra en controlPHP/controlBD/bd.php
			$categorias = cargar_categorias(); 

			// print_r($_SESSION['carrito']);

			if($categorias===false){
				echo "<p class='error'>Error al conectar con la base datos</p>";
			}else{
 
				echo "<form method='GET'>";
				foreach($categorias as $cat){				
					/**
					 * $url guardará la ruta a la que hay que dirigirse para llegar al contenido de cada categoría. 
					 * Depués se mostrará en pantalla una lista ordenada de cada categoría como enlaces a cada categoría.
					 * 
					 * $cat['codCat'] guarda el registro actual del codCat de la tabla 'categorias'. 
					 * $cat['nombre'] guarda el registro actual del nombre de la tabla 'categorias'. 
					 * 
					 * Cuando decimos el registro actual
					 * nos referimos a que tenemos en $categorias guardado un array con todos los registros de la tabla 'categorias' de la 
					 * base de datos 'productos'. Conseguimos este array gracias a la función 'cargar_categorias()'. Para acceder a cada uno
					 * de los registros que hemos obtenido por medio de una sentencia SQL, un medio es este foreach.
					 */

					$url = "categorias.php?categoria=".$cat['codCat'];
					echo "<a class='botonProductos btn btn-outline-light text-dark' href='".$url."'>".$cat['nombre']."</a>";
				}

				echo "</form>";

			}

			
			?>
			<div class="mt-5">
				<?php 
					require "plantillas/productos.php";
					if (isset($_GET['categoria'])) {
						echo "<div id='muestraProducto'>".generarContenidoProducto($_GET['categoria'])."</div>";
					}
				?>
			</div>
		</div>


		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	</body>
</html>