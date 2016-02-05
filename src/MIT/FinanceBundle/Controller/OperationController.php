<?php
/**
 * Created by PhpStorm.
 * User: abdelmoughit
 * Date: 04/02/2016
 * Time: 16:04
 */

namespace MIT\FinanceBundle\Controller;


use MIT\FinanceBundle\Entity\Compte;
use MIT\FinanceBundle\Entity\Operation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class OperationController extends Controller
{

    public function versCreateAction()
    {
        $comptes = $this->getDoctrine()->getRepository("MITFinanceBundle:Compte")->findAll();
        return $this->render("MITFinanceBundle:Operation:saveOperation.html.twig", array('comptes' => $comptes));
    }

    public function createAction(Request $request)
    {
        if ($request->getMethod() == 'POST') {
            if ($request->get('montant') > 0) {
                $operation = new Operation();
                $compte = new Compte();
                $compte->setId($request->get('compteId'));
                $operation->setCompte($compte)->setMontant($request->get('montant'))->setType($request->get('type'));
                $this->getDoctrine()->getRepository("MITFinanceBundle:Operation")->save($operation);
                return $this->redirect($this->generateUrl("versAddOperation"));
            }
        }
        return $this->redirect($this->generateUrl("versAddOperation"));
    }

    public function findByCompteAction($id)
    {
        $compte = new Compte();
        $compte->setId($id);
        $operations = $this->getDoctrine()->getRepository("MITFinanceBundle:Operation")->findOperationsByCompte($compte);
        return $this->render("MITFinanceBundle:Operation:getOperationsByCompte.html.twig", array('operations' => $operations));
    }

}