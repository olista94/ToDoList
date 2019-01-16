<!-- FORMULARIO PARA AÑADIR UNA FASE A UNA TAREA
CREADO POR: Los Cangrejas
Fecha: 26/12/2018-->

<?php
 //Declaracion de la clase 
class Fases_ADD{
	 //Id de la tarea a la que pertenece la fase a añadir
	var $id_tarea;
	//Descripcion de la tarea a la que pertenece la fase a añadir
	var $descripcion;
	//Contactos que participaran en la tarea
	var $contactos;
	//Variable con el enlace al form de ADD fase
	var $enlace;	
	//Constructor de la clase
	function __construct($id_tarea,$descripcion,$contactos,$enlace){
				
		$this -> id_tarea = $id_tarea;
		$this -> descripcion = $descripcion;
		$this -> contactos = $contactos;
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
<!--Formulario para añadir fase-->
		<div class="form">

			<form name="registerForm" id="registerForm" method="post" action="../Controllers/Fases_Controller.php" enctype="multipart/form-data" onsubmit="return comprobarTarea(this)">
				<legend><?php echo $strings['Añadir fase a '];?><?php echo $this -> descripcion;?>
				
				</legend>

				<div>
				<!--Campo descripcion de la fase-->
					<label for="descripcion"><?php echo $strings['Descripcion']; ?></label>
					<input type="descripcion" id="descripcion" name="descripcion" size="50"  onblur=" return !comprobarVacio(this) && comprobarTamano(this,45)"/>	
						<!--Tarea a la que pertenece la fase-->
					<label>
					<?php echo $GLOBALS['strings']['Tarea']; ?></label>
					<input type="text" name="descripcion_tarea" readonly value="<?php echo $this -> descripcion;?>">
					<input type="hidden" name="TAREAS_id_TAREAS" value="<?php echo $this -> id_tarea;?>">
				<!--Campo para seleccionar (o no) los contactos de la fase-->
					<label>
					<?php echo $strings['Contacto']; ?></label>
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
				<!--Campo para seleccionar (o no) los archivos de la fase-->
					<label for="archivo"><?php echo $strings['Archivos']; ?></label>
                    <input type="file" name="archivo[]" id="archivo" size="40" multiple="multiple"/>
					
				</div>
				<!--Boton para añadir otra fase-->
				<button type="submit" name="action" value="Confirmar_CONTINUAR" value="Submit" class="continuar"></button>
				<!--Boton para finalizar-->
				<button type="submit" name="action" value="Confirmar_ADD" value="Submit" class="aceptar"></button>
				<!--Boton de borrado de texto-->
				<button type="reset" value="Reset" class="cancelar"></button>

			</form> 
		</div> 
<?php
	}
}
?>