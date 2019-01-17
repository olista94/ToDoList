<!---MODELO DE LAS FASES
 CREADO POR los Cangrejas EL 21/12/2018-->
<?php
//Declaracion de la clase
class FASES_Model {

	//Id de la fase
	var $id_fase;
	//Descripcion de la fase
	var $descripcion;
	//Fecha de inicio de la fase
	var $fecha_ini;
	//Fecha fin de la fase
	var $fecha_fin;
	//Variable que indica si una fase esta completada o no
	var $completada;
	//Tarea a la que pertenece la fase
	var $TAREAS_id_TAREAS;

	//Constructor de la clase
	function __construct($id_fase,$descripcion,$fecha_ini,$fecha_fin,$completada,$TAREAS_id_TAREAS){
		$this->id_fase = $id_fase;
		$this->descripcion = $descripcion;
		$this->fecha_ini = $fecha_ini;
		$this->fecha_fin = $fecha_fin;
		$this->completada = $completada;
		$this->TAREAS_id_TAREAS = $TAREAS_id_TAREAS;

		//Incluimos el archivo de acceso a la bd
		include_once 'Access_DB.php';
		//Funcion de conexion a la bd
		$this->mysqli = ConnectDB();
	}

	//Funcion para insertar una fase
	function add(){
		//Funcion para coger la fecha del sistema
		$date = date('Y-m-d', time());
		//Sentencia sql para insertar
		$sql = "INSERT INTO fases
				VALUES (
					'$this->id_fase',
					'$this->descripcion',
					'$date',
					'$this->fecha_fin',
					'$this->completada',
					'$this->TAREAS_id_TAREAS'
					)
				";

		if (!$this->mysqli->query($sql)) { 
			return 'Error al insertar';	//Devuelve mensaje de error				
		}else{ 				
			return 'Insercion correcta'; //Devuelve mensaje de exito					
		}
	} 

	//Funcion para editar una fase
	function edit(){
		
		$sql = "SELECT * FROM fases WHERE (id_FASES = '$this->id_fase')";    
		$result = $this->mysqli->query($sql);//Guarda el resultado
		
		if ($result->num_rows == 1){
				//Sentencia sql para editr
			$sql = "UPDATE fases SET
						`descripcion` = '$this->descripcion'
					WHERE (`id_FASES` = '$this->id_fase')";

			if (!($resultado = $this->mysqli->query($sql))){
				return 'Error en la modificación';//Devuelve mensaje de error
			}else{ 
				return 'Modificado correctamente'; //Devuelve mensaje de exito
			}
		}else{ 
			return 'No existe';//Devuelve mensaje de error
		}
	}

	//Funcion para buscar una fase de una tarea
	function search(){ 
		//Sentencia sql para buscar
		$sql = "SELECT *
			FROM fases
			WHERE `TAREAS_id_TAREAS` = '".$_REQUEST['TAREAS_id_TAREAS']."' &&
				( 
				(`id_FASES` LIKE '%$this->id_fase%') &&
				(`descripcion` LIKE '%$this->descripcion%') &&
				(`fecha_inicio` LIKE '%$this->fecha_ini%') &&
				(`fecha_fin` LIKE '%$this->fecha_fin%') &&
				(`TAREAS_id_TAREAS` LIKE '%$this->TAREAS_id_TAREAS%')			
				)";	
	
		if (!($resultado = $this->mysqli->query($sql))){
			return "Error en la búsqueda";//Devuelve mensaje de error
		}else{//Devuelve el resultado
			return $resultado;
		}
	}

	//Funcion para borrar una fase
	function delete(){	
		$sql = "SELECT * FROM fases WHERE (`id_FASES` = '$this->id_fase')";    
		$result = $this->mysqli->query($sql);//Guarda el resultado
		
		if ($result->num_rows == 1){
			//Sentencia sql para borrar
			$sql = "DELETE FROM fases WHERE (`id_FASES` = '$this->id_fase')";        
			$this->mysqli->query($sql);        
			return 'Borrado correctamente';//Devuelve mensaje de exito
		}else{
			return 'No existe';//Devuelve mensaje de error
		}
	}

	//Funcion que devuelve los datos de una fase
	function rellenadatos(){	
		$sql = "SELECT * FROM fases WHERE (`id_FASES` = '$this->id_fase')";
	
		if (!($resultado = $this->mysqli->query($sql))){
			return 'No existe'; //Devuelve mensaje de error
		}else{//Devuelve el resultado
			$result = $resultado;
			return $result;
		}
	}

	//Funcion que devuelve las fases de una tarea
	function getFasesOfTarea() {	
		$sql = "SELECT * FROM fases WHERE (`TAREAS_id_TAREAS` = '$this->TAREAS_id_TAREAS')";
	
		if (!($resultado = $this->mysqli->query($sql))){
			return 'No existe'; //Devuelve mensaje de error
		}
		else{//Devuelve el resultado
			$result = $resultado;
			return $result;
		
		}
	}

	//Funcion que muestra todas las fases
	function FasesShowAll(){
		$sql = "SELECT * FROM fases ";
		
		if (!($resultado = $this->mysqli->query($sql))){
			return 'No existe'; //Devuelve mensaje de error
		}
		else{ 
			$result = $resultado;
			return $result;
		}
	}

	//Funcion para buscar la ultima fase insertada
	function BuscarIDFase(){
		$sql = "SELECT MAX(id_FASES) FROM fases";	
		
		if (!($resultado = $this->mysqli->query($sql))){
			return 'No existe'; //Devuelve mensaje de error
		}
		else{ 
			$result = $resultado->fetch_array()[0];
			
			return $result;
		}
	}

	//Funcion para marcar como completada una fase
	function setCompletada(){	
		$sql = "SELECT * FROM fases WHERE (id_FASES = '$this->id_fase')";
		
		$result = $this->mysqli->query($sql);//Guarda el resultado
		
		if ($result->num_rows == 1)
		{	
			//Guardamos la fecha del sistema
			$date = date('Y-m-d', time());
			//Marca como completada una fase
			$sql = "UPDATE fases SET
						`completada` = '1',
						`fecha_fin` = '$date'				

					WHERE (`id_FASES` = '$this->id_fase')";

			if (!($resultado = $this->mysqli->query($sql))){
				return 'Error al cerrar la fase';//Devuelve mensaje de error
			}
			else{ 
				return 'La fase se ha cerrado'; //Devuelve mensaje de exito
			}
		}
		else 
			return 'No existe';//Devuelve mensaje de error
	} 

	//Funcion para marcar como no completada una fase
	function setNoCompletada(){
		$sql = "SELECT * FROM tareas WHERE (id_tarea = '$this->TAREAS_id_TAREAS') && (completada = '1')";
		
		$result = $this->mysqli->query($sql);//Guarda el resultado
		
		if ($result->num_rows == 0)
		{	
		
			$sql = "SELECT * FROM fases WHERE (id_FASES = '$this->id_fase')";
			
			$result = $this->mysqli->query($sql);//Guarda el resultado
			
			if ($result->num_rows == 1)
			{	
			//Marca como incompleta una fase
				$sql = "UPDATE fases SET
							`completada` = '0',
							`fecha_fin` = ''					

						WHERE (`id_FASES` = '$this->id_fase')";

				if (!($resultado = $this->mysqli->query($sql))){
					return 'Error al abrir la fase';//Devuelve mensaje de error
				}
				else{ 
					return 'La fase se ha vuelto a abrir'; //Devuelve mensaje de exito
				}
			}else{
				return 'No existe';//Devuelve mensaje de error
			}
		}else{
			return 'No se puede abrir una fase de una tarea cerrada';//Devuelve mensaje de error
		}
			
	}

	//Funcion para buscar la ultima fase insertada II
	function BuscarMaxID(){
		$sql = "SELECT MAX(id_FASES)
				FROM fases
						";		
		
		if (!($resultado = $this->mysqli->query($sql))){
			return 'No existe'; //Devuelve mensaje de error
		}
		else{ 
			$result = $resultado->fetch_array()[0];
			
			return $result;
		}
	} 


}//fin de clase

?> 