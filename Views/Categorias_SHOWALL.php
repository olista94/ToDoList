<?php

include_once '../Functions/Authentication.php';
include '../Views/Header.php';

 class Categorias_SHOWALL{ 
	
	var $datos;
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
				<tr><th class="title" colspan="4"><?php echo $strings['Categorias']; ?>
				<form class="tableActions" action="../Controllers/Categorias_Controller.php" method="">
				<button class="buscar-little" name="action" value="Confirmar_SEARCH" type="submit"></button>
				<button class="anadir-little"  name="action" value="Confirmar_ADD" type="submit"></button>
				</form></th></tr>
		
				<tr>
					<th><?php echo $strings['Nombre']; ?></th>
								
					<th></th>
				</tr>
			<?php 
				while($fila = $this ->datos->fetch_array()){                        
			?>
				<tr>
					<form action="../Controllers/Categorias_Controller.php" method="post" name="action" >
						<input type="hidden" name="id_CATEGORIA" value="<?php echo $fila['id_CATEGORIA']; ?>">
						<td><?php echo $fila['nombre']; ?></td>
									
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