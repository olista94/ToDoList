/*
Creado por: on7s94
Fecha de creacion: 28/10/2018
*/

/*Comprueba si un campo está vacio o no. Si esta vacio devuelve false, si no, true*/
function comprobarVacio(campo){
  if ((campo.value == null) || (campo.value.length == 0)){ //Si es null o tiene longitud 0 (doble comprobacion) es vacio
    alert('El atributo no puede ser vacio'); //Muestra un alert con el error
    campo.style.borderColor = "#FF0000"; //Cambia el borde del campo a rojo
    return false;
  }else{
    campo.style.borderColor = "#008000"; //Cambia el borde del campo a verde
    return true;
  }
}

/*Comprueba que el campo esta lleno de texto, esto es:
  que solo tiene caracteres y carece de espacios, dado que se usa para contraseñas y nombre de usuario*/
function comprobarTexto(campo,size) {
  var valor = campo.value; //variable que almacena el valor del campo
  if(!/^\S+$/.test(valor)){ //expresion regular que busca si hay espacios
    alert('Este campo no puede contener espacios'); //Si contiene espacios se muestra el alert
    campo.style.borderColor = "#FF0000"; //Cambia el borde del campo a rojo
    return false;
  }else{
    //Tambien comprueba el tamaño
    if (campo.value.length>size) {
      alert('Longitud incorrecta. El campo debe ser maximo ' + size + ' y es ' + campo.value.length); //Si tiene una longitud mayor de la deseada, tambien muestra alert
      campo.style.borderColor = "#FF0000";  //Cambia el borde del campo a rojo   
      return false;
    }
    campo.style.borderColor = "#008000"; //Cambia el borde del campo a verde
    return true;
  }
}

/* Dada una expresion regular cualquiera que se le pasa por parametro
  este metodo comprueba que el campo que tambien se le pasa cumple dicha expresion*/
function comprobarExpresionRegular(campo, exprreg, size){
  var filter = new RegExp(exprreg); //variable que crea y almacena la expresion regular

  var valor = campo.value; //variable que almacena el valor del campo a comprobar

  if (!filter.test(valor)) {
    alert("El campo no coincide con la expresion regular");
    campo.style.borderColor = "#FF0000"; //Cambia el borde del campo a rojo
    return false;
  }else{
    //Se comprueba la longitud del campo
    if(campo.value.length>size){
      alert('Longitud incorrecta. El atributo ' + campo.name + 'debe ser maximo ' + size + ' y es ' + campo.value.length);
      campo.style.borderColor = "#FF0000"; //Cambia el borde del campo a rojo
      return false;
    }
    campo.style.borderColor = "#008000"; //Cambia el borde del campo a verde
    return true;
  }
}

/*Funcion que comprueba si el campo que se le pasa es un numero
  y si es mayor o menor a los valores indicados por parametros*/
function comprobarEntero(campo,valormenor,valormayor) {

    var valor = campo.value; //variable que almacena el valor del campo a comprobar

    if (!/^[0-9]*$/.test(valor)) { //Expresion regular para saber si es un numero entero
        alert("El campo debe ser un entero");
        campo.style.borderColor = "#FF0000"; //Cambia el borde del campo a rojo
        return false;
    }else{
        // Se comprueba el rango del valor
        if((valor<valormenor)||(valor>valormayor)||(valor=='')){
            alert("El numero no puede ser mayor que " + valormayor + " o menor que " + valormenor);
            campo.style.borderColor = "#FF0000"; //Cambia el borde del campo a rojo
            return false;
        }else{
          campo.style.borderColor = "#008000"; //Cambia el borde del campo a verde
          return true;
        }
    }
}

/*Funcion que comprueba si el campo está formado solamente por letras 
  (incluye espacios para apellidos y nombres compuestos)*/
function comprobarAlfabetico(campo){

  var valor = campo.value; //variable que almacena el valor del campo a comprobar

  //Expresion regular para saber si solo contiene letras y espacios
  if (!/^([a-zA-ZÁÉÍÓÚÑÇáéíóúñç]+\s)*[a-zA-ZÁÉÍÓÚÑÇáéíóúñç]+$/.test(valor)) {
    alert("El campo " + campo.name + " solo puede contener letras y espacios");
    campo.style.borderColor = "#FF0000"; //Cambia el borde del campo a rojo
    return false;
  }else{
    campo.style.borderColor = "#008000"; //Cambia el borde del campo a verde
    return true;
  }
}

/*Funcion que comprueba si el grupo es correcto (no usada, no es necesaria)*/
function comprobarGrupo(campo){

  var valor = campo.value; //variable que almacena el valor del campo a comprobar

  if (!/^IU[1-6]*$/.test(valor)) {
    alert("El grupo no es correcto");
    campo.style.borderColor = "#FF0000"; //Cambia el borde del campo a rojo
    return false;
  }else{
    campo.style.borderColor = "#008000"; //Cambia el borde del campo a verde
    return true;
  }
}

/*Funcion que comprueba que la fecha es correcta y sigue el formato adecuado*/
function comprobarFecha(campo){

    var valor = campo.value; //variable que almacena el valor del campo a comprobar
  
    if (!/^([0-2][0-9]|3[0-1])(\/|-)(0[1-9]|1[0-2])\2(\d{4})$/.test(valor)) {
      alert("El formato de la fecha es incorrecto");
      campo.style.borderColor = "#FF0000"; //Cambia el borde del campo a rojo
      return false;
    }else{
      campo.style.borderColor = "#008000"; //Cambia el borde del campo a verde
      return true;
    }
  }

/*Funcion que comprueba que el numero introducido es real
y que tiene el numero de decimales indicado
Ademas, tambien comprueba que dicho numero se encuentra entre
los rangos proporcionados*/
function comprobarReal(campo, numDec, min, max){

  valor = campo.value(); //variable que almacena el valor del campo a comprobar

  var filter = new RegExp("/^\d+(\.\d{1,"+numDec+"})+$/"); //Variable que almacena la expresion regular

  // Se comprueba el numero en la expresion regular
  if(!filter.test(valor)){
    alert("El numero no puede tener mas de " + numDec + " decimales");        
    return false;
  }else{
    //Tambien se comprueba el rango de valores
    if(valor<min||valor>max){
      alert("El numero no puede ser mayor que " + max + " o menor que " + min);
      campo.style.borderColor = "#FF0000"; //Cambia el borde del campo a rojo
      return false;
    }else{
      campo.style.borderColor = "#008000"; //Cambia el borde del campo a verde
      return true;
    }        
  }

}

//Funcion que comprueba que el formato y la letra del DNI son validos
function comprobarDni(campo){
  var valor = campo.value; //variable que almacena el valor del campo a comprobar
  var letras = ['T', 'R', 'W', 'A', 'G', 'M', 'Y', 'F', 'P', 'D', 'X', 'B', 'N', 'J', 'Z', 'S', 'Q', 'V', 'H', 'L', 'C', 'K', 'E', 'T'];

  if( !(/^\d{8}[a-zA-Z]$/.test(valor)) ) { //Se comprueba si se cumple o no el formato de de DNI (8 NUMEROS) mediante la expresion formal
    alert('DNI incorrecto');
    campo.style.borderColor = "#FF0000"; //Cambia el borde del campo a rojo
    return false;
  }

  if(valor.charAt(8).toUpperCase() != letras[(valor.substring(0, 8))%23]) { //Se comprueba si la letra es correcta haciendo uso del array
    alert('La letra no coincida, el DNI esta mal');
    campo.style.borderColor = "#FF0000"; //Cambia el borde del campo a rojo
    return false;
  }else{
    campo.style.borderColor = "#008000"; //Cambia el borde del campo a verde
    return true;
  }
}

//Funcion que comprueba el número de telefono
function comprobarTelf(campo){
  var valor = campo.value; //variable que almacena el valor del campo a comprobar  

  if(!/^(\+34|0034|34)?[6|7|9][0-9]{8}$/.test(valor)){ //Se comprueba si se cumple o no el formato de telefono mediante la expresion formal
    alert('Telefono incorrecto'); //Si es asi se muestra advertencia
    campo.style.borderColor = "#FF0000"; //Cambia el borde del campo a rojo
    return false;
  }
    campo.style.borderColor = "#008000"; //Cambia el borde del campo a verde
    return true;

} 

//Funcion que comprueba el que el formato del email es correcto
function comprobarEmail(campo, longitud){
  valor = campo.value;//Variable valor donde se almacena el valor del campo a comprobar
  if( !(/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i.test(valor)) ) {
    alert('Direccion de email incorrecta');
    campo.style.borderColor = "#FF0000"; //Cambia el borde del campo a rojo
    return false;
  }else{
    campo.style.borderColor = "#008000"; //Cambia el borde del campo a verde
    return true;
  }
}

function comprobarRegistro(formulario) {
   
  if ( !comprobarVacio(formulario.login) || !comprobarTexto(formulario.login, 15) ) {
    alert("Introduzca correctamente el login");
		return false;
    }
  if ( !comprobarVacio(formulario.password) || !comprobarTexto(formulario.password, 128) ){
    alert("Introduzca correctamente la contraseña");
    return false;
  }
  if ( !comprobarVacio(formulario.DNI) || !comprobarDni(formulario.DNI) ) {
    alert("Introduzca correctamente el dni");
		return false;
    }  
  if ( !comprobarVacio(formulario.nombre) || !comprobarAlfabetico(formulario.nombre, 30) ) {
    alert("Introduzca correctamente el nombre");
		return false;
    }
  if ( !comprobarVacio(formulario.apellidos) || !comprobarAlfabetico(formulario.apellidos, 50) ){
    alert("Introduzca correctamente los apellidos");
    return false;
  }
  if ( !comprobarVacio(formulario.telefono) || !comprobarTelf(formulario.telefono) ){
    alert("Introduzca correctamente el telefono");
    return false;
  }
	if ( !comprobarVacio(formulario.email) || !comprobarEmail(formulario.email, 60) ) {
    alert("Introduzca correctamente el email");
		return false;	
	}
  return true;
}

/*Funcion que recorre el formulario de registro
  y va comprobando que todos los campos tienen contenido y este es correcto*/
function comprobarFormulario(formulario) {
    	
	if ( !comprobarVacio(formulario.email) || !comprobarEmail(formulario.email, 60) ) {
    alert("Introduzca correctamente el email");
		return false;	
	}
	if ( !comprobarVacio(formulario.nombre) || !comprobarAlfabetico(formulario.nombre, 30) ) {
    alert("Introduzca correctamente el nombre");
		return false;
    }
  if ( !comprobarVacio(formulario.apellidos) || !comprobarAlfabetico(formulario.apellidos, 40) ){
    alert("Introduzca correctamente los apellidos");
    return false;
  }
  if ( !comprobarVacio(formulario.participacion) || !comprobarEntero(formulario.participacion,0,999) ){
    alert("Introduzca correctamente la participacion");
    return false;
  }
  return true;
}

/*Funcion que recorre el formulario de edicion
  y va comprobando que todos los campos tienen contenido y este es correcto*/
function comprobarFormularioEdit(formulario) {
    	
    if ( !comprobarVacio(formulario.email) || !comprobarEmail(formulario.email, 60) ) {
      alert("Introduzca correctamente el email");
      return false;	
    }
    if ( !comprobarVacio(formulario.nombre) || !comprobarAlfabetico(formulario.nombre, 30) ) {
      alert("Introduzca correctamente el nombre");
      return false;
      }
    if ( !comprobarVacio(formulario.apellidos) || !comprobarAlfabetico(formulario.apellidos, 40) ){
      alert("Introduzca correctamente los apellidos");
      return false;
    }
    if ( !comprobarVacio(formulario.participacion) || !comprobarEntero(formulario.participacion,0,999) ){
      alert("Introduzca correctamente la participacion");
      return false;
    }
    if ( !comprobarVacio(formulario.premipersonal) || !comprobarEntero(formulario.premipersonal,0,999999) ){
      alert("Introduzca correctamente la participacion");
      return false;
    }
    return true;
}

/*Funcion que recorre el formulario de busqueda
  y va comprobando que todos los campos son correctos*/
function comprobarFormularioSearch(formulario) {

  if (!comprobarTexto(formulario.login, 25) ) {
    alert("Introduzca correctamente el login a buscar (sin espacios)");
		return false;	
	}
	if (!comprobarAlfabetico(formulario.nombre, 30) ){
    alert("Introduzca correctamente el nombre a buscar (solo letras)");
		return false;
	}
	if (!comprobarAlfabetico(formulario.apellidos, 40) ) {
    alert("Introduzca correctamente el apellido a buscar (solo letras)");
		return false;
	}
	if (!comprobarEntero(formulario.participacion,0,999) ) {
    alert("Introduzca correctamente el curso academico a buscar (solo numeros)");
		return false;
  }
  if (!comprobarEntero(formulario.premipersonal,0,999999) ) {
    alert("Introduzca correctamente el curso academico a buscar (solo numeros)");
		return false;
  }
    return true;
}

function comprobarLogin(formulario){
  
  if ( !comprobarVacio(formulario.login) || !comprobarTexto(formulario.login, 15) ) {
    alert("Introduzca correctamente el login");
		return false;
  }
  if ( !comprobarVacio(formulario.password) || !comprobarTexto(formulario.password, 128) ){
    alert("Introduzca correctamente la contraseña");
    return false;
  }
  return true;
}

