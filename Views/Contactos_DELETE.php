<!-- TABLA QUE MUESTRA TODOS LOS DATOS DE UN CONTACTO
 CREADO POR mi3ac6 EL 17/11/2018-->
 
 <?php
  //Declaracion de la clase
 class Contactos_DELETE{
	//Datos del contacto
	var $datos;
	//Variable con el enlace al DELETE contacto
	var $enlace;
	var $fila;
	
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
              <!--Tabla con los datos del contacto--> 
			<div class="show-half">
			
				<form class="formShow" enctype="multipart/form-data" action="../Controllers/Contactos_Controller.php">
            	<!--Clave del contacto que se pasa como hidden al model-->
				<input type="hidden" name="email" value= "<?php echo $this -> fila['email'] ?>">	
            	<table class="showU" style="margin-left: 30%;">	

                <tr><th class="title" colspan="4"><?php echo $strings['Detalles del contacto']; ?>
                   <!--Boton para volver atrás -->
				   <button onclick="location.href='../Controllers/Contactos_Controller.php';" class="volver"></button></th>
                </tr>
				 <!--Campo nombre del contacto-->
                <tr>
                    <th><?php echo $strings['Nombre']; ?></th>
                    <td><?php echo $this -> fila['nombre']; ?></td>
                </tr>
				 <!--Campo email del contacto-->
                <tr>
                    <th><?php echo $strings['Email']; ?></th>
                    <td><?php echo $this -> fila['email']; ?></td>
                </tr>
				 <!--Campo descripcion del contacto-->				
				<tr>
                    <th><?php echo $strings['Descripcion']; ?></th>
                    <td><?php echo $this -> fila['descripcion']; ?></td>
                </tr>
				<!--Campo telefono del contacto-->
				<tr>
                    <th><?php echo $strings['Telefono']; ?></th>
                    <td><?php echo $this -> fila['telefono']; ?></td>
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