<!---MODELO DE LAS FASES_HAS_CONTACTOS (CONTACTOS QUE REALIZAN UNA FASE)
 CREADO POR los Cangrejas EL 21/12/2018-->
<?php
//Declaracion de la clase
class FASES_HAS_CONTACTOS_Model {
	//Id de la fase
	var $FASES_id_FASES;
	//Id de la tarea a la que pertenece la fase
	var $FASES_TAREAS_id_TAREAS;
	//Email de los contactos que realizan una fase
    var $CONTACTOS_email;
	
	//Constructor de la clase
	function __construct($FASES_id_FASES, $FASES_TAREAS_id_TAREAS, $CONTACTOS_email){

		$this->FASES_id_FASES = $FASES_id_FASES;
		$this->FASES_TAREAS_id_TAREAS = $FASES_TAREAS_id_TAREAS;
		$this->CONTACTOS_email = $CONTACTOS_email;
		
		//Incluimos el archivo de acceso a la bd
		include_once 'Access_DB.php';
		//Funcion de conexion a la bd
		$this->mysqli = ConnectDB();
	}

	//Funcion para añadir un contacto a una fase
	function add(){
			//Sentencia sql para insertar
		$sql = "INSERT INTO fases_has_contactos
				VALUES (
					'$this->FASES_id_FASES',
					'$this->FASES_TAREAS_id_TAREAS',
					'$this->CONTACTOS_email'
					)
				";

		if (!$this->mysqli->query($sql)) { 
			return 'Error al insertar';		//Devuelve mensaje de error	
		}else{ 
		
			return 'Insercion correcta'; //Devuelve mensaje de exito
			
		}

	}

	//Funcion que devuelve los contactos de una tarea
	function getContactosOfTarea() {	
		$sql = "SELECT * FROM fases_has_contactos WHERE (`FASES_TAREAS_id_TAREAS` = '$this->FASES_TAREAS_id_TAREAS') GROUP BY `CONTACTOS_email`";

		if (!($resultado = $this->mysqli->query($sql))){
			return 'No existe'; //Devuelve mensaje de error
		}else{ 
			$result = $resultado;//Se guarda el resultado de la consulta sql
			return $result;//Se devuelve el resultado de la consulta
		
		}
	}

	//Funcion que devuelve los contactos de una fase
	function getContactosOfFase() {	
		$sql = "SELECT * FROM fases_has_contactos WHERE (`FASES_id_FASES` = '$this->FASES_id_FASES')";

		if (!($resultado = $this->mysqli->query($sql))){
			return 'No existe'; //Devuelve mensaje de error
		}else{ 
			$result = $resultado;//Se guarda el resultado de la consulta sql
			return $result;//Se devuelve el resultado de la consulta
		
		}
	}

	//Funcion que busca los contactos de una fase
	function search(){ 
			//Sentencia sql para buscar
			$sql = "SELECT *
					FROM fases_has_contactos
					WHERE
						( 
						
						(`FASES_id_FASES` LIKE '%$this->FASES_id_FASES%') &&
						(`FASES_TAREAS_id_TAREAS` LIKE '%$this->FASES_TAREAS_id_TAREAS%') &&
						(`CONTACTOS_email` LIKE '%$this->CONTACTOS_email%')
						
						)";
					
	
		if (!($resultado = $this->mysqli->query($sql))){
			return 'Error en la búsqueda';//Devuelve mensaje de error		
		}else{ 
			return $resultado;//Se devuelve el resultado de la consulta
		}
	}

	//Funcion que borra un contacto de una fase
	function delete(){	
		$sql = "SELECT * FROM fases_has_contactos WHERE (`FASES_id_FASES` = '$this->FASES_id_FASES') &&
						(`FASES_TAREAS_id_TAREAS` = '$this->FASES_TAREAS_id_TAREAS') &&
						(`CONTACTOS_email` = '$this->CONTACTOS_email')";
		
		$result = $this->mysqli->query($sql);//Se guarda el resultado de la consulta sql
		
		if ($result->num_rows == 1){
			//Sentencia sql para borrar
			$sql = "DELETE FROM fases_has_contactos WHERE (`FASES_id_FASES` = '$this->FASES_id_FASES') &&
						(`FASES_TAREAS_id_TAREAS` = '$this->FASES_TAREAS_id_TAREAS') &&
						(`CONTACTOS_email` = '$this->CONTACTOS_email')";
			
			$this->mysqli->query($sql);
			
			return 'Borrado correctamente';//Devuelve mensaje de exito
		}else{
			return 'No existe';//Devuelve mensaje de error
		}
	}

	//Funcion que devuelve los contactos de una fase
	function rellenadatos() {	
		$sql = "SELECT * FROM fases_has_contactos WHERE (`FASES_id_FASES` = '$this->FASES_id_FASES') &&
						(`FASES_TAREAS_id_TAREAS` = '$this->FASES_TAREAS_id_TAREAS') &&
						(`CONTACTOS_email` = '$this->CONTACTOS_email')";
	
		if (!($resultado = $this->mysqli->query($sql))){
			return 'No existe'; //Devuelve mensaje de error
		}else{ 
			$result = $resultado;//Se guarda el resultado de la consulta sql
			return $result;	//Se devuelve el resultado de la consulta
		}
	}

}//fin de clase

?> 