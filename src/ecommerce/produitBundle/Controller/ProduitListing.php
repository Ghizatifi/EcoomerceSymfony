<?php

namespace ecommerce\produitBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ecommerce\produitBundle\Entity\produit;
use ecommerce\produitBundle\Entity\stock;
use Doctrine\ORM\Query;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ProduitListing extends Controller
{


 /**
     * @Route("/detail1/{id}",name="detail1")
     */
  public function detail1Action($id)
    {

        $Produit = $this->getDoctrine()
        ->getRepository('produitBundle:produit')
        ->find($id);
        return $this->render('produitBundle:produit:detail1.html.twig', array(
        'ListeProduits' => $Produit));



      
    }

 /**
     * @Route("/ChaussuresHommeModerne",name="product_liste")
     */
   public function afficherChMAction()
    {
        $produit = $this->getDoctrine()->getRepository('produitBundle:produit')->findBy(array('categorie' => 'Chaussures', 'categorieHF' => 'Homme','categorieMT' => 'Moderne'));
        return $this->render('produitBundle:produit:afficher.html.twig', array('ListeProduits' => $produit ));
    }


/**
     * @Route("/HabitsHommeModerne",name="product_lis")
     */
   public function afficherHhMAction()
    {
        $produit = $this->getDoctrine()->getRepository('produitBundle:produit')->findBy(array('categorie' => 'Habits', 'categorieHF' => 'Homme','categorieMT' => 'Moderne'));
        return $this->render('produitBundle:produit:afficher.html.twig', array('ListeProduits' => $produit ));
    }


    /**
     * @Route("/AccessoiresHommeModerne",name="product_li")
     */
   public function afficherAhMAction()
    {
        $produit = $this->getDoctrine()->getRepository('produitBundle:produit')->findBy(array('categorie' => 'Accessoires', 'categorieHF' => 'Homme','categorieMT' => 'Moderne'));
        return $this->render('produitBundle:produit:afficher.html.twig', array('ListeProduits' => $produit ));
    }



 /**
     * @Route("/ChaussuresHommeTraditionnelle",name="product")
     */
   public function afficherChTAction()
    {
        $produit = $this->getDoctrine()->getRepository('produitBundle:produit')->findBy(array('categorie' => 'Chaussures', 'categorieHF' => 'Homme','categorieMT' => 'Traditionnel'));
        return $this->render('produitBundle:produit:afficher.html.twig', array('ListeProduits' => $produit ));
    }


/**
     * @Route("/HabitsHommeTraditionnelle",name="produc")
     */
   public function afficherHhTAction()
    {
        $produit = $this->getDoctrine()->getRepository('produitBundle:produit')->findBy(array('categorie' => 'Habits', 'categorieHF' => 'Homme','categorieMT' => 'Traditionnel'));
        return $this->render('produitBundle:produit:afficher.html.twig', array('ListeProduits' => $produit ));
    }


    /**
     * @Route("/AccessoiresHommeTraditionnelle",name="produ")
     */
   public function afficherAhTAction()
    {
        $produit = $this->getDoctrine()->getRepository('produitBundle:produit')->findBy(array('categorie' => 'Accessoires', 'categorieHF' => 'Homme','categorieMT' => 'Traditionnel'));
        return $this->render('produitBundle:produit:afficher.html.twig', array('ListeProduits' => $produit ));
    }


   /**
     * @Route("/HabitsFemmeModerne",name="prod")
     */
   public function afficherHfMAction()
    {
        $produit = $this->getDoctrine()->getRepository('produitBundle:produit')->findBy(array('categorie' => 'Habits', 'categorieHF' => 'Femme','categorieMT' => 'Moderne'));
        return $this->render('produitBundle:produit:afficher.html.twig', array('ListeProduits' => $produit ));
    }


    /**
     * @Route("/ChaussuresFemmeModerne",name="pro")
     */
   public function afficherCHfMAction()
    {
        $produit = $this->getDoctrine()->getRepository('produitBundle:produit')->findBy(array('categorie' => 'Chaussures', 'categorieHF' => 'Femme','categorieMT' => 'Moderne'));
        return $this->render('produitBundle:produit:afficher.html.twig', array('ListeProduits' => $produit ));
    }

     /**
     * @Route("/AccessoiresFemmeModerne",name="pr")
     */
   public function afficherAfMAction()
    {
        $produit = $this->getDoctrine()->getRepository('produitBundle:produit')->findBy(array('categorie' => 'Accessoires', 'categorieHF' => 'Femme','categorieMT' => 'Moderne'));
        return $this->render('produitBundle:produit:afficher.html.twig', array('ListeProduits' => $produit ));
    }


   /**
     * @Route("/HabitsFemmeTraditionnelle",name="p")
     */
   public function afficherHfTAction()
    {
        $produit = $this->getDoctrine()->getRepository('produitBundle:produit')->findBy(array('categorie' => 'Habits', 'categorieHF' => 'Femme','categorieMT' => 'Traditionnel'));
        return $this->render('produitBundle:produit:afficher.html.twig', array('ListeProduits' => $produit ));
    }


    /**
     * @Route("/ChaussuresFemmeTraditionnelle",name="pt")
     */
   public function afficherCHfTAction()
    {
        $produit = $this->getDoctrine()->getRepository('produitBundle:produit')->findBy(array('categorie' => 'Chaussures', 'categorieHF' => 'Femme','categorieMT' => 'Traditionnel'));
        return $this->render('produitBundle:produit:afficher.html.twig', array('ListeProduits' => $produit ));
    }

     /**
     * @Route("/AccessoiresFemmeTraditionnelle",name="prodt")
     */
   public function afficherAfTAction()
    {
        $produit = $this->getDoctrine()->getRepository('produitBundle:produit')->findBy(array('categorie' => 'Accessoires', 'categorieHF' => 'Femme','categorieMT' => 'Traditionnel'));
        return $this->render('produitBundle:produit:afficher.html.twig', array('ListeProduits' => $produit ));
    }



  


    
}
