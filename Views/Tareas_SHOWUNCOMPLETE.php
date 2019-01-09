<?php

include_once '../Functions/Authentication.php';
include_once '../Views/Header.php';


 class Tareas_SHOWUNCOMPLETE{ 
	
	var $datos;
	var $archivos;
	var $archivos2;
	var $fases;
	var $fases2;
	var $contactos;
	var $contactos2;
	var $enlace;	
	
	function __construct($datos,$archivos,$fases,$contactos,$enlace){
		
		$this -> datos = $datos;
		$this -> archivos = $archivos;
		$this -> archivos2 = [];
		if($this -> archivos -> num_rows > 0){
			while($archi = $this -> archivos -> fetch_array()){
						$this -> archivos2[$archi[1]] = $archi[0];	
							}
		}
				
		$this -> fases = $fases;
		$this -> fases2 = [];
		if($this -> fases -> num_rows > 0){
			while($fas = $this -> fases -> fetch_array()){
						$this -> fases2[$fas[1]] = $fas[0];	
							}
		}
		
		$this -> contactos = $contactos;
		$this -> contactos2 = [];
		if($this -> contactos -> num_rows > 0){
			while($cont = $this -> contactos -> fetch_array()){
						$this -> contactos2[$cont[1]] = $cont[0];	
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
				<tr><th class="title" colspan="6">Tareas incompletas
				</th></tr>
		
				<tr>
					<th><?php echo $strings['Completada']; ?></th>
					<th><?php echo $strings['Descripcion']; ?></th>
					<th><?php echo $strings['Categoria']; ?></th>	
					<th>Ficheros</th>
					<th>Fases</th>
					<th>Contactos</th>					
					<th></th>
				</tr>
			<?php 
				
				while($fila = $this ->datos->fetch_array()){                        
			?>
                <?php
                    if($fila['completa'] == 0){
                ?>
				<tr style="background-color:<?php echo $fila['color_tarea']; ?>;">
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
						
						<td>
						<?php
						/* print_r($this -> archivos); */
						if($this -> fases-> num_rows == 0){
							echo '0';
						}
						else{
							$entra = 0;
							foreach($this -> fases2 as $indice => $valor){
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
						
						
							<td>
						<?php
						/* print_r($this -> archivos); */
						if($this -> contactos-> num_rows == 0){
							echo '0';
						}
						else{
							$entra = 0;
							foreach($this -> contactos2 as $indice => $valor){
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