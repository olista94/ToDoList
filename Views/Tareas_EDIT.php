<?php

class Tareas_EDIT{
	 
	var $fila;
	var $prioridades;
	var $categorias;
	var $enlace;	
	
	function __construct($fila,$prioridades,$categorias,$enlace){
		
		$this -> fila = $fila -> fetch_array();
		
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
				<legend><?php echo $strings['Editar tarea']; ?>
				<button onclick="location.href='../Controllers/Tareas_Controller.php';" class="volver"></button>
				</legend>

				<div>
					<input hidden type="text" name="id_tarea"  value="<?php echo $this -> fila[0]; ?>" readonly><br>

					<label for="descripcion"><?php echo $strings['Descripcion']; ?></label>
					<input type="descripcion" id="descripcion" name="descripcion" size="40" value="<?php echo $this -> fila['descripcion']; ?>" maxlength="60"/>	
						
					<label for="fecha_ini"><?php echo $strings['Fecha inicio']; ?></label>
					<input type="date"  name="fecha_ini" id="fecha_ini" value="<?php echo $this -> fila['Fecha_Ini']; ?>" onkeypress="return false;" />
					
					<label for="categoria"><?php echo $strings['Categoria']; ?></label>
					<select name="id_categoria">
						<?php
							while($categorias=$this->categorias->fetch_array())
							{
						?>
							<option value="<?php echo $categorias[0];?>" <?php if($this -> fila[5] == $categorias[0]) echo "selected"; ?>><?php echo $categorias[1];?>

							</option>
						<?php
							}
						?>
					</select>

					<label for="prioridad"><?php echo $strings['Prioridad']; ?></label>
					<select name="nivel_prioridad">
						<?php						
							while($prioridades=$this->prioridades->fetch_array())
							{
						?>
							<option value="<?php echo $prioridades[0];?>" <?php if($this -> fila[5] == $prioridades[0]) echo "selected"; ?>><?php echo $prioridades[1];?>

							</option>
						<?php
							}
						?>
					</select>
					
				</div>

				<button type="submit" name="action" value="Confirmar_EDIT" value="Submit" class="aceptar"></button>
				<button type="reset" value="Reset" class="cancelar"></button>

			</form>               

		</div>
 
 <?php
	}
}
?>