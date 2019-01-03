<!-- TABLA PARA BORRAR USUARIO QUE JUEGA LA LOTERIAIU
 CREADO POR mi3ac6 EL 17/11/2018-->
 
  <?php
 class Usuarios_DELETE{

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
            <form class="formShow" enctype="multipart/form-data" action="../Controllers/Usuarios_Controller.php">
                <input type="hidden" name="login" value= "<?php echo $this -> fila['login'] ?>">
                <table class="showU" style="margin-left: 40%;">

                <tr><th class="title" colspan="4"><?php echo $strings['Detalles del usuario']; ?>
                    <button onclick="location.href='../Controllers/Usuarios_Controller.php';" class="volver"></button></th>
                </tr>
                <tr>
                    <th><?php echo $strings['Login']; ?></th>
                    <td><?php echo $this -> fila['login']; ?></td>								
                </tr>
                <tr>
                    <th><?php echo $strings['Contraseña']; ?></th>
                    <td><?php echo $this -> fila['password']; ?></td>
                </tr>
                <tr>
                    <th><?php echo $strings['Nombre']; ?></th>
                    <td><?php echo $this -> fila['nombre']; ?></td>
                </tr>
                <tr>
                    <th><?php echo $strings['Apellidos']; ?></th>
                    <td><?php echo $this -> fila['apellidos']; ?></td>
                </tr>
                <tr>
                    <th><?php echo $strings['DNI']; ?></th>
                    <td><?php echo $this -> fila['dni']; ?></td>
                </tr>
                <tr>
                    <th><?php echo $strings['Teléfono']; ?></th>
                    <td><?php echo $this -> fila['telefono']; ?></td>
                </tr>
                <tr>
                    <th><?php echo $strings['Email']; ?></th>
                    <td><?php echo $this -> fila['email']; ?></td>
                </tr>             
				<tr>
                    <th><?php echo $strings['Fecha de nacimiento']; ?></th>
                    <td><?php echo $this -> fila['fecha']; ?></td>
                </tr>
				<tr>
                    <th><?php echo $strings['Tipo']; ?></th>
                    <td><?php echo $this -> fila['tipo']; ?></td>
                </tr>

				<tr>
					<th><button class="borrar-si" type="submit" name="action" value="Confirmar_DELETE2"></button></th>
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