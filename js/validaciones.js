/* FICHERO JS EN EL QUE SE MUESTRAN LAS FUNCIONES DE VALIDACION DE LOS FORMULARIOS DE LA ET3 */
/*-- CREADO POR mi3ac6 EL 17/11/2018 */


/* Función que comprueba si un campo que se le pasa como parámetro está o no vacío.True si lo está,false en caso contrario. */
function comprobarVacio(campo){
	//Campo será la variable que represente al campo del formulario
	/* Comprueba si el tamaño del valor del campo es igual a 0 */
	
	if(campo.value.length == 0){
		/* Si el valor introducido es erróneo,mostrará el campo con un borde rojo */
		campo.style.border = "2px solid red";
		return true;
	}
	
	/* Si el valor introducido es correcto,mostrará el campo con un borde verde */
	campo.style.border = "2px solid green"; 
	return false;
}

//Comprueba el tamaño de un campo que acepta cualquie expresion regular
function comprobarTamano(campo,size){
	
	if(campo.value.length > size){
		/* Si el valor introducido es erróneo,mostrará el campo con un borde rojo */
		campo.style.border = "2px solid red";
		return false;
	}
	
	/* Si el valor introducido es correcto,mostrará el campo con un borde verde */
	campo.style.border = "2px solid green"; 
	return true;
}

/* Función que comprueba si un campo que se le pasa como parámetro tiene unicamente letras (con o sin espacios) */
function comprobarTexto(campo,size){
	//Size será la variable que determine el tamaño máximo del valor introducido en el campo
	/* Comprobamos con la funcion comprobarExpresionRegular que al menos,el valor del campo,contiene una letra */
	if(comprobarExpresionRegular(campo,'^[a-zA-ZáéíóúÁÉÍÓÚÑñ]+[ a-zA-ZáéíóúÁÉÍÓÚÑñ ]*$',size)){
		campo.style.border = "2px solid green";
		return true;
	}
	else{
		campo.style.border = "2px solid red";
		return false;
	}
}


/* Función que comprueba si un campo que se le pasa como parámetro cumple una expresión regular dada.Se usará para comprobar el DNI,teléfono... */
function comprobarExpresionRegular(campo,exprreg,size){
	//Exprreg será la variable que represente la expresión regular que debe cumplir el valor del campo
	/* Comprueba que el valor se ajuste al tamaño del campo */
	if(campo.value.length > size){
		campo.style.border = "2px solid red";
		return false;
	}
	else{
	
	/* Variable en la que se guardará la expresión regular */
	var patron = new RegExp (exprreg);
	
	/* Comprueba que la variable patron (donde se guarda una expresión regular) coincide con el valor del campo */
	if(patron.test(campo.value)){		
		campo.style.border = "2px solid green";
		return true;
	}	
	campo.style.border = "2px solid red";
	return false;
	}
}


/* Función que comprueba si un campo que se le pasa como parámetro es cualquier cadena alfanumérica con cualquier caracter especial,sin espacios */
function comprobarAlfabetico(campo,size){
	
	/* Comprueba que el valor contenga cualquier caracter de la expresión,excepto el espacio en blanco */
	if(comprobarExpresionRegular(campo,'^[0-9a-zA-ZáéíóúÁÉÍÓÚÑñ.,\/#!$%\^&\*;:{}=\-_`~()]+$',size)){
		campo.style.border = "2px solid green";
		return true;
	}
	else{
	campo.style.border = "2px solid red";
	return false;
	}
}


/* Función que comprueba si un campo que se le pasa como parámetro es un número entero comprendido entre "valormenor" y "valormayor" */
function comprobarEntero(campo,valormenor,valormayor){
	//Valormenor será el mínimo permitido como valor introducido en el campo
	//Valormayor será el máximo permitido como valor introducido en el campo
	
	/* Comprueba que el valor sea un entero */
	if((campo.value % 1) != 0){
		campo.style.border = "2px solid red";
		return false;
	}
	
	/* Comprueba que el valor sea mayor que "valormenor" y menor que "valormayor" */
	if(parseInt(campo.value) >= valormenor && parseInt(campo.value) <= valormayor){
		campo.style.border = "2px solid green";
		return true;
	}
	if(campo.value.length == 0){
		campo.style.border = "1px solid grey";
		return true;
	}
	else{
		campo.style.border = "2px solid red";
		return false;
	}
}


/* Función que comprueba si un campo que se le pasa como parámetro es un número real comprendido entre "valormenor" y "valormayor",
con el número de decimales indicado en "numero_decimales" */
function comprobarReal(campo,numero_decimales,valormenor,valormayor){
	//Numero_decimales será el número de decimales que tendrá que llevar el valor del campo
	/* Comprueba que el valor del campo sea un número */
	if(isNaN(campo.value)){
		campo.style.border = "2px solid red";
		return false;
	}
	
	/* Array que separará la parte entera de la decimal (con un . como separador) */
	var partes = campo.value.split(".");
	
	/* En izq guardamos la parte entera y en der guardamos la decimal */
	var izq = partes[0];
	var der = partes[1];
	
	/* Comprueba que el número introducido no sea un entero */
	if((campo.value % 1) == 0){
		campo.style.border = "2px solid red";
		return false;
	}
	
	/* Comprueba que el número de decimales sea el indicado en la variable numero_decimales */
	if( partes[1].length != numero_decimales){
		campo.style.border = "2px solid red";
		return false;
	}
	
	/* Comprueba que el valor sea mayor que "valormenor" y menor que "valormayor" */
	if(parseFloat(campo.value) >= valormenor && parseFloat(campo.value) <= valormayor){
			campo.style.border = "2px solid green";
			return true;
	}
	else{
		campo.style.border = "2px solid red";
		return false;
	}
}


/* Función que comprueba si un campo que se le pasa como parámetro es un DNI con formato de 8 dígitos y una letra mayúscula o minúscula,sin separadores */
function comprobarDni(campo){
	
	/* Comprueba que el valor tenga un formato de 8 dígitos y una letra mayúscula o minúscula,sin separadores */
	if(!comprobarExpresionRegular(campo,'^[0-9]{8}[A-Za-z]$',9)){
		campo.style.border = "2px solid red";
		return false;
	}
	
	/* Separamos los números de la letra con la función substr() */
	var numeros = campo.value.substr(0,8);
	var letra = campo.value.substr(8,1);
	
	/* Variable para comprobar que la letra introducida se corresponde al DNI */
	var letras = "TRWAGMYFPDXBNJZSQVHLCKE";
	
	/* Comprobamos que la letra es la correcta */
	var indice = parseInt(numeros)%23;
	if(letras.charAt(indice) == letra.toUpperCase()){
		campo.style.border = "2px solid green";
		return true;
	}

	campo.style.border = "2px solid red";
	return false;
}


/*Función que comprueba si un campo que se le pasa como parámetro es un teléfono con 9 digitos con o sin prefijo (que podrá ser 34,+34 o 0034) y sin separador*/
function comprobarTelf(campo){
	
	/* Si la longitud es 9,será del tipo: 676234598 (pudiendo empezar por 6,7,8 o 9) */
	if(campo.value.length == 9){
		return comprobarExpresionRegular(campo,'^[6-9][0-9]{8}$',9);
	}
	
	/* Si la longitud es 11,será del tipo: 34676234598 */
	else if(campo.value.length == 11){	
		return comprobarExpresionRegular(campo,'^(34)[6-9][0-9]{8}$',11);
	}
	
	else{
		campo.style.border = "2px solid red";
		return false;
	}
}


/* Función que comprueba si un campo que se le pasa como parámetro es un email con el formato cadenaAlfanumericos@cadenaAlfanumericos.cadenaAlfabeticos */
function comprobarEmail(campo,size){
	
	if(campo.value.length > size){
		campo.style.border = "2px solid red";
		return false;
	}
	else{
		/* Expresión regular que valida un email */
		const regex = /^[_a-zA-ZÑñ0-9-]+(\.[_a-zA-ZÑñ0-9-]+)*@[a-zA-ZÑñ0-9-]+(\.[a-zA-ZÑñ0-9-]+)*\.[a-zA-ZÑñ]{2,6}$/;
		
		/* Comprobamos que el valor coincide con la expresión */
		if (patron1 = regex.test(campo.value))  {
			campo.style.border = "2px solid green";
			return true;
		}
		else{
			campo.style.border = "2px solid red";
			return false;
		}		
	}
	campo.style.border = "2px solid red";
	return false;
}


/* Función que comprueba si el campo fecha está o no vacío */
function comprobarFecha(campo){
	
	if(campo.value.length == 0){
		campo.style.border = "2px solid red";
		return false;
	}
	else{
		campo.style.border = "2px solid green";
		return true;
	}
}


function comprobarLetrasYNumeros(campo,size){
	//Size será la variable que determine el tamaño máximo del valor introducido en el campo
	/* Comprobamos con la funcion comprobarExpresionRegular que al menos,el valor del campo,contiene una letra */
	if(comprobarExpresionRegular(campo,'^[a-zA-ZáéíóúÁÉÍÓÚÑñ.,\/#!$%\^&\*;:{}=\-_`~()]+$]+[ a-zA-ZáéíóúÁÉÍÓÚÑñ.,\/#!$%\^&\*;:{}=\-_`~()]+$ ]*$',size)){
		campo.style.border = "2px solid green";
		return true;
	}
	else{
		campo.style.border = "2px solid red";
		return false;
	}
}

//Se comprueba que los campos de registrar usuario son correctos
function comprobarRegistro(formAdd){
	
	/* En cada campo comprobrará,primero su tamaño y si es incorrecto mostrará una ventana de error */
	if(formAdd.login.value.length == 0 || formAdd.login.value.length > 15){
		alert("El tamaño del campo "+formAdd.login.name+" es incorrecto");
		return false;
	}
	/* Y además comprobará que el formato introducido sea el correcto (mostrando una ventana en caso contrario) */
	else if(comprobarAlfabetico(formAdd.login) ==  false){
		alert("El campo "+formAdd.login.name+" no puede llevar espacios en blanco");
		return false;
	}
	
	else if(formAdd.password.value.length == 0 || formAdd.password.value.length > 20){
		alert("El tamaño del campo "+formAdd.password.name+" es incorrecto");
		return false;
	}
	else if(comprobarAlfabetico(formAdd.password) ==  false){
		alert("El campo "+formAdd.password.name+" no puede llevar espacios en blanco");
		return false;
	}
	
	else if(formAdd.DNI.value.length == 0 || formAdd.DNI.value.length > 9){
		alert("El tamaño del campo "+formAdd.DNI.name+" es incorrecto");
		return false;
	}
	else if(comprobarDni(formAdd.DNI) ==  false){
		alert("Formato o letra del campo "+formAdd.DNI.name+" erróneo (Ej:44657079K)");
		return false;
	}
	
	else if(formAdd.nombre.value.length == 0 || formAdd.nombre.value.length > 30){
		alert("El tamaño del campo "+formAdd.nombre.name+" es incorrecto");
		return false;
	}
	else if(comprobarTexto(formAdd.nombre) ==  false){
		alert("El campo "+formAdd.nombre.name+" solo puede llevar texto o empezar por una letra");
		return false;
	}
	
	else if(formAdd.apellidos.value.length == 0 || formAdd.apellidos.value.length > 50){
		alert("El tamaño del campo "+formAdd.apellidos.name+" es incorrecto");
		return false;
	}
	else if(comprobarTexto(formAdd.apellidos) ==  false){
		alert("El campo "+formAdd.apellidos.name+" solo puede llevar texto o empezar por una letra");
		return false;
	}
	
	else if(formAdd.telefono.value.length == 0 || formAdd.telefono.value.length > 11){
		alert("El tamaño del campo "+formAdd.telefono.name+" es incorrecto");
		return false;
	}
	else if(comprobarTelf(formAdd.telefono) ==  false){
		alert("Formato del campo "+formAdd.telefono.name+" erróneo (Ej:34668952356)");
		return false;
	}
	
	else if(formAdd.email.value.length == 0 || formAdd.email.value.length > 60){
		alert("El tamaño del campo "+formAdd.email.name+" es incorrecto");
		return false;
	}
	else if(comprobarEmail(formAdd.email) ==  false){
		alert("El formato del campo "+formAdd.email.name+" es erróneo (ejemplo@ejemplo.com)");
		return false;
	}
	
	
	else if(comprobarFecha(formAdd.FechaNacimiento) == false){
		alert("El campo "+formAdd.FechaNacimiento.name+" no puede estar vacío");
		return false;
	}
	
	
	else{
		return true;
	}
}

function comprobarCategoria(formu){//Comprueba añadir y editar categoria
	
	/* En cada campo comprobrará,primero su tamaño y si es incorrecto mostrará una ventana de error */
	if(formu.nombre.value.length == 0 || formu.nombre.value.length > 45){
		alert("El tamaño del campo nombre es incorrecto");
		return false;
	}
	/* Y además comprobará que el formato introducido sea el correcto (mostrando una ventana en caso contrario) */
	else if(comprobarTexto(formu.nombre) ==  false){
		alert("El campo nombre solo puede llevar texto o empezar por una letra");
		return false;
	}
	
	else{
		return true;
	}
	
	
}

function comprobarContacto(formu){//Comprueba añadir y editar contacto
	
	/* En cada campo comprobrará,primero su tamaño y si es incorrecto mostrará una ventana de error */
	if(formu.nombre.value.length == 0 || formu.nombre.value.length > 45){
		alert("El tamaño del campo nombre es incorrecto");
		return false;
	}
	/* Y además comprobará que el formato introducido sea el correcto (mostrando una ventana en caso contrario) */
	else if(comprobarTexto(formu.nombre) ==  false){
		alert("El campo nombre solo puede llevar texto o empezar por una letra");
		return false;
	}
	
	else if(formu.descripcion.value.length == 0 || formu.descripcion.value.length > 45){
		alert("El tamaño del campo descripcion es incorrecto");
		return false;
	}
		
	
	else if(formu.telefono.value.length == 0 || formu.telefono.value.length > 11){
		alert("El tamaño del campo teléfono es incorrecto");
		return false;
	}
	else if(comprobarTelf(formu.telefono) ==  false){
		alert("Formato del campo teléfono erróneo (Ej:34668952356)");
		return false;
	}
	
	else if(formu.email.value.length == 0 || formu.email.value.length > 60){
		alert("El tamaño del campo email es incorrecto");
		return false;
	}
	else if(comprobarEmail(formu.email) ==  false){
		alert("Formato del campo email erróneo (ejemplo@ejemplo.com)");
		return false;
	}
	
	else{
		return true;
	}
	
}



function comprobarUsuario(formu){//Comprueba añadir y editar usuario
	
	/* En cada campo comprobrará,primero su tamaño y si es incorrecto mostrará una ventana de error */
	if(formu.login.value.length == 0 || formu.login.value.length > 15){
		alert("El tamaño del campo login es incorrecto");
		return false;
	}
	/* Y además comprobará que el formato introducido sea el correcto (mostrando una ventana en caso contrario) */
	else if(comprobarAlfabetico(formu.login) ==  false){
		alert("El campo login no puede llevar espacios en blanco");
		return false;
	}
	
	else if(formu.password.value.length == 0 || formu.password.value.length > 20){
		alert("El tamaño del campo password es incorrecto");
		return false;
	}
	else if(comprobarAlfabetico(formu.password) ==  false){
		alert("El campo password no puede llevar espacios en blanco");
		return false;
	}
	
	else if(formu.dni.value.length == 0 || formu.dni.value.length > 9){
		alert("El tamaño del campo DNI es incorrecto");
		return false;
	}
	else if(comprobarDni(formu.dni) ==  false){
		alert("Formato o letra del campo DNI erróneo (Ej:44657079K)");
		return false;
	}
	
	else if(formu.nombre.value.length == 0 || formu.nombre.value.length > 30){
		alert("El tamaño del campo nombre es incorrecto");
		return false;
	}
	else if(comprobarTexto(formu.nombre) ==  false){
		alert("El campo nombre solo puede llevar texto o empezar por una letra");
		return false;
	}
	
	else if(formu.apellidos.value.length == 0 || formu.apellidos.value.length > 50){
		alert("El tamaño del campo apellidos es incorrecto");
		return false;
	}
	else if(comprobarTexto(formu.apellidos) ==  false){
		alert("El campo apellidos solo puede llevar texto o empezar por una letra");
		return false;
	}
	
	else if(formu.telefono.value.length == 0 || formu.telefono.value.length > 11){
		alert("El tamaño del campo telefono es incorrecto");
		return false;
	}
	else if(comprobarTelf(formu.telefono) ==  false){
		alert("Formato del campo telefono erróneo (Ej:34668952356)");
		return false;
	}
	
	else if(formu.email.value.length == 0 || formu.email.value.length > 60){
		alert("El tamaño del campo email es incorrecto");
		return false;
	}
	else if(comprobarEmail(formu.email) ==  false){
		alert("El formato del campo email es erróneo (ejemplo@ejemplo.com)");
		return false;
	}
	
	
	else if(comprobarFecha(formu.fecha) == false){
		alert("El campo fecha no puede estar vacío");
		return false;
	}
	
	
	else{
		return true;
	}
}

function comprobarPrioridad(formu){//Comprueba añadir y editar contacto
	
	/* En cada campo comprobrará,primero su tamaño y si es incorrecto mostrará una ventana de error */
	if(formu.nivel.value.length == 0 || formu.nivel.value.length > 2){
		alert("El tamaño del campo nivel es incorrecto");
		return false;
	}
	/* Y además comprobará que el formato introducido sea el correcto (mostrando una ventana en caso contrario) */
	else if(comprobarEntero(formu.nivel,1,99) ==  false){
		alert("El campo nivel solo puede llevar numeros");
		return false;
	}
	
	else if(formu.descripcion.value.length == 0 || formu.descripcion.value.length > 45){
		alert("El tamaño del campo descripcion es incorrecto");
		return false;
	}
		
	else{
		return true;
	}
	
	
}

function comprobarTarea(formu){//Comprueba añadir y editar tarea y fase
	
	 if(formu.descripcion.value.length == 0 || formu.descripcion.value.length > 45){
		alert("El tamaño del campo descripcion es incorrecto");
		return false;
	}
		
	else{
		return true;
	}
	
	
}





//Comprueba que ni el login,ni la password del login esten vacíos
 function validarLogin(formLogin){
	
	if(formLogin.login.value.length == 0 ||  formLogin.login.value.length > 15){
		alert("El tamaño del "+formLogin.login.name+" es incorrecto");
		return false;
	}
	else if(formLogin.password.value.length == 0 ){
		alert("El campo "+formLogin.password.name+" está vacío");
		return false;
	}
	else{
		return true;
	}
} 


