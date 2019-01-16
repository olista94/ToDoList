<!-- FORMULARIO PARA BUSCAR USUARIOS
CREADO POR: Los Cangrejas
Fecha: 20/12/2018-->

<?php
 //Declaracion de la clase
    class Usuarios_SEARCH {
		
//Variable con el enlace al form para SEARCH usuaro
      var $enlace;

//Constructor de la clase	
      function __construct($enlace){

        $this -> enlace = $enlace;
        $this->pinta();

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
         <!--Form para buscar un usuario-->
        <form class="formB" id="searchForm" enctype="multipart/form-data" method="post" action="../Controllers/Usuarios_Controller.php">
            <legend><?php echo $strings['Buscar usuario'];?>
            <!--Boton para volver atras-->
			<button onclick="location.href='../Controllers/Usuarios_Controller.php';" class="volver"></button>
            </legend>

            <input hidden type="text" id="password" name="password" maxlength="25" size="40"/>
            <!--Campo login del usuario-->	
			<div class="form-group">
                <label for="login"><?php echo $strings['Login']; ?></label>
                <input type="text" id="login" name="login" />
            </div>	
			 <!--Campo nombre del usuario-->
            <div class="form-group">
                <label for="nombre"><?php echo $strings['Nombre']; ?></label>
                <input type="text" id="nombre" name="nombre" maxlength="50" size="40"/>
            </div>
			<!--Campo apellidos del usuario-->
            <div class="form-group">
                <label for="apellidos"><?php echo $strings['Apellidos']; ?></label>
                <input type="text" id="apellidos" name="apellidos" maxlength="25" size="40"/>
            </div>
			<!--Campo DNI del usuario-->
            <div class="form-group">
                <label for="dni"><?php echo $strings['DNI']; ?></label>
                <input type="text" id="dni" name="dni" />
            </div>	
			<!--Campo email del usuario-->
            <div class="form-group">
                <label for="email"><?php echo $strings['Correo electrónico']; ?></label>
                <input type="text" id="email" name="email" maxlength="50" size="40"/>
            </div>
			<!--Campo fecha de nacimiento del usuario-->
            <div class="form-group">
                <label for="fecha"><?php echo $strings['Fecha de nacimiento']; ?></label>
                <input type="text" id="fecha" name="fecha" />
            </div>
			<!--Campo telefono del usuario-->
            <div class="form-group">
                <label for="telefono"><?php echo $strings['Telefono']; ?></label>
                <input type="text" id="telefono" name="telefono" maxlength="11"/>
            </div>	
			<!--Campo tipo del usuario (ADMIN O NORMAL)-->
		<div class="form-group">
		<label for="tipo"><?php echo $strings['Tipo']; ?></label>
		<input type="text" id="tipo" name="tipo"/>
           </div>  
		   
		   <!--Boton de confirmar busqueda-->
            <button type="submit" name="action" value="Confirmar_SEARCH" class="buscar"></button>

        </form>
            
        </body>
        </html>
        
        <?php
    
        }
    }
?>
