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
 //Cargo los valores        
 document.getElementById("documentoId").value=id;
 //Activo la vista previa       
 activarVistaPreviaDocumento(id);
}  

