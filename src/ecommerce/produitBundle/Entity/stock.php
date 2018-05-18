<?php

namespace ecommerce\produitBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * stock
 *
 * @ORM\Table(name="stock")
 * @ORM\Entity(repositoryClass="ecommerce\produitBundle\Repository\stockRepository")
 */
class stock
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
     * @var float
     *
     * @ORM\Column(name="quantiteMax", type="float")
     */
    private $quantiteMax;

    /**
     * @var float
     *
     * @ORM\Column(name="quantiteMin", type="float")
     */
    private $quantiteMin;

    /**
     * @var int
     *
     * @ORM\Column(name="idP", type="integer")
     */
    private $idP;


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
     * Set quantiteMax
     *
     * @param float $quantiteMax
     *
     * @return stock
     */
    public function setQuantiteMax($quantiteMax)
    {
        $this->quantiteMax = $quantiteMax;

        return $this;
    }

    /**
     * Get quantiteMax
     *
     * @return float
     */
    public function getQuantiteMax()
    {
        return $this->quantiteMax;
    }

    /**
     * Set quantiteMin
     *
     * @param float $quantiteMin
     *
     * @return stock
     */
    public function setQuantiteMin($quantiteMin)
    {
        $this->quantiteMin = $quantiteMin;

        return $this;
    }

    /**
     * Get quantiteMin
     *
     * @return float
     */
    public function getQuantiteMin()
    {
        return $this->quantiteMin;
    }

    /**
     * Set idP
     *
     * @param integer $idP
     *
     * @return stock
     */
    public function setIdP($idP)
    {
        $this->idP = $idP;

        return $this;
    }

    /**
     * Get idP
     *
     * @return int
     */
    public function getIdP()
    {
        return $this->idP;
    }
}

