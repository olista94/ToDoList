<?php

include_once '../Functions/Authentication.php';
//Header
include '../Views/Header.php';
 //Declaracion de la clase 
 class Categorias_SHOWALL{ 
	//Datos de las categorias
	var $datos;
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
<!--Tabla con los datos de las categorias-->
        <div class="showall">   
                                
            <table class="showAllUsers">
				<tr><th class="title" colspan="4"><?php echo $strings['Categorias']; ?>
				<form class="tableActions" action="../Controllers/Categorias_Controller.php" method="">
				<!--Botones para añadir o buscar-->
				<button class="buscar-little" name="action" value="Confirmar_SEARCH1" type="submit"></button>
				<button class="anadir-little"  name="action" value="Confirmar_ADD1" type="submit"></button>
				</form></th></tr>
		<!--Campo nombre-->
				<tr>
					<th><?php echo $strings['Nombre']; ?></th>
								
					<th></th>
				</tr>
			<?php 
				while($fila = $this ->datos->fetch_array()){                        
			?>
				<tr>
					<form action="../Controllers/Categorias_Controller.php" method="post" name="action" >
						<input type="hidden" name="id_CATEGORIAS" value="<?php echo $fila['id_CATEGORIAS']; ?>">
						<td><?php echo $fila['nombre']; ?></td>
									
						<td style="text-align:right">
						<!--Botones para editar,borrar o ver en detall-->
							<button class="editar" name="action" value="Confirmar_EDIT1" type="submit"></button>
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