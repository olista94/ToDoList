<?php

/*
 * Clase : LOTERIA_SHOWALL 
 * Vista para ver todas las participaciones de loteria 
 * (o una vista parcial obtenida de un search)
 * Autor: yq5lj9
 * Fecha: 30/11/2018
 */
    
    include_once '../Functions/Authentication.php';
    include '../Locales/Strings_SPANISH.php';
	include '../Views/Header.php';
  
    
    class LOTERIA_SHOWALL {

        private $lista;
        private $loterias;
        private $message;

        function __construct($lista,$loterias,$message){
            
            $this->pinta($loterias,$message);

        }


//función que pinta la vista
    function pinta($loterias,$message){
        //comprueba si hay un idioma en $_SESSION
        //si no, inserta el idioma español
        if(!isset($_SESSION['idioma'])){
            $_SESSION['idioma'] = 'SPANISH';
        }

        include '../Locales/Strings_'. $_SESSION['idioma'] .'.php';

        ?>
            <section class="form-basic-start"> 

            <div class="showall">
    
                                
                <table class="showAllUsers">
                    <tr><th class="title" colspan="4"><?php echo $strings['Lotería']; ?>
                    <form class="tableActions" action="../Controllers/Loteria_Controller.php" method="">
                    <button class="buscar-little" name="action" value="SEARCH" type="submit"></button>
                    <button class="anadir-little"  name="action" value="ADD" type="submit"></button>
                    </form></th>
			
		</tr>
		<tr>
			<th><?php echo $strings['Email']; ?></th>
			<th><?php echo $strings['Nombre']; ?></th>
			<th><?php echo $strings['Apellidos']; ?></th>			
			<th></th>
		</tr>
		<?php 
        
			while ($row = $loterias->fetch_array()){
                        
        ?>
		<tr>
			<form action="../Controllers/Loteria_Controller.php" method="" >
				<td><input type="hidden" name="email" value="<?php echo $row['lot.email']; ?>"><?php echo $row['lot.email']; ?></td>
				<td><?php echo $row['lot.nombre']; ?></td>
				<td><?php echo $row['lot.apellidos']; ?></td>				
				<td style="text-align:right">
					<button class="editar" name="action" value="EDIT" type="submit"></button>
					<button class="borrar" name="action" value="DELETE" type="submit"></button>
					<button class="add" name="action" value="SHOWCURRENT" type="submit"></button>
				</td>
			</form>
		</tr>
		<?php
			}
		?>
                    
                    </table>        
            </div>           
        
        <?php
    
        }
    }
    ?>

    
    <footer>
        <?php include '../Views/Footer.php'; ?>
    </footer>