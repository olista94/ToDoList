<?php

/*
 * Clase : Login_View 
 * Contiene la vista del login
 * Autor: yq5lj9
 * Fecha: 30/11/2018
 */

	class Login{

		function __construct(){	
			$this->render();
		}

		function render(){
			include '../Views/Header.php'; 
?>
				 
	<form class="login_form" name = 'Form' action='../Controllers/Login_Controller.php' method='post' onsubmit="return comprobarLogin(this);">
			
		<div>	
			<legend><?php echo $strings['Inicia sesión']; ?></legend>

			<label for="login"><?php echo $strings['Login']; ?></label>
			<input type ="text" id="login" name="login" placeholder="Login" maxlength="15" value = '' required onchange="comprobarTexto(this, 15)"><br>
			
			<label for="password"><?php echo $strings['Contraseña']; ?></label>
			<input type = 'password' id="password" name = 'password' placeholder ="<?php echo $strings['Contraseña']; ?>" maxlength="128" value = '' required onchange="comprobarTexto(this, 128)"><br>

		</div>
		
		<button type="submit" value="Login" name="action" class="aceptar"></button>

	</form>							
<?php
			include '../Views/Footer.php';
		} //fin metodo render
	} //fin Login

?>
