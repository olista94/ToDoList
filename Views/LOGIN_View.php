<?php

/*
 * Clase : Login_View 
 * Contiene la vista del login
 * Autor: yq5lj9
 * Fecha: 30/11/2018
 */

	class Login_View{

		function __construct(){	
			$this->render();
		}

		function render(){
			include_once '../Views/Header.php'; 
?>
			
				 
	<form class="login_form" name = 'Form' action='../Controllers/Login_Controller.php' method='post'>
			
		<div>	
			<legend><?php echo $strings['Inicia sesión']; ?></legend>

			<label for="login"><?php echo $strings['Login']; ?></label>
			<input type ="text" id="login" name="login" placeholder="Login" maxlength="15" value = '' ><br>
			
			<label for="password"><?php echo $strings['Contraseña']; ?></label>
			<input type = 'password' id="password" name = 'password' placeholder ="<?php echo $strings['Contraseña']; ?>" maxlength="128" value = '' ><br>

		</div>
		
		<button type="submit" value="Confirmar_LOGIN" name="action" class="aceptar"></button>
		<button type="submit" title="<?php echo $strings['Registrar nuevo usuario']; ?>" class="botontabla" name="action" value="Confirmar_REGISTRO">
		<i class="fas fa-user-plus"></i></button>

	</form>							
<?php
			include '../Views/Footer.php';
		} //fin metodo render
	} //fin Login

?>
