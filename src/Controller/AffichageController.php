<?php

namespace App\Controller;
use App\Entity\Produit ;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AffichageController extends AbstractController
{
    /**
     * @Route("/affichage", name="affichage")
     */
    public function index(): Response
    {
        $prod= $this->getDoctrine()->getRepository(Produit::class)->findAll();
        return  $this->render('affichage/index.html.twig',['prod' => $prod]);
        
    }
}
