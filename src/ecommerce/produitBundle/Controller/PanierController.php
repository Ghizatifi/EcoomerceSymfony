<?php

namespace ecommerce\produitBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Ecommerce\ProduitBundle\Entity\produit;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\Query;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\Session;

class PanierController extends Controller
{


	 /**
     * @Route("/ajouterpanier/{id}",name="ajouter")
	 * @Method({"GET"})
     */
	 public function addpanierAction($id,Request $request)
    {
         
	 $session = new Session();
		
     if (!$session->has('panierClt')) $session->set('panierClt', array());
	 $panierClt = $session->get('panierClt');
	
	 $panierClt[$id]=$request->query->get('qte');
     $this->get('session')->getFlashBag()->add('success','Produit ajouté avec succès dans votre panier');

	    $session->set('panierClt',$panierClt);

		        return $this->redirectToRoute('panierClt');		
    
    }
	 /**
     * @Route("/panier1",name="panierClt")
     */
	public function panierAction()
    {
		$session = new Session();
        if (!$session->has('panierClt')) $session->set('panierClt', array());
        
        $em = $this->getDoctrine()->getManager();
        $produits = $em->getRepository('produitBundle:produit')->findArray(array_keys($session->get('panierClt')));
        
        return $this->render('produitBundle:Panier:addPanier.html.twig', array('produit' => $produits,
                                                                     'panierClt' => $session->get('panierClt')));
         //return $this->render('produitBundle:Panier:addpPanier.html.twig');
      
    }
	
	 /**
     * @Route("/supprimer/{id}",name="supprimer")
     */
	public function SupprimerAction($id,Request $request)
    {
       $session = new Session();
       
        $panierCltClt = $session->get('panierClt');
        
      
            unset($panierCltClt[$id]);
            $session->set('panierClt',$panierCltClt);
       
               return $this->redirectToRoute('panierClt');		

    }
	/**
     * @Route("/recherche",name="recherche")
     */
     public function rechercheAction() 
    {
        $form = $this->createForm(new RechercheType());
        return $this->render('produitBundle:Panier:recherche.html.twig', array('form' => $form->createView()));
    }
	

    
	
	
}
