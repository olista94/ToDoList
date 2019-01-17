<!---MODELO DE LAS CATEGORIAS
 CREADO POR los Cangrejas EL 21/12/2018-->
<?php
//Declaracion de la clase
class CATEGORIAS_Model {
	//Id de la categoria
	var $id_CATEGORIAS;
	//Nombre de la categoria
	var $nombre;
	
//Constructor de la clase
function __construct($id_CATEGORIAS,$nombre){
	$this->id_CATEGORIAS = $id_CATEGORIAS;
	$this->nombre = $nombre;
	//Incluimos el archivo de acceso a la bd
	include_once 'Access_DB.php';
	//Funcion de conexion a la bd
	$this->mysqli = ConnectDB();
}

//Funcion para insertar categorias
function add(){
			//Sentencia sql que insetara la categoria
		$sql = "INSERT INTO categorias (
			nombre
			) 
				VALUES (
					'$this->nombre'
					)";
			
			//Si ya se han insertado la PK o FK
		if (!$this->mysqli->query($sql)) {
			
			return 'Error al insertar';
		}
		//operacion de insertado correcta
		else{
			return  'Insercion correcta'; 
		}		
	}
//Funcion que obtiene todos los datos de una categoria especifica	
	function rellenadatos() 
{	
    $sql = "SELECT * FROM categorias WHERE (`id_CATEGORIAS` = '$this->id_CATEGORIAS')";
   //Si no existe
    if (!($resultado = $this->mysqli->query($sql))){
		return 'No existe'; 
	}
	//Devolucion de la consulta
    else{ 
		$result = $resultado;
		return $result;
	}
}

//Funcion para editar categoria
function edit()
{
	//Sentencia sql que buscara todos los datos de una categoria
    $sql = "SELECT * FROM categorias WHERE (`id_CATEGORIAS` = '$this->id_CATEGORIAS')";
    
    $result = $this->mysqli->query($sql);
    
	//Si devuelve 1a fila (consulta realizada correctamente)
    if ($result->num_rows == 1)
    {	
		$sql = "UPDATE categorias SET		
					`nombre` = '$this->nombre'				
				WHERE (`id_CATEGORIAS` = '$this->id_CATEGORIAS')";
				//Si se realiza erroneamente la edicion
        if (!($resultado = $this->mysqli->query($sql))){
			return 'Error en la modificación';
		}
		else{ 
			//Edit correcto
			return 'Modificado correctamente'; 
		}
    }//Si no encuentra ninguna categoria
    else 
		return 'No existe';
}

//Funcion sql que buscara las categorias que correspondan
function search(){ 
//Sentencia sql que buscara las categorias cuyo nombre contengan la cadena introducida en el form de SEARCH
	     $sql = "SELECT *
       			FROM categorias
    			WHERE
    				( 
					(`id_CATEGORIAS` LIKE '%$this->id_CATEGORIAS%')	&&
	 				(`nombre` LIKE '%$this->nombre%')
									
    				)";
				
   //Si se produce un error
    if (!($resultado = $this->mysqli->query($sql))){
		return 'Error en la búsqueda';
		
	}//Si las encuentra (aunque no devuelva ninguna)
    else{ 
		return $resultado;
	}
}

//Devuelve una categoria
function searchById(){ 
	$sql = "SELECT *
			  FROM categorias
		   WHERE
			   ( 
			   
				(`id_CATEGORIAS` LIKE '%$this->id_CATEGORIAS%')
			   
			   )";
		//No la encuentra   
	if (!($resultado = $this->mysqli->query($sql))){
		return 'Error en la búsqueda';
		
	}
	else{ //Busqueda positiva
		return $resultado;
	}
}

//Funcion de borrado de una categoria
function delete()
{	
//Sentencia sql que buscara la categoria a borrar
    $sql = "SELECT * FROM categorias WHERE (`id_CATEGORIAS` = '$this->id_CATEGORIAS')";
    
    $result = $this->mysqli->query($sql);
    //Si se encuentra
    if ($result->num_rows == 1)
    {
    	//Sentencia sql que borrara la categoria
        $sql = "DELETE FROM categorias WHERE (`id_CATEGORIAS` = '$this->id_CATEGORIAS')";
        
		//Resultado positivo
        if($this->mysqli->query($sql)){
        
			return 'Borrado correctamente';
		}
		else{//Si esta asociada a una tarea no se puede borrar
			return 'No se puede borrar.Hay tareas asociadas a esta categoria';
		}
    } 
    else//Si no existe
        return 'No existe';
} 


 
}//fin de clase
?> 