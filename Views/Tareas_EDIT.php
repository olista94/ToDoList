<?php

class Tareas_EDIT{
	//Datos de la tarea	 
	var $fila;
	//Prioridades para añadir a la tarea (solo 1)
	var $prioridades;
	//Categorias para añadir a la tarea (solo 1)
	var $categorias;
	//Variable con el enlace al form de EDIT tarea
	var $enlace;	
	//Constructor de la clase	
	function __construct($fila,$prioridades,$categorias,$enlace){
		
		$this -> fila = $fila -> fetch_array();
		
		$this -> prioridades = $prioridades;
		$this -> categorias = $categorias;
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
<!--Formulario para editar tarea-->
		<div class="form">
			
			<form name="registerForm" id="registerForm" method="post" action="../Controllers/Tareas_Controller.php" enctype="multipart/form-data" onsubmit="return comprobarTarea(this)">
				<legend><?php echo $strings['Editar tarea']; ?>
				<!--Boton para volver atras-->
				<button type="button" onclick="location.href='../Controllers/Tareas_Controller.php';" class="volver"></button>
				</legend>

				<div>
				  <!--Clave de la tarea que se pasa como hidden al model-->
					<input hidden type="text" name="id_tarea"  value="<?php echo $this -> fila[0]; ?>" readonly><br>
				<!--Campo descripcion de la tarea-->
					<label for="descripcion"><?php echo $strings['Descripcion']; ?></label>
					<input type="descripcion" id="descripcion" name="descripcion" size="50" value="<?php echo $this -> fila['descripcion']; ?>" onblur=" return !comprobarVacio(this) && comprobarTamano(this,45)"/>	
					<!--Categoria de la tarea-->
					<label for="categoria"><?php echo $strings['Categoria']; ?></label>
					<select name="id_categoria">
						<?php
							while($categorias=$this->categorias->fetch_array())
							{
						?>
						<!--Usa la PK aunque muestre el nombre de la categoria-->
							<option value="<?php echo $categorias[0];?>" <?php if($this -> fila[6] == $categorias[0]) echo "selected"; ?>><?php echo $categorias[1];?>

							</option>
						<?php
							}
						?>
					</select>
					<!--Prioridad de la tarea-->
					<label for="prioridad"><?php echo $strings['Prioridad']; ?></label>
					<select name="nivel_prioridad">
						<?php						
							while($prioridades=$this->prioridades->fetch_array())
							{
						?>
						<!--Usa la PK aunque muestre el nombre de la prioridad-->
							<option value="<?php echo $prioridades[0];?>" <?php if($this -> fila[7] == $prioridades[0]) echo "selected"; ?>><?php echo $prioridades[1];?>

							</option>
						<?php
							}
						?>
					</select>
					
				</div>
				<!--Boton para editar la tarea-->
				<button type="submit" name="action" value="Confirmar_EDIT" value="Submit" class="aceptar"></button>
				<!--Boton de borrado de texto-->
				<button type="reset" value="Reset" class="cancelar"></button>

			</form>               

		</div>
 
 <?php
	}
}
?>