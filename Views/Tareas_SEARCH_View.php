<!-- FORMULARIO PARA BUSCAR TAREAS
CREADO POR: Los Cangrejas
Fecha: 28/12/2018-->

<?php
 //Declaracion de la clase
    class Tareas_SEARCH {
	
	 //Variable con el enlace al form de SEARCH tarea
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
        <!--Formulario para buscar tarea-->
        <form class="formB" id="searchForm" enctype="multipart/form-data" method="post" action="../Controllers/Tareas_Controller.php">
            <legend><?php echo $strings['Buscar tarea'];?>
			<!--Boton para volver atras-->
            <button onclick="location.href='../Controllers/Tareas_Controller.php';" class="volver"></button>
            </legend>
			<!--Campo ID de la tarea-->
			<div class="form-group">
			<label for="id_tarea"><?php echo $strings['ID tarea']; ?></label>
				<input type="text" name="id_tarea"  size="5" >
			</div>
			<!--Campo descripcion de la tarea-->
            <div class="form-group">
                <label for="descripcion"><?php echo $strings['Descripcion']; ?></label>
                <input type="text" id="descripcion" name="descripcion" maxlength="50" size="40"/>
            </div>
            <!--Campo fecha inicio de la tarea-->
			<div class="form-group">
                <label for="fecha_ini"><?php echo $strings['Fecha inicio']; ?></label>
                <input type="text" id="fecha_ini" name="fecha_ini" maxlength="11" size="15"/>
            </div>
			<!--Campo fecha fin de la tarea-->
			<div class="form-group">
                <label for="fecha_fin"><?php echo $strings['Fecha fin']; ?></label>
                <input type="text" id="fecha_fin" name="fecha_fin" maxlength="11" size="15"/>
            </div>
			<!--Campo usuario de la tarea-->
			<div class="form-group">
                <label for="USUARIOS_login"><?php echo $strings['Usuario']; ?></label>
                <input type="text" id="USUARIOS_login" name="USUARIOS_login" maxlength="50" size="55"/>
            </div>
			<!--Campo categoria de la tarea-->
			<div class="form-group">
                <label for="id_categoria"><?php echo $strings['Categoria']; ?></label>
                <input type="text" id="id_categoria" name="id_categoria" maxlength="50" size="55"/>
            </div>
			<!--Campo prioridad de la tarea-->
			<div class="form-group">
                <label for="nivel_prioridad"><?php echo $strings['Prioridad']; ?></label>
                <input type="text" id="nivel_prioridad" name="nivel_prioridad" maxlength="50" size="55"/>
            </div>
			
			<!--Boton de confirmar busqueda-->
            <button type="submit" name="action" value="Confirmar_SEARCH2" class="buscar"></button>

        </form>
            
        </body>
        </html>
        
        <?php
    
        }
    }
?>