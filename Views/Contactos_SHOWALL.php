<?php

include_once '../Functions/Authentication.php';
include '../Views/Header.php';


if(isset($_SESSION['tipo'])){
	if($_SESSION['tipo']=='ADMIN'){


 class Contactos_SHOWALL{	 
	
	var $datos;
	var $enlace;	
	
	function __construct($datos,$enlace){
		
		$this -> datos = $datos;
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
                                
		<table class="showAllUsers">
			<tr><th class="title" colspan="4"><?php echo $strings['Contactos']; ?>
			<form class="tableActions" action="../Controllers/Contactos_Controller.php" method="">
			<button class="buscar-little" name="action" value="Confirmar_SEARCH" type="submit"></button>
			<button class="anadir-little"  name="action" value="Confirmar_ADD" type="submit"></button>
			</form></th></tr>
	
			<tr>
				<th><?php echo $strings['Email']; ?></th>
				<th><?php echo $strings['Nombre']; ?></th>
				<th><?php echo $strings['Descripcion']; ?></th>
				<th></th>
			</tr>
		<?php 
			while($fila = $this ->datos->fetch_array()){                        
		?>
			<tr>
				<form action="../Controllers/Contactos_Controller.php" method="post" name="action" >
					<input type="hidden" name="email" value="<?php echo $fila['email']; ?>">
					<td><?php echo $fila['email']; ?></td>
					<td><?php echo $fila['nombre']; ?></td>
					<td><?php echo $fila['descripcion']; ?></td>		
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

<?php   
    }else{
			
			
			 class Contactos_SHOWALL{	 
	
	var $datos;
	var $enlace;	
	
	function __construct($datos,$enlace){
		
		$this -> datos = $datos;
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
                                
		<table class="showAllUsers">
			<tr><th class="title" colspan="4"><?php echo $strings['Contactos']; ?>
			<form class="tableActions" action="../Controllers/Contactos_Controller.php" method="">
			<button class="buscar-little" name="action" value="Confirmar_SEARCH" type="submit"></button>
			<button class="anadir-little"  name="action" value="Confirmar_ADD" type="submit"></button>
			</form></th></tr>
	
			<tr>
				<th><?php echo $strings['Email']; ?></th>
				<th><?php echo $strings['Nombre']; ?></th>
				<th><?php echo $strings['Descripcion']; ?></th>
				<th></th>
			</tr>
		<?php 
			while($fila = $this ->datos->fetch_array()){                        
		?>
			<tr>
				<form action="../Controllers/Contactos_Controller.php" method="post" name="action" >
					<input type="hidden" name="email" value="<?php echo $fila['email']; ?>">
					<td><?php echo $fila['email']; ?></td>
					<td><?php echo $fila['nombre']; ?></td>
					<td><?php echo $fila['descripcion']; ?></td>		
					<td style="text-align:right">
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
	<?php   
    }
}		
?>