<?php

#EXTENSIÓN DE CLASES: Los objetos pueden ser extendidos, y pueden heredar propiedades y métodos. Para definir una clase como extensión, debo definir una clase padre, y se utiliza dentro de una clase hija.

require_once "Connector.php";

//heredar la clase DBConnector de Connector.php para poder utilizar "DBConnector" del archivo Connector.php.
// Se extiende cuando se requiere manipuar una funcion, en este caso se va a  manipular la función "conectar" del modelos/Connector.php:
class AlumnoData extends DBConnector{

	# METODO PARA REGISTRAR NUEVOS ALUMNOS	
	#-------------------------------------
	public static function newAlumnoModel($alumnoModel, $tabla_db){

		#prepare() Prepara una sentencia SQL para ser ejecutada por el método PDOStatement::execute(). La sentencia SQL puede contener cero o más marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada. Ayuda a prevenir inyecciones SQL eliminando la necesidad de entrecomillar manualmente los parámetros.

		$stmt = DBConnector::connect()->prepare("INSERT INTO $tabla_db (matricula,nombre,carrera,tutor) VALUES (:matricula,:nombre,:carrera,:tutor)");	

		#bindParam() Vincula una variable de PHP a un parámetro de sustitución con nombre o de signo de interrogación correspondiente de la sentencia SQL que fue usada para preparar la sentencia.

		$stmt->bindParam(":matricula", $alumnoModel["matricula"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre", $alumnoModel["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":carrera", $alumnoModel["carrera"], PDO::PARAM_INT);
		$stmt->bindParam(":tutor", $alumnoModel["tutor"], PDO::PARAM_INT);

		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}

		$stmt->close();
	}


	# VISTA DE ALUMNOS
	#-------------------------------------

	public static function viewAlumnoModel($tabla_db){

		$stmt = DBConnector::connect()->prepare("SELECT * FROM $tabla_db");	
		$stmt->execute();

		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetchAll();

		$stmt->close();

	}


	# METODO PARA BORRAR UN ALUMNO
	#------------------------------------
	public static function deleteAlumnoModel($alumnoModel, $tabla_db){

		$stmt = DBConnector::conectar()->prepare("DELETE FROM $tabla_db WHERE matricula = :matricula");
		$stmt->bindParam(":matricula", $alumnoModel, PDO::PARAM_INT);
		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}
		$stmt->close();
	}

	# METODO PARA DEVOLVER Y EDITAR UN ALUMNO
	#------------------------------------
	public static function editarAlumnoModel($alumnoModel, $tabla_db){

		$stmt = DBConnector::conectar()->prepare("SELECT * FROM $tabla_db WHERE matricula = :matricula");
		$stmt->bindParam(":matricula", $alumnoModel, PDO::PARAM_INT);
		if($stmt->execute()){
			return $stmt->fetch();
		}else{
			return "error";
		}
		$stmt->close();
	}

	# METODO PARA ACTUALIZAR UN ALUMNO
	#------------------------------------
	public static function actualizarAlumnoModel($alumnoModel, $tabla_db){

		$stmt = DBConnector::conectar()->prepare("UPDATE $tabla_db SET matricula=:matricula, nombre=:nombre, carrera=:carrera, tutor = :tutor WHERE matricula = :matricula");
		$stmt->bindParam(":matricula", $alumnoModel["matricula"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre", $alumnoModel["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":carrera", $alumnoModel["carrera"], PDO::PARAM_INT);
		$stmt->bindParam(":tutor", $alumnoModel["tutor"], PDO::PARAM_INT);
		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}
		$stmt->close();
	}

}
?>