<?php
  //Declaracion de la clase
    class Contactos_SEARCH {
//Variable con el enlace al form de SEARCH contacto
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
        <!--Formulario para buscar contacto-->
        <form class="formB" id="searchForm" enctype="multipart/form-data" method="post" action="../Controllers/Contactos_Controller.php">
            <legend><?php echo $strings['Buscar contacto'];?>
            <!--Boton para volver atrás -->
			<button onclick="location.href='../Controllers/Contactos_Controller.php';" class="volver"></button>
            </legend>

			<!--Campo nombre del contacto-->
            <div class="form-group">
                <label for="nombre"><?php echo $strings['Nombre']; ?></label>
                <input type="text" id="nombre" name="nombre" maxlength="50" size="40"/>
            </div>
			 <!--Campo email del contacto-->
            <div class="form-group">
                <label for="email"><?php echo $strings['Email']; ?></label>
                <input type="text" id="email" name="email" maxlength="50" size="40"/>
            </div>
			 <!--Campo descripcion del contacto-->
            <div class="form-group">
                <label for="descripcion"><?php echo $strings['Descripcion']; ?></label>
                <input type="text" id="descripcion" name="descripcion" />
            </div>
			<!--Campo telefono del contacto-->
            <div class="form-group">
                <label for="telefono"><?php echo $strings['Telefono']; ?></label>
                <input type="text" id="telefono" name="telefono" maxlength="11"/>
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
