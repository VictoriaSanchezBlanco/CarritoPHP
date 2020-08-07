<?php
use PHPMailer\PHPMailer\PHPMailer;
require dirname(__FILE__)."/vendor/autoload.php";

/*
   Esta función recibirá tres parámetros, $carrito, $pedido y $correo, con la finalidad de enviar un correo electrónico.
   Para ello utilizará otras dos funciónes en su ejecución.
   Estos parámetros son insertados en "plantillas/procesar_pedidos.php" que es el responsable de hacer la llamada a esta función.
 */
function enviar_correos($carrito, $pedido, $correo){
	// El cuerpo del correo será almacenado en una variable llamada $cuerpo y ésta llama a la función "crear_correo", 
	// pasándole los parámetros mencionados anteriormente. 
	$cuerpo = crear_correo($carrito, $pedido, $correo);

	return enviar_correo_multiples("$correo, pedidos@empresafalsa.com", 
                        	$cuerpo, "Pedido $pedido confirmado");
}

/*
    Esta función recibirá tres parámetros, $carrito, $pedido y $correo.
    La variable $texto almacenará un conjunto de elementos a base de encabezado, texto y tabla.
    La variable $productos almacenará un array de claves a traves de la ejecucions de la la función "cargar_producto" que, a su vez,
    utilizará la función array_keys, pasándole el parámetro $carrito que contendrá un array con los productos que hayamos seleccionado en el apartado 'categorías'.
    
 */
function crear_correo($carrito, $pedido, $correo){
	$texto = "<h1>Pedido nº $pedido </h1><h2>Restaurante: $correo </h2>";
	$texto .= "Detalle del pedido:";
	$productos = cargar_productos(array_keys($carrito));	
	$texto .= "<table>"; 
	$texto .= "<tr><th>Nombre</th><th>Descripción</th><th>Peso</th><th>Unidades</th></tr>";

	/*
	   El foreach recorrerá la variable $productos que contiene un array con las claves de todos los productos
	   Los cuales iremos separando mediante varias variables $cod, $nom, $des, $peso y asociandolo con los apartados correspondientes a la base de datos.
	   $unidades almacenará $_SESSION['carrito'] que es un array de los productos seleccionados junto con la variable $cod que en este caso ase referencia 
	   a CodProd de la base de datos de la tabla productos. 
	 */
	foreach($productos as $producto){
		$cod = $producto['CodProd'];
		$nom = $producto['Nombre'];
		$des = $producto['Descripcion'];
		$peso = $producto['Peso'];
		$unidades = $_SESSION['carrito'][$cod];									    
		$texto .= "<tr><td>$nom</td><td>$des</td><td>$peso</td><td>$unidades</td>
		<td> </tr>";
	}
	$texto .= "</table>";	
	return $texto;
}

/*
   función que se hará cargo de generar un correo basico con los parámetros minimos requeridos para su envio,
   atraves del uso del objeto PHPMailer y sus funciónes internas correspondientes.
   $mail es la variable que usaremos para 
 */
function enviar_correo_multiples($lista_correos,  $cuerpo,  $asunto = ""){
		$mail = new PHPMailer();		
		$mail->IsSMTP(); 					
		$mail->SMTPDebug  = 0;  // cambiar a 1 o 2 para ver errores
		$mail->SMTPAuth   = true;                  
		$mail->SMTPSecure = "tls";                 
		$mail->Host       = "smtp.gmail.com";      
		$mail->Port       = 587;                   
		$mail->Username   = "";  //usuario de gmail
		$mail->Password   = ""; //contraseña de gmail          
		$mail->SetFrom('noreply@empresafalsa.com', 'Sistema de pedidos');
		$mail->Subject    = $asunto;
		$mail->MsgHTML($cuerpo);
		/*partir la lista de correos por la coma*/

		//
		$correos = explode(",", $lista_correos);
		foreach($correos as $correo){
			$mail->AddAddress($correo, $correo);
		}
		if(!$mail->Send()) {
		  return $mail->ErrorInfo;
		} else {
		  return TRUE;
		}
	}	
