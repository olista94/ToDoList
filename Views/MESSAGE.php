 <!-- ARCHIVO QUE MUESTRA UN MENSAJE Y UN ENLACE PARA REGRESAR
 CREADO POR: Los Cangrejas
Fecha: 20/12/2018-->

<?php

 //Declaracion de la clase 
class MESSAGE{

 //Cadena que se muestra como mensaje
	private $string; 
	//Enlace para volver a otra pagina
	private $volver;
//Constructor de la clase
	function __construct($string, $volver){
		$this->string = $string;
		$this->volver = $volver;	
		$this->render();
	}
	//Funcion que "muestra" el contenido de la página
	function render(){
		//Variable de idioma
if(!isset($_SESSION['idioma'])){
            $_SESSION['idioma'] = 'SPANISH';
        }
		//Archivo de idioma
		include '../Locales/Strings_'.$_SESSION['idioma'].'.php';
		//Header
		include_once '../Views/Header.php';
?>
		<br>
		<br>
		<br>
		<p>
		<H3>
<?php		
		//Aqui se muestra el mensaje
		echo $strings[$this->string];
?>
		</H3>
		</p>
		<br>
		<br>
		<br>

<?php
		//Aqui se muestra el enlace en forma de boton
		echo '<button class="volver" onclick=location.href=\'' . $this->volver . "'> </button>";

		//Pie
		include_once '../Views/Footer.php';
	} //fin metodo render

}
