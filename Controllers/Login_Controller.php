<!---CONTROLADOR DEL LOGIN
 Creado por: Los Cangrejas
 Fecha: 23/12/2018-->

<?php

//Creamos la sesion
session_start();

//Variable del idioma
if(!isset($_SESSION['idioma'])){
	$_SESSION['idioma'] = 'SPANISH'; //Por defecto el idioma en 
	$idioma = 'SPANISH'; //Spanish
//Elegimos el idioma en funcion de la variable idioma
}else{
	$idioma = $_SESSION['idioma']; //Idioma en la variable
}	

//Include de las funciones que necesitamos
include_once '../Locales/Strings_'.$idioma.'.php';
include_once "../Models/USUARIOS_Model.php";
include_once "../Views/LOGIN_View.php";
include_once "../Views/REGISTRO_View.php";
include_once "../Views/Usuarios_ADD.php";
include_once "../Views/MESSAGE.php";

/* RECOGE LOS DATOS DEL FORMULARIO */
function getDataForm(){
	$login = $_REQUEST['login']; //Login
	$password = $_REQUEST['password'];//pass
	$dni = $_REQUEST['dni'];//dni
	$nombre = $_REQUEST['nombre'];//nombre
	$apellidos = $_REQUEST['apellidos'];//apellidos
	$telefono = $_REQUEST['telefono'];//telefono
	$email = $_REQUEST['email'];//email
	$fecha = $_REQUEST['fecha'];//fecha
	$tipo = $_REQUEST['tipo'];//tipo
	
	$usuario = new USUARIOS_Model ($login,$password,$dni,$nombre,$apellidos,$telefono,$email,$fecha,$tipo);//creamos objeto usuario
	
	return $usuario;//devolvemos objeto usuario
}

//Comprobamos que accion esta definida
if(!isset($_REQUEST['action'])){
	$_REQUEST['action'] = '';
}

//Creamos la variable titulos
$titulos =  array('login','password','dni','nombre','apellidos','telefono','email','fecha','tipo');

//Segun la action elegida
switch ($_REQUEST['action']){
	
	//Queremos hacer un registro
	case 'Confirmar_REGISTRO':		
			new REGISTRO_View($titulos,'../Controllers/Usuarios_Controller.php');	//Creamos la vista de registro	
	break;
	
	//Queremos hacer login
	case 'Confirmar_LOGIN':	
		$usuario = new Usuarios_Model($_REQUEST['login'],$_REQUEST['password'],'','','','','','',''); //Creamos el objeto usuario con el login y pass
		$respuesta = $usuario->login(); //Hacemos login y guardamos respuesta

		//Si la respuesta es afirmativa
		if ($respuesta == 'true'){
			session_start(); //Creamos la sesion
			$_SESSION['login'] = $_REQUEST['login'];//Guardamos datos de sesion
			$tipo = $usuario -> DevolverTipo(); //Guardamos el tipo de user
			$_SESSION['tipo'] = $tipo;//ADMIN o NORMAL
			header('Location:../index.php'); //Vamos al index
		}else{		
			new MESSAGE($respuesta, './Login_Controller.php'); //Sino devolvemos mensaje de error
		}
	break;
	
	//Si queremos hacer logout
	case 'Confirmar_DESCONECTAR':
		include '../Functions/Desconectar.php'; //Desconectamos
	break;
	
	//Por defecto
	default:
		new Login_View(); //Creamos la vista de login
}
?>