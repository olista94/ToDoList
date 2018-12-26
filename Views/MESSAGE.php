<?php

/*
 * Clase : MESSAGE_View 
 * Vista para ver un mensaje concreto
 * Autor: yq5lj9
 * Fecha: 30/11/2018
 */

class MESSAGE{

	private $string; 
	private $volver;

	function __construct($string, $volver){
		$this->string = $string;
		$this->volver = $volver;	
		$this->render();
	}

	function render(){

		include '../Locales/Strings_'.$_SESSION['idioma'].'.php';
		include_once '../Views/Header.php';
?>
		<br>
		<br>
		<br>
		<p>
		<H3>
<?php		
		echo $strings[$this->string];
?>
		</H3>
		</p>
		<br>
		<br>
		<br>

<?php

		echo '<button class="volver" onclick=location.href=\'' . $this->volver . "'> </button>";

		//echo '<a href=\'' . $this->volver . "'>" . $strings['Volver'] . " </a>";
		include_once '../Views/Footer.php';
	} //fin metodo render

}
