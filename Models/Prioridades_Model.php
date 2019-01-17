<!---MODELO DE LAS PRIORIDADES
 CREADO POR los Cangrejas EL 21/12/2018-->
<?php
//Declaracion de la clase
class PRIORIDADES_Model {
	//Nivel de la prioridad
	var $nivel;
	//Descripcion de la prioridad
	var $descripcion;
	//Color de la prioridad
	var $color;
	
	//Constructor de la clase
	function __construct($nivel,$descripcion,$color){
		$this->nivel = $nivel;
		$this->descripcion = $descripcion;
		$this->color = $color;
		//Incluimos el archivo de acceso a la bd
		include_once 'Access_DB.php';
		//Funcion de conexion a la bd
		$this->mysqli = ConnectDB();
	}

	//Funcion para añadir una prioridad
	function add(){
			//Sentencia sql para insertar	
			$sql = "INSERT INTO prioridades (
				nivel,
				descripcion,
				color
				) 
					VALUES (
						'$this->nivel',
						'$this->descripcion',
						'$this->color'
						
						)";
				
			if (!$this->mysqli->query($sql)) {
				
				return 'Error al insertar';//Devuelve mensaje de error
			}
			else{
				return 'Insercion correcta'; //operacion de insertado correcta
			}		
		}
		
		//Funcion que devuelve los datos de una prioridad
		function rellenadatos() 
		{	
			//Sentencia sql que muestra los datos de una prioridad
			$sql = "SELECT * FROM prioridades WHERE (`nivel` = '$this->nivel')";
		
			if (!($resultado = $this->mysqli->query($sql))){
				return 'No existe'; //Devuelve mensaje de error
			}
			else{ //Devuelve el resultado
				$result = $resultado;
				return $result;
			}
		}

	//Funcion para editar una prioridad
	function edit()
	{
		
		$sql = "SELECT * FROM prioridades WHERE (`nivel` = '$this->nivel')";
		
		$result = $this->mysqli->query($sql);//Guarda el resultado
		
		if ($result->num_rows == 1)
		{	
	//Sentencia sql para editar
			$sql = "UPDATE prioridades SET
						
						`descripcion` = '$this->descripcion',
						`color` = '$this->color'
						
					WHERE (`nivel` = '$this->nivel')";
			if (!($resultado = $this->mysqli->query($sql))){
				return 'Error en la modificación';//Devuelve mensaje de error
			}
			else{ 
				
				return 'Modificado correctamente';//Devuelve mensaje de exito
			}
		}
		else 
			return 'No existe';//Devuelve mensaje de error
	} 

	//Funcion para buscar una prioridad
	function search(){ 
	//Sentencia sql para buscar
		$sql = "SELECT *
				FROM prioridades
				WHERE
					( 
					(`nivel` LIKE '%$this->nivel%') &&
					(`descripcion` LIKE '%$this->descripcion%') &&
					(`color` LIKE '%$this->color%')
					
					)";					
	
		if (!($resultado = $this->mysqli->query($sql))){
			return 'Error en la búsqueda';//Devuelve mensaje de error
			
		}
		else{ 
			return $resultado;
		}
	}

	//Funcion para buscar una prioridad por ID
	function searchById(){ 
		$sql = "SELECT *
				FROM prioridades
			WHERE
				( 
				(`nivel` LIKE '%$this->nivel%')
				
				)";
			
		if (!($resultado = $this->mysqli->query($sql))){
		return 'Error en la búsqueda';//Devuelve mensaje de error

		}
		else{ 
		return $resultado;
		}
	}

	//Funcion para borrar una prioridad
	function delete()
	{	
		$sql = "SELECT * FROM prioridades WHERE (`nivel` = '$this->nivel')";
		
		$result = $this->mysqli->query($sql);//Guarda el resultado
		
		if ($result->num_rows == 1){
			//Sentencia sql para borrar
			$sql = "DELETE FROM prioridades WHERE (`nivel` = '$this->nivel')";
			
			if($this->mysqli->query($sql)){
			
				return 'Borrado correctamente';//Devuelve mensaje de exito
			}
			else{
				return 'No se puede borrar.Hay tareas asociadas a esta prioridad';//Devuelve mensaje de error
			}	
	
		}  
		else
			return 'No existe';//Devuelve mensaje de error
	}
}//fin de clase
?> 