<!-- FORMULARIO PARA REGISTRAR UN NUEVO USUARIO EN LA APLICACIÓN
 CREADO POR mi3ac6 EL 21/11/2018-->
<?php

include_once '../Functions/Authentication.php';
include_once '../Views/Header.php';
 
 class Fases_EDIT{
	 
	var $idtarea;
	var $datos;
	var $contactos;
	var $currentcontactos;
	var $currentarchivos;
	var $enlace;
	
	
	function __construct($idtarea,$datos,$contactos,$currentcontactos,$currentarchivos,$enlace){
		
		$this -> idtarea = $idtarea;
		$this -> datos = $datos -> fetch_array();
		$this -> contactos = $contactos;
		$this -> currentcontactos = $currentcontactos;
		$this -> currentarchivos = $currentarchivos;
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
	
	<form name="registerForm" id="registerForm" method="post" action="../Controllers/Fases_Controller.php" enctype="multipart/form-data" onsubmit="return comprobarTarea(this)">
	<legend><?php echo $strings['Editar fase']; ?></label> <button type="button" onclick="location.href='../Controllers/Tareas_Controller.php?action=Confirmar_SHOWFASES&id_tarea=<?php echo $this->idtarea; ?>';" class="volver"></button></legend>
 
	<input hidden type="text" name="id_fase"  value="<?php echo $this -> datos[0]; ?>" readonly><br>
 	<input type="hidden" name="TAREAS_id_TAREAS" value="<?php echo $this->idtarea; ?>">

	<label>
	<?php echo $strings['Descripcion']; ?></label>
	<input type="text" rows="4" cols="50" name="descripcion" value="<?php echo $this -> datos[1]; ?>" onblur=" return !comprobarVacio(this) && comprobarTamano(this,45)">

		
	<label>
	<?php echo $strings['Añadir contacto']; ?></label>
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
	<?php echo $strings['Borrar contacto']; ?></label><br>
	<select name="CONTACTOS_email1[]" multiple>
		<?php
			while($currentcontactos=$this->currentcontactos->fetch_array()){
		?>
				<option value="<?php echo $currentcontactos[2];?>"><?php echo $currentcontactos[2];?>

				</option>
		<?php
			}
		?>
	</select>

	<label for="archivo"><?php echo $strings['Añadir archivos']; ?></label>
	<input type="file" name="archivo[]" id="archivo" size="40" multiple="multiple"/>

	<label>
	<?php echo $strings['Quitar archivos']; ?></label><br>
	<select name="archivos_delete[]" multiple>
		<?php
			while($currentarchivos=$this->currentarchivos->fetch_array()){
		?>
				<option value="<?php echo $currentarchivos[2];?>"><?php echo $currentarchivos[1];?>

				</option>
		<?php
			}
		?>
	</select>
  


 <!-- BOTONES DE CONFIRMAR O CANCELAR NUEVO USUARIO -->
  
 <button type="submit" name="action" value="Confirmar_EDIT" class="aceptar"></button>
				<button type="reset" value="Reset" class="cancelar"></button>

			</form> 
		</div> 
 
 
 </article>
 
 <?php
	include_once "../Views/Footer.php";
	}
 }
 ?>