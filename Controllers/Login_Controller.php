<!---CONTROLADOR DEL LOGIN
 CREADO POR mi3ac6 EL 19/11/2018-->

<?php

session_start();
if (!isset($_SESSION['idioma'])) {
		$_SESSION['idioma'] = 'SPANISH';
		$idioma = 'SPANISH';
	}
	else{
		$idioma = $_SESSION['idioma'];
	}
	

include_once '../Locales/Strings_'.$idioma.'.php';
include_once "../Models/USUARIOS_Model.php";
include_once "../Views/LOGIN_View.php";
include_once "../Views/REGISTRO_View.php";
include_once "../Views/Usuarios_ADD.php";
include_once "../Views/MESSAGE.php";




/* RECOGE LOS DATOS DEL FORMULARIO */
function getDataForm(){
	$login = $_REQUEST['login'];
	$password = $_REQUEST['password'];
	$dni = $_REQUEST['dni'];
	$nombre = $_REQUEST['nombre'];
	$apellidos = $_REQUEST['apellidos'];
	$telefono = $_REQUEST['telefono'];
	$email = $_REQUEST['email'];
	$fecha = $_REQUEST['fecha'];
	$tipo = $_REQUEST['tipo'];
	
	$usuario = new USUARIOS_Model ($login,$password,$dni,$nombre,$apellidos,$telefono,$email,$fecha,$tipo);
	
	return $usuario;
}


if(!isset($_REQUEST['action'])){
	$_REQUEST['action'] = '';
}
$titulos =  array('login','password','dni','nombre','apellidos','telefono','email','fecha','tipo');
/* print_r($_REQUEST); */
switch ($_REQUEST['action']){
	
	case 'Confirmar_REGISTRO':
		
			new REGISTRO_View($titulos,'../Controllers/Usuarios_Controller.php');
		
	break;
	
	case 'Confirmar_LOGIN':
	
	$usuario = new Usuarios_Model($_REQUEST['login'],$_REQUEST['password'],'','','','','','','');
	$respuesta = $usuario->login();

	if ($respuesta == 'true'){
		session_start();
		$_SESSION['login'] = $_REQUEST['login'];
		$tipo = $usuario -> DevolverTipo();
		$_SESSION['tipo'] = $tipo;//ADMIN o NORMAL
		header('Location:../index.php');
	}
	else{
		
		new MESSAGE($respuesta, './Login_Controller.php');
	}
	break;
	
	case 'Confirmar_DESCONECTAR':
	include '../Functions/Desconectar.php';
	break;
	
	 default: 
	 
	 new Login_View();
	
			

}
?>