<!---MODELO DE LA contactos,DONDE SE REALIZARÁN LAS OPERACIONES DE INSERCIÓN,BÚSQUEDA,BORRADO... EN LA BD
 CREADO POR mi3ac6 EL 20/11/2018-->
<?php

class CONTACTOS_Model{

	var $email;
	var $nombre;
	var $descripcion;
	var $telefono;
	
	
	function __construct ($email,$nombre,$descripcion,$telefono){
		$this -> email = $email;
		$this -> nombre = $nombre;
		$this -> descripcion = $descripcion;
		$this -> telefono = $telefono;

		
		include_once '../Models/Access_DB.php';
		$this->mysqli = ConnectDB();
		}
		
function add(){
		
	if (($this->email != '')){

		
        $sql = "SELECT * FROM contactos WHERE (`email` = '$this->email')";
		if (!$result = $this->mysqli->query($sql)){ 
			return 'No se ha podido conectar con la base de datos'; 
		}
		else { 
			if ($result->num_rows == 0 ){ 
				
				$sql = "INSERT INTO contactos
						VALUES (
							'$this->email',
							'$this->nombre',
							'$this->descripcion',
							'$this->telefono'
						)
						";

				if (!$this->mysqli->query($sql)) { 
					return 'Error al insertar';
					/* echo $sql; */
				}
				else{ 
					return 'Insertado correcto'; 
					
				}

			}
			else 
				return 'El usuario ya existe'; 
		}
    }
    else{ 
         return 'Introduzca un valor para la clave'; 
		
	}
} 


function search(){ 

	     $sql = "SELECT *
       			FROM contactos
    			WHERE
    				( 
    				(`email` LIKE '%$this->email%') &&
	 				(`nombre` LIKE '%$this->nombre%') &&
					(`descripcion` LIKE '%$this->descripcion%') &&
					(`telefono` LIKE '%$this->telefono%')
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
    $sql = "SELECT * FROM contactos WHERE (`email` = '$this->email')";
    
    $result = $this->mysqli->query($sql);
    
    if ($result->num_rows == 1)
    {
    	
        $sql = "DELETE FROM contactos WHERE (`email` = '$this->email')";
        
        if($this->mysqli->query($sql)){
        
			return 'Borrado correctamente';
		}
		else{
			return 'No se puede borrar.Hay fases asociadas a este contacto';
		}
    } 
    else
        return 'No existe';
} 


function rellenadatos() 
{	
    $sql = "SELECT * FROM contactos WHERE (`email` = '$this->email')";
   
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
	
    $sql = "SELECT * FROM contactos WHERE (`email` = '$this->email')";
    
    $result = $this->mysqli->query($sql);
    
    if ($result->num_rows == 1)
    {	
		$sql = "UPDATE contactos SET
					`nombre` = '$this->nombre',
					`descripcion` = '$this->descripcion',
					`telefono` = '$this->telefono'

				WHERE (`email` = '$this->email')";

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
}
?>