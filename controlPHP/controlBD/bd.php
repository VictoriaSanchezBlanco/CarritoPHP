<?php

// Esta función acepta dos parámetros que será el nombre de un archivo xml y el esquema xsd de ese archivo xml
function leer_config($nombre, $esquema){
	// Crea un objeto de tipo documento. El documento que se cargará dentro de este objeto será el que le pasemos como parámetro $nombre
	// El esquema de verificación que le pasaremos es el indicado por $esquema.
	// $confing y $res son variables que tan solo las usaremos para verifcar que los datos de nuestros achivos xml y xsd pasados por
	// parametros son correctos y no tienen errores.
	$config = new DOMDocument(); 
	$config->load($nombre);
	$res = $config->schemaValidate($esquema);

	// En el caso de que haya algún fallo en la carga del documento lanzaremos una excepción con el mensaje aquí indicado.
	if ($res===FALSE){ 
	   throw new InvalidArgumentException("Revise fichero de configuración");
	} 		

	/**
		En en el caso que nuestros archivos xsd y xml sean correctos no habrá lanzado el try anterior y entrara por aqui.
		$datos cargará todos los datos del archivo xml pasados por el parámetro llamado $nombre.
		$ip almacenará el contenido de las etiquetas ip del archivo xml que tenemos cargados en $datos
		$nombre almacenará el contenido de las etiquetas nombre del archivo xml que tenemos cargados en $datos
		$usu almacenará el contenido de las etiquetas usuario del archivo xml que tenemos cargados en $datos
		$clave almacenará el contenido de las etiquetas clave del archivo xml que tenemos cargados en $datos

	 */
	$datos = simplexml_load_file($nombre);	
	$ip = $datos->xpath("//ip");
	$nombre = $datos->xpath("//nombre");
	$usu = $datos->xpath("//usuario");
	$clave = $datos->xpath("//clave");

	// $cad almacenará una string formateada gracias a "sprintf" que será la cabecera a la conexión a la base de datos
	// "sprintf("mysql:dbname=%s;host=%s", $nombre[0], $ip[0])" se sustituye "%s" por los parámetros que hay situados 
	// después de la coma respectivamente. 
	$cad = sprintf("mysql:dbname=%s;host=%s", $nombre[0], $ip[0]);

	// $resul es un array que almacenará la cabecera, nombre usuario y clave para la conexión a la base de datos.
	$resul = [];
	$resul[] = $cad;
	$resul[] = $usu[0];
	$resul[] = $clave[0];
	// var_dump($resul);
	return $resul;
}


function comprobar_usuario($nombre, $clave){

	//$res almacenará lo que devuelve la función "leer_config".
	// 'dirname(__FILE__)' devuelve la ruta absoluta del fichero actual. En este caso la ruta absoluta de bd.php
	$res = leer_config(dirname(__FILE__)."/filesConfigurationBD/configuracion.xml", dirname(__FILE__)."/filesConfigurationBD/configuracion.xsd");

	/*
		$bd es una conexión a la base de datos mediante la creacion del objeto PDO.
		$res[0] es la cabecera a la conexion de la base de datos.
		$res[1] es el nombre de usuario.
		$res[2] es la clave de usuario.
	 */
	$bd = new PDO($res[0], $res[1], $res[2]);

	// $ins almacenará una sentecia sql. En este caso, la sentencia devuelve el codRes y correo de la tabla restaurante.
	// donde el resgistro correo coincida con el valor del parámetro $nombre y el registro clave conicida con el valor del parámetro $clave.
	$ins = "select codRes, correo from restaurantes where correo = '$nombre' 
			and clave = '$clave'";

	//$resul almacenará la ejecución de la sentencia sql $ins. Solo debe almacenar un registro.
	// En el caso de que así sea devolverá el resultado de la sentecia sql; en caso contrario devolverá un False
	$resul = $bd->query($ins);	
	if($resul->rowCount() === 1){		
		return $resul->fetch();		
	}else{
		return FALSE;
	}
}

function cargar_categorias(){
	$res = leer_config(dirname(__FILE__)."/filesConfigurationBD/configuracion.xml", dirname(__FILE__)."/filesConfigurationBD/configuracion.xsd");
	$bd = new PDO($res[0], $res[1], $res[2]);

	// La sentencia SQL que almacena $ins devuelve el codCat y nombre de la tabla categorias.
	$ins = "select codCat, nombre from categorias";
	$resul = $bd->query($ins);	

	// Si no puede cargar lo solicitado o el número de filas es 0 devuelve un false. En otro caso devuelve todos los registros de la sentencia SQL como un array.
	if (!$resul) {
		return FALSE;
	}
	if ($resul->rowCount() === 0) {    
		return FALSE;
    }
	//si hay 1 o más
	return $resul;	
}

function cargar_categoria($codCat){
	$res = leer_config(dirname(__FILE__)."/filesConfigurationBD/configuracion.xml", dirname(__FILE__)."/filesConfigurationBD/configuracion.xsd");
	$bd = new PDO($res[0], $res[1], $res[2]);

	// La sentencia SQL que almacena $ins devuelve el nombre y descripción de una categoría donde el codCat es uno que le pasan por el parámetro $codCat.
	$ins = "select nombre, descripcion from categorias where codcat = $codCat";
	$resul = $bd->query($ins);
	
	// Si no puede cargar lo solicitado o el número de filas es 0 devuelve un false. En otro caso devuelve todos los registros de la sentencia SQL y los muestra
	if (!$resul) {
		return FALSE;
	}
	if ($resul->rowCount() === 0) {    
		return FALSE;
    }	

	// Devuelve la siguiente fila de un conjunto de resultados. Puesto que solo puede haber un único resultado, devolverá el que buscamos.
	return $resul->fetch();	
}

function cargar_productos_categoria($codCat){
	$res = leer_config(dirname(__FILE__)."/filesConfigurationBD/configuracion.xml", dirname(__FILE__)."/filesConfigurationBD/configuracion.xsd");
	$bd = new PDO($res[0], $res[1], $res[2]);
	
	// La sentencia SQL que almacena $ins devuelve todos los registros de la tabla 'productos' donde el registro de la columna 'categoría' es igual al que le pasan por el parámetro $codCat.
	$sql = "select * from productos where categoria = $codCat";	
	$resul = $bd->query($sql);
	
	// Si no puede cargar lo solicitado o el número de filas es 0 devuelve un false. En otro caso devuelve todos los registros de la sentencia SQL como un array.
	if (!$resul) {
		return FALSE;
	}
	if ($resul->rowCount() === 0) {    
		return FALSE;
    }	
	//si hay 1 o más
	return $resul;			
}

// Recibe un array de códigos de productos
// Devuelve un cursor con los datos de esos productos
function cargar_productos($codigosProductos){
	$res = leer_config(dirname(__FILE__)."/filesConfigurationBD/configuracion.xml", dirname(__FILE__)."/filesConfigurationBD/configuracion.xsd");
	$bd = new PDO($res[0], $res[1], $res[2]);

	/**
	 * $codigosProductos es un array que irá almacenando los códigos de los productos que se irán añadiendo al carrito.
	 * La sentencia SQL que almacena $ins devuelve todos los registros de la tabla 'productos' donde el registro de la columna 'codProd' es alguno de los que indica $texto_in.
	*/
	$texto_in = implode(",", $codigosProductos);
	$ins = "select * from productos where codProd in($texto_in)";
	$resul = $bd->query($ins);	
	if (!$resul) {
		return FALSE;
	}
	return $resul;	
}

function insertar_pedido($carrito, $codRes){
	$res = leer_config(dirname(__FILE__)."/filesConfigurationBD/configuracion.xml", dirname(__FILE__)."/filesConfigurationBD/configuracion.xsd");
	$bd = new PDO($res[0], $res[1], $res[2]);

	/**
	 * Desctiva el modo 'autocommit'. Mientras el modo 'autocommit' esté desactivado, no se consignarán los cambios realizados en la base de datos 
	 * a través de una instancia de PDO hasta que se finalice la transacción con una llamada a PDO::commit().
	 */
	$bd->beginTransaction();	
	$hora = date("Y-m-d H:i:s", time());

	// La sentencia SQL que almacena $sql insertará dentro de la tabla 'pedidos' los elementos que están dentro del paréntesis.
	$sql = "insert into pedidos(fecha, enviado, restaurante) 
			values('$hora',0, $codRes)";
	$resul = $bd->query($sql);

	if (!$resul) {
		return FALSE;
	}

	// $pedido almacenará el último registro insertado en la tabla 'pedidos' si $resul pudo insertarlo correctamente, es decir, no se ha devuelto aún un FALSE.
	$pedido = $bd->lastInsertId();

	// insertar las filas en pedidoproductos
	foreach($carrito as $codProd=>$unidades){

		/**
		 * La sentencia SQL que almacena $sql insertará dentro de la tabla 'pedidosproductos' todos los productos que han ido insertando al carrito.
		 */
		$sql = "insert into pedidosproductos(Pedido, Producto, Unidades) 
		             values($pedido, $codProd, $unidades)";			
		$resul = $bd->query($sql);	

		if (!$resul) {

			// Una llamada a PDO::rollBack() revertirá todos los cambios de la base de datos y devolverá la conexión al modo 'autocommit'.
			$bd->rollback();
			return FALSE;
		}
	}

	$bd->commit();
	return $pedido;
}

