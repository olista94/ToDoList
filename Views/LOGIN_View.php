<!-- VISTA DEL LOGIN
CREADO POR: Los Cangrejas
Fecha: 27/12/2018-->

<?php

 //Declaracion de la clase 
	class Login_View{
//Constructor de la clase
		function __construct(){	
			$this->render();
		}
	//Funcion que "muestra" el contenido de la página
		function render(){
			include_once '../Views/Header.php'; 
?>
			
	<div class="welcome">		
	<img src="../img/logo.png" alt="Logo" width="60" height="60"> <h1>ToDoList</h1>
	</div>
		<!--Form del login-->	
	<form class="login_form" name = 'FormLogin' action='../Controllers/Login_Controller.php' method='post'>
			
		<div>	
			<legend><?php echo $strings['Inicia sesión']; ?>
			<!--Boton para registrar un usuario nuevo-->
			<button type="submit" title="<?php echo $strings['Registrar nuevo usuario']; ?>" class="registrarse" name="action" value="Confirmar_REGISTRO"></button>
			</legend>
			<!--Campo login-->
			<label for="login"><?php echo $strings['Login']; ?></label>
			<input type ="text" id="login" name="login" placeholder="Login"  value = '' onblur=" return !comprobarVacio(this) && comprobarAlfabetico(this,15)"><br>
			<!--Campo password-->
			<label for="password"><?php echo $strings['Contraseña']; ?></label>
			<input type = 'password' id="password" name = 'password' placeholder ="<?php echo $strings['Contraseña']; ?>"  value = '' onblur=" return !comprobarVacio(this) && comprobarAlfabetico(this,15)"><br>

		</div>
		<!--Boton para loguearse-->
		<button type="submit" title="<?php echo $strings['Iniciar sesion']; ?>" value="Confirmar_LOGIN" name="action" class="aceptar" onclick="if (validarLogin(document.forms['FormLogin'])) document.forms['FormLogin'].submit();else return false;"></button>
				
	</form>
	<!--Banderas para cambiar el idioma-->
	<div class="flags1">
		<form name='idioma' action="../Functions/CambioIdioma.php" method="POST" style="display: inline-block; margin:10; padding:0;">
			<input type="hidden" name='idioma' value="ENGLISH">
			<input type="image" src="../Views/img/uk.png"  width="45px">
		</form>
		
		<form name='idioma' action="../Functions/CambioIdioma.php" method="POST" style="display: inline-block; margin:10; padding:0;">
			<input type="hidden" name='idioma' value="SPANISH" >
			<input type="image"  src="../Views/img/spain.png"  width="35px" >
		</form>
		
		<form name='idioma' action="../Functions/CambioIdioma.php" method="POST" style="display: inline-block; margin:10;  padding:0;">
			<input type="hidden" name='idioma' value="GALLAECIAN" >
			<input type="image"  src="../Views/img/galicia.png" width="35px">	
		</form>
	</div>
						
<?php
//Pie
			include '../Views/Footer.php';
		} //fin metodo render
	} //fin Login

?>
