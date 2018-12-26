<!---MODELO DE LOS USUARIOS QUE ADMINISTRARÁN LA LOTERIAIU,DONDE SE REALIZARÁ LA OPERACION DE INSERCIÓN EN LA BD
 CREADO POR mi3ac6 EL 23/11/2018-->
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
			/* echo $sql; */
			return 'Error en la inserción';
		}
		else{
			return 'Inserción realizada con éxito'; //operacion de insertado correcta
		}		
	}
	
	function rellenadatos() 
{	
    $sql = "SELECT * FROM prioridades WHERE (`nivel` = '$this->nivel')";
   
    if (!($resultado = $this->mysqli->query($sql))){
		return $GLOBALS['strings']['No existe']; 
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
			return 'Error en la inserción';
		}
		else{ 
			/* echo $sql; */
			return 'Inserción realizada con éxito';
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
				/* echo $sql; */
   
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
    $sql = "SELECT * FROM prioridades WHERE (`nivel` = '$this->nivel')";
    
    $result = $this->mysqli->query($sql);
    
    if ($result->num_rows == 1)
    {
    	
        $sql = "DELETE FROM prioridades WHERE (`nivel` = '$this->nivel')";
        
        $this->mysqli->query($sql);
        
    	return 'Borrado correctamente';
    } 
    else
        return 'No existe';
}  

}//fin de clase

?> 