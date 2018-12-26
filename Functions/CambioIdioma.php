<?php

/*
 Archivo php donde cambiamos el idioma
 Autor: yq5lj9
 Fecha: 30/11/2018
*/

session_start();
$idioma = $_POST['idioma'];
$_SESSION['idioma'] = $idioma;
header('Location:' . $_SERVER["HTTP_REFERER"]);
?>