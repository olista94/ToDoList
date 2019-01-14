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

			<div class="flags1" style="margin-right:420px; margin-top:270px;" style="position:absolute">
				<form name='idioma' action="../Functions/CambioIdioma.php" method="POST" style="display: inline-block; margin:10; padding:0;">
					<input type="hidden" name='idioma' value="ENGLISH">
					<input type="image" src="../img/uk.png"  width="45px">
				</form>
				
				<form name='idioma' action="../Functions/CambioIdioma.php" method="POST" style="display: inline-block; margin:10; padding:0;">
					<input type="hidden" name='idioma' value="SPANISH" >
					<input type="image"  src="../img/spain.png"  width="35px" >
				</form>
				
				<form name='idioma' action="../Functions/CambioIdioma.php" method="POST" style="display: inline-block; margin:10;  padding:0;">
					<input type="hidden" name='idioma' value="GALLAECIAN" >
					<input type="image"  src="../img/galicia.png" width="35px">	
				</form>
			</div>
			
	<form class="login_form" name = 'FormLogin' action='../Controllers/Login_Controller.php' method='post'>
			
		<div>	
			<legend><?php echo $strings['Inicia sesión']; ?>
			<button style="margin-right:-150px" type="submit" title="<?php echo $strings['Registrar nuevo usuario']; ?>" class="registrarse" name="action" value="Confirmar_REGISTRO"></button>
			</legend>

			<label for="login"><?php echo $strings['Login']; ?></label>
			<input type ="text" id="login" name="login" placeholder="Login"  value = '' onblur=" return !comprobarVacio(this) && comprobarAlfabetico(this,15)"><br>
			
			<label for="password"><?php echo $strings['Contraseña']; ?></label>
			<input type = 'password' id="password" name = 'password' placeholder ="<?php echo $strings['Contraseña']; ?>"  value = '' onblur=" return !comprobarVacio(this) && comprobarAlfabetico(this,15)"><br>

		</div>
		
		<button type="submit" title="<?php echo $strings['Iniciar sesion']; ?>" value="Confirmar_LOGIN" name="action" class="aceptar" onclick="if (validarLogin(document.forms['FormLogin'])) document.forms['FormLogin'].submit();else return false;"></button>
				
	</form>							
<?php
			include '../Views/Footer.php';
		} //fin metodo render
	} //fin Login

?>
