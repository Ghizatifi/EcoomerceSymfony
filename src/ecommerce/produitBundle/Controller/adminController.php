<?php

namespace ecommerce\produitBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use ecommerce\produitBundle\Entity\produit;
use ecommerce\produitBundle\Entity\Admin;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\HttpFoundation\Session\Session;
use Doctrine\ORM\Query;


class adminController extends Controller
{
    
    
    
    /**
    * @Route("/login", name="users_login")
    */
    public function loginAction(Request $request)
    {   $session = new Session();
     
     
    $admin= new Admin();
    $adminBD= new Admin();
    $form = $this->createFormBuilder($admin)
    ->add('login', TextType::class, array('label' => ' ' ,'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px', 'placeholder' => 'Login')))
    ->add('password', passwordType::class, array('label' => ' ' ,'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px', 'placeholder' => 'Password')))
    ->add('Enregistrer', SubmitType::class, array('label' => 'Se connecter' , 'attr' => array('class' => 'btn btn-primary', 'style' => 'margin-bottom:15px')))
    ->getForm();
    
    $form->handleRequest($request);
    if($form->isSubmitted() && $form->isValid()){
        $login    = $form['login']->getData();
        $password = $form['password']->getData();
    
        $admin->setLogin($login);
        $admin->setPassword($password);
    
        $repository = $this->getDoctrine()->getRepository('produitBundle:Admin');
    
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
             
            //$admins = $query->getResult();
            // to get just one result:
            $adminBD = $query->setMaxResults(1)->getOneOrNullResult();
             
            if($adminBD->getLogin() == $admin->getLogin() && $adminBD->getPassword() == $admin->getPassword()){
    
                //$session->start();
                $session->set('login', $adminBD->getLogin());
    
                return $this->redirect('http://localhost/Projet1/web/app_dev.php/produits');
                 
            }
             
        }
    }
    
    return $this->render('produitBundle:login:login.html.twig', array('form' =>$form->createView()));
    }
    
    
    
    /**
     * @Route("/logout", name="users_logout")
     */
    public function logoutAction(Request $request)
    {
        $session = new Session();
         
        if(strlen($session->get('login')) == 0 ){
            return $this->redirectToRoute('users_login');
        }
        $session = new Session();
        $session->clear();
        return $this->redirectToRoute('users_login');
         
    }

    
}
