
<?php
// Clase para devolver una conexion a una base de datos especifica.
class DBConnector
{
	
	public static function connect()
	{
		// Devuelve la conexion a la base de datos.
		$tmp_conn = new PDO("mysql:host=localhost;dbname=practica8;port=3307;","root","usbw");
		return $tmp_conn;
	}

}

?>
