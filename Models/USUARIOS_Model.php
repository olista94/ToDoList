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
	var $tipo;
	/* var $mysqli; */

//Constructor de la clase
//

function __construct($login,$password,$dni,$nombre,$apellidos,$telefono,$email,$fecha,$tipo){
	$this->login = $login;
	$this->password = $password;
	$this->dni = $dni;
	$this->nombre = $nombre;
	$this->apellidos = $apellidos;
	$this->telefono = $telefono;
	$this->email = $email;
	$this->fecha = $fecha;
	$this->tipo = $tipo;

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
		return 'El login no existe';
	}
	else{
		$tupla = $resultado->fetch_array();
		if ($tupla['password'] == $this->password){
			return true;
		}
		else{
			return 'La password para este usuario no es correcta';
		}
	}
}//fin metodo login

//
function Register(){

		$sql = "select * from usuarios where login = '".$this->login."'";

		$result = $this->mysqli->query($sql);
		if ($result->num_rows == 1){  // existe el usuario
				return 'El usuario ya existe';
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
			fecha,
			tipo
			) 
				VALUES (
					'$this->login',
					'$this->password',
					'$this->dni',
					'$this->nombre',
					'$this->apellidos',
					'$this->telefono',
					'$this->email',
					'$this->fecha',
					'$this->tipo'
					)";
			
		if (!$this->mysqli->query($sql)) {
			
			return 'Error al insertar';
		}
		else{
			
			return  'Insercion correcta'; //operacion de insertado correcta
		}		
	}
	
	function rellenadatos() 
{	
    $sql = "SELECT * FROM usuarios WHERE (`login` = '$this->login')";
   
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
					`fecha` = '$this->fecha',
					`tipo` = '$this->tipo'

				WHERE (`login` = '$this->login')";

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
       			FROM usuarios
    			WHERE
    				( 
    				(`login` LIKE '%$this->login%') &&
	 				(`nombre` LIKE '%$this->nombre%') &&
					(`apellidos` LIKE '%$this->apellidos%') &&
					(`dni` LIKE '%$this->dni%') &&
					(`telefono` LIKE '%$this->telefono%') &&
					(`email` LIKE '%$this->email%') &&
					(`fecha` LIKE '%$this->fecha%') &&
					(`tipo` LIKE '%$this->tipo%')
					
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
    $sql = "SELECT * FROM usuarios WHERE (`login` = '$this->login')";
    
    $result = $this->mysqli->query($sql);
    
    if ($result->num_rows == 1)
    {
    	
        $sql = "DELETE FROM usuarios WHERE (`login` = '$this->login')";
        
        $this->mysqli->query($sql);
        
    	return 'Borrado correctamente';
    } 
    else
        return 'No existe';
}  

function DevolverTipo()
{	
    $sql = "SELECT tipo FROM usuarios WHERE (`login` = '$this->login')";
    
    $result = $this->mysqli->query($sql);
    
    if ($result->num_rows == 1)
    {    
    	return $result -> fetch_array()[0];
    } 
    else
        return 'No existe';
}  

}//fin de clase

?> 