<?php
/*
 * Archivo php donde manejamos las acciones para el registro
 * Autor: yq5lj9
 * Fecha: 30/11/2018
 */
session_start();
include_once '../Locales/Strings_'.$_SESSION['idioma'].'.php';

if(!isset($_POST['login'])){
	include '../Views/REGISTRO_View.php';
	$register = new REGISTRO_View('');
}else{		
	include '../Models/USUARIOS_Model.php';
	$usuario = new USUARIOS_Model($_REQUEST['login'],$_REQUEST['password'],$_REQUEST['DNI'],
									$_REQUEST['nombre'],$_REQUEST['apellidos'],$_REQUEST['telefono'],$_REQUEST['email'],
									$_REQUEST['FechaNacimiento'],$_REQUEST['tipo']);
	$respuesta = $usuario->registrar();

	if ($respuesta == 'true'){
		$respuesta = $usuario->registrar();
		Include '../Views/MESSAGE.php';
		new MESSAGE($respuesta, './Login_Controller.php');
	}else{
		include '../Views/MESSAGE.php';
		new MESSAGE($respuesta, './Login_Controller.php');
	}
}
?>