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
   
}