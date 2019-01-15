<?php
/*
 * Archivo php donde manejamos el index
 * Autor: yq5lj9
 * Fecha: 30/11/2018
 */

//Creamos la session
session_start();
//incluir funcion autenticacion
include '../Functions/Authentication.php';
//si no esta autenticado
if (!IsAuthenticated()){
	header('Location: ../index.php'); //Al index
//Si esta autenticado
}else{
	include '../Views/index_View.php'; //Al index view
	new Index();
}
?>