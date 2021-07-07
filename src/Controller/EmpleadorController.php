<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\EmpleadorType;
use App\Entity\Empleador;
use App\Entity\Persona;


class EmpleadorController extends AbstractController {

    /**
     * @Route("/app/empleadores", name="empleadores")
     */
    //Funcion para listar el index de empleadores
    public function index(): Response {
     //Obtengo el Entity Manager
     $em = $this ->getDoctrine()->getManager();
     
     //Obtengo todos los empleadores
     $empleadores=$em->getRepository(Empleador::class)->findAll();

        //Retorno la vista
        return $this->render('Empleador/index.html.twig', 
        	[             
             'empleadores' => $empleadores,
            ]
        );
    }
    
  
    /**
     * @Route("/app/empleador/ver/{idEmpleador}", name="verEmpleador", methods={"GET"})
     */
    //Funcion para acceder a ver un empleador
    public function verEmpleador($idEmpleador): Response {
     //Obtengo el Entity Manager
     $em = $this ->getDoctrine()->getManager();
     //Obtengo el empleador
     $empleadorSeleccionado=$em->getRepository(Empleador::class)->find($idEmpleador);

        //Retorno la vista
        return $this->render('Empleador/ver.html.twig', 
            [             
             'empleador' => $empleadorSeleccionado,
            ]
        );
    }
    

    /**
     * @Route("/app/empleador/nuevo", name="nuevoEmpleador")
     */
    //Funcion para crear un nuevo empleador
    public function nuevoEmpelador(Request $request): Response {
     //Defino un empleador nuevo
     $empleador = new Empleador();
     //Defino el Formulario
     $form = $this->createForm(EmpleadorType::class, $empleador);
     //Si se envia el formulario , existe un request
     $form->handleRequest($request);

        //Si se disparo el formulario y es valido
        if ($form->isSubmitted() && $form->isValid()) {
         //Obtengo el EntityManager
         $entityManager = $this->getDoctrine()->getManager();
         //Obtengo el empleador formulario
         $empleador = $form->getData();      
         //Le doy persistencia al empleador nuevo
         $entityManager->persist($empleador);
         //Asiento los cambios en la base de datos
         $entityManager->flush();

         //Redirecciono al listado de empleadores
         return $this->redirectToRoute('empleadores');
        }

        //Redirecciono nuevamente a la vista
        return $this->render('Empleador/nuevo.html.twig', [
            'form' => $form->createView(),
        ]);      
    }
    
    /**
     * @Route("/app/empleador/borrar/{idEmpleador}", name="borrarEmpleador", methods={"GET","HEAD","POST"})
     */
    //Funcion para borrar los datos de un empleador
    public function borrarEmpleador($idEmpleador): Response {
     //Obtengo el EntityManager
     $entityManager=$this->getDoctrine()->getManager();    
     //Obtengo el empleador seleccionado
     $empleador=$entityManager->getRepository(Empleador::class)->find($idEmpleador);        
     //Elimino el empleador seleccionado
     $entityManager->remove($empleador);
     //Asiento los cambios en la Base de Datos
     $entityManager->flush();
          
     //Redirecciono al listado de alumno
     return $this->redirectToRoute('empleadores');     
    }


    /**
     * @Route("/app/empleador/editar/{idEmpleador}", name="editarEmpleador", methods={"GET","HEAD","POST"})
     */
    //Funcion para editar los datos de un empleador
    public function editarEmpleador($idEmpleador,Request $request): Response {
     //Obtengo el EntityManager
     $entityManager=$this->getDoctrine()->getManager();
     //Obtengo el empleador seleccionado
     $empleador=$entityManager->getRepository(Empleador::class)->find($idEmpleador);   
     //Defino el Formulario
     $form = $this->createForm(EmpleadorType::class, $empleador);

     //Si se envia el formulario , existe un request
     $form->handleRequest($request);
       
       //Si se disparo el formulario y es valido
        if ($form->isSubmitted() && $form->isValid()) {
         //Obtengo el empleador del formulario
         $empleador = $form->getData();
         //Obtengo el EntityManager
         $entityManager = $this->getDoctrine()->getManager();
         //Le doy persistencia al empleador
         $entityManager->persist($empleador);
         //Asiento los cambios en la base de datos
         $entityManager->flush();

         //Redirecciono al listado de empleadores
         return $this->redirectToRoute('registros');
        }
      
        return $this->render('Empleador/editar.html.twig', [
         'form' => $form->createView(),
         'empleador' => $empleador,
        ]);
    }








    
}