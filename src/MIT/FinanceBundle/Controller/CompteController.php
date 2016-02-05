<?php
/**
 * Created by PhpStorm.
 * User: abdelmoughit
 * Date: 04/02/2016
 * Time: 16:03
 */

namespace MIT\FinanceBundle\Controller;


use MIT\FinanceBundle\Entity\Compte;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class CompteController extends Controller
{

    public function versCreateAction()
    {
        return $this->render('MITFinanceBundle:Compte:saveCompte.html.twig');
    }

    public function createAction(Request $request)
    {
        $compte = new Compte();
        if ($request->getMethod() == 'POST') {
            $rib = $request->get('rib');
            if (isset($rib)) {
                $compte->setRib($rib)->setSolde($request->get('solde'));
                $this->getDoctrine()->getRepository("MITFinanceBundle:Compte")->save($compte);
                return $this->redirect($this->generateUrl('listComptes'));
            }
        }
        return $this->render('MITFinanceBundle:Compte:saveCompte.html.twig');
    }

    public function listAction(Request $request)
    {
        if($request->isXmlHttpRequest())
        {
            $result =  $this->getDoctrine()->getRepository("beanBundle:Compte")->findAll();
            return new JsonResponse(array('data'=> $result));
        }
        $comptes = $this->getDoctrine()->getRepository("beanBundle:Compte")->findAll();
        return $this->render('MITFinanceBundle:Compte:listComptes.html.twig', array('comptes' => $comptes));
    }

    public function versUpdateAction($id)
    {
        $compte = $this->getDoctrine()->getRepository("beanBundle:Compte")->find($id);
        return $this->render("MITFinanceBundle:Compte:modifierCompte.httml.twig", array('compte' => $compte));
    }

    public function updateAction(Request $request, $id)
    {
        $compteService = $this->getDoctrine()->getRepository("MITFinanceBundle:Compte");
        $compte = new Compte();
        $compte = $compteService->find($id);
        $compte->setRib($request->get('rib'))->setSolde($request->get('solde'));
        $compteService->update($compte);
        return $this->redirect($this->generateUrl("listComptes"));
    }

    public function supprimerAction($id)
    {
        $compteService = $this->getDoctrine()->getRepository("MITFinanceBundle:Compte");
        $compte = $compteService->find($id);
        $compteService->removeCompteWithOps($compte);
        return $this->redirect($this->generateUrl("listComptes"));
    }


}