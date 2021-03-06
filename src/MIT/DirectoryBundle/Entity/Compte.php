<?php

namespace MIT\DirectoryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Compte
 *
 * @ORM\Table(name="comptetest")
 * @ORM\Entity(repositoryClass="MIT\DirectoryBundle\Repository\CompteRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Compte
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
     * @ORM\Column(name="numero", type="float", unique=true)
     */
    private $numero;

    /**
     * @var float
     *
     * @ORM\Column(name="solde", type="float", nullable=true)
     */
    private $solde;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreation", type="datetime", nullable=true)
     */
    private $dateCreation;

    /**
     * @ORM\OneToMany(targetEntity="MIT\DirectoryBundle\Entity\Operation",mappedBy="compte")
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
     * Set numero
     *
     * @param float $numero
     * @return Compte
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return float 
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set solde
     *
     * @param float $solde
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
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     * @return Compte
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * Get dateCreation
     *
     * @return \DateTime 
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * ORM\PrePersist
     */
    public function createdAt(){
        $this->setDateCreation(new \DateTime());

    }
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->operations = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add operations
     *
     * @param \MIT\DirectoryBundle\Entity\Operation $operations
     * @return Compte
     */
    public function addOperation(\MIT\DirectoryBundle\Entity\Operation $operations)
    {
        $this->operations[] = $operations;

        return $this;
    }

    /**
     * Remove operations
     *
     * @param \MIT\DirectoryBundle\Entity\Operation $operations
     */
    public function removeOperation(\MIT\DirectoryBundle\Entity\Operation $operations)
    {
        $this->operations->removeElement($operations);
    }

    /**
     * Get operations
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOperations()
    {
        return $this->operations;
    }
}
