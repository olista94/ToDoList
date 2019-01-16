<!---MODELO DE LOS CONTACTOS
 CREADO POR los Cangrejas EL 21/12/2018-->
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

		//Incluimos el archivo de acceso a la bd
		include_once 'Access_DB.php';
		//Funcion de conexion a la bd
		$this->mysqli = ConnectDB();
		}
		
function add(){
		
	if (($this->email != '')){

		
        $sql = "SELECT * FROM contactos WHERE (`email` = '$this->email')";
		if (!$result = $this->mysqli->query($sql)){ 
			return 'No se ha podido conectar con la base de datos'; //Devuelve mensaje de error
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
					return 'Error al insertar';//Devuelve mensaje de error
					
				}
				else{ 
					return 'Insercion correcta'; //Devuelve mensaje de exito
					
				}

			}
			else 
				return 'El usuario ya existe'; //Devuelve mensaje de error
		}
    }
    else{ 
         return 'Introduzca un valor para la clave';//Devuelve mensaje de error 
		
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
				
   
    if (!($resultado = $this->mysqli->query($sql))){
		return 'Error en la búsqueda';
		
	}
    else{ 
		return $resultado;
	}
} 
function delete()
{	
    $sql = "SELECT * FROM contactos WHERE (`email` = '$this->email')";
    
    $result = $this->mysqli->query($sql);//Guarda el resultado
    
    if ($result->num_rows == 1)
    {
    	
        $sql = "DELETE FROM contactos WHERE (`email` = '$this->email')";
        
        if($this->mysqli->query($sql)){
        
			return 'Borrado correctamente';//Devuelve mensaje de exito
		}
		else{
			return 'No se puede borrar.Hay fases asociadas a este contacto';//Devuelve mensaje de error
		}
    } 
    else
        return 'No existe';
} 


function rellenadatos() 
{	
    $sql = "SELECT * FROM contactos WHERE (`email` = '$this->email')";
   
    if (!($resultado = $this->mysqli->query($sql))){
		return 'No existe'; //Devuelve mensaje de error
	}
    else{ 
		$result = $resultado;
		return $result;
	}
} 

function edit()
{
	
    $sql = "SELECT * FROM contactos WHERE (`email` = '$this->email')";
    
    $result = $this->mysqli->query($sql); //Guarda el resultado
    
    if ($result->num_rows == 1)
    {	
		$sql = "UPDATE contactos SET
					`nombre` = '$this->nombre',
					`descripcion` = '$this->descripcion',
					`telefono` = '$this->telefono'

				WHERE (`email` = '$this->email')";

        if (!($resultado = $this->mysqli->query($sql))){
			return 'Error en la modificación';//Devuelve mensaje de error
		}
		else{ 
			return 'Modificado correctamente'; //Devuelve mensaje de exito
		}
    }
    else 
    	return 'No existe';//Devuelve mensaje de error
}
}
?>