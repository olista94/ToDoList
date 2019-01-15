<?php
 //Declaracion de la clase
class Tareas_ADD{
	 
	var $fila;
	//Prioridades para añadir a la tarea (solo 1)
	var $prioridades;
	//Categorias para añadir a la tarea (solo 1)
	var $categorias;
	//Variable con el enlace al form de ADD tarea
	var $enlace;	
	//Constructor de la clase
	function __construct($prioridades,$categorias,$enlace){
				
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
<!--Formulario para añadir tarea-->
		<div class="form">

			<form name="registerForm" id="registerForm" method="post" action="../Controllers/Tareas_Controller.php" enctype="multipart/form-data" onsubmit="return comprobarTarea(this)">
				<legend><?php echo $strings['Añadir tarea'];?>
				<!--Boton para volver atras-->
				<button type="button" type="button" onclick="location.href='../Controllers/Tareas_Controller.php';" class="volver"></button>
				</legend>

				<div>
					<!--Campo descripcion de la tarea-->
					<label for="descripcion"><?php echo $strings['Descripcion']; ?></label>
					<input type="descripcion" id="descripcion" name="descripcion" size="40" onblur=" return !comprobarVacio(this) && comprobarTamano(this,45)"/>	
						
					
					<!--Categorias-->
					<label>
					<?php echo $strings['Categoria']; ?></label><br>
					<select name="id_categoria">
						<?php
							while($categorias=$this->categorias->fetch_array()){
						?>
						<!--Usa la PK aunque muestre el nombre de la categoria-->
								<option value="<?php echo $categorias[0];?>"><?php echo $categorias[1];?>

								</option>
						<?php
							}
						?>
					</select>
					<!--Prioridades-->
					<label>
					<?php echo $strings['Prioridad']; ?></label><br>
					<select name="nivel_prioridad">
						<?php
							while($prioridad=$this->prioridades->fetch_array()){
						?>
						<!--Usa la PK aunque muestre el nombre de la prioridad-->
								<option value="<?php echo $prioridad[0];?>"><?php echo $prioridad[1];?>

								</option>
						<?php
							}
						?>
					</select>
					
				</div>
				<!--Boton para añadir la tarea y pasar a añadir fases-->
				<button type="submit" name="action" value="Confirmar_ADD" value="Submit" class="aceptar"></button>
				<!--Boton de borrado de texto-->
				<button type="reset" value="Reset" class="cancelar"></button>

			</form> 
		</div> 
<?php
	}
}
?>