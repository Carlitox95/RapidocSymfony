<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\PersonaType;
use App\Entity\Persona;


class PersonaController extends AbstractController {


    /**
     * @Route("/app/registros", name="registros")
     */
    //Funcion para listar el index del modulo personas
    public function index(): Response {
     //Obtengo el Entity Manager
     $em = $this ->getDoctrine()->getManager();
     
     //Obtengo todas las personas
     $personas=$em->getRepository(Persona::class)->findAll();

        //Retorno la vista
        return $this->render('Persona/index.html.twig', 
        	[             
             'personas' => $personas,
            ]
        );
    }
    
  
    /**
     * @Route("/app/registros/ver/{idPersona}", name="verPersona", methods={"GET"})
     */
    //Funcion para acceder a ver una persona
    public function verPersona($idPersona): Response {
     //Obtengo el Entity Manager
     $em = $this ->getDoctrine()->getManager();
     //Obtengo la persona
     $personaSeleccionada=$em->getRepository(Persona::class)->find($idPersona);

        //Retorno la vista
        return $this->render('Persona/ver.html.twig', 
            [             
             'persona' => $personaSeleccionada,
            ]
        );
    }
    

    /**
     * @Route("/app/registros/nueva", name="nuevaPersona")
     */
    //Funcion para crear una nueva persona
    public function nuevaPersona(Request $request): Response {
     //Defino una persona nueva
     $persona = new Persona();
     //Defino el Formulario
     $form = $this->createForm(PersonaType::class, $persona);
     //Si se envia el formulario , existe un request
     $form->handleRequest($request);

        //Si se disparo el formulario y es valido
        if ($form->isSubmitted() && $form->isValid()) {
         //Obtengo el EntityManager
         $entityManager = $this->getDoctrine()->getManager();
         //Obtengo la persona del formulario
         $persona = $form->getData();      
         //Le doy persistencia a la persona nueva
         $entityManager->persist($persona);
         //Asiento los cambios en la base de datos
         $entityManager->flush();

         //Redirecciono al listado de personas
         return $this->redirectToRoute('registros');
        }

        //Redirecciono nuevamente a la vista
        return $this->render('Persona/nueva.html.twig', [
            'form' => $form->createView(),
        ]);      
    }
    
    /**
     * @Route("/app/registros/borrar/{idPersona}", name="borrarPersona", methods={"GET","HEAD","POST"})
     */
    //Funcion para borrar los datos de una persona
    public function borrarPersona($idPersona): Response {
     //Obtengo el EntityManager
     $entityManager=$this->getDoctrine()->getManager();    
     //Obtengo el la persona seleccionada
     $persona=$entityManager->getRepository(Persona::class)->find($idPersona);        
     //Elimino la persona seleccionada
     $entityManager->remove($persona);
     //Asiento los cambios en la Base de Datos
     $entityManager->flush();
          
     //Redirecciono al listado de alumno
     return $this->redirectToRoute('registros');     
    }


    /**
     * @Route("/app/registros/editar/{idPersona}", name="editarPersona", methods={"GET","HEAD","POST"})
     */
    //Funcion para editar los datos de una persona
    public function editarPersona($idPersona,Request $request): Response {
     //Obtengo el EntityManager
     $entityManager=$this->getDoctrine()->getManager();
     //Obtengo la persona seleccionado
     $persona=$entityManager->getRepository(Persona::class)->find($idPersona);   
     //Defino el Formulario
     $form = $this->createForm(PersonaType::class, $persona);

     //Si se envia el formulario , existe un request
     $form->handleRequest($request);
       
       //Si se disparo el formulario y es valido
        if ($form->isSubmitted() && $form->isValid()) {
         //Obtengo el alumno del formulario
         $persona = $form->getData();
         //Obtengo el EntityManager
         $entityManager = $this->getDoctrine()->getManager();
         //Le doy persistencia a la persona nueva
         $entityManager->persist($persona);
         //Asiento los cambios en la base de datos
         $entityManager->flush();

         //Redirecciono al listado de personas
         return $this->redirectToRoute('registros');
        }
      
        return $this->render('Persona/editar.html.twig', [
         'form' => $form->createView(),
         'persona' => $persona,
        ]);
    }








    
}