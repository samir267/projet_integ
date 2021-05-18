<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InscriController extends AbstractController
{
    /**
     * @Route("/inscri", name="inscri")
     */
    public function index(): Response
    {
        return $this->render('inscri/index.html.twig', [
            'controller_name' => 'InscriController',
        ]);
    }
}
