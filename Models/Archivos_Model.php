<!---MODELO DE LOS ARCHIVOS
 CREADO POR los Cangrejas EL 21/12/2018-->
<?php
//Declaracion de la clase
class ARCHIVOS_Model {
	//Id del archivo
	var $id_ARCHIVOS;
	//Nombre del archivo
	var $nombre;
	//URL del archivo
    var $url;
	//Fase a la que pertenece el archivo
	var $FASES_id_FASES;
	//Tarea a la que pertenece el archivo
	var $FASES_TAREAS_id_TAREAS;
	
	//Constructor de la clase
	function __construct($id_ARCHIVOS, $nombre, $url, $FASES_id_FASES,$FASES_TAREAS_id_TAREAS){

		$this->id_ARCHIVOS = $id_ARCHIVOS;
		$this->nombre = $nombre;
		$this->url = $url;
		$this->FASES_id_FASES = $FASES_id_FASES;
		$this->FASES_TAREAS_id_TAREAS = $FASES_TAREAS_id_TAREAS;
		
		//Conexion a la BD
		include_once '../Models/Access_DB.php';
		$this->mysqli = ConnectDB();
	}

	//Funcion para insertar archivos
	function add(){
			//Sentencia sql que insetara archivos	
		$sql = "INSERT INTO archivos
				VALUES (
					'$this->id_ARCHIVOS',
					'$this->nombre',
					'$this->url',
					'$this->FASES_id_FASES',
					'$this->FASES_TAREAS_id_TAREAS'
					)
				";

		if (!$this->mysqli->query($sql)) { 
			return 'Error al insertar';//Devuelve mensaje de error
			
			
				
		}
		else{ 
		
			return 'Insercion correcta'; //Devuelve mensaje de exito
			
		}

	}

	//Funcion para obtener los archivos de una tarea concreta
	function getArchivosOfTarea() {	
		$sql = "SELECT * FROM archivos WHERE (`FASES_TAREAS_id_TAREAS` = '$this->FASES_TAREAS_id_TAREAS')";
	
		if (!($resultado = $this->mysqli->query($sql))){
			return 'No existe'; //Devuelve mensaje de error
		}
		else{ 
			$result = $resultado;//Se guarda el resultado de la consulta sql
			return $result;//Se devuelve el resultado de la consulta
		
		}
	}

	//Funcion para obtener los archivos de una fase concreta
	function getArchivosOfFase() {	
		$sql = "SELECT * FROM archivos WHERE (`FASES_id_FASES` = '$this->FASES_id_FASES')";
	
		if (!($resultado = $this->mysqli->query($sql))){
			return 'No existe'; //Devuelve mensaje de error
		}
		else{ 
			$result = $resultado;//Se guarda el resultado de la consulta sql
			return $result;//Se devuelve el resultado de la consulta
		
		}
	}

	//Funcion para borrar un archivo
	function delete()
	{	
		$sql = "SELECT * FROM archivos WHERE (`url` = '$this->url')";
		
		$result = $this->mysqli->query($sql);//Guarda el resultado
		
		if ($result->num_rows == 1)
		{
			
			$sql = "DELETE FROM archivos WHERE (`url` = '$this->url')";
			
			$this->mysqli->query($sql);
			
			return 'Borrado correctamente';//Devuelve mensaje de exito
		} 
		else
			return 'No existe';//Devuelve mensaje de error
	}

	//Funcion que devuelve todos los archivos de una fase
	function rellenadatos() {	
		$sql = "SELECT * FROM archivos WHERE (`FASES_id_FASES` = '$this->id_fase')";
	
		if (!($resultado = $this->mysqli->query($sql))){
			return 'No existe'; //Devuelve mensaje de error
		}
		else{ 
			$result = $resultado;//Se guarda el resultado de la consulta sql
			return $result;//Se devuelve el resultado de la consulta
		
		}
	}

}//fin de clase

?> 