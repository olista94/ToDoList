<?php
/*
 * Archivo php donde manejamos las acciones para el registro
 * Autor: yq5lj9
 * Fecha: 30/11/2018
 */

//Creamos la sesion
session_start();

//Incluimos el fichero de Strings para el idioma
include_once '../Locales/Strings_'.$_SESSION['idioma'].'.php';

//Si no hemos hecho login
if(!isset($_POST['login'])){
	//Incluimos la vista de registro
	include '../Views/REGISTRO_View.php';
	$register = new REGISTRO_View('');//Creamos la vista para el registro
//Si no
}else{
	//Incluimos el modelo de usurio		
	include '../Models/USUARIOS_Model.php';
	$usuario = new USUARIOS_Model($_REQUEST['login'],$_REQUEST['password'],$_REQUEST['DNI'],
									$_REQUEST['nombre'],$_REQUEST['apellidos'],$_REQUEST['telefono'],$_REQUEST['email'],
									$_REQUEST['FechaNacimiento'],$_REQUEST['tipo']); //Creamos el objeto usuario con los datos
	$respuesta = $usuario->registrar();//Llamamos a la funcion para saber si podemos registrar el usuario

	//Si la respuesta es afirmativa
	if ($respuesta == 'true'){
		$respuesta = $usuario->registrar(); //Registramos el usuario
		Include '../Views/MESSAGE.php';
		new MESSAGE($respuesta, './Login_Controller.php'); //Mostramos mensaje
	//Si es negativa
	}else{
		include '../Views/MESSAGE.php';
		new MESSAGE($respuesta, './Login_Controller.php'); //Mostramos mensaje
	}
}
?>