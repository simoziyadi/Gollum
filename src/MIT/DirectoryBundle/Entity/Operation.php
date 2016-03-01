<?php

namespace MIT\DirectoryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Operation
 *
 *@ORM\Table(name="operationtest")
 * @ORM\Entity(repositoryClass="MIT\DirectoryBundle\Repository\OperationRepository")
 * ORM\InheritanceType("SINGLE_TABLE")
 * ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({
 *     "retraitt" = "Retrait",
 *     "versement" = "Versement"
 *         })
 */
abstract class Operation
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var int
     *
     * @ORM\Column(name="numOperation", type="integer")
     */
    protected $numOperation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateOperation", type="datetime")
     */
    protected $dateOperation;

    /**
     * @var float
     *
     * @ORM\Column(name="montant", type="float", nullable=true)
     */
    protected $montant;

    /**
     * @var Compte
     * @ORM\ManyToOne(targetEntity="MIT\DirectoryBundle\Entity\Compte",inversedBy="operations")
     * @ORM\JoinColumn(nullable=false)
     */
    protected $compte;


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
     * Set numOperation
     *
     * @param integer $numOperation
     * @return Operation
     */
    public function setNumOperation($numOperation)
    {
        $this->numOperation = $numOperation;

        return $this;
    }

    /**
     * Get numOperation
     *
     * @return integer 
     */
    public function getNumOperation()
    {
        return $this->numOperation;
    }

    /**
     * Set dateOperation
     *
     * @param \DateTime $dateOperation
     * @return Operation
     */
    public function setDateOperation($dateOperation)
    {
        $this->dateOperation = $dateOperation;

        return $this;
    }

    /**
     * Get dateOperation
     *
     * @return \DateTime 
     */
    public function getDateOperation()
    {
        return $this->dateOperation;
    }

    /**
     * Set montant
     *
     * @param float $montant
     * @return Operation
     */
    public function setMontant($montant)
    {
        $this->montant = $montant;

        return $this;
    }

    /**
     * Get montant
     *
     * @return float 
     */
    public function getMontant()
    {
        return $this->montant;
    }

    /**
     * Set compte
     *
     * @param Compte $compte
     * @return Operation
     */
    public function setCompte(Compte $compte)
    {
        $this->compte = $compte;

        return $this;
    }

    /**
     * Get compte
     *
     * @return Compte
     */
    public function getCompte()
    {
        return $this->compte;
    }
}
