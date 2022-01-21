<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\Constraints\DateTimeValidator;
use Symfony\Component\Validator\Constraints\Date;
use App\Entity\Documento;

class EstadisticasController extends AbstractController
{
    /**
     * @Route("/app/estadisticas", name="estadisticas")
     */
    public function index(): Response {

    	//Retorno a la vista
        return $this->render('Estadisticas/index.html.twig', [
            'controller_name' => 'EstadisticasController',
        ]);
    }


    /**
     * @Route("/app/estadisticas/Ultimos30Dias", name="metricaUltimos30Dias")
     */
    public function metricaUltimos30Dias(): Response {

     //Obtengo el directorio de los archivos
     //$publicArchivos=$this->getParameter('kernel.project_dir').'/public/archivos';
     
     //Obtengo los ultimos 30 dias
     $arrayUltimos30Dias=$this->obtenerDiasMesActual();
     //Obtengo el array que contiene los datos estadisticos de los documentos generados
     $arrayDocumentos=$this->obtenerArchivosUltimos30Dias($arrayUltimos30Dias);
     

    	//Retorno a la vista
        return $this->render('Estadisticas/metricaUltimos30Dias.html.twig', [
            'arrayDocumentos' => $arrayDocumentos,
            'metrica' => 'ultimos30Dias',
        ]);
    }



     
    /** ---------------- Funciones Auxiliares ---------------- **/
   
    //Funcion que me retorna un array con todos los archivos creados durante el ultimo mes
    private function obtenerArchivosUltimos30Dias($arrayUltimos30Dias) {
     //Obtengo el Entity Manager
     $entityManager = $this ->getDoctrine()->getManager(); 
     //Defino mi array de objetos
     $arrayDocumentos=[];

        //Voy a iterar sobre todas las fechas del array de los ultimos 30 dias
        foreach ($arrayUltimos30Dias as $dia) {         
         //Obtengo todas los archivos del dia
         $documentos=$entityManager->getRepository(Documento::class)->findBy(['fechaCreacion' => new \DateTime($dia)]);
         //Me capturo los archivos del dia
         $diaActual = array('fecha' => $dia, "cantidad" => count($documentos),'color'=>$this->obtenerColorRandom(),"documentos"=> $documentos);
         //Inserto el dia calculado en el array de documentos generados
       	 array_push($arrayDocumentos,$diaActual);      
        }

     //Retorno el array con los documentos con la cantidad de documentos generados por dia
     return $arrayDocumentos;
    }


    //Funcion para obtener todos los dias del corriente mes
    private function obtenerDiasMesActual() {
     //Defino mi array para los dias del mes
     $arrayFechasMes=[];

     //Obtengo la fecha de hoy
     $fechaFin=new \DateTime();
     //Obtengo la fecha de 1 mes hacia atras
     $fecha_actual = date("Y-m-d");
     $fechaInicio= date("Y-m-d",strtotime($fecha_actual."- 1 month"));
     
     //Calculo la diferencia de dias entre ambas fechas 
     $datetime1= date_create($fechaInicio);
     $datetime2= date_create($fecha_actual);
     $diferenciaDias= date_diff($datetime1, $datetime2)->format('%a');
       
        //Voy iterando hasta generar todas las fechas
        for ($i=0; $i <= $diferenciaDias ; $i++) { 
         //Calculo la fecha
         $fechaCalculada=date("Y-m-d",strtotime($fechaInicio."+ ".$i." days"));
         //Inserto la fecha al array de fecha
       	 array_push($arrayFechasMes,$fechaCalculada);
       	}
    
      //Retorno el array con los dias de los ultimos 30 dias
      return $arrayFechasMes;
    }

    //Funcion para obtener colores aleatorios
    private function obtenerColorRandom(){
     //Defino el esquema de colores
     $letras='ABCDEF0123456789';
     $color = '#';
        
        for ( $i = 0; $i < 6; $i++ ) {
         $color .= $letras[rand(0, strlen($letras) - 1)];
        }
     return $color;
    }

  








}
