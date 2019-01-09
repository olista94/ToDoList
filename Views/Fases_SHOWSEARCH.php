<?php

include_once '../Functions/Authentication.php';
include_once '../Views/Header.php';


 class Fases_SHOWSEARCH{ 
	
	var $datos;
	var $enlace;	
	
	function __construct($datos,$enlace){
		
		$this -> datos = $datos;
        $this -> enlace = $enlace;
        
        $this -> aux = $this ->datos->fetch_array();


		$this -> pinta();
	}
		
	function pinta(){
		
		if(!isset($_SESSION['idioma'])){
            $_SESSION['idioma'] = 'SPANISH';
        }

        include '../Locales/Strings_'. $_SESSION['idioma'] .'.php';
?>

<div class="showall">
							
		<table class="showAllUsers">
			<tr><th class="title" colspan="8"><?php echo $strings['Fases']; ?>
			<form class="tableActions" action="../Controllers/Fases_Controller.php" method="">
				<input type="hidden" name="TAREAS_id_TAREAS" value="<?php echo $this->aux['TAREAS_id_TAREAS']; ?>">
				<button class="buscar-little" name="action" value="Confirmar_SEARCH" type="submit"></button>
				<button class="anadir-little"  name="action" value="Confirmar_ADD" type="submit"></button>
			</form></th></tr>

			<tr>
				<th><?php echo $strings['Completada']; ?></th>
				<th><?php echo $strings['Descripcion']; ?></th>
				<th><?php echo $strings['Fecha inicio']; ?></th>
				<th><?php echo $strings['Contacto']; ?></th>			
				<th></th>
			</tr>
		<?php
			$this -> datos->data_seek(0);
			while($fila = $this ->datos->fetch_array()){     
			
		?>
		
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
	<?php include '../Views/Footer.php'; ?>
</footer>