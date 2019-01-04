<?php

include_once '../Functions/Authentication.php';
include_once '../Views/Header.php';


 class Tareas_SHOWALL{ 
	
	var $datos;
	var $archivos;
	var $archivos2;
	var $enlace;	
	
	function __construct($datos,$archivos,$enlace){
		
		$this -> datos = $datos;
		$this -> archivos = $archivos;
		$this -> archivos2 = [];
		if($this -> archivos -> num_rows > 0){
			while($archi = $this -> archivos -> fetch_array()){
						$this -> archivos2[$archi[1]] = $archi[0];	
							}
		}
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
				<tr><th class="title" colspan="6"><?php echo $strings['Tareas']; ?>
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
					<th><?php echo $strings['Categoria']; ?></th>	
					<th>Ficheros</th>					
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
						<td style="background-color:<?php echo $fila['color_tarea']; ?>;" ><button class="tarea" name="action" value="Confirmar_SHOWFASES"><?php echo $fila[1]; ?></button></td>
						<td><?php echo $fila[6]; ?></td>	
						<td>
						<?php
						/* print_r($this -> archivos); */
						if($this -> archivos-> num_rows == 0){
							echo '0';
						}
						else{
							$entra = 0;
							foreach($this -> archivos2 as $indice => $valor){
								if($indice == $fila['id_tarea']){
									$entra = 1;
									echo $valor;
								}
							}
							if($entra == 0){
								echo '0';
							}
							$entra = 0;
						}
						?>
						</td>
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