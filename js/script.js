
//Hace que el menú sea responsive
function responsiveMenu() {
    var x = document.getElementById("menu-bar");
    if (x.className === "menu-bar") {
        x.className += " responsive";
    } else {
        x.className = "menu-bar";
    }
}

//Para abrir desplegables
function dropdown() {
    document.getElementById("myDropdown").classList.toggle("show");    
}

/*
window.onclick = function(e) {
    if (!e.target.matches('.lenguaje')) {
      var myDropdown = document.getElementById("myDropdown");
        if (myDropdown.classList.contains('show')) {
          myDropdown.classList.remove('show');
        }
    }
}
*/