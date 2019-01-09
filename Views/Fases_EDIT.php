<!-- FORMULARIO PARA REGISTRAR UN NUEVO USUARIO EN LA APLICACIÓN
 CREADO POR mi3ac6 EL 21/11/2018-->
<?php

include_once '../Functions/Authentication.php';
include_once '../Views/Header.php';
 
 class Fases_EDIT{
	 
	var $datos;
	var $contactos;
	var $currentcontactos;
	var $enlace;
	
	
	function __construct($datos,$contactos,$currentcontactos,$enlace){
		
		$this -> datos = $datos -> fetch_array();
		
		$this -> contactos = $contactos;
		$this -> currentcontactos = $currentcontactos;
		$this -> enlace = $enlace;
		$this -> mostrar();
	}
	
	function mostrar(){

		if(!isset($_SESSION['idioma'])){
            $_SESSION['idioma'] = 'SPANISH';
        }

        include '../Locales/Strings_'. $_SESSION['idioma'] .'.php'; 
	 
?>


<div class="form">

<form name="registerForm" id="registerForm" method="post" action="../Controllers/Fases_Controller.php" enctype="multipart/form-data">
	<legend><?php echo $strings['Editar categoria'];?>
	<button onclick="location.href='../Controllers/Fases_Controller.php';" class="volver"></button>
	</legend>
 
	<input hidden type="text" name="id_fase"  value="<?php echo $this -> datos[0]; ?>" readonly><br>
 

	<label>
	<?php echo $strings['Descripcion']; ?></label><br>
	<input type="text" rows="4" cols="50" name="descripcion" value="<?php echo $this -> datos[1]; ?>" onblur= "return !comprobarVacio(this)">
	
	
	<label>
	<?php echo $strings['Fecha inicio']; ?></label><br>
	<input type="date" name="fecha_ini"   value="<?php echo $this -> datos[2]; ?>" onblur=" return !comprobarVacio(this)"><br>
	
	<label>
	<?php echo $strings['Fecha fin']; ?></label><br>
	<input type="date" name="fecha_fin"   value="<?php echo $this -> datos[3]; ?>" onblur=" return !comprobarVacio(this)"><br>
  
		
	<label>
	<?php echo $strings['Añadir contacto']; ?></label><br>
	<select name="CONTACTOS_email[]" multiple>
		<?php
			while($contactos=$this->contactos->fetch_array()){
		?>
				<option value="<?php echo $contactos[0];?>"><?php echo $contactos[0];?>

				</option>
		<?php
			}
		?>
	</select>

	<label>
	<?php echo $strings['Quitar contacto']; ?></label><br>
	<select name="CONTACTOS_email[]" multiple>
		<?php
			while($currentcontactos=$this->currentcontactos->fetch_array()){
		?>
				<option value="<?php echo $currentcontactos[2];?>"><?php echo $currentcontactos[2];?>

				</option>
		<?php
			}
		?>
	</select>
  
  
  


 <!-- BOTONES DE CONFIRMAR O CANCELAR NUEVO USUARIO -->
  
 <button type="submit" name="action" value="Confirmar_EDIT" value="Submit" class="aceptar"></button>
				<button type="reset" value="Reset" class="cancelar"></button>

			</form> 
		</div> 
 
 
 </article>
 
 <?php
	include_once "../Views/Footer.php";
	}
 }
 ?>