<?php
//Comprobamos que está autenticado
include_once '../Functions/Authentication.php';
//Header
include '../Views/Header.php';

//Si se loguea como ADMIN
if(isset($_SESSION['tipo'])){
	if($_SESSION['tipo']=='ADMIN'){

 //Declaracion de la clase 
 class Contactos_SHOWALL{	 
	//Datos de los contactos
	var $datos;
	//Variable con el enlace al showall
	var $enlace;	
	//Constructor de la clase
	function __construct($datos,$enlace){
		
		$this -> datos = $datos;
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
<!--Tabla con los datos de los contactos-->
	<div class="showall">   
                                
		<table class="showAllUsers">
			<tr><th class="title" colspan="4"><?php echo $strings['Contactos']; ?>
			<form class="tableActions" action="../Controllers/Contactos_Controller.php" method="">
			<!--Botones para añadir o buscar-->
			<button class="buscar-little" name="action" value="Confirmar_SEARCH" type="submit"></button>
			<button class="anadir-little"  name="action" value="Confirmar_ADD" type="submit"></button>
			</form></th></tr>
	<!--Campos email,nombre y descripcion-->
			<tr>
				<th><?php echo $strings['Email']; ?></th>
				<th><?php echo $strings['Nombre']; ?></th>
				<th><?php echo $strings['Descripcion']; ?></th>
				<th></th>
			</tr>
		<?php 
		//Mientras haya filas en la bd
			while($fila = $this ->datos->fetch_array()){                        
		?>
			<tr>
				<form action="../Controllers/Contactos_Controller.php" method="post" name="action" >
					<input type="hidden" name="email" value="<?php echo $fila['email']; ?>">
					<!--Datos-->
					<td><?php echo $fila['email']; ?></td>
					<td><?php echo $fila['nombre']; ?></td>
					<td><?php echo $fila['descripcion']; ?></td>		
					<td style="text-align:right">
					<!--Botones para editar,borrar o ver en detalle-->
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
<!--Pie de pagina-->
	<?php include '../Views/Footer.php'; ?>
</footer>

<?php   
    }else{//Si se loguea como NORMAL
			
			 //Declaracion de la clase
			 class Contactos_SHOWALL{	 
	//Datos del contacto
	var $datos;
	var $enlace;	
	//Constructor de la clase
	function __construct($datos,$enlace){
		
		$this -> datos = $datos;
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
<!--Tabla con los datos de los contactos-->
	<div class="showall">   
                                
		<table class="showAllUsers">
			<tr><th class="title" colspan="4"><?php echo $strings['Contactos']; ?>
			<form class="tableActions" action="../Controllers/Contactos_Controller.php" method="">
			<!--Botones para añadir o buscar-->
			<button class="buscar-little" name="action" value="Confirmar_SEARCH" type="submit"></button>
			<button class="anadir-little"  name="action" value="Confirmar_ADD" type="submit"></button>
			</form></th></tr>
	<!--Campos email,nombre y descripcion-->
			<tr>
				<th><?php echo $strings['Email']; ?></th>
				<th><?php echo $strings['Nombre']; ?></th>
				<th><?php echo $strings['Descripcion']; ?></th>
				<th></th>
			</tr>
		<?php 
		//Mientras haya filas en la bd
			while($fila = $this ->datos->fetch_array()){                        
		?>
			<tr>
				<form action="../Controllers/Contactos_Controller.php" method="post" name="action" >
					<input type="hidden" name="email" value="<?php echo $fila['email']; ?>">
					<td><?php echo $fila['email']; ?></td>
					<td><?php echo $fila['nombre']; ?></td>
					<td><?php echo $fila['descripcion']; ?></td>		
					<td style="text-align:right">
					<!--Al no ser ADMIN no podra ni borrar ni editar contactos,solo verlos en detalle-->
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
<!--Pie de pagina-->
	<?php include '../Views/Footer.php'; ?>
</footer>
	<?php   
    }
}		
?>