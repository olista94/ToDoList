<!---ARCHIVO CON LA FUNCION DESCONECTARSE (DESTRUYE LA SESSION)
 Creado por: Los Cangrejas
 Fecha: 20/12/2018-->

<?php
//Creamos la session
session_start();
//Destruimos la session
session_destroy();
//Redirige al index (nos mandara al login)
header('Location:../index.php');

?>
