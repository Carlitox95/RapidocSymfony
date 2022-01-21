<?php
namespace App\Controller;

use Symfony\Component\Security\Core\Exception\AccessDeniedException; 
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\UserType;
use App\Form\UserRolesType;
use App\Form\FormularioType;
use App\Entity\Formulario;


class FormularioController extends AbstractController {

    /**
     * Require ROLE_ADMIN for only this controller method.
     *
     * @Route("/app/formularios/", name="abm_formularios")
     *
     * @IsGranted("ROLE_ADMIN")
    */
    public function index(): Response {    
     //Obtengo el Entity Manager
     $em = $this ->getDoctrine()->getManager(); 
     //Obtengo el usuario logueado
     $usuario=$this->get('security.token_storage')->getToken()->getUser();

     //Obtengo todos los formularios
     $formularios=$em->getRepository(Formulario::class)->findAll();

        //Retorno la vista
        return $this->render('Formulario/index.html.twig', 
        	[             
             'formularios' => $formularios,
            ]
        );
    }


    /**
     * Require ROLE_ADMIN for only this controller method.
     *
     * @Route("/app/formularios/ver/{idFormulario}", name="verFormulario", methods={"GET"})
     *
     * @IsGranted("ROLE_ADMIN")
    */
    public function verFormulario($idFormulario): Response {    
     //Obtengo el Entity Manager
     $em = $this ->getDoctrine()->getManager();
     //Obtengo la persona
     $formularioSeleccionado=$em->getRepository(Formulario::class)->find($idFormulario);
     //Defino el Formulario
     $form = $this->createForm(FormularioType::class, $formularioSeleccionado);

        //Retorno la vista
        return $this->render('Formulario/verFormulario.html.twig', 
            [             
             'form' => $form->createView(),
             'formulario' => $formularioSeleccionado,
            ]
        );
    }


    /**
     * Require ROLE_ADMIN for only this controller method.
     *
     * @Route("/app/formularios/editar/{idFormulario}", name="editarFormulario", methods={"GET","HEAD","POST"})
     *
     * @IsGranted("ROLE_ADMIN")
    */
    public function editarFormulario($idFormulario,Request $request): Response {    
     //Obtengo el Entity Manager
     $em = $this ->getDoctrine()->getManager();
     //Obtengo el formulario
     $formulario=$em->getRepository(Formulario::class)->find($idFormulario);
     //Defino el Formulario
     $form = $this->createForm(FormularioType::class, $formulario);
     //Si se envia el formulario , existe un request
     $form->handleRequest($request);

        //Si se disparo el formulario y es valido
        if ($form->isSubmitted() && $form->isValid()) {
         //Obtengo el formulario del formulario
         $formulario = $form->getData();
         //Obtengo el EntityManager
         $entityManager = $this->getDoctrine()->getManager();
         //Le doy persistencia al nuevo formulario
         $entityManager->persist($formulario);
         //Asiento los cambios en la base de datos
         $entityManager->flush();

         //Redirecciono al listado de personas
         return $this->redirectToRoute('abm_formularios');
        }
        
        //Retorno la vista
        return $this->render('Formulario/editarFormulario.html.twig', [
         'form' => $form->createView(),
         'formulario' => $formulario,
        ]);

        
        
    }



   
}