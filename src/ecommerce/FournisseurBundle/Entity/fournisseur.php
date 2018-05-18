<?php

namespace ecommerce\FournisseurBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * fournisseur
 *
 * @ORM\Table(name="fournisseur")
 * @ORM\Entity(repositoryClass="ecommerce\FournisseurBundle\Repository\fournisseurRepository")
 */
class fournisseur
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
     * @ORM\Column(name="nomF", type="string", length=255)
     */
    private $nomF;

    /**
     * @var string
     *
     * @ORM\Column(name="telF", type="string", length=255)
     */
    private $telF;

    /**
     * @var string
     *
     * @ORM\Column(name="emailF", type="string", length=255)
     */
    private $emailF;


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
     * Set nomF
     *
     * @param string $nomF
     *
     * @return fournisseur
     */
    public function setNomF($nomF)
    {
        $this->nomF = $nomF;

        return $this;
    }

    /**
     * Get nomF
     *
     * @return string
     */
    public function getNomF()
    {
        return $this->nomF;
    }

    /**
     * Set telF
     *
     * @param string $telF
     *
     * @return fournisseur
     */
    public function setTelF($telF)
    {
        $this->telF = $telF;

        return $this;
    }

    /**
     * Get telF
     *
     * @return string
     */
    public function getTelF()
    {
        return $this->telF;
    }

    /**
     * Set emailF
     *
     * @param string $emailF
     *
     * @return fournisseur
     */
    public function setEmailF($emailF)
    {
        $this->emailF = $emailF;

        return $this;
    }

    /**
     * Get emailF
     *
     * @return string
     */
    public function getEmailF()
    {
        return $this->emailF;
    }
}

