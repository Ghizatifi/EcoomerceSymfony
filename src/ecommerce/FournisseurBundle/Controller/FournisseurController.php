<?php

namespace ecommerce\FournisseurBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ecommerce\FournisseurBundle\Entity\fournisseur;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Session\Session;

class FournisseurController extends Controller
{
    /**
     * @Route("/fournisseurs",name="fournisseur_list")
     */
   public function indexAction()
    {
        $session = new Session();
         
        if(strlen($session->get('login')) > 0 ){
        $fournisseur = $this->getDoctrine()->getRepository('ecommerceFournisseurBundle:fournisseur')->findAll();
        return $this->render('ecommerceFournisseurBundle:fournisseur:index.html.twig', array('ListeFournisseurs' => $fournisseur ));
   }
   else{
            return $this->redirect('http://localhost/Projet1/web/app_dev.php/login');
        }
}



     /**
     * @Route("/detailF/{id}",name="detailF")
     */
  public function detailAction($id)
    {
        $session = new Session();
         
        if(strlen($session->get('login')) > 0 ){
        $fournisseur = $this->getDoctrine()
        ->getRepository('ecommerceFournisseurBundle:fournisseur')
        ->find($id);
        return $this->render('ecommerceFournisseurBundle:fournisseur:detail.html.twig', array(
        'ListeFournisseurs' =>  $fournisseur));

}
else{
            return $this->redirect('http://localhost/Projet1/web/app_dev.php/login');
        }
      
    }

    /**
     * @Route("/fournisseurAjt",name="fournisseur_ajout")
     */
    public function ajoutAction(Request $request)

    {
        $session = new Session();
         
        if(strlen($session->get('login')) > 0 ){
       
        $fournisseur = new fournisseur();
        $form = $this->createFormBuilder($fournisseur)
        ->add('nomF', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
        ->add('telF', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
        ->add('emailF', TextareaType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
        ->add('Enregistrer', SubmitType::class, array('label' => 'Ajouter Fournisseur' , 'attr' => array('class' => 'btn btn-primary', 'style' => 'margin-bottom:15px')))
        ->getForm();
         
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $nomF =$form['nomF']->getData();
            $telF =$form['telF']->getData();
            $emailF =$form['emailF']->getData();

    
            $fournisseur->setNomF($nomF);
            $fournisseur->setTelF( $telF);
            $fournisseur->setEmailF($emailF);
            
        
            $em = $this->getDoctrine()->getManager();
            $em->persist($fournisseur);
            $em->flush();
            $this->addFlash('notice', "Ajout reussit");
        
            return $this->redirectToRoute('fournisseur_list');
        
        }
        // replace this example code with whatever you need
        return $this->render('ecommerceFournisseurBundle:fournisseur:ajout.html.twig', array('form' =>$form->createView()));
    }
    else{
            return $this->redirect('http://localhost/Projet1/web/app_dev.php/login');
        }
}

    /**
     * @Route("/fournisseurSup/{id}",name="fournisseur_supp")
     */
    public function suppAction($id)
    {
        $session = new Session();
         
        if(strlen($session->get('login')) > 0 ){
        $em=$this->getDoctrine()->getManager();
        $fournisseur=$em->getRepository('ecommerceFournisseurBundle:fournisseur')->find($id);
        $em->remove($fournisseur);
        $em->flush();
        return $this->redirectToRoute('fournisseur_list');
}
else{
            return $this->redirect('http://localhost/Projet1/web/app_dev.php/login');
        }
    }


/**
     * @Route("/modifierF/{id}",name="fournisseur_modif")
     */

 public function modifAction($id, request $request)
    {
        $session = new Session();
         
        if(strlen($session->get('login')) > 0 ){
        $fournisseur = $this->getDoctrine()
        ->getRepository('ecommerceFournisseurBundle:fournisseur')
        ->find($id);

            $fournisseur->setNomF($fournisseur->getNomF());
            $fournisseur->setTelF($fournisseur->getTelF());
            $fournisseur->setEmailF($fournisseur->getEmailF());
           


        $form = $this->createFormBuilder($fournisseur)
        ->add('nomF', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
        ->add('telF', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
        ->add('emailF', TextareaType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
        ->add('Enregistrer', SubmitType::class, array('label' => 'Modifier Fournisseur' , 'attr' => array('class' => 'btn btn-primary', 'style' => 'margin-bottom:15px')))
        ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted() &&  $form->isValid()){

            //get Data
           $nomF =$form['nomF']->getData();
            $telF =$form['telF']->getData();
            $emailF =$form['emailF']->getData();
           

            $em = $this->getDoctrine()->getManager();
            $fournisseur = $em->getRepository('ecommerceFournisseurBundle:fournisseur')->find($id);

            //$now = new\DateTime('now');
           
            $fournisseur->setNomF($nomF);
            $fournisseur->setTelF( $telF);
            $fournisseur->setEmailF($emailF);
            
        
            $em->flush();

            $this->addFlash(
                'notice',
                'fournisseur modifié'
                );
            return $this->redirectToRoute('fournisseur_list');
        }
        return $this->render('ecommerceFournisseurBundle:fournisseur:modifier.html.twig', array(
        'fournisseur' => $fournisseur,
        'form' => $form->createView()

        ));
}
    else{
            return $this->redirect('http://localhost/Projet1/web/app_dev.php/login');
        }
    }
}
