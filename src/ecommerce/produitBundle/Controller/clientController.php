<?php

namespace ecommerce\produitBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ecommerce\produitBundle\Entity\client;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class clientController extends Controller
{

 
    /**
    * @Route("/loginC", name="user_login")
    */
    public function loginAction(Request $request)
    {   $session = new Session();
     
     
    $client= new client();
    $clientBD= new client();
    $form = $this->createFormBuilder($client)
    ->add('login', TextType::class, array('label' => ' ' ,'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px', 'placeholder' => 'Login')))
    ->add('password', passwordType::class, array('label' => ' ' ,'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px', 'placeholder' => 'Password')))
    ->add('Enregistrer', SubmitType::class, array('label' => 'Se connecter' , 'attr' => array('class' => 'btn btn-primary', 'style' => 'margin-bottom:15px')))
    ->getForm();
    
    $form->handleRequest($request);
    if($form->isSubmitted() && $form->isValid()){
        $login    = $form['login']->getData();
        $password = $form['password']->getData();
    
        $client->setLogin($login);
        $client->setPassword($password);
    
        $repository = $this->getDoctrine()->getRepository('produitBundle:client');
    
        $cmp = $repository->createQueryBuilder('a')
        ->select('COUNT(a)')
        ->where('a.login = :login and a.password = :password')
        ->setParameter('login', $login)
        ->setParameter('password', $password)
        ->getQuery()
        ->getSingleScalarResult();
        if ($cmp > 0){
            $query = $repository->createQueryBuilder('a')
            ->where('a.login = :login and a.password = :password')
            ->setParameter('login', $login)
            ->setParameter('password', $password)
            ->orderBy('a.login', 'ASC')
            ->getQuery();
             
            //$clients = $query->getResult();
            // to get just one result:
            $clientBD = $query->setMaxResults(1)->getOneOrNullResult();
             
            if($clientBD->getLogin() == $client->getLogin() && $clientBD->getPassword() == $client->getPassword()){
    
                //$session->start();
                $session->set('login', $clientBD->getLogin());
    
                return $this->redirect('http://localhost/Projet1/web/Template1/index.html');
                 
            }
             
        }
    }
    
    return $this->render('produitBundle:login:login.html.twig', array('form' =>$form->createView()));
    }
    
    



    /**
     * @Route("/clients",name="client_list")
     */
   public function indexAction()
    {
        $session = new Session();
         
        if(strlen($session->get('login')) > 0 ){
        $client = $this->getDoctrine()->getRepository('produitBundle:client')->findAll();
        return $this->render('produitBundle:client:index.html.twig', array('Listeclients' => $client ));
    }
     else{
            return $this->redirect('http://localhost/Projet1/web/app_dev.php/login');
        }
    }



     /**
     * @Route("/detailC/{id}",name="detailC")
     */
  public function detailAction($id)
    {
        $session = new Session();
         
        if(strlen($session->get('login')) > 0 ){
        $client = $this->getDoctrine()
        ->getRepository('produitBundle:client')
        ->find($id);
        return $this->render('produitBundle:client:detail.html.twig', array(
        'Listeclients' =>  $client));
}

 else{
            return $this->redirect('http://localhost/Projet1/web/app_dev.php/login');
        }
      
    }

    /**
     * @Route("/clientAjt",name="client_ajout")
     */
    public function ajoutAction(Request $request)

    {
        $session = new Session();
         
        if(strlen($session->get('login')) > 0 ){
       
        $client = new client();
        $form = $this->createFormBuilder($client)
        ->add('login', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
        ->add('password', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
        ->add('Enregistrer', SubmitType::class, array('label' => 'Ajouter client' , 'attr' => array('class' => 'btn btn-primary', 'style' => 'margin-bottom:15px')))
        ->getForm();
         
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $login =$form['login']->getData();
            $password =$form['password']->getData();
            

    
            $client->setLogin($login);
            $client->setPassword( $password);
            
            
        
            $em = $this->getDoctrine()->getManager();
            $em->persist($client);
            $em->flush();
            $this->addFlash('notice', "Ajout reussit");
        
            return $this->redirectToRoute('client_list');
        
        }
        // replace this example code with whatever you need
       
        return $this->render('produitBundle:client:ajout.html.twig', array('form' =>$form->createView()));
    }
     else{
            return $this->redirect('http://localhost/Projet1/web/app_dev.php/login');
        }
    }


    /**
     * @Route("/clientSup/{id}",name="client_supp")
     */
    public function suppAction($id)
    {
      $session = new Session();
         
        if(strlen($session->get('login')) > 0 ){
        $em=$this->getDoctrine()->getManager();
        $client=$em->getRepository('produitBundle:client')->find($id);
        $em->remove($client);
        $em->flush();
        return $this->redirectToRoute('client_list');
}
 else{
            return $this->redirect('http://localhost/Projet1/web/app_dev.php/login');
        }
    }


/**
     * @Route("/modifierC/{id}",name="client_modif")
     */

 public function modifAction($id, request $request)
    {
        $session = new Session();
         
        if(strlen($session->get('login')) > 0 ){
        $client = $this->getDoctrine()
        ->getRepository('produitBundle:client')
        ->find($id);

        $form = $this->createFormBuilder($client)
        ->add('login', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
        ->add('password', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
        ->add('Enregistrer', SubmitType::class, array('label' => 'Modifier client' , 'attr' => array('class' => 'btn btn-primary', 'style' => 'margin-bottom:15px')))
        ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted() &&  $form->isValid()){

            //get Data
           $login =$form['login']->getData();
            $password =$form['password']->getData();
            
           

            $em = $this->getDoctrine()->getManager();
            $client = $em->getRepository('produitBundle:client')->find($id);

            //$now = new\DateTime('now');
           
            $client->setLogin($login);
            $client->setPassword( $password);
            
            
        
            $em->flush();

            $this->addFlash(
                'notice',
                'client modifié'
                );
            return $this->redirectToRoute('client_list');
        }
        return $this->render('produitBundle:client:modifier.html.twig', array(
        'client' => $client,
        'form' => $form->createView()

        ));
}
 else{
            return $this->redirect('http://localhost/Projet1/web/app_dev.php/login');
        }
       
    }
}
