<!---MODELO DE LOS CONTACTOS
 CREADO POR los Cangrejas EL 21/12/2018-->
<?php
//Declaracion de la clase
class CONTACTOS_Model{
	//Email del contacto
	var $email;
	//Nombre del contacto
	var $nombre;
	//Descripcion del contacto
	var $descripcion;
	//Telefono del contacto
	var $telefono;
	
	//Constructor de la clase
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
//Funcion para insertar contactos
function add(){
		
	if (($this->email != '')){

		//Sentencia sql para insertar contacto
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

//Funcion sql que buscara las categorias que correspondan
function search(){ 
//Sentencia sql que buscara los contactos que correspondan a los datos introducidos en los campos del form
	     $sql = "SELECT *
       			FROM contactos
    			WHERE
    				( 
    				(`email` LIKE '%$this->email%') &&
	 				(`nombre` LIKE '%$this->nombre%') &&
					(`descripcion` LIKE '%$this->descripcion%') &&
					(`telefono` LIKE '%$this->telefono%')
    				)";
				
   //Mensaje de error
    if (!($resultado = $this->mysqli->query($sql))){
		return 'Error en la búsqueda';
		
	}
    else{//Devuelve el resultado
		return $resultado;
	}
} 

//Funcion de borrado de un contacto
function delete()
{	
	//Sentencia sql que buscara el contacto a borrar
    $sql = "SELECT * FROM contactos WHERE (`email` = '$this->email')";
    
    $result = $this->mysqli->query($sql);//Guarda el resultado
    
    if ($result->num_rows == 1)
    {
    	//Sentencia sql para borrar
        $sql = "DELETE FROM contactos WHERE (`email` = '$this->email')";
        
        if($this->mysqli->query($sql)){
        
			return 'Borrado correctamente';//Devuelve mensaje de exito
		}
		else{
			return 'No se puede borrar.Hay fases asociadas a este contacto';//Devuelve mensaje de error
		}
    } 
    else//Si no la encuentra
        return 'No existe';
} 

//Funcion que obtiene todos los datos de un contacto especifico
function rellenadatos() 
{	
	//Sentencia sql para buscar el contacto por email (PK)
    $sql = "SELECT * FROM contactos WHERE (`email` = '$this->email')";
   
    if (!($resultado = $this->mysqli->query($sql))){
		return 'No existe'; //Devuelve mensaje de error
	}
    else{//Devuelve el resultado
		$result = $resultado;
		return $result;
	}
} 

//Funcion para editar contacto
function edit()
{
	//Sentencia sql que buscara todos los datos de un contacto
    $sql = "SELECT * FROM contactos WHERE (`email` = '$this->email')";
    
    $result = $this->mysqli->query($sql); //Guarda el resultado
    //Si devuelve 1a fila (consulta realizada correctamente)
    if ($result->num_rows == 1)
    {	
	//Sentencia sql para editar
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