<?php

namespace App\Controller;
use App\Entity\User ;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use App\Form\RegistrationType;
class RegistrationController extends AbstractController
{
   
/*
public function registration(){
    $user=new User();
    $form=$this->createForm(RegistrationType::class,$user);
    return $this->render('registration/index.html.twig',['form'=>$form-createView()]);
}
    */

   /**
     * @Route("/registration/new", name="new_user")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function new(Request $request){
        $prod = new User();
        $form = $this->createFormBuilder($prod)
        ->add('email', TextType::class,array('attr' => array('class' => 'form-control  ','style'=>'width:250px; float:center')))
        ->add('password', IntegerType::class,array('attr' => array('class' => 'form-control ','style'=>'width:250px;')))
            
      ->add('save', SubmitType::class, array(
        'label' => 'Ajouter' ,'attr' => array('class' => 'btn btn-outline-primary ')       
      ))->getForm();
        $form->handleRequest($request);
  
        if($form->isSubmitted() && $form->isValid()) {
            $jouet = $form->getData();
  
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($prod);
            $entityManager->flush();
  
            return $this->redirectToRoute('new_user');
        }
        return $this->render('registration/index.html.twig',['form' => $form->createView()]);
    }
  
    
}
