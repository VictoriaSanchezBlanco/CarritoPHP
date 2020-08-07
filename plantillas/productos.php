<?php 
require_once 'controlPHP/controlBD/bd.php';

	function generarContenidoProducto($codigoProducto) {
		$cadProducto = cargar_categoria($codigoProducto);
		$productos = cargar_productos_categoria($codigoProducto);
?>

	<div class="container contenido-productos" >
		<h1><?php echo $cadProducto['nombre'] ?></h1>
		<p><?php $cadProducto['descripcion'] ?></p>		

		<table class="table table-striped contenido-tabla-productos">
			<thead class="thead-dark">
				<tr>
					<th>CodProd</th>
					<th>Nombre</th>
					<th>Descripción</th>
					<th>Peso</th>
					<th>Stock</th>
					<th>Comprar</th>
				</tr>
			</thead>
			<tbody>		
				<?php foreach($productos as $producto) { ?>
					
				<tr>
					<td><?php echo $producto['CodProd'] ?> </td>
					<td><?php echo $producto['Nombre'] ?></td>
					<td><?php echo $producto['Descripcion'] ?></td>
					<td><?php echo $producto['Peso'] ?></td>
					<td><?php echo $producto['Stock'] ?></td>
					<td>
						<form action="controlCarrito/anadir.php" method='POST'>
							<div class="form-row">
								<div class="form-group col-md-4">
									<input type="number" class="form-control" name="unidades" min="1" max="<?php echo $producto['Stock'] ?>" value="1">
								</div>
								<div class="form-group col-md-8">
									<button type="submit" class="form-control btn btn-outline-dark btn-block">Comprar</button>

									<input name='codigoDelProducto' type='hidden' value='<?php echo $producto['CodProd'] ?>'>
									<input name='codigoCategoria' type='hidden' value='<?php echo $_GET['categoria'] ?>'>
								</div>
							</div>
							
						</form>
					</td>
				</tr>

				<?php } ?>

			</tbody>
		</table>	
	</div>	
<?php } ?>		


