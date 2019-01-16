<!---MODELO DE LOS USUARIOS
 CREADO POR los Cangrejas EL 21/12/2018-->
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

//Constructor de la clase
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

	//Incluimos el archivo de acceso a la bd
	include_once 'Access_DB.php';
	//Funcion de conexion a la bd
	$this->mysqli = ConnectDB();
}

//Funcion para hacer login
function login(){

	$sql = "SELECT *
			FROM usuarios
			WHERE (
				(login = '$this->login') 
			)";

	$resultado = $this->mysqli->query($sql);//Guarda el resultado
	if ($resultado->num_rows == 0){
		return 'El login no existe';//Devuelve mensaje de error	
	}
	else{
		$tupla = $resultado->fetch_array();
		if ($tupla['password'] == $this->password){
			return true; //Exito
		}
		else{
			return 'La password para este usuario no es correcta';//Devuelve mensaje de error	
		}
	}
}//fin metodo login

//Funcion que comprueba la validez del registro
function Register(){

		$sql = "select * from usuarios where login = '".$this->login."'";

		$result = $this->mysqli->query($sql);//Guarda el resultado
		if ($result->num_rows == 1){  // existe el usuario
				return 'El usuario ya existe';//Devuelve mensaje de error	
			}
		else{
	    		return true; //no existe el usuario
		}

	}

//Funcion que realiza el registro
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
			
			return 'Error al insertar';//Devuelve mensaje de error	
		}
		else{
			
			return  'Insercion correcta'; //operacion de insertado correcta
		}		
	}
	
	function rellenadatos() 
{	
    $sql = "SELECT * FROM usuarios WHERE (`login` = '$this->login')";
   
    if (!($resultado = $this->mysqli->query($sql))){
		return 'No existe'; //Devuelve mensaje de error	
	}
    else{ 
		$result = $resultado;
		return $result;//Se devuelve el resultado de la consulta
	}
}

//Funcion que edita un usuario
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
			return 'Error en la modificación';//Devuelve mensaje de error	
		}
		else{ 
			
			return 'Modificado correctamente'; //Exito
		}
    }
    else 
    	return 'No existe';//Devuelve mensaje de error	
} 

//Funcion para buscar un usuario
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
		return 'Error en la búsqueda';//Devuelve mensaje de error	
		
	}
    else{ 
		return $resultado;//Se devuelve el resultado de la consulta
	}
}

//Funcion para borrar un usuario
function delete()
{	
    $sql = "SELECT * FROM usuarios WHERE (`login` = '$this->login')";
    
    $result = $this->mysqli->query($sql);//Guarda el resultado
    
    if ($result->num_rows == 1)
    {
    	
        $sql = "DELETE FROM usuarios WHERE (`login` = '$this->login')";
        
        $this->mysqli->query($sql);
        
    	return 'Borrado correctamente';//Exito
    } 
    else
        return 'No existe';//Devuelve mensaje de error	
}  

//Funcion que devuelve el tipo de usuario
function DevolverTipo()
{	
    $sql = "SELECT tipo FROM usuarios WHERE (`login` = '$this->login')";
    
    $result = $this->mysqli->query($sql);//Guarda el resultado
    
    if ($result->num_rows == 1)
    {    
    	return $result -> fetch_array()[0];//Guarda el resultado (El tipo de usuario)
    } 
    else
        return 'No existe';//Devuelve mensaje de error	
}  

}//fin de clase

?> 