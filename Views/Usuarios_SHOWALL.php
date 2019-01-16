<!-- TABLA QUE MUESTRA TODOS LOS USUARIOS
CREADO POR: Los Cangrejas
Fecha: 20/12/2018-->

<?php
//Comprobamos que está autenticado
include_once '../Functions/Authentication.php';
//Header
include '../Views/Header.php';

 //Declaracion de la clase 
 class Usuarios_SHOWALL{	 
	//Datos de los usuarios
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
<!--Tabla con los datos de los usuarios-->
	<div class="showall">   
                                
		<table class="showAllUsers">
			<tr><th class="title" colspan="4"><?php echo $strings['Usuarios']; ?>
			<form class="tableActions" action="../Controllers/Usuarios_Controller.php" method="">
			<!--Botones para añadir o buscar-->
			<button class="buscar-little" name="action" value="Confirmar_SEARCH" type="submit"></button>
			<button class="anadir-little"  name="action" value="Confirmar_ADD" type="submit"></button>
			</form></th></tr>
			<!--Campos a mostrar-->
			<tr>
				<th><?php echo $strings['Login']; ?></th>
				<th><?php echo $strings['Nombre']; ?></th>
				<th><?php echo $strings['Apellidos']; ?></th>
				<th></th>
			</tr>
		<?php 
		//Mientras haya filas en la bd
			while($fila = $this ->datos->fetch_array()){                        
		?>
			<tr>
				<form action="../Controllers/Usuarios_Controller.php" method="post" name="action" >
					<input type="hidden" name="login" value="<?php echo $fila['login']; ?>">
					<!--Datos-->
					<td><?php echo $fila['login']; ?></td>
					<td><?php echo $fila['nombre']; ?></td>
					<td><?php echo $fila['apellidos']; ?></td>		
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
