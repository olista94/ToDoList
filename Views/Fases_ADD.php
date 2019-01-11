<?php
class Fases_ADD{
	 
	var $id_tarea;
	var $descripcion;
	var $contactos;
	var $enlace;	
	
	function __construct($id_tarea,$descripcion,$contactos,$enlace){
				
		$this -> id_tarea = $id_tarea;
		$this -> descripcion = $descripcion;
		$this -> contactos = $contactos;
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
				<legend><?php echo $strings['Añadir fase a '];?><?php echo $this -> descripcion;?>
				
				</legend>

				<div>

					<label for="descripcion"><?php echo $strings['Descripcion']; ?></label>
					<input type="descripcion" id="descripcion" name="descripcion" size="50"  onblur=" return !comprobarVacio(this) && comprobarTamano(this,45)"/>	
						
					<label>
					<?php echo $GLOBALS['strings']['Tarea']; ?></label>
					<input type="text" name="descripcion_tarea" readonly value="<?php echo $this -> descripcion;?>">
					<input type="hidden" name="TAREAS_id_TAREAS" value="<?php echo $this -> id_tarea;?>">

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

					<label for="archivo"><?php echo $strings['Archivos']; ?></label>
                    <input type="file" name="archivo[]" id="archivo" size="40" multiple="multiple"/>
					
				</div>
				
				<button type="submit" name="action" value="Confirmar_CONTINUAR" value="Submit" class="continuar"></button>
				<button type="submit" name="action" value="Confirmar_ADD" value="Submit" class="aceptar"></button>
				<button type="reset" value="Reset" class="cancelar"></button>

			</form> 
		</div> 
<?php
	}
}
?>