<?php

namespace ecommerce\BonsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * bon
 *
 * @ORM\Table(name="bon")
 * @ORM\Entity(repositoryClass="ecommerce\BonsBundle\Repository\bonRepository")
 */
class bon
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
     * @ORM\Column(name="typeB", type="string", length=255)
     */
    private $typeB;


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
     * Set typeB
     *
     * @param string $typeB
     *
     * @return bon
     */
    public function setTypeB($typeB)
    {
        $this->typeB = $typeB;

        return $this;
    }

    /**
     * Get typeB
     *
     * @return string
     */
    public function getTypeB()
    {
        return $this->typeB;
    }
}

