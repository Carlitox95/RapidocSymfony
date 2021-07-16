//Funcion para activar la vista previa
function activarVistaPreviaDocumento(id) {
 //Reseteo todos los elementos del contenedor
 let contenedorVistaPrevia=document.getElementById("coleccionImagenes").querySelectorAll('li');
  //Reseteo uno a uno los elementos
  for (var i = 0; i < contenedorVistaPrevia.length; i++) {
   contenedorVistaPrevia[i].setAttribute("class","collection-item oculto");
  } 
 //Activo el elemento seleccionado
 document.getElementById("vistaPrevia"+id).setAttribute("class","collection-item");        
}

//Funcion para activar la seleccion de un documento
function seleccionarDocumento(id){
 //Activo el boton de seleccion
 document.getElementById("botonSubmitDocumento").setAttribute("class","waves-effect waves-light btn-large blue lighten-2 white-text");
 //Reseteo todos los elementos del contenedor
 let contenedorPersonas=document.getElementById("coleccionDocumentacion").querySelectorAll('a');
  //Reseteo uno a uno los elementos
  for (var i = 0; i < contenedorPersonas.length; i++) {
   contenedorPersonas[i].setAttribute("class","collection-item");
  }        
 //Activo el elemento seleccionado
 document.getElementById("formulario"+id).setAttribute("class","collection-item cyan lighten-3 white-text");
 //Cargo los valores        
 document.getElementById("documentoId").value=document.getElementById("formulario"+id).getAttribute("identificador");
 //Activo la vista previa       
 activarVistaPreviaDocumento(id);
}  

