<!---MODELO DE LOS USUARIOS QUE ADMINISTRARÁN LA LOTERIAIU,DONDE SE REALIZARÁ LA OPERACION DE INSERCIÓN EN LA BD
 CREADO POR mi3ac6 EL 23/11/2018-->
<?php

class USUARIOS_Model {

	var $login;
	var $password;
	var $dni;
	var $nombre;
	var $apellidos;
	var $telefono;
	var $email;
	var $fecha;
	/* var $mysqli; */

//Constructor de la clase
//

function __construct($login,$password,$dni,$nombre,$apellidos,$telefono,$email,$fecha){
	$this->login = $login;
	$this->password = $password;
	$this->dni = $dni;
	$this->nombre = $nombre;
	$this->apellidos = $apellidos;
	$this->telefono = $telefono;
	$this->email = $email;
	$this->fecha = $fecha;

	include_once '../Models/Access_DB.php';
	$this->mysqli = ConnectDB();
}




function login(){

	$sql = "SELECT *
			FROM usuarios
			WHERE (
				(login = '$this->login') 
			)";

	$resultado = $this->mysqli->query($sql);
	if ($resultado->num_rows == 0){
		return $GLOBALS['strings']['El login no existe'];
	}
	else{
		$tupla = $resultado->fetch_array();
		if ($tupla['password'] == $this->password){
			return true;
		}
		else{
			return $GLOBALS['strings']['La password para este usuario no es correcta'];
		}
	}
}//fin metodo login

//
function Register(){

		$sql = "select * from usuarios where login = '".$this->login."'";

		$result = $this->mysqli->query($sql);
		if ($result->num_rows == 1){  // existe el usuario
				return $GLOBALS['strings']['El usuario ya existe'];
			}
		else{
	    		return true; //no existe el usuario
		}

	}

function registrar(){

			
		$sql = "INSERT INTO usuarios (
			login,
			password,
			dni,
			nombre,
			apellidos,
			telefono,
			email,
			fecha
			) 
				VALUES (
					'$this->login',
					'$this->password',
					'$this->dni',
					'$this->nombre',
					'$this->apellidos',
					'$this->telefono',
					'$this->email',
					'$this->fecha'
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
    $sql = "SELECT * FROM usuarios WHERE (`login` = '$this->login')";
   
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
	
    $sql = "SELECT * FROM usuarios WHERE (`login` = '$this->login')";
    
    $result = $this->mysqli->query($sql);
    
    if ($result->num_rows == 1)
    {	
		$sql = "UPDATE usuarios SET
					`password` = '$this->password',
					`dni` = '$this->dni',
					`nombre` = '$this->nombre',
					`apellidos` = '$this->apellidos',
					`telefono` = '$this->telefono',
					`email` = '$this->email',
					`fecha` = '$this->fecha'

				WHERE (`login` = '$this->login')";

        if (!($resultado = $this->mysqli->query($sql))){
			return $GLOBALS['strings']['Error en la modificación'];
		}
		else{ 
			echo $sql;
			return $GLOBALS['strings']['Modificado correctamente']; 
		}
    }
    else 
    	return $GLOBALS['strings']['No existe'];
} 

function search(){ 

	     $sql = "SELECT *
       			FROM usuarios
    			WHERE
    				( 
    				(`login` LIKE '%$this->login%') &&
	 				(`nombre` LIKE '%$this->nombre%') &&
					(`apellidos` LIKE '%$this->apellidos%') &&
					(`dni` LIKE '%$this->dni%') &&
					(`telefono` LIKE '%$this->telefono%') &&
					(`email` LIKE '%$this->email%') &&
					(`fecha` LIKE '%$this->fecha%')
					
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
    $sql = "SELECT * FROM usuarios WHERE (`login` = '$this->login')";
    
    $result = $this->mysqli->query($sql);
    
    if ($result->num_rows == 1)
    {
    	
        $sql = "DELETE FROM usuarios WHERE (`login` = '$this->login')";
        
        $this->mysqli->query($sql);
        
    	return $GLOBALS['strings']['Borrado correctamente'];
    } 
    else
        return $GLOBALS['strings']['No existe'];
}  

}//fin de clase

?> 