<?php

namespace MIT\FinanceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Compte
 *
 * @ORM\Table(name="compte")
 * @ORM\Entity(repositoryClass="MIT\FinanceBundle\Repository\CompteRepository")
 */
class Compte
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="rib", type="string", length=30)
     */
    private $rib;

    /**
     * @var float
     *
     * @ORM\Column(name="solde", type="float")
     */
    private $solde;

    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="Operation", mappedBy="compte")
     */
    private $operations;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set id
     *
     * @param integer $id
     *
     * @return Compte
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set rib
     *
     * @param string $rib
     *
     * @return Compte
     */
    public function setRib($rib)
    {
        $this->rib = $rib;

        return $this;
    }

    /**
     * Get rib
     *
     * @return string
     */
    public function getRib()
    {
        return $this->rib;
    }

    /**
     * Set solde
     *
     * @param float $solde
     *
     * @return Compte
     */
    public function setSolde($solde)
    {
        $this->solde = $solde;

        return $this;
    }

    /**
     * Get solde
     *
     * @return float
     */
    public function getSolde()
    {
        return $this->solde;
    }

    /**
     * Set operations
     *
     * @param Collection $operations
     *
     * @return Compte
     */
    public function setOperations($operations)
    {
        $this->operations = $operations;

        return $this;
    }

    /**
     * Get operations
     *
     * @return Collection
     */
    public function getOperations()
    {
        return $this->operations;
    }
}

