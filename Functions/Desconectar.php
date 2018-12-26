<?php

/*
 Archivo php donde destruimos la sesion
 Autor: yq5lj9
 Fecha: 30/11/2018
*/

session_start();
session_destroy();
header('Location:../index.php');

?>
