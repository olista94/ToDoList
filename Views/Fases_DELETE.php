<!-- TABLA QUE MUESTRA TODOS LOS DATOS DE UNA FASE A BORRAR
 CREADO POR mi3ac6 EL 17/11/2018-->
 
  <?php
  	 
	include_once '../Functions/Authentication.php';

 class Fases_DELETE{


	var $fila;
	var $enlace;
	
	function __construct($fila,$enlace){
		
		$this -> fila = $fila -> fetch_array();

		$this -> enlace = $enlace;
		$this -> mostrar();
	}
	
	//función que pinta la vista
    function mostrar(){
        //comprueba si hay un idioma en $_SESSION
        //si no, inserta el idioma español
        if(!isset($_SESSION['idioma'])){
            $_SESSION['idioma'] = 'SPANISH';
        }

        include '../Locales/Strings_'. $_SESSION['idioma'] .'.php';
	?>
            
		<div class="show-half">
            <form class="formShow" enctype="multipart/form-data" action="../Controllers/Fases_Controller.php">
                <input type="hidden" name="id_fase" value= "<?php echo $this -> fila['id_FASES'] ?>">
                <table class="showU" style="margin-left: 40%;">

                    <tr><th class="title" colspan="4"><?php echo $strings['Borrar fase']; ?>
                        <button onclick="location.href='../Controllers/Fases_Controller.php';" class="volver"></button></th>
                    </tr>

                    <tr>
                        <th><?php echo $strings['Descripcion']; ?></th>
                        <td><?php echo $this -> fila['descripcion']; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo $strings['Fecha inicio']; ?></th>
                        <td><?php echo $this -> fila['fecha_inicio']; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo $strings['Fecha fin']; ?></th>
                        <td><?php echo $this -> fila['fecha_fin']; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo $strings['Contacto']; ?></th>
                        <td><?php echo $this -> fila['CONTACTOS_email']; ?></td>
                    </tr>

                    <tr>
                        <th><button class="borrar-si" type="submit" name="action" value="Confirmar_DELETE2"></button></th>
                        <td><button class="borrar-no" type="submit" name="action" value=""></button></td>
                    </tr>            
                                                                            
                </table>
            </form>            
        </div>       
        
<?php    
    }
}
?>