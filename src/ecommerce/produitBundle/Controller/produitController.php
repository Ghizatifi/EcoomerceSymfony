<?php

namespace ecommerce\produitBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ecommerce\produitBundle\Entity\produit;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\Session\Session;
class produitController extends Controller
{
    /**
     * @Route("/produits",name="product_list")
     */
   public function indexAction()
    {
       $session = new Session();
         
        if(strlen($session->get('login')) > 0 ){

        $produit = $this->getDoctrine()->getRepository('produitBundle:produit')->findAll();
        return $this->render('produitBundle:produit:index.html.twig', array('ListeProduits' => $produit ));
      }
      else{
            return $this->redirect('http://localhost/Projet1/web/app_dev.php/login');
        }
    }



     /**
     * @Route("/detail/{id}",name="details")
     */
  public function detailAction($id)
    {
      $session = new Session();
         
        if(strlen($session->get('login')) > 0 ){

        $Produit = $this->getDoctrine()
        ->getRepository('produitBundle:produit')
        ->find($id);
        return $this->render('produitBundle:produit:detail.html.twig', array(
        'ListeProduits' => $Produit));
}
else{
            return $this->redirect('http://localhost/Projet1/web/app_dev.php/login');
        }

      
    }

/**
     * @Route("/produitsAjt",name="product_ajout")
     */
    public function ajoutAction(Request $request)

    {
      $session = new Session();
         
        if(strlen($session->get('login')) > 0 ){
       
        $produit = new produit();
        $form = $this->createFormBuilder($produit)
        ->add('designationP', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
        ->add('prixP', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
        ->add('marque', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
         ->add('size', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
          ->add('couleur', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
          ->add('quantite', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
          ->add('seuil', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
          ->add('categorieHF', ChoiceType::class, array('choices' =>array('Homme' => 'Homme', 'Femme' => 'Femme'), 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
          ->add('categorieMT', ChoiceType::class, array('choices' =>array('Moderne' => 'Moderne', 'Traditionnel' => 'Traditionnel'), 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
          ->add('categorie', ChoiceType::class, array('choices' =>array('Habits' => 'Habits', 'Chaussures' => 'Chaussures', 'Accessoires' =>'Accessoires' ), 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
         ->add('image', FileType::class, array('label' => 'Image (JPEG/PNG or GIF pic)'))
        ->add('Enregistrer', SubmitType::class, array('label' => 'Ajouter Produit' , 'attr' => array('class' => 'btn btn-primary', 'style' => 'margin-bottom:15px')))
        ->getForm();
         
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $designation =$form['designationP']->getData();
            $prix =$form['prixP']->getData();
            $marque =$form['marque']->getData();
            $size =$form['size']->getData();
            $couleur =$form['couleur']->getData();
             $quantite =$form['quantite']->getData();
              $seuil =$form['seuil']->getData();
              $categorieHF =$form['categorieHF']->getData();
               $categorieMT =$form['categorieMT']->getData();
                $categorie =$form['categorie']->getData();

            
            $file = $produit->getImage();
            
            // Generate a unique name for the file before saving it
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            
            // Move the file to the directory where brochures are stored
            $file->move(
                    $this->getParameter('images_directory'),
                    $fileName
                    );
            
            // Update the 'brochure' property to store the PDF file name
            // instead of its contents
            $produit->setImage($fileName);

        
           
        
            $produit->setDesignationP($designation);
            $produit->setPrixP($prix);
            $produit->setMarque($marque);
            $produit->setSize($size);
            $produit->setCouleur($couleur);
            $produit->setQuantite($quantite);
            $produit->setSeuil($seuil);
            $produit->setCategorieHF($categorieHF);
            $produit->setCategorieMT($categorieMT);
            $produit->setCategorie($categorie);
            
        
            $em = $this->getDoctrine()->getManager();
            $em->persist($produit);
            $em->flush();
            $this->addFlash('notice', "Ajout reussit");
        
            return $this->redirectToRoute('product_list');
        
        }
        // replace this example code with whatever you need
        return $this->render('produitBundle:produit:ajout.html.twig', array('form' =>$form->createView()));
    }
    else{
            return $this->redirect('http://localhost/Projet1/web/app_dev.php/login');
        }
  }


/**
     * @Route("/produitsSup/{id}",name="product_supp")
     */
    public function suppAction($id)
    {
      $session = new Session();
         
        if(strlen($session->get('login')) > 0 ){
       
        $em=$this->getDoctrine()->getManager();
        $produit=$em->getRepository('produitBundle:produit')->find($id);
        $em->remove($produit);
        $em->flush();
        return $this->redirectToRoute('product_list');
}
else{
            return $this->redirect('http://localhost/Projet1/web/app_dev.php/login');
        }
    }


/**
     * @Route("/Modif/{id}",name="product_modif")
     */

 public function modifAction($id, request $request)
    {

      $session = new Session();
         
        if(strlen($session->get('login')) > 0 ){
       
        $Produit = $this->getDoctrine()
        ->getRepository('produitBundle:produit')
        ->find($id);

        
    
            $Produit->setImage(new File($this->getParameter('images_directory').'/'. $Produit->getImage()));


        $form = $this->createFormBuilder($Produit)
         ->add('designationP', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
        ->add('prixP', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
        ->add('marque', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
         ->add('size', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
          ->add('couleur', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
          ->add('quantite', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
          ->add('seuil', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
          ->add('categorieHF', ChoiceType::class, array('choices' =>array('Homme' => 'Homme', 'Femme' => 'Femme'), 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
          ->add('categorieMT', ChoiceType::class, array('choices' =>array('Moderne' => 'Moderne', 'Traditionnel' => 'Traditionnel'), 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
          ->add('categorie', ChoiceType::class, array('choices' =>array('Habits' => 'Habits', 'Chaussures' => 'Chaussures', 'Accessoires' =>'Accessoires' ), 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
         ->add('image', FileType::class, array('label' => 'Image (JPEG/PNG or GIF pic)'))
        ->add('Enregistrer', SubmitType::class, array('label' => 'Modifier Produit' , 'attr' => array('class' => 'btn btn-primary', 'style' => 'margin-bottom:15px')))
        ->getForm();
        
        $form->handleRequest($request);
        if($form->isSubmitted() &&  $form->isValid()){

            //get Data
            $designation =$form['designationP']->getData();
            $prix =$form['prixP']->getData();
            $marque =$form['marque']->getData();
            $size =$form['size']->getData();
            $couleur =$form['couleur']->getData();
             $quantite =$form['quantite']->getData();
             $seuil =$form['seuil']->getData();
              $categorieHF =$form['categorieHF']->getData();
               $categorieMT =$form['categorieMT']->getData();
                $categorie =$form['categorie']->getData();

            $em = $this->getDoctrine()->getManager();
            $Produit = $em->getRepository('produitBundle:produit')->find($id);

            //$now = new\DateTime('now');
            $Produit->setDesignationP($designation);
            $Produit->setPrixP($prix);
            $Produit->setMarque($marque);
            $Produit->setSize($size);
            $Produit->setCouleur($couleur);
            $Produit->setQuantite($quantite);
            $Produit->setSeuil($seuil);
            $Produit->setCategorieHF($categorieHF);
            $Produit->setCategorieMT($categorieMT);
            $Produit->setCategorie($categorie);
            
           
           
                    //==========================================
                    
                    //=======================================
                    // $file stores the uploaded PDF file
                    /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
                    $file =  $Produit->getImage();
                    
                    // Generate a unique name for the file before saving it
                    $fileName = md5(uniqid()).'.'.$file->guessExtension();
                    
                    // Move the file to the directory where brochures are stored
                    $file->move(
                            $this->getParameter('images_directory'),
                            $fileName
                            );
                    
                    // Update the 'brochure' property to store the PDF file name
                    // instead of its contents
                    // il faut une instav=ce de file
                   $Produit->setImage($fileName);
            //$Produit->setCreateDate($now);

            
        
            $em->flush();

            $this->addFlash(
                'notice',
                'Produit modifié'
                );
            return $this->redirectToRoute('product_list');
        }
        return $this->render('produitBundle:produit:modifier.html.twig', array(
        'produit' => $Produit,
        'form' => $form->createView()

        ));
  }
  else{
            return $this->redirect('http://localhost/Projet1/web/app_dev.php/login');
        }
}


/**
     * @Route("/reapprov/{id}",name="product_reapprov")
     */

 public function reapprovisionnement($id, request $request)
    {

      $session = new Session();
         
        if(strlen($session->get('login')) > 0 ){
       
        $Produit = $this->getDoctrine()
        ->getRepository('produitBundle:produit')
        ->find($id);

        
    
            


        $form = $this->createFormBuilder($Produit)
         ->add('designationP', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
         ->add('quantite', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
         ->add('Enregistrer', SubmitType::class, array('label' => 'Valider' , 'attr' => array('class' => 'btn btn-primary', 'style' => 'margin-bottom:15px')))
        ->getForm();
        
        $form->handleRequest($request);
        if($form->isSubmitted() &&  $form->isValid()){

            //get Data
            $designation =$form['designationP']->getData();
             $quantite =$form['quantite']->getData();

            $em = $this->getDoctrine()->getManager();
            $Produit = $em->getRepository('produitBundle:produit')->find($id);

            //$now = new\DateTime('now');
            $Produit->setDesignationP($designation);
            $Produit->setQuantite($quantite);
            
            $em->flush();

            $this->addFlash(
                'notice',
                'Produit modifié'
                );
            return $this->redirectToRoute('product_list');
        }
        return $this->render('produitBundle:produit:reapprov.html.twig', array(
        'produit' => $Produit,
        'form' => $form->createView()

        ));
  }
  else{
            return $this->redirect('http://localhost/Projet1/web/app_dev.php/login');
        }
}
}