<?php

namespace bean\beanBundle\Controller;

use bean\beanBundle\Entity\Compte;
use bean\beanBundle\Entity\Operation;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Collection;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('beanBundle:Default:index.html.twig', array('name' => $name));
    }

//    /**
//     * @Route("/ajouter",name="verAddCompte")
//     */
    public function versAddCompteFormAction()
    {
        return $this->render('beanBundle:Default:saveCompte.html.twig');
    }


//    /**
//     * @Route("/Create",name="create")
//     * @Template()
//     */
    public function saveCompteAction(Request $request)
    {
        $compte = new Compte();
        if ($request->getMethod() == 'POST') {
            $rib = $request->get('rib');
//            var_dump($request->get('solde'));
            if (isset($rib)) {
                $compte->setRib($rib)->setSolde($request->get('solde'));
                $this->getDoctrine()->getRepository("beanBundle:Compte")->save($compte);
                return $this->redirect($this->generateUrl('listComptes'));
            }
        }
        return $this->render('beanBundle:Default:saveCompte.html.twig');

    }

//    /**
//     * @Route("/Comptes",name="listComptes")
//     * @Template()
//     */
    public function listComptesAction()
    {
        $comptes = $this->getDoctrine()->getRepository("beanBundle:Compte")->findAll();
        return $this->render('beanBundle:Default:listComptes.html.twig', array('comptes' => $comptes));
    }

    public function versAddOperationAction(Request $request)
    {
        var_dump($request->getSession()->get('resultat'));

        $comptes = $this->getDoctrine()->getRepository("beanBundle:Compte")->findAll();
        return $this->render("beanBundle:Default:saveOperation.html.twig", array('comptes' => $comptes));
    }

    public function saveOperationAction(Request $request)
    {
        dump($request->getSession()->get('resultat'));
        if ($request->getMethod() == 'POST') {
            if ($request->get('montant') > 0) {
                $operation = new Operation();
                $compte = new Compte();
                $compte->setId($request->get('compteId'));
                $operation->setCompte($compte)->setMontant($request->get('montant'))->setType($request->get('type'));
                $rslt = $this->getDoctrine()->getRepository("beanBundle:Operation")->save($operation);
                $session = $request->getSession();
                $session->set('resultat', $rslt);
                return $this->redirect($this->generateUrl("versAddOperation"));
            }
        }
        return $this->redirect($this->generateUrl("versAddOperation"));
    }


    public function getOperationsByCompteAction($id)
    {
//        $liste=new ArrayCollection();
        $compte = new Compte();
        $compte->setId($id);
        $operations = $this->getDoctrine()->getRepository("beanBundle:Operation")->findOperationsByCompte($compte);
        return $this->render("beanBundle:Default:getOperationsByCompte.html.twig", array('operations' => $operations));
    }

    public function versModifierCompteAction($id)
    {
        $compte = $this->getDoctrine()->getRepository("beanBundle:Compte")->find($id);
        return $this->render("beanBundle:Default:modifierCompte.httml.twig", array('compte' => $compte));
    }

    public function mettreAjourCompteAction(Request $request, $id)
    {
        $compteService = $this->getDoctrine()->getRepository("beanBundle:Compte");
        $compte = new Compte();
        $compte = $compteService->find($id);
        $compte->setRib($request->get('rib'))->setSolde($request->get('solde'));
        $compteService->update($compte);
        return $this->redirect($this->generateUrl("listComptes"));
    }

    public function supprimerCompteAction($id)
    {
        $compteService = $this->getDoctrine()->getRepository("beanBundle:Compte");
        $compte = $compteService->find($id);
        $compteService->removeCompteWithOps($compte);
        return $this->redirect($this->generateUrl("listComptes"));
    }
}
