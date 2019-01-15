<?php
class PRIORIDADES_Model {
	var $nivel;
	var $descripcion;
	var $color;
	
//Constructor de la clase
//
function __construct($nivel,$descripcion,$color){
	$this->nivel = $nivel;
	$this->descripcion = $descripcion;
	$this->color = $color;
	include_once 'Access_DB.php';
	$this->mysqli = ConnectDB();
}
function add(){
			
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
			
			return 'Error al insertar';
		}
		else{
			return 'Insercion correcta'; //operacion de insertado correcta
		}		
	}
	
	function rellenadatos() 
{	
    $sql = "SELECT * FROM prioridades WHERE (`nivel` = '$this->nivel')";
   
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
	
    $sql = "SELECT * FROM prioridades WHERE (`nivel` = '$this->nivel')";
    
    $result = $this->mysqli->query($sql);
    
    if ($result->num_rows == 1)
    {	
		$sql = "UPDATE prioridades SET
					
					`descripcion` = '$this->descripcion',
					`color` = '$this->color'
					
				WHERE (`nivel` = '$this->nivel')";
        if (!($resultado = $this->mysqli->query($sql))){
			return 'Error en la modificación';
		}
		else{ 
			
			return 'Modificado correctamente';
		}
    }
    else 
    	return 'No existe';
} 
function search(){ 
	     $sql = "SELECT *
       			FROM prioridades
    			WHERE
    				( 
    				(`nivel` LIKE '%$this->nivel%') &&
	 				(`descripcion` LIKE '%$this->descripcion%') &&
					(`color` LIKE '%$this->color%')
					
    				)";
				
   
    if (!($resultado = $this->mysqli->query($sql))){
		return 'Error en la búsqueda';
		
	}
    else{ 
		return $resultado;
	}
}
function searchById(){ 
	$sql = "SELECT *
			  FROM prioridades
		   WHERE
			   ( 
			   (`nivel` LIKE '%$this->nivel%')
			   
			   )";
		   
if (!($resultado = $this->mysqli->query($sql))){
   return 'Error en la búsqueda';

}
else{ 
   return $resultado;
}
}
function delete()
{	
    $sql = "SELECT * FROM prioridades WHERE (`nivel` = '$this->nivel')";
    
    $result = $this->mysqli->query($sql);
    
    if ($result->num_rows == 1){
    	
        $sql = "DELETE FROM prioridades WHERE (`nivel` = '$this->nivel')";
        
        if($this->mysqli->query($sql)){
        
			return 'Borrado correctamente';
		}
		else{
			return 'No se puede borrar.Hay tareas asociadas a esta prioridad';
		}	
   
	}  
	else
        return 'No existe';
}
}//fin de clase
?> 