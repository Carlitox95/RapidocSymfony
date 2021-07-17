<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Formulario;
use App\Entity\Persona;
use App\Entity\Empleador;
use App\Entity\Documento;

class ArchivosController extends AbstractController
{
    /**
     * @Route("app/archivos", name="archivos")
     */
    //Funcion para listar todos los archivos
    public function index(): Response {
     //Obtengo el Entity Manager
     $em = $this ->getDoctrine()->getManager();
     //Obtengo todas los archivos
     $documentos=$em->getRepository(Documento::class)->findAll();
     //Obtengo todas las personas
     $personas=$em->getRepository(Persona::class)->findAll();
        
        //Retorno a la vista
        return $this->render('Archivos/index.html.twig', [
            'documentos' => $documentos,
            'personas' => $personas,
        ]);
    }

    /**
     * @Route("/app/archivos/{idPersona}", name="archivosPersona", methods={"GET"})
     */
    //Funcion para acceder a todos los archivos de una persona
    public function archivosPersona($idPersona): Response {
     //Obtengo el Entity Manager
     $em = $this ->getDoctrine()->getManager();
     //Obtengo la persona
     $personaSeleccionada=$em->getRepository(Persona::class)->find($idPersona);
     //Obtengo los documentos de la persona
     $documentos=$personaSeleccionada->getDocumentos();

        //Retorno la vista
        return $this->render('Archivos/verArchivosPersona.html.twig', 
            [             
             'persona' => $personaSeleccionada,
             'documentos' => $documentos,
            ]
        );
    }

    /**
     * @Route("/app/archivo{idDocumento}", name="verArchivo", methods={"GET"})
     */
    //Funcion para acceder a ver un archivo
    public function verArchivo($idDocumento): Response {
     //Obtengo el Entity Manager
     $em = $this ->getDoctrine()->getManager();
     //Obtengo el archivo
     $documentoSeleccionado=$em->getRepository(Documento::class)->find($idDocumento);
     
        //Retorno la vista
        return $this->render('Archivos/verArchivo.html.twig', 
            [             
             'documento' => $documentoSeleccionado,
            ]
        );
    }


    /**
     * @Route("/app/archivo/eliminar{idDocumento}", name="eliminarArchivo", methods={"GET"})
     */
    //Funcion para acceder a ver un archivo
    public function eliminarArchivo($idDocumento): Response {
     //Obtengo el Entity Manager
     $em = $this ->getDoctrine()->getManager();
     //Obtengo el archivo
     $documentoSeleccionado=$em->getRepository(Documento::class)->find($idDocumento);
     //Obtengo la persona
     $persona= $documentoSeleccionado->getPersona();
     //Obtengo la ubicacion fisica
     $archivoFisico=$documentoSeleccionado->getUbicacion();
     

        //Si se ejecuta normalmente
        try { 
         //Elimino el archivo fisicamente antes
         unlink($archivoFisico); 
         //Elimino la persona seleccionada
         $em->remove($documentoSeleccionado);
         //Asiento los cambios en la Base de Datos
         $em->flush();
         
         //Me traigo los documentos de la persona
         $documentos=$persona->getDocumentos();
            
            //Retorno la vista
            return $this->render('Archivos/verArchivosPersona.html.twig', 
                [             
                 'persona' => $persona,
                 'documentos' => $documentos,
                ]
            );
        } 
        //De ocurrir un error lo muestro en el dump
        catch(Exception $e) { 
          var_dump($e);
          die;
        } 

        
    }




    
}
