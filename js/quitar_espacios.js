// Script para quitar espacios en blanco

  function sinespacio(e) {

  var cadena =  e.value;
  var limpia = "";
  var parts = cadena.split(" ");
  var length = parts.length;

    for (var i = 0; i < length; i++) {
        nuevacadena = parts[i];
        subcadena = nuevacadena.trim();

    if(subcadena != "") {
       limpia += subcadena + " ";
          }
    }
  limpia = limpia.trim();
  e.value = limpia;

   };




function quitarespacios(e) {

var cadena =  e.value;
cadena = cadena.trim();

e.value = cadena;

};

