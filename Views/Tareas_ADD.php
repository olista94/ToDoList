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

			<form name="registerForm" id="registerForm" method="post" action="../Controllers/Tareas_Controller.php" enctype="multipart/form-data">
				<legend><?php echo $strings['Añadir tarea'];?>
				<button onclick="location.href='../Controllers/Tareas_Controller.php';" class="volver"></button>
				</legend>

				<div>

					<label for="descripcion"><?php echo $strings['Descripcion']; ?></label>
					<input type="descripcion" id="descripcion" name="descripcion" size="40" maxlength="60"/>	
						
					<label for="fecha_ini"><?php echo $strings['Fecha inicio']; ?></label>
					<input type="date"  name="fecha_ini" id="fecha_ini" onkeypress="return false;"/>
					
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
				<a href="<?php echo $this -> enlace;?>"><button type="button" title="<?php echo $GLOBALS['strings']['Cancelar']; ?>" class="cancelar"><i class="fas fa-times"></i></button></a>

			</form> 
		</div> 
<?php
	}
}
?>