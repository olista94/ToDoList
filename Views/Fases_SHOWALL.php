<!-- TABLA QUE MUESTRA TODOS LOS fases QUE JUEGAN LA LOTERIAIU
 CREADO POR mi3ac6 EL 17/11/2018-->
<?php

include_once '../Functions/Authentication.php';
include_once '../Views/Header.php';

 class Fases_SHOWALL{	 
	
	var $datos;
	var $archivos;
	var $enlace;	
	
	function __construct($datos,$archivos,$enlace){
		
		$this -> datos = $datos;
		$this -> archivos = $archivos;
		$this -> enlace = $enlace;
		$this -> mostrar();
	}
	
	function mostrar(){
		
		if(!isset($_SESSION['idioma'])){
            $_SESSION['idioma'] = 'SPANISH';
        }

        include '../Locales/Strings_'. $_SESSION['idioma'] .'.php';
 
?>

	<div class="showall">

			
		<form>
		<legend>Ficheros de la tarea</legend>
		<?php
			if($this ->archivos != null){
				while($fila2 = $this ->archivos->fetch_array()){
		?>  
			<li><a href="<?php echo $fila2['url']; ?>" download><?php echo $fila2['nombre']; ?></a></li>
		<?php
				}
			}
		?>
		</form> 
								
		<table class="showAllUsers">
			<tr><th class="title" colspan="8"><?php echo $strings['Fases']; ?>
			<form class="tableActions" action="../Controllers/Fases_Controller.php" method="">
			<button class="buscar-little" name="action" value="Confirmar_SEARCH" type="submit"></button>
			<button class="anadir-little"  name="action" value="Confirmar_ADD" type="submit"></button>
			</form></th></tr>

			<tr>
				<th><?php echo $strings['Descripcion']; ?></th>
				<th><?php echo $strings['Fecha inicio']; ?></th>
				<th><?php echo $strings['Contacto']; ?></th>			
				<th></th>
			</tr>
		<?php 
			while($fila = $this ->datos->fetch_array()){     
			
		?>
		
			<tr>
				<form action="../Controllers/Fases_Controller.php" method="post" name="id_fase" >
					<input type="hidden" name="id_fase" value="<?php echo $fila[0]; ?>">
					<td><?php echo $fila['descripcion']; ?></td>
					<td><?php echo $fila['fecha_inicio']; ?></td>
					<td><?php echo $fila['CONTACTOS_email']; ?></td>				
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