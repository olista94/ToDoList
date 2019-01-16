<!---ARCHIVO QUE REALIZARÁ LA CONEXION CON LA BASE DE DATOS
 CREADO POR: Los Cangrejas
 Fecha: 26/12/2018-->

<?php

//----------------------------------------------------
// DB connection function
// Can be modified to use CONSTANTS defined in config.inc
//----------------------------------------------------

//Funcion para conectar con la BD
function ConnectDB()
{
    $mysqli = new mysqli("localhost", "todolist", "todolist", "todolist");//Servidor,usuario,contraseÃ±a y nombre de la bd
    	
	//Si se produce un error	
	if ($mysqli->connect_errno) {
		include './MESSAGE.php';
		//Mensaje de fallo
		new MESSAGE("Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error, './index.php');
		return false;
	}
	else{//Si se conecta correctamente
		return $mysqli;
	}
}

?>
