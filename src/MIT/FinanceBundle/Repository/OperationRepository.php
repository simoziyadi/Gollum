<?php

namespace MIT\FinanceBundle\Repository;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityRepository;
use MIT\FinanceBundle\Entity\Compte;
use MIT\FinanceBundle\Entity\Operation;

/**
 * OperationRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class OperationRepository extends EntityRepository
{

    public function save(Operation $operation)
    {

        $operation->setCompte($this->_em->getRepository("MITFinanceBundle:Compte")->find($operation->getCompte()->getId()));
        $compte = $operation->getCompte();
        if ($operation->getType() == "debit") {
            if ($compte->getSolde() - $operation->getMontant() >= 0) {
                $compte->setSolde($compte->getSolde() - $operation->getMontant());
                $operation->setCompte($compte);
                $this->_em->persist($operation);
                $this->_em->getRepository("MITFinanceBundle:Compte")->_em->merge($compte);
                $this->_em->flush();
                return 1;
            }
            return -1;
        } else {
            $compte = $operation->getCompte();
            $compte->setSolde($compte->getSolde() + $operation->getMontant());
            $operation->setCompte($compte);
            $this->_em->persist($operation);
            $this->_em->getRepository("MITFinanceBundle:Compte")->_em->merge($compte);
            $this->_em->flush();
            return 2;
        }
    }


    /**
     * @param Compte $compte
     * @return ArrayCollection
     */
    public function findOperationsByCompte(Compte $compte)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('op')
            ->from('MITFinanceBundle:Operation', 'op')
            ->join('op.compte', 'c')
            ->where('c.id=' . $compte->getId());
        $query = $qb->getQuery()->getResult();
        return new ArrayCollection($query);
    }


    public function removeOperationByCompte($idCompte)
    {
        //DQL does not support joins in DELETE and UPDATEs, even if the underlaying database, like MySQL, supports it
        $rslts = $this->_em
            ->createQueryBuilder()
            ->select('op')
            ->from('MITFinanceBundle:Operation', 'op')
            ->Join('op.compte', 'c')
            ->where('c.id=' . $idCompte)->getQuery()->getResult();
        foreach ($rslts as $rslt) {
            $this->_em->remove($rslt);
        }
    }


}
