<!-- TABLA QUE MUESTRA TODAS LAS PRIORIDADES
CREADO POR: Los Cangrejas
Fecha: 20/12/2018-->

<?php
//Comprobamos que está autenticado
include_once '../Functions/Authentication.php';
//Header
include '../Views/Header.php';
 //Declaracion de la clase 
 class Prioridades_SHOWALL{ 
		//Datos de las prioridades
	var $datos;
	//Variable con el enlace al showall
	var $enlace;	
		//Constructor de la clase
	function __construct($datos,$enlace){
		
		$this -> datos = $datos;
		$this -> enlace = $enlace;
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
<!--Tabla con los datos de las prioridades-->
        <div class="showall">   
                                
            <table class="showAllUsers">
				<tr><th class="title" colspan="4"><?php echo $strings['Prioridades']; ?>
				<form class="tableActions" action="../Controllers/Prioridades_Controller.php" method="">
				<!--Botones para añadir o buscar-->
				<button class="buscar-little" name="action" value="Confirmar_SEARCH" type="submit"></button>
				<button class="anadir-little"  name="action" value="Confirmar_ADD" type="submit"></button>
				</form></th></tr>
		<!--Campos a mostrar-->
				<tr>
					<th><?php echo $strings['Nivel']; ?></th>
					<th><?php echo $strings['Descripcion']; ?></th>
					<th><?php echo $strings['Color']; ?></th>			
					<th></th>
				</tr>
			<?php 
			//Mientras haya filas en la bd
				while($fila = $this ->datos->fetch_array()){                        
			?>
				<tr>
					<form action="../Controllers/Prioridades_Controller.php" method="post" name="action" >
						<input type="hidden" name="nivel" value="<?php echo $fila['nivel']; ?>">
						<!--Datos-->
						<td><?php echo $fila['nivel']; ?></td>
						<td><?php echo $fila['descripcion']; ?></td>
						<td style="color:<?php echo $fila['color']; ?>;"><?php echo $fila['color']; ?></td>				
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