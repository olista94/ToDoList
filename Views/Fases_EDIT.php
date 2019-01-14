<!-- FORMULARIO PARA REGISTRAR UN NUEVO USUARIO EN LA APLICACIÓN
 CREADO POR mi3ac6 EL 21/11/2018-->
<?php
//Comprueba que este autenticado
include_once '../Functions/Authentication.php';
include_once '../Views/Header.php';
  //Declaracion de la clase 
 class Fases_EDIT{
	  //Id de la tarea a la que pertenece la fase a añadir
	var $idtarea;
	//Datos de la fase a editar
	var $datos;
	//Contactos que participaran en la tarea
	var $contactos;
	//Contactos que participan en la tarea actual
	var $currentcontactos;
	//Archivos que participan en la tarea actual
	var $currentarchivos;
	//Variable con el enlace al form de EDIT fase
	var $enlace;
	
		//Constructor de la clase
	function __construct($idtarea,$datos,$contactos,$currentcontactos,$currentarchivos,$enlace){
		
		$this -> idtarea = $idtarea;
		$this -> datos = $datos -> fetch_array();
		$this -> contactos = $contactos;
		$this -> currentcontactos = $currentcontactos;
		$this -> currentarchivos = $currentarchivos;
		$this -> enlace = $enlace;
		$this -> mostrar();
	}
	//Funcion que "muestra" el contenido de la página
	function mostrar(){
//Variable de idioma
		if(!isset($_SESSION['idioma'])){
            $_SESSION['idioma'] = 'SPANISH';
        }
//Archivo del idioma
        include '../Locales/Strings_'. $_SESSION['idioma'] .'.php'; 
	 
?>
<!--Formulario para editar fase-->

<div class="form">	
	
	<form name="registerForm" id="registerForm" method="post" action="../Controllers/Fases_Controller.php" enctype="multipart/form-data" onsubmit="return comprobarTarea(this)">
	<legend><?php echo $strings['Editar fase']; ?></label> 
	<!--Boton para volver atrás -->
	<button type="button" onclick="location.href='../Controllers/Tareas_Controller.php?action=Confirmar_SHOWFASES&id_tarea=<?php echo $this->idtarea; ?>';" class="volver"></button>
	</legend>
  <!--Clave de la fase que se pasa como hidden al model-->
	<input hidden type="text" name="id_fase"  value="<?php echo $this -> datos[0]; ?>" readonly><br>
 	 <!--Clave de la tarea que se pasa como hidden al model-->
	<input type="hidden" name="TAREAS_id_TAREAS" value="<?php echo $this->idtarea; ?>">

<!--Campo descripcion de la fase-->
	<label>
	<?php echo $strings['Descripcion']; ?></label>
	<input type="text" rows="4" size="50" name="descripcion" value="<?php echo $this -> datos[1]; ?>" onblur=" return !comprobarVacio(this) && comprobarTamano(this,45)">

		<!--Contactos para añadir (o no) a la fase-->
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

<!--Contactos para eliminar de la fase a la que pertenecen-->
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

<!--Archivos para añadir (o no) a la fase-->
	<label for="archivo"><?php echo $strings['Añadir archivos']; ?></label>
	<input type="file" name="archivo[]" id="archivo" size="40" multiple="multiple"/>

<!--Archivos para eliminar de la fase a la que pertenecen-->
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
  

<!--Boton de confirmar editar-->
  
 <button type="submit" name="action" value="Confirmar_EDIT" class="aceptar"></button>
 <!--Boton de borrado de texto-->
				<button type="reset" value="Reset" class="cancelar"></button>

			</form> 
		</div> 
 
 
 </article>
 
 <?php
 //Pie
	include_once "../Views/Footer.php";
	}
 }
 ?>