<?php

/*
 * Clase : Access_DB donde se realiza la conexion a la BD
 * Autor: yq5lj9
 * Fecha: 30/11/2018
 */

//----------------------------------------------------
// DB connection function
// Can be modified to use CONSTANTS defined in config.inc
//----------------------------------------------------


function ConnectDB()
{
    $mysqli = new mysqli("localhost", "root", "", "todolist");
    	
	if ($mysqli->connect_errno) {
		include './MESSAGE.php';
		new MESSAGE("Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error, './index.php');
		return false;
	}
	else{
		return $mysqli;
	}
}

?>
