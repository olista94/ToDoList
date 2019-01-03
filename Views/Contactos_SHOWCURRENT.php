<!-- TABLA QUE MUESTRA TODOS LOS DATOS DE UN CONTACTO
 CREADO POR mi3ac6 EL 17/11/2018-->
 
 <?php
 class Contactos_SHOWCURRENT{
	 
	var $datos;
	var $enlace;
	var $fila;
	
	function __construct($datos,$enlace){
		
		$this -> datos = $datos;
		$this -> enlace = $enlace;
		$this -> fila = $this -> datos -> fetch_array();
		$this -> mostrar();
	}
	
	function mostrar(){
        
        if(!isset($_SESSION['idioma'])){
            $_SESSION['idioma'] = 'SPANISH';
        }

        include '../Locales/Strings_'. $_SESSION['idioma'] .'.php';
        ?>
            
        <div class="show-half">	
            <table class="showU" style="margin-left: 40%;">

                <tr><th class="title" colspan="4"><?php echo $strings['Detalles del contacto']; ?>
                    <button onclick="location.href='../Controllers/Contactos_Controller.php';" class="volver"></button></th>
                </tr>

                <tr>
                    <th><?php echo $strings['Nombre']; ?></th>
                    <td><?php echo $this -> fila['nombre']; ?></td>
                </tr>
                <tr>
                    <th><?php echo $strings['Email']; ?></th>
                    <td><?php echo $this -> fila['email']; ?></td>
                </tr>             
				<tr>
                    <th><?php echo $strings['Descripcion']; ?></th>
                    <td><?php echo $this -> fila['descripcion']; ?></td>
                </tr>
				<tr>
                    <th><?php echo $strings['Telefono']; ?></th>
                    <td><?php echo $this -> fila['telefono']; ?></td>
                </tr>
                                                                        
            </table>

        </div>
            
        </body>
        </html>
        
        <?php
    
        }
    }
?>