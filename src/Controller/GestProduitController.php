<?php

namespace App\Controller;
use App\Entity\Produit ;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class GestProduitController extends AbstractController
{
    /**
     * @Route("/admin/gest/produit", name="gest_produit")
     */
    public function index(): Response
    {
        $prod= $this->getDoctrine()->getRepository(Produit::class)->findAll();
        return  $this->render('gest_produit/index.html.twig',['prod' => $prod]);
    }


/**
     * @Route("/gest/produit/new", name="new_jouet")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function ajouter_jouet(Request $request){
        $jouet = new Produit();
        $form = $this->createFormBuilder($jouet)
        ->add('nom', TextType::class,array('attr' => array('class' => 'form-control')))
        ->add('categorie', TextType::class,array('attr' => array('class' => 'form-control')))
        ->add('image', TextType::class,array('attr' => array('class' => 'form-control')))
        ->add('prix', TextType::class,array('attr' => array('class' => 'form-control')))
        ->add('qtite', TextType::class,array('attr' => array('class' => 'form-control')))

       
      ->add('save', SubmitType::class, array(
        'label' => 'Ajouter' ,'attr' => array('class' => 'btn btn-outline-primary')       
      ))->getForm();
        $form->handleRequest($request);
  
        if($form->isSubmitted() && $form->isValid()) {
            $jouet = $form->getData();
  
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($jouet);
            $entityManager->flush();
  
            return $this->redirectToRoute('gest_produit');
        }
        return $this->render('gest_produit/new.html.twig',['form' => $form->createView()]);
    }
  
  
  
  /**
       * @Route("/gest/produit/edit/{id}", name="edit_jouet")
       * Method({"GET", "POST"})
       */
      public function edit(Request $request, $id) {
        $jouet = new Produit();
        $jouet = $this->getDoctrine()->getRepository(Produit::class)->find($id);
  
        $form = $this->createFormBuilder($jouet)
        ->add('nom', TextType::class,array('attr' => array('class' => 'form-control')))
        ->add('categorie', TextType::class,array('attr' => array('class' => 'form-control')))
        ->add('image', TextType::class,array('attr' => array('class' => 'form-control')))
        ->add('prix', TextType::class,array('attr' => array('class' => 'form-control')))
        ->add('qtite', TextType::class,array('attr' => array('class' => 'form-control')))

        ->add('save', SubmitType::class, array(
          'label' => 'Modifier' ,'attr' => array('class' => 'btn btn-outline-primary')       
        ))->getForm();
  
        $form->handleRequest($request);
  
        if($form->isSubmitted() && $form->isValid()) {
  
          $entityManager = $this->getDoctrine()->getManager();
          $entityManager->flush();
  
          return $this->redirectToRoute('Gest');
        }
  
        return $this->render('gest_produit/edit.html.twig', array(
          'form' => $form->createView()
        ));
      }
  
  

 /**
       * @Route("/gest/produit/delete/{id}",name="delete_jouet")
       * @Method({"DELETE"})
       */
      public function delete(Request $request, $id) {
        $jouet = $this->getDoctrine()->getRepository(Produit::class)->find($id);
  
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($jouet);
        $entityManager->flush();
  
        $response = new Response();
        $response->send();

        return $this->redirectToRoute('Gest');
      }


}
