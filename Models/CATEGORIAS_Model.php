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
			return $GLOBALS['strings']['Error al insertar'];
		}
		else{
			return  $GLOBALS['strings']['Insercion correcta']; //operacion de insertado correcta
		}		
	}
	
	function rellenadatos() 
{	
    $sql = "SELECT * FROM categorias WHERE (`id_CATEGORIAS` = '$this->id_CATEGORIAS')";
   
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
	
    $sql = "SELECT * FROM categorias WHERE (`id_CATEGORIAS` = '$this->id_CATEGORIAS')";
    
    $result = $this->mysqli->query($sql);
    
    if ($result->num_rows == 1)
    {	
		$sql = "UPDATE categorias SET
					
					
					`nombre` = '$this->nombre'
					

				WHERE (`id_CATEGORIAS` = '$this->id_CATEGORIAS')";

        if (!($resultado = $this->mysqli->query($sql))){
			return $GLOBALS['strings']['Error en la modificación'];
		}
		else{ 
			echo $sql;
			return $GLOBALS['strings']['Modificado correctamente']; 
		}
    }
    else 
		echo $sql;
    	return $GLOBALS['strings']['No existe'];
} 

function search(){ 

	     $sql = "SELECT *
       			FROM categorias
    			WHERE
    				( 
    				
	 				(`nombre` LIKE '%$this->nombre%')
					
    				)";
				/* echo $sql; */
   
    if (!($resultado = $this->mysqli->query($sql))){
		return $GLOBALS['strings']['Error en la búsqueda'];
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
        
        $this->mysqli->query($sql);
        
    	return $GLOBALS['strings']['Borrado correctamente'];
    } 
    else
        return $GLOBALS['strings']['No existe'];
}  

}//fin de clase

?> 