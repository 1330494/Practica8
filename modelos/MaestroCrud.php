<?php

#EXTENSIÓN DE CLASES: Los objetos pueden ser extendidos, y pueden heredar propiedades y métodos. Para definir una clase como extensión, debo definir una clase padre, y se utiliza dentro de una clase hija.

require_once "Connector.php";

//heredar la clase DBConnector de Connector.php para poder utilizar "DBConnector" del archivo Connector.php.
// Se extiende cuando se requiere manipuar una funcion, en este caso se va a  manipular la función "conectar" del modelos/Connector.php:
class MaestroData extends DBConnector{

	# METODO PARA REGISTRAR NUEVOS MAESTROS	
	#-------------------------------------
	public static function newMaestroModel($maestroModel, $tabla_db){

		#prepare() Prepara una sentencia SQL para ser ejecutada por el método PDOStatement::execute(). La sentencia SQL puede contener cero o más marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada. Ayuda a prevenir inyecciones SQL eliminando la necesidad de entrecomillar manualmente los parámetros.

		$stmt = DBConnector::connect()->prepare("INSERT INTO $tabla_db (no_empleado,nombre,carrera,email,password) VALUES (:no_empleado,:nombre,:carrera,:email,:password)");	

		#bindParam() Vincula una variable de PHP a un parámetro de sustitución con nombre o de signo de interrogación correspondiente de la sentencia SQL que fue usada para preparar la sentencia.

		$stmt->bindParam(":no_empleado", $maestroModel["no_empleado"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre", $maestroModel["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":carrera", $maestroModel["carrera"], PDO::PARAM_INT);
		$stmt->bindParam(":email", $maestroModel["email"], PDO::PARAM_STR);
		$stmt->bindParam(":password", $maestroModel["password"], PDO::PARAM_STR);

		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}

		$stmt->close();
	}


	# VISTA DE MAESTROS
	#-------------------------------------

	public static function viewMaestroModel($tabla_db){

		$stmt = DBConnector::connect()->prepare("SELECT * FROM $tabla_db");	
		$stmt->execute();

		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetchAll();

		$stmt->close();

	}


	# METODO PARA BORRAR UN MAESTRO
	#------------------------------------
	public static function deleteMaestroModel($maestroModel, $tabla_db){

		$stmt = DBConnector::connect()->prepare("DELETE FROM $tabla_db WHERE no_empleado = :no_empleado");
		$stmt->bindParam(":no_empleado", $maestroModel, PDO::PARAM_STR);
		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}
		$stmt->close();
	}

	# METODO PARA EL INGRESO DE UN MAESTRO
	#------------------------------------
	public static function ingresoMaestroModel($maestroModel, $tabla_db)
	{
		$stmt = DBConnector::connect()->prepare("SELECT no_empleado, password FROM $tabla_db WHERE no_empleado = :no_empleado AND password = :password");	
		$stmt->bindParam(":no_empleado", $maestroModel["no_empleado"], PDO::PARAM_STR);
		$stmt->bindParam(":password", $maestroModel["password"], PDO::PARAM_STR);
		$stmt->execute();

		#fetch(): Obtiene una fila de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetch();

		$stmt->close();
	}

	# METODO PARA DEVOLVER Y EDITAR UN MAESTRO
	#------------------------------------
	public static function editarMaestroModel($maestroModel, $tabla_db){

		$stmt = DBConnector::connect()->prepare("SELECT * FROM $tabla_db WHERE no_empleado = :no_empleado");
		$stmt->bindParam(":no_empleado", $maestroModel, PDO::PARAM_STR);
		if($stmt->execute()){
			return $stmt->fetch();
		}else{
			return "error";
		}
		$stmt->close();
	}

	# METODO PARA ACTUALIZAR UN MAESTRO
	#------------------------------------
	public static function actualizarMaestroModel($maestroModel, $tabla_db){

		$stmt = DBConnector::connect()->prepare("UPDATE $tabla_db SET no_empleado=:no_empleado, nombre=:nombre, carrera=:carrera, email = :email, password = :password WHERE no_empleado = :no_empleado");
		$stmt->bindParam(":no_empleado", $maestroModel["no_empleado"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre", $maestroModel["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":carrera", $maestroModel["carrera"], PDO::PARAM_INT);
		$stmt->bindParam(":email", $maestroModel["email"], PDO::PARAM_STR);
		$stmt->bindParam(":password", $maestroModel["password"], PDO::PARAM_STR);

		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}
		$stmt->close();

	}
}
?>