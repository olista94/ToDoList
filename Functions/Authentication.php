<!---ARCHIVO CON LA FUNCION PARA VALIDAR SI EXISTE LA SESION LOGIN (SI ESTA O NO LOGUEADO)
 Creado por: Los Cangrejas
 Fecha: 20/12/2018-->
<?php

/*Si no existe la sesion login redirige a la pagina de login
Si existe comprueba si el usuario tiene permisos para ejecutar la accion de ese controlador*/
function IsAuthenticated(){
	if (!isset($_SESSION['login'])){
		//header('Location:USUARIOS_Controller.php?accion=Login');	
		return false;
	}
	else{
		/*if (!HavePermissions($controller, $_REQUEST['accion']))
			new Mensaje('No tiene permisos para ejecutar esta acción','index.php');	
		*/
		//header('Location:USUARIOS_Controller.php');
		return true;
	}
} //Fin de la función
?>

