//Funcion para renderizar la metrica de los ultimos 30 dias
function renderUltimos30Dias(arrayDatos) {
 //Obtengo los datos del Controller     
 const arrayArchivosXFecha=arrayDatos;
 console.log(arrayArchivosXFecha);
 
 //Obtengo el canvas
 var canvas = document.getElementById("canvasArchivosMensual"); 
 let dias= [];
 let cants= [];
 let backgroundColors = [];

    //Itero sobre el array para definir los datos del canvas
    for (let i=0; i< arrayArchivosXFecha.length; i++) {  
     dias.push(arrayArchivosXFecha[i].fecha);
     cants.push(arrayArchivosXFecha[i].cantidad);         
     backgroundColors.push(arrayArchivosXFecha[i].color);
    };
    
    //Defino los datos de mi canvas
    let canvas = new Chart(canvas, 
        {
         type: 'line',
            data: {  
              labels: dias,          
              datasets: [{
                 label: "Documentos Generados durante los ultimos 30 Dias",
                 data: cants,
                 backgroundColor: backgroundColors,
                 borderColor: backgroundColors,             
                 borderWidth: 1
              }],
              options: {responsive: true,maintainAspectRatio: false,showScale: false,indexAxis: 'y',} 
            },                       
        }
    );    




}

//Funcion que me permite imprimir contenedores como PDF
function descargarPDF(elementoHTML,orientacionPDF) {
 //Obtengo la fecha actual
 let date = new Date();
 let fecha=date.toLocaleDateString();
 //Obtengo el nombre del reporte
 let nombreReporte=document.getElementById(elementoHTML+"Titulo").innerHTML;
 //Obtengo el contenedor
 var contenedor=document.getElementById(elementoHTML);         
    //Completo las variables de renderizado del PDF
    html2pdf().set({
     margin: 1,
     filename: 'Reporte_'+fecha+'_'+nombreReporte+'.pdf',
     image: {
         type: 'jpeg',
         quality: 1
        },
        html2canvas: {
         scale: 5, // A mayor escala, mejores gráficos, pero más peso
         letterRendering: true,
        },
        jsPDF: {
         unit: "in",
         format: "a3",
         orientation: orientacionPDF // landscape o portrait
        }
    }).from(contenedor).save().catch(err => console.log(err));
}

//Funcion que me genera un color de forma alteatoria
function getRandomColor() {
 var letters = '0123456789ABCDEF';
 var color = '#';
  for (var i = 0; i < 6; i++) {
   color += letters[Math.floor(Math.random() * 16)];
  }
 return color;
}