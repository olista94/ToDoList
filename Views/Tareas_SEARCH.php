<?php

    class Tareas_SEARCH {

      var $enlace;

      function __construct($enlace){

        $this -> enlace = $enlace;
        $this->pinta();

      }

      function pinta(){
        
        if(!isset($_SESSION['idioma'])){
            $_SESSION['idioma'] = 'SPANISH';
        }

        include '../Locales/Strings_'. $_SESSION['idioma'] .'.php';

        ?>
        
        <form class="formB" id="searchForm" enctype="multipart/form-data" method="post" action="../Controllers/Tareas_Controller.php">
            <legend><?php echo $strings['Buscar tarea'];?>
            <button onclick="location.href='../Controllers/Tareas_Controller.php';" class="volver"></button>
            </legend>

            <div class="form-group">
                <label for="descripcion"><?php echo $strings['Descripcion']; ?></label>
                <input type="text" id="descripcion" name="descripcion" maxlength="50" size="40"/>
            </div>
            
            <button type="submit" name="action" value="Confirmar_SEARCH" class="buscar"></button>

        </form>
            
        </body>
        </html>
        
        <?php
    
        }
    }
?>