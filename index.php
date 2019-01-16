<!-- Fiechero que indica a donde debe redireccionarse al entrar en la aplicacion
CREADO POR: Los Cangrejas
Fecha: 20/12/2018-->


<?php
//entrada a la aplicacion

//se va usar la session de la conexion
session_start();

//funcion de autenticacion
include './Functions/Authentication.php';

//si no ha pasado por el login de forma correcta
if (!IsAuthenticated()){
	header('Location:./Controllers/Login_Controller.php');
}
//si ha pasado por el login de forma correcta 
else{
	header('Location:./Controllers/Index_Controller.php');
}

?>
