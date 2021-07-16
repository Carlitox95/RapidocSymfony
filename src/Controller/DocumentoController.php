<?php
namespace App\Controller;


use Symfony\Component\Security\Core\Exception\AccessDeniedException; 
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\Constraints\DateTimeValidator;

use Dompdf\Dompdf;
use Dompdf\Options;

use App\Entity\Formulario;
use App\Entity\Persona;
use App\Entity\Empleador;
use App\Entity\Documento;
use App\Entity\F575B;
use App\Form\F575BType;



class DocumentoController extends AbstractController {

    /**
     * Require ROLE_ADMIN for only this controller method.
     *
     * @Route("/app/documentos/", name="documento")
     *
    */
    public function index(): Response {    
     //Obtengo el Entity Manager
     $entityManager = $this ->getDoctrine()->getManager(); 
     //Obtengo todos los formularios
     $formularios=$entityManager->getRepository(Formulario::class)->findAll();
     //Obtengo todas las personas
     $personas=$entityManager->getRepository(Persona::class)->findAll();

        //Retorno la vista
        return $this->render('Documento/index.html.twig', 
            [             
             'formularios' => $formularios,
             'personas' => $personas,
            ]
        );
    }

    /**
     * @Route("/app/documentos/generar", name="seleccionarPersona", methods={"GET","HEAD","POST"})
     */
    public function SeleccionarPersona(Request $request): Response { 
     //Obtengo el Entity Manager
     $entityManager = $this ->getDoctrine()->getManager(); 
     //Obtengo los datos que me llegan del formulario
     $idFormulario= $request->request->get('documentoId');
       
        //Si falta el parametro vuelvo a la vista
        if ($idFormulario==NULL) {
         //Redirecciono a la vista principal
         return $this->redirectToRoute('documento');
        }
        else {
         //Obtengo el formulario
         $formulario=$entityManager->getRepository(Formulario::class)->find($idFormulario);         
         //Obtengo todas las personas disponibles
         $personas=$entityManager->getRepository(Persona::class)->findAll();

           //Retorno la vista
            return $this->render('Documento/seleccionarPersona.html.twig', 
                [                      
                 'formulario' => $formulario,
                 'personas' => $personas,
                ]
            );
        }
        
    }


    /**
     * @Route("/app/documentos/seleccionPersona", name="verificarPersona", methods={"GET","HEAD","POST"})
     */
    public function verificarPersona(Request $request): Response { 
     //Obtengo el Entity Manager
     $entityManager = $this ->getDoctrine()->getManager(); 
     //Obtengo los datos que me llegan del formulario
     $idFormulario= $request->request->get('formularioId');
     //Obtengo el id de la persona seleccionada
     $idPersona= $request->request->get('personaId');


        //Si falta el parametro vuelvo a la vista
        if ($idPersona==NULL) {
         //Redirecciono a la vista principal
         return $this->redirectToRoute('documento');
        }
        else {
         //Obtengo la persona
         $persona=$entityManager->getRepository(Persona::class)->find($idPersona);
         
            //Si la persona existe redirecciono 
            if($persona) {
             //Redirecciono pasando el request directamente
             return $this->redirectToRoute('verificarDocumento',['request' => $request],307);
            }
            else {    
             //Redirecciono a la vista principal
             return $this->redirectToRoute('documento');    
            }
        }
        
    }
    
    /**
     * @Route("/app/documentos/verificarDocumento", name="verificarDocumento", methods={"GET","HEAD","POST"})
     */
    public function verificarDocumento(Request $request): Response { 
     //Obtengo el Entity Manager
     $entityManager = $this ->getDoctrine()->getManager(); 
     //Obtengo el id de la persona seleccionada
     $idPersona=$request->request->get('personaId');
     //Obtengo los datos que me llegan del formulario
     $idFormulario= $request->request->get('formularioId');
     //Obtengo el usuario logueado
     $usuario=$this->get('security.token_storage')->getToken()->getUser();

     //Obtengo la persona
     $persona=$entityManager->getRepository(Persona::class)->find($idPersona);
     //Obtengo el formulario
     $formulario=$entityManager->getRepository(Formulario::class)->find($idFormulario);
     
        //Dependiendo del tipo de documento, importo el formulario que corresponda
        if ($formulario->getNombre() =="Formulario F575B") {         
        
         //Creo la nueva entidad del formulario 
         $f575b= new F575B();  
                 
         //Le doy datos al formulario
         $f575b->setNombre($persona->getNombre()); 
         $f575b->setApellido($persona->getApellido());   
         $f575b->setCuitcuil($persona->getCuitCuil());

            if ($persona->getEmpleador()) {
             $f575b->setCuitcuilEmpleador($persona->getEmpleador()->getCuitCuil());
            }
               
         //Defino el form del documento
         $form= $this->createForm(F575BType::class, $f575b); 
    
            //Retorno la vista
            return $this->render('Documento/verificarDocumento.html.twig', 
                [                  
                 'persona' => $persona,
                 'form' => $form->createView(),
                 'formulario' => $formulario,
                 'documento' => null,
                ]
            );
        }





    }

    /**
     * @Route("/app/documentos/verificarDocumentoUpdate", name="verificarDocumentoUpdate", methods={"GET","HEAD","POST"})
     */
    public function verificarDocumentoUpdate(Request $request): Response { 
     //Obtengo el Entity Manager
     $entityManager = $this ->getDoctrine()->getManager(); 
     //Obtengo el usuario logueado
     $usuario=$this->get('security.token_storage')->getToken()->getUser();
     //Obtengo el id de la persona y la persona
     $idPersona=$request->request->get('idPersona');  
     $persona=$entityManager->getRepository(Persona::class)->find($idPersona);
     //Obtengo el id del formulario y el formulario
     $idFormulario=$request->request->get('idFormulario');  
     $formulario=$entityManager->getRepository(Formulario::class)->find($idFormulario);


       //Dependiendo del tipo de documento, importo el formulario que corresponda
        if ($formulario->getNombre() =="Formulario F575B") { 
         //Creo la nueva entidad del formulario 
         $f575b= new F575B(); 
         $form= $this->createForm(F575BType::class, $f575b); 
         $form->handleRequest($request);

            //SI el formulario se envio y es valido
            if ($form->isSubmitted() && $form->isValid()) {

             //Capturo los datos del formulario
             $formDatos = $form->getData();
             
             //Creo el documento
             $documento= new Documento();
             //Le doy atributos al documento, cargando el formulario trabajado y el formulario de creacion
             $documento->setNombre($persona->getCuitcuil()."_F575B_".$formDatos->getAnio()."_".$formDatos->getMes());
             $documento->setCategoria($formulario->getNombre());
             $documento->setDescripcion($formulario->getNombre());
             $documento->setArchivo($formDatos); 
             $documento->setFormulario($formulario);
             $documento->setFechaCreacion(new \DateTime()); 

                  

                //Recopilo los datos necesarios para crear el PDF
                $boleta = array(
                 "cuitPersona"=>$persona->getCuitcuil(),
                 "cuitEmpleador"=>$formDatos->getCuitcuilEmpleador(),
                 "mes"=>$formDatos->getMes(),
                 "anio"=>$formDatos->getAnio(),
                 "nombreArchivo"=> $documento->getNombre(),
                 "imagenFondo"=>$formulario->getImagen(),
                 "diferenciaContribuciones" =>$formDatos->getDiferenciaContribuciones(),
                 "interesesResarcitorios" =>$formDatos->getInteresesResarcitorios()
                );
             


             //Invocamos a la funcion para generar el archivo
             $archivo=$this->generarPDF($boleta,$formulario->getPlantilla());
             //Cargo la direccion del archivo en el documento
             $documento->setUbicacion($archivo);
             
             //Cargo el documento en la persona
             $persona->addDocumento($documento);

             //Le doy persistencia al objeto
             $entityManager->persist($persona);
             //Asiento los cambios en la base de datos
             $entityManager->flush();

             //Genero el nuevo formulario para volver a crear otro archivo
             $f575bNuevo=new F575B(); 
             //Le doy datos al formulario
             $f575bNuevo->setNombre($persona->getNombre()); 
             $f575bNuevo->setApellido($persona->getApellido());   
             $f575bNuevo->setCuitcuil($persona->getCuitCuil());

                if ($persona->getEmpleador()) {
                 $f575bNuevo->setCuitcuilEmpleador($persona->getEmpleador()->getCuitCuil());
                }
                
             $formNuevo= $this->createForm(F575BType::class,$f575bNuevo); 

              
              //Retorno la vista
                return $this->render('Documento/verificarDocumento.html.twig', 
                    [ 
                     'usuario' => $usuario,            
                     'formulario' => $formulario,
                     'form' => $formNuevo->createView(),
                     'persona' => $persona,             
                     'documento' => $documento,
                    ]
                );
            }

        }



     
    
        //Retorno la vista con un null en caso de que no haya un documento valido
        return $this->render('Documento/visualizarDocumento.html.twig', 
            [ 
             'usuario' => $usuario,            
             'formulario' => $formulario,
             'persona' => $persona,             
             'documento' => null,
            ]
        );
           
    }


    //Funcion para generar PDF
    private function generarPDF($boleta,$plantillaHTML) {
      
     // Configure Dompdf according to your needs
     $pdfOptions = new Options();
     $pdfOptions->set('defaultFont', 'Arial');
     $pdfOptions->setIsHtml5ParserEnabled(true);
     $pdfOptions->SetIsRemoteEnabled(true);
        
     // Instantiate Dompdf with our options
     $dompdf = new Dompdf($pdfOptions);
       
     // Retrieve the HTML generated in our twig file
     $html = $this->renderView('bundles/Plantillas/'.$plantillaHTML, ['boleta' => $boleta]);
       
     // Load HTML to Dompdf
     $dompdf->loadHtml($html);
       
     // (Optional) Setup the paper size and orientation 'portrait' or 'landscape'
     $dompdf->setPaper('A3', 'portrait');

     // Render the HTML as PDF
     $dompdf->render();

     // Store PDF Binary Data
     $output = $dompdf->output(); 
      
     // In this case, we want to write the file in the public directory
     //$publicDirectory = $this->getParameter('kernel.project_dir') . '/public/archivos';
     $publicDirectory = $this->getParameter('kernel.project_dir') . '/public/archivos';

     // e.g /var/www/project/public/mypdf.pdf
     $pdfFilepath =  $publicDirectory.'/'.$boleta['nombreArchivo'].'.pdf';
        
     // Write file to the desired path
     file_put_contents($pdfFilepath, $output);

     //retorno la ruta del archivo
     return  $pdfFilepath;
    }







    /**
     * @Route("/app/documentos/generarF575B", name="generarF575B", methods={"GET","HEAD","POST"})
     */
    public function generarF575B(Request $request) {
     //Obtengo el Entity Manager
     $entityManager = $this ->getDoctrine()->getManager(); 
     //Obtengo todas las personas disponibles
     $persona=$entityManager->getRepository(Persona::class)->find($idPersona);
     //Obtengo el formulario
     $formulario=$entityManager->getRepository(Formulario::class)->find($idFormulario);
     //Obtengo el usuario logueado
     $usuario=$this->get('security.token_storage')->getToken()->getUser(); 

     var_dump($request);
     die;
       
      
     //Defino la boleta


        //Retorno la vista
        return $this->render('bundles/Plantillas/F575B.html.twig', 
            [ 
             'usuario' => $usuario,            
             'formulario' => $formulario,
             'boleta' =>$boleta,
             'persona' => $persona,
            ]
        );



    }










   
}