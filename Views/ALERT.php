<?php


class ALERT{

	private $string;

	function __construct($string){
		$this->string = $string;	
		$this->render();
	}

	function render(){

		include '../Locales/Strings_'.$_SESSION['idioma'].'.php';
		include_once '../Views/Header.php';
?>
		<br>
		<br>
		<br>
		<div class="alert info">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>  
<?php		
		echo $strings[$this->string];
?>
        </div>
		<br>
		<br>

<?php

	} //fin metodo render

}
