<!-- TABLA QUE MUESTRA LOS DATOS DE UNA CATEGORIA A BORRAR
CREADO POR: Los Cangrejas
Fecha: 20/12/2018-->

<?php
//Incluimos el archivo para comprobar la autenticacion del usuario
    include_once '../Functions/Authentication.php';    
     //Declaracion de la clase
	class Categorias_DELETE{
	 
	//Datos de la categoria
	var $datos;	
	var $fila;
	//Variable con el enlace al DELETE categoria
	var $enlace;
	
	//Constructor de la clase
	function __construct($datos,$enlace){

		$this -> datos = $datos;
		$this -> enlace = $enlace;
		$this -> fila = $this -> datos -> fetch_array();
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
         <!--Tabla con los datos de la categoria-->   
        <div class="show-half">
		<!--ID de la categoria que se pasa como hidden al model-->
			<form class="formShow" enctype="multipart/form-data" action="../Controllers/Categorias_Controller.php">
            <input type="hidden" name="id_CATEGORIAS" value= "<?php echo $this -> fila['id_CATEGORIAS'] ?>">	
            <table class="showU" style="margin-left: 30%;">

                <tr><th class="title" colspan="2"><?php echo $strings['Borrar categoria']; ?>
                   <!--Boton para volver atrás -->
				   <button onclick="location.href='../Controllers/Categorias_Controller.php';" class="volver"></button></th>
                </tr>
				<!--Campo ID de la categoria-->
                <tr>
                    <th><?php echo $strings['ID categoria']; ?></th>
                    <td><?php echo $this -> fila['id_CATEGORIAS']; ?></td>								
                </tr>
				<!--Campo nombre de la categoria-->
                <tr>
                    <th><?php echo $strings['Nombre']; ?></th>
                    <td><?php echo $this -> fila['nombre']; ?></td>
                </tr>
                

				<tr>
				<!--Confirmar borrado-->
					<th><button class="borrar-si" type="submit" name="action" value="Confirmar_DELETE2"></button></th>
				<!--Cancelar borrado-->	
					<td><button class="borrar-no" type="submit" name="action" value=""></button></td>
                </tr>   
                                                                        
            </table>

        </div>
            
        </body>
        </html>
        
        <?php
    
        }
    }
?>