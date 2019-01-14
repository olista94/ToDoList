<?php
//Comprueba si esta autenticado
include_once '../Functions/Authentication.php';
include_once '../Views/Header.php';

 //Declaracion de la clase 
 class Fases_SHOWSEARCH{ 
		//Datos de las fases
	var $datos;
	//Variable con el enlace al showsearch
	var $enlace;	
	
		//Constructor de la clase
	function __construct($datos,$enlace){
		
		$this -> datos = $datos;
        $this -> enlace = $enlace;
        
        $this -> aux = $this ->datos->fetch_array();


		$this -> pinta();
	}
				//Funcion que "muestra" el contenido de la página
	function pinta(){
				//Variable de idioma
		if(!isset($_SESSION['idioma'])){
            $_SESSION['idioma'] = 'SPANISH';
        }
//Archivo del idioma
        include '../Locales/Strings_'. $_SESSION['idioma'] .'.php';
?>
 <!--Tabla con todas las fases que correspondan a la busqueda-->
<div class="showall">
							
		<table class="showAllUsers">
			<tr><th class="title" colspan="8"><?php echo $strings['Fases']; ?>
			<form class="tableActions" action="../Controllers/Fases_Controller.php" method="">
			<!--Clave de la tarea que se pasa como hidden al model-->
				<input type="hidden" name="TAREAS_id_TAREAS" value="<?php echo $this->aux['TAREAS_id_TAREAS']; ?>">
				 <!--Botones para añadir y buscar-->
				<button class="buscar-little" name="action" value="Confirmar_SEARCH" type="submit"></button>
				<button class="anadir-little"  name="action" value="Confirmar_ADD" type="submit"></button>
			</form></th></tr>
 <!--Campos de muestra-->
			<tr>
				<th><?php echo $strings['Completada']; ?></th>
				<th><?php echo $strings['Descripcion']; ?></th>
				<th><?php echo $strings['Fecha inicio']; ?></th>
							
				<th></th>
			</tr>
		<?php
			$this -> datos->data_seek(0);
			while($fila = $this ->datos->fetch_array()){     
			
		?>
				 <!--Tick para cerrar o abrir una fase-->
			<tr>
				<form action="../Controllers/Fases_Controller.php" method="post" name="id_fase" >
					<input type="hidden" name="id_fase" value="<?php echo $fila[0]; ?>">
					<input type="hidden" name="TAREAS_id_TAREAS" value="<?php echo $fila['TAREAS_id_TAREAS']; ?>">
					<?php
						if($fila['completada'] == 0){
					?>
						<td>
							<label class="container">
							<input type="checkbox" name="action" onclick="this.form.submit()" value="Confirmar_COMPLETADA"><span class="checkmark"></span>
							</label>
						</td>
					<?php
						}else{
					?>
						<td>
							<label class="container">
							<input type="hidden" name="action" value="Confirmar_NO_COMPLETADA"/>
							<input type="checkbox" name="action" onclick="this.form.submit()" value="Confirmar_NO_COMPLETADA" checked><span class="checkmark"></span>
							</label>
						</td>
					<?php
						}
					?>
					<td><?php echo $fila['descripcion']; ?></td>
					<td><?php echo $fila['fecha_inicio']; ?></td>
								
					<td style="text-align:right">
					 <!--Botones para editar,borrar y ver en detalle-->
						<button class="editar" name="action" value="Confirmar_EDIT" type="submit"></button>
						<button class="borrar" name="action" value="Confirmar_DELETE1" type="submit"></button>
						<button class="add" name="action" value="Confirmar_SHOWCURRENT" type="submit"></button>
					</td>
				</form>
			</tr>
		<?php
			}
		?>                 
		</table> 
	
	</div>         
        
<?php   
    }
}
?>
    
	<footer>
	 <!--Pie-->
	<?php include '../Views/Footer.php'; ?>
</footer>