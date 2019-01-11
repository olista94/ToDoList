<?php

class Tareas_ADD{
	 
	var $fila;
	var $prioridades;
	var $categorias;
	var $enlace;	
	
	function __construct($prioridades,$categorias,$enlace){
				
		$this -> prioridades = $prioridades;
		$this -> categorias = $categorias;
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

			<form name="registerForm" id="registerForm" method="post" action="../Controllers/Tareas_Controller.php" enctype="multipart/form-data" onsubmit="return comprobarTarea(this)">
				<legend><?php echo $strings['Añadir tarea'];?>
				<button type="button" type="button" onclick="location.href='../Controllers/Tareas_Controller.php';" class="volver"></button>
				</legend>

				<div>

					<label for="descripcion"><?php echo $strings['Descripcion']; ?></label>
					<input type="descripcion" id="descripcion" name="descripcion" size="40" onblur=" return !comprobarVacio(this) && comprobarTamano(this,45)"/>	
						
					
					
					<label>
					<?php echo $strings['Categoria']; ?></label><br>
					<select name="id_categoria">
						<?php
							while($categorias=$this->categorias->fetch_array()){
						?>
								<option value="<?php echo $categorias[0];?>"><?php echo $categorias[1];?>

								</option>
						<?php
							}
						?>
					</select>
					
					<label>
					<?php echo $strings['Prioridad']; ?></label><br>
					<select name="nivel_prioridad">
						<?php
							while($prioridad=$this->prioridades->fetch_array()){
						?>
								<option value="<?php echo $prioridad[0];?>"><?php echo $prioridad[1];?>

								</option>
						<?php
							}
						?>
					</select>
					
				</div>

				<button type="submit" name="action" value="Confirmar_ADD" value="Submit" class="aceptar"></button>
				<button type="reset" value="Reset" class="cancelar"></button>

			</form> 
		</div> 
<?php
	}
}
?>