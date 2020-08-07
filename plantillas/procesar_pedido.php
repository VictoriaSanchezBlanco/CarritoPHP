<div class="modal fade" id="procesarPedido" tabindex="-1" role="dialog" aria-labelledby="procesarPedidoModal" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="procesarPedidoModal">Procesando pedido</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">

				<?php 
		
					// $resul = insertar_pedido($_SESSION['carrito'], $_SESSION['usuario']['codRes']);
					// if($resul === FALSE){
					// 	echo "No se ha podido realizar el pedido<br>";	
					// 	print_r($_SESSION['carrito']);
					// 	print_r($_SESSION['usuario']['codRes']);		
					// }else{
						$correo = $_SESSION['usuario']['correo'];
						echo "<p>Se va a realizar el pedido. <br>Se enviará un correo de confirmación a: <br><b>$correo</b> </p>";	
						
						if (isset($_GET['confirmar'])) {
							$conf = enviar_correos($_SESSION['carrito'], $resul, $correo);	
													
							if($conf!==TRUE){
								echo "Error al enviar: $conf <br>";
							};		
							//vaciar carrito	
							$_SESSION['carrito'] = [];
	
							}
						// }
								
				?>
			</div>
			<div class="modal-footer">
				<!-- 
					En el caso de que se le de a confirmar la realización del pedido se redirigirá a la misma página, pero añadiendo en la cabecera un 'confirmar=si'
					para que pueda ser procesado en la página 'carrito.php' y tomar una condición u otra según se haya confirmado toda la compra del carrito o no
				-->
				<a href="carrito.php?confirmar=si">
					<button type="button" class="btn btn-outline-dark">Confirmar</button>
				</a>
				<button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
			</div>
		</div>
	</div>
</div>


	