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
			
	<div class="welcome">		
	<img src="../img/logo.png" alt="Logo" width="60" height="60"> <h1>ToDoList</h1>
	</div>	

	<form class="login_form" name = 'FormLogin' action='../Controllers/Login_Controller.php' method='post' onsubmit="return validarLogin(this)">
			
		<div>	
			<legend><?php echo $strings['Inicia sesión']; ?>
			<button type="submit" title="<?php echo $strings['Registrar nuevo usuario']; ?>" class="registrarse" name="action" value="Confirmar_REGISTRO"></button>
			</legend>

			<label for="login"><?php echo $strings['Login']; ?></label>
			<input type ="text" id="login" name="login" placeholder="Login"  value = '' onblur=" return !comprobarVacio(this) && comprobarAlfabetico(this,15)"><br>
			
			<label for="password"><?php echo $strings['Contraseña']; ?></label>
			<input type = 'password' id="password" name = 'password' placeholder ="<?php echo $strings['Contraseña']; ?>"  value = '' onblur=" return !comprobarVacio(this) && comprobarAlfabetico(this,15)"><br>

		</div>
		
		<button type="submit" title="<?php echo $strings['Iniciar sesion']; ?>" value="Confirmar_LOGIN" name="action" class="aceptar"></button>
				
	</form>							
<?php
			include '../Views/Footer.php';
		} //fin metodo render
	} //fin Login

?>
