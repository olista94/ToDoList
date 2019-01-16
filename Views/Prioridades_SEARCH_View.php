<!-- FORMULARIO PARA BUSCAR PRIORIDADES
CREADO POR: Los Cangrejas
Fecha: 20/12/2018-->

<?php
  //Declaracion de la clase
    class Prioridades_SEARCH {
//Variable con el enlace al form de SEARCH prioridad
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
        <!--Formulario para buscar prioridad-->
        <form class="formB" id="searchForm" enctype="multipart/form-data" method="post" action="../Controllers/Prioridades_Controller.php">
            <legend><?php echo $strings['Buscar prioridad'];?>
			<!--Boton para volver atrás -->
            <button onclick="location.href='../Controllers/Prioridades_Controller.php';" class="volver"></button>
            </legend>
			<!--Campo nivel de la prioridad-->
            <div class="form-group">
                <label for="nivel"><?php echo $strings['Nivel']; ?></label>
                <input type="number" id="nivel" name="nivel" size="5"/>
            </div>	
			<!--Campo descripcion de la prioridad-->
            <div class="form-group">
                <label for="descripcion"><?php echo $strings['Descripcion']; ?></label>
                <input type="text" id="descripcion" name="descripcion" maxlength="50" size="40"/>
            </div>
			 <!--Campo color de la prioridad-->	
            <div class="form-group">
                <label for="color"><?php echo $strings['Color']; ?></label>
                <input type="text" id="color" name="color" maxlength="25" size="40"/>
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