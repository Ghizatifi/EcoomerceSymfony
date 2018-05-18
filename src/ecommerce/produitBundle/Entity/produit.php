<?php

namespace ecommerce\produitBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * produit
 *
 * @ORM\Table(name="produit")
 * @ORM\Entity(repositoryClass="ecommerce\produitBundle\Repository\produitRepository")
 */
class produit
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="designationP", type="string", length=255)
     */
    private $designationP;

    /**
     * @var float
     *
     * @ORM\Column(name="prixP", type="float")
     */
    private $prixP;

    

    /**
     * @var string
     *
     * @ORM\Column(name="marque", type="string", length=255)
     */
    private $marque;

    /**
     * @var string
     *
     * @ORM\Column(name="couleur", type="string", length=255)
     */
    private $couleur;

    /**
     * @var string
     *
     * @ORM\Column(name="size", type="string", length=255)
     */
    private $size;

    /**
     * @var float
     *
     * @ORM\Column(name="quantite", type="float")
     */
    private $quantite;

    /**
     * @var float
     *
     * @ORM\Column(name="seuil", type="float")
     */
    private $seuil;
    /**
     * @var string
     *
     * @ORM\Column(name="categorie", type="string", length=255)
     */
    private $categorie;

    /**
     * @var string
     *
     * @ORM\Column(name="categorieHF", type="string", length=255)
     */
    private $categorieHF;

    /**
     * @var string
     *
     * @ORM\Column(name="categorieMT", type="string", length=255)
     */
    private $categorieMT;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set designationP
     *
     * @param string $designationP
     *
     * @return produit
     */
    public function setDesignationP($designationP)
    {
        $this->designationP = $designationP;

        return $this;
    }

    /**
     * Get designationP
     *
     * @return string
     */
    public function getDesignationP()
    {
        return $this->designationP;
    }

    /**
     * Set prixP
     *
     * @param float $prixP
     *
     * @return produit
     */
    public function setPrixP($prixP)
    {
        $this->prixP = $prixP;

        return $this;
    }

    /**
     * Get prixP
     *
     * @return float
     */
    public function getPrixP()
    {
        return $this->prixP;
    }

    /**
     * Set marque
     *
     * @param string $marque
     *
     * @return produit
     */
    public function setMarque($marque)
    {
        $this->marque = $marque;

        return $this;
    }

    /**
     * Get marque
     *
     * @return string
     */
    public function getMarque()
    {
        return $this->marque;
    }

    /**
     * Set couleur
     *
     * @param string $couleur
     *
     * @return produit
     */
    public function setCouleur($couleur)
    {
        $this->couleur = $couleur;

        return $this;
    }

    /**
     * Get couleur
     *
     * @return string
     */
    public function getCouleur()
    {
        return $this->couleur;
    }

    /**
     * Set size
     *
     * @param string $size
     *
     * @return produit
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get size
     *
     * @return string
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set quantite
     *
     * @param float $quantite
     *
     * @return produit
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * Get quantite
     *
     * @return float
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * Set seuil
     *
     * @param float $seuil
     *
     * @return produit
     */
    public function setSeuil($seuil)
    {
        $this->seuil = $seuil;

        return $this;
    }

    /**
     * Get seuil
     *
     * @return float
     */
    public function getSeuil()
    {
        return $this->seuil;
    }


    /**
     * Set categorie
     *
     * @param string $categorie
     *
     * @return produit
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return string
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Set categorieHF
     *
     * @param string $categorieHF
     *
     * @return produit
     */
    public function setCategorieHF($categorieHF)
    {
        $this->categorieHF = $categorieHF;

        return $this;
    }

    /**
     * Get categorieHF
     *
     * @return string
     */
    public function getCategorieHF()
    {
        return $this->categorieHF;
    }

    /**
     * Set categorieMT
     *
     * @param string $categorieMT
     *
     * @return produit
     */
    public function setCategorieMT($categorieMT)
    {
        $this->categorieMT = $categorieMT;

        return $this;
    }

    /**
     * Get categorieMT
     *
     * @return string
     */
    public function getCategorieMT()
    {
        return $this->categorieMT;
    }


    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255)
     * Assert\NotBlank(Message=" SVP PNG JPEG GIF")
     * Assert\File(mimeTypes={"image/jpeg","image/png","image/gif"})
     */
    private $image;

 /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

     /**
     * Set image
     *
     * @param string $image
     *
     * @return Categorie
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }
    
}

