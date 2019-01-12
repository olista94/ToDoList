<?php

/*
 * Clase : Header 
 * Contiene la vista del header de la pagina
 * Autor: yq5lj9
 * Fecha: 30/11/2018
 */

	include_once '../Functions/Authentication.php';
	if (!isset($_SESSION['idioma'])) {
		$_SESSION['idioma'] = 'SPANISH';
	}
	else{
	}
	include '../Locales/Strings_' . $_SESSION['idioma'] . '.php';
?>

<script>
idioma = "<?php echo $_SESSION['idioma']; ?>"; //Variable global que permite pasar el idioma seleccionado al archivo JavaScript
</script>

<html>
<head>
	<title>ET4</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
	<link rel="stylesheet" type="text/css" href="../Views/style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script type="text/javascript" src="../js/validaciones.js"></script> 
	<script src="../js/script.js"></script>
	<link rel="stylesheet" type="text/css" href="../Views/tcal.css" />
	<script type="text/javascript" src="../js/tcal.js"></script>	

</head>

<?php
if(isset($_SESSION['tipo'])){
	if($_SESSION['tipo']=='ADMIN'){
?>

<header id="main-header">	

	<div class="fixednav">
		<div class="topnav">
			<div class="topnav-centered">
				<a><h2><?php echo $strings['ToDoList']; ?></h2></a>
			</div>

			<a><button class="logo"></button></a>

			<div class="topnav-right">
			<form name='idiomaform' action="../Functions/CambioIdioma.php" method="post" style="display: contents;">
				<select class="idioma" name="idioma" onChange='this.form.submit()'>
					<option value="SPANISH"> </option>
					<option value="ENGLISH"><?php echo $strings['Ingles']; ?></option>
					<option value="SPANISH"><?php echo $strings['Español']; ?></option>
					<option value="GALLAECIAN"><?php echo $strings['Gallego']; ?></option>
				</select>
			</form>
                <?php	
                    if (IsAuthenticated()){
                ?>

				<button class="user"><?php echo $_SESSION['login'];?></button>				   		
   
				<a href='../Functions/Desconectar.php'><button class="logout"></button></a>

                <?php                    
                    }
                    else{
                ?>
                    <a href='../Controllers/Registro_Controller.php'><button class="registrar"></button></a>
                <?php
                    }	
                ?>
				
			</div>
		</div>
	</div>

	<div class="menu-bar" id="menu-bar">
		<li><a class="dropdownElm" onclick="dropdown()"><?php echo $strings['Tareas']; ?></a>
			<nav class="dropdownContent" id="myDropdown">
				<a href="../Controllers/Tareas_Controller.php?action=default"><?php echo $strings['Todas']; ?></a>
				<a href="../Controllers/Tareas_Controller.php?action=Mostrar_Completas"><?php echo $strings['Completas']; ?></a>
				<a href="../Controllers/Tareas_Controller.php?action=Mostrar_NoCompletas"><?php echo $strings['Sin completar']; ?></a>
			</nav>
		</li>
		<li><a href="../Controllers/Prioridades_Controller.php"><?php echo $strings['Prioridades']; ?></a></li>
		<li><a href="../Controllers/Usuarios_Controller.php"><?php echo $strings['Usuarios']; ?></a></li>
		<li><a href="../Controllers/Contactos_Controller.php"><?php echo $strings['Contactos']; ?></a></li>
		<li><a href="../Controllers/Categorias_Controller.php"><?php echo $strings['Categorias']; ?></a></li>
		

		
		<a href="javascript:void(0);" class="icon" onclick="responsiveMenu()">
			<i class="fa fa-bars"></i>
		</a>
	</div>

</header>

<?php
	}
	else{
		?>
		
		<header id="main-header">	

	<div class="fixednav">
		<div class="topnav">
			<div class="topnav-centered">
				<a><h2><?php echo $strings['ToDoList']; ?></h2></a>
			</div>

			<a><button class="logo"></button></a>

			<div class="topnav-right">
			<form name='idiomaform' action="../Functions/CambioIdioma.php" method="post" style="display: contents;">
				<select class="idioma" name="idioma" onChange='this.form.submit()'>
					<option value="SPANISH"> </option>
					<option value="ENGLISH"><?php echo $strings['Ingles']; ?></option>
					<option value="SPANISH"><?php echo $strings['Español']; ?></option>
					<option value="GALLAECIAN"><?php echo $strings['Gallego']; ?></option>
				</select>
			</form>
                <?php	
                    if (IsAuthenticated()){
                ?>

				<button class="user"><?php echo $_SESSION['login'];?></button>				   		
   
				<a href='../Functions/Desconectar.php'><button class="logout"></button></a>

                <?php                    
                    }
                    else{
                ?>
                    <a href='../Controllers/Registro_Controller.php'><button class="registrar"></button></a>
                <?php
                    }	
                ?>
				
			</div>
		</div>
	</div>

	<div class="menu-bar" id="menu-bar">
		<li><a class="dropdownElm" onclick="dropdown()"><?php echo $strings['Tareas']; ?></a>
			<nav class="dropdownContent" id="myDropdown">
				<a href="../Controllers/Tareas_Controller.php?action=default"><?php echo $strings['Todas']; ?></a>
				<a href="../Controllers/Tareas_Controller.php?action=Mostrar_Completas"><?php echo $strings['Completas']; ?></a>
				<a href="../Controllers/Tareas_Controller.php?action=Mostrar_NoCompletas"><?php echo $strings['Sin completar']; ?></a>
			</nav>
		</li>
		<li><a href="../Controllers/Contactos_Controller.php"><?php echo $strings['Contactos']; ?></a></li>
		<a href="javascript:void(0);" class="icon" onclick="responsiveMenu()">
			<i class="fa fa-bars"></i>
		</a>
	</div>

</header>
		
<?php
}
}
?>