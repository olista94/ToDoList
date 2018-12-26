<?php

    class Prioridades_SEARCH {

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
        
        <form class="formB" id="searchForm" enctype="multipart/form-data" method="post" action="../Controllers/Prioridades_Controller.php">
            <legend><?php echo $strings['Buscar prioridad'];?>
            <button onclick="location.href='../Controllers/Prioridades_Controller.php';" class="volver"></button>
            </legend>

            <div class="form-group">
                <label for="nivel"><?php echo $strings['Nivel']; ?></label>
                <input type="number" id="nivel" name="nivel" size="5"/>
            </div>	
            <div class="form-group">
                <label for="descripcion"><?php echo $strings['Descripcion']; ?></label>
                <input type="text" id="descripcion" name="descripcion" maxlength="50" size="40"/>
            </div>
            <div class="form-group">
                <label for="color"><?php echo $strings['Color']; ?></label>
                <input type="text" id="color" name="color" maxlength="25" size="40"/>
            </div>
            
            <button type="submit" name="action" value="Confirmar_SEARCH" class="buscar"></button>

        </form>
            
        </body>
        </html>
        
        <?php
    
        }
    }
?>