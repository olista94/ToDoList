<!-- TABLA QUE MUESTRA LOS DATOS DE UNA CATEGORIA
CREADO POR: Los Cangrejas
Fecha: 20/12/2018-->

<?php

    include_once '../Functions/Authentication.php';    
     //Declaracion de la clase
	class Categorias_SHOWCURRENT{
	 
	 //Datos de la categoria
	var $datos;	
	var $fila;
	//Variable con el enlace al SHOWCURRENT de categoria
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
			<form class="formShow" enctype="multipart/form-data" action="../Controllers/Categorias_Controller.php">
            <input type="hidden" name="id_CATEGORIAS" value= "<?php echo $this -> fila['id_CATEGORIAS'] ?>">	
            <table class="showU" style="margin-left: 30%;">

                <tr><th class="title" colspan="2"><?php echo $strings['Detalles de la categoria']; ?>
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
                 
                                                                        
            </table>

        </div>
            
        </body>
        </html>
        
        <?php
    
        }
    }
?>