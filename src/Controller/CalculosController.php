<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CalculosController extends AbstractController
{
    /**
     * @Route("/app/calculos", name="calculos")
     */
    public function index(): Response {

        return $this->render('Calculos/index.html.twig', [
            'controller_name' => 'CalculosController',
        ]);
    }
}
