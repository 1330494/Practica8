<?php 

class Pages{
	
	public static function linksModel($links){

		if($links == "maestros" || $links == "ingresar" || $links == "salir" || $links == "alumnos" 
			|| $links == "carreras" || $links == "registro-alumno" || $links == "registro-maestro" 
			|| $links == "editar-alumno" || $links == "editar-maestro")
		{
			$module =  "vistas/modulos/".$links.".php";
		}else if($links == "index"){
			$module =  "vistas/modulos/ingresar.php";
		}else if($links == "ok"){
			$module =  "vistas/modulos/tutorias.php";
		}else if($links == "fallo"){
			$module =  "vistas/modulos/ingresar.php";
		}else if($links == "cambio"){
			$module =  "vistas/modulos/tutorias.php";
		}else{
			$module =  "vistas/modulos/tutorias.php";
		}
		return $module;
	}
}

?>