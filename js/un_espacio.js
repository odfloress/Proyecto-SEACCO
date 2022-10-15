document.getElementById("text").addEventListener("keydown", teclear);

var flag = false;
var teclaAnterior = "";

function teclear(event) {
teclaAnterior = teclaAnterior + " " + event.keyCode;
var arregloTA = teclaAnterior.split(" ");
if (event.keyCode == 32 && arregloTA[arregloTA.length - 2] == 32) {
    event.preventDefault();
}
}