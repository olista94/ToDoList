<?php

 //Declaracion de la clase
class ALERT{

//Cadena que se muestra como mensaje
	private $string;

//Constructor de la clase
	function __construct($string){
		$this->string = $string;	
		$this->render();
	}

//Funcion que "muestra" el contenido de la página
	function render(){

		//Archivo de idioma
		include '../Locales/Strings_'.$_SESSION['idioma'].'.php';
		//Header
		include_once '../Views/Header.php';
?>
		<br>
		<br>
		<br>
		<div class="alert info">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>  
<?php		
//Aqui se muestra el mensaje
		echo $strings[$this->string];
?>
        </div>
		<br>
		<br>

<?php

	} //fin metodo render

}
