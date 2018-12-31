<?php

include_once '../Functions/Authentication.php';
include '../Views/Header.php';


 class Tareas_SHOWALL{ 
	
	var $datos;
	var $prioridades;
	var $enlace;	
	
	function __construct($datos,$enlace){
		
		$this -> datos = $datos;
		$this -> enlace = $enlace;
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
				<tr><th class="title" colspan="4"><?php echo $strings['Tareas']; ?>
				<form class="tableActions" action="../Controllers/Tareas_Controller.php" method="">
					<button class="buscar-little" name="action" value="Confirmar_SEARCH" type="submit"></button>
					<button class="anadir-little"  name="action" value="Confirmar_ADD" type="submit"></button>
				</form>

				<form class="tableActions" action="../Controllers/Tareas_Controller.php" method="">
					<div>
						<label class="lblSearch" for="action">Ordenar por:</label>
						<select class="slcSearch" name="action" id="action" onchange="this.form.submit()">
							<option value="">Seleccionar</option>
							<option value="Ordenar_Fecha"><?php echo $strings['Fecha']; ?></option>
							<option value="Ordenar_Prioridad"><?php echo $strings['Prioridad']; ?></option>
							<option value="Ordenar_Categoria"><?php echo $strings['Categoria']; ?></option>
						</select>

					</div>
				</form>
				
				</th></tr>
		
				<tr>
					<th><?php echo $strings['Completada']; ?></th>
					<th><?php echo $strings['Descripcion']; ?></th>
					<th><?php echo $strings['Prioridad']; ?></th>			
					<th></th>
				</tr>
			<?php 
				while($fila = $this ->datos->fetch_array()){                        
			?>
				<tr>
					<form action="../Controllers/Tareas_Controller.php" method="post" name="id_tarea" >
						<input type="hidden" name="id_tarea" value="<?php echo $fila['id_tarea']; ?>">
						<?php
							if($fila['completa'] == 0){
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
						<td style="background-color:<?php echo $fila['color_tarea']; ?>;" ><?php echo $fila[1]; ?></td>
						<td><?php echo $fila[2]; ?></td>				
						<td style="text-align:right">
							<button class="editar" name="action" value="Confirmar_EDIT" type="submit"></button>
							<button class="borrar" name="action" value="Confirmar_DELETE1" type="submit"></button>
							<button class="add" name="action" value="Confirmar_SHOWCURRENT" type="submit"></button>
							<button class="ver" name="action" value="Confirmar_SHOWFASES" type="submit"></button>
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