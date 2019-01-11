<!---MODELO DE LOS USUARIOS QUE ADMINISTRARÁN LA LOTERIAIU,DONDE SE REALIZARÁ LA OPERACION DE INSERCIÓN EN LA BD
 CREADO POR mi3ac6 EL 23/11/2018-->
<?php
class CATEGORIAS_Model {
	var $id_CATEGORIAS;
	var $nombre;
	
//Constructor de la clase
//
function __construct($id_CATEGORIAS,$nombre){
	$this->id_CATEGORIAS = $id_CATEGORIAS;
	$this->nombre = $nombre;
	include_once 'Access_DB.php';
	$this->mysqli = ConnectDB();
}
function add(){
			
		$sql = "INSERT INTO categorias (
			
			nombre
			
			) 
				VALUES (
					
					'$this->nombre'
					
					
					)";
			
		if (!$this->mysqli->query($sql)) {
			echo $sql;
			return 'Error al insertar';
		}
		else{
			return  'Insercion correcta'; //operacion de insertado correcta
		}		
	}
	
	function rellenadatos() 
{	
    $sql = "SELECT * FROM categorias WHERE (`id_CATEGORIAS` = '$this->id_CATEGORIAS')";
   
    if (!($resultado = $this->mysqli->query($sql))){
		return 'No existe'; 
	}
    else{ 
		$result = $resultado;
		return $result;
	}
}
function edit()
{
	
    $sql = "SELECT * FROM categorias WHERE (`id_CATEGORIAS` = '$this->id_CATEGORIAS')";
    
    $result = $this->mysqli->query($sql);
    
    if ($result->num_rows == 1)
    {	
		$sql = "UPDATE categorias SET
					
					
					`nombre` = '$this->nombre'
					
				WHERE (`id_CATEGORIAS` = '$this->id_CATEGORIAS')";
        if (!($resultado = $this->mysqli->query($sql))){
			return 'Error en la modificación';
		}
		else{ 
			echo $sql;
			return 'Modificado correctamente'; 
		}
    }
    else 
		echo $sql;
    	return 'No existe';
} 
function search(){ 
	     $sql = "SELECT *
       			FROM categorias
    			WHERE
    				( 
    				
	 				(`nombre` LIKE '%$this->nombre%')
					
    				)";
				
   
    if (!($resultado = $this->mysqli->query($sql))){
		return 'Error en la búsqueda';
		/* return "Error en la consulta"; */
	}
    else{ 
		return $resultado;
	}
}
function searchById(){ 
	$sql = "SELECT *
			  FROM categorias
		   WHERE
			   ( 
			   
				(`id_CATEGORIAS` LIKE '%$this->id_CATEGORIAS%')
			   
			   )";
		   
	if (!($resultado = $this->mysqli->query($sql))){
		return 'Error en la búsqueda';
		/* return "Error en la consulta"; */
	}
	else{ 
		return $resultado;
	}
}
function delete()
{	
    $sql = "SELECT * FROM categorias WHERE (`id_CATEGORIAS` = '$this->id_CATEGORIAS')";
    
    $result = $this->mysqli->query($sql);
    
    if ($result->num_rows == 1)
    {
    	
        $sql = "DELETE FROM categorias WHERE (`id_CATEGORIAS` = '$this->id_CATEGORIAS')";
        
        if($this->mysqli->query($sql)){
        
			return 'Borrado correctamente';
		}
		else{
			return 'No se puede borrar.Hay tareas asociadas a esta categoria';
		}
    } 
    else
        return 'No existe';
} 


 
}//fin de clase
?> 