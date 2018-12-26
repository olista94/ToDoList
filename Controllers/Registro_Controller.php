<?php

/*
 * Archivo php donde manejamos las acciones para el registro
 * Autor: yq5lj9
 * Fecha: 30/11/2018
 */

session_start();
include_once '../Locales/Strings_'.$_SESSION['idioma'].'.php';

//session_start();

if(!isset($_POST['login'])){
	include '../Views/REGISTRO_View.php';
	$register = new Register();
}
else{

	if($_FILES['fotopersonal']['size'] > 0){
		$directory = '../Files/';
		
		$path = $_FILES['fotopersonal']['name'];
		$ext = pathinfo($path, PATHINFO_EXTENSION);

		$uploaded_file = $directory . "foto_" . $_REQUEST['login'] . "." . $ext;
		copy($_FILES['fotopersonal']['tmp_name'], $uploaded_file);

		$fotopersonal = $uploaded_file;
		unset($_FILES['fotopersonal']);
	}else{
		$fotopersonal = '../Files/default.jpg';
	}
		
	include '../Models/USUARIOS_Model.php';
	$usuario = new USUARIOS_Model($_REQUEST['login'],$_REQUEST['password'],$_REQUEST['DNI'],
	$_REQUEST['nombre'],$_REQUEST['apellidos'],$_REQUEST['telefono'],$_REQUEST['email'],
	$_REQUEST['FechaNacimiento'],$fotopersonal,$_REQUEST['sexo']);
	$respuesta = $usuario->Register();

	if ($respuesta == 'true'){
		$respuesta = $usuario->registrar();
		Include '../Views/MESSAGE.php';
		new MESSAGE($respuesta, './Login_Controller.php');
	}
	else{
		include '../Views/MESSAGE.php';
		new MESSAGE($respuesta, './Login_Controller.php');
	}

}

?>

