<?php
/**
 * Created by PhpStorm.
 * User: zidan
 * Date: 29/02/2016
 * Time: 19:11
 */

namespace MIT\DirectoryBundle\Controller;


use Doctrine\ORM\ORMException;
use MIT\DirectoryBundle\Entity\Compte;
use MIT\DirectoryBundle\Form\CompteEditeType;
use MIT\DirectoryBundle\Form\CompteType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CompteController extends Controller
{
    public function listComptesAction()
    {

        $em = $this->getDoctrine()->getEntityManager();
        $comptes = $em->getRepository('MITDirectoryBundle:Compte')->findAll();

        return $this->render('MITDirectoryBundle:Compte:listeComptes.html.twig', array('cptes' => $comptes));

    }

    public function addCompteAction(Request $request)
    {
        $compte = new Compte();
        $form = $this->get('form.factory')->create(new CompteType(), $compte);
        $form->handleRequest($request);
        if ($form->isValid()) {
            try {
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($compte);
                $em->flush();
                return $this->redirectToRoute('listesComptes');
            } catch (\Exception $e) {
                return $this->render('MITDirectoryBundle:Compte:addCompte.html.twig', array(
                    'form' => $form->createView(),
                ));
            }


        }
        return $this->render('MITDirectoryBundle:Compte:addCompte.html.twig', array(
            'form' => $form->createView(),
        ));


    }

    public function updateCompteAction(Request $request, $id)
    {

        $em = $this->getDoctrine()->getEntityManager();
        $compte = $em->getRepository('MITDirectoryBundle:Compte')->find($id);
        $form = $this->get('form.factory')->create(new CompteEditeType(), $compte);
        $form->handleRequest($request);
        if ($form->isValid()) {
            try {
                $em = $this->getDoctrine()->getEntityManager();
                $em->flush();
                return $this->redirectToRoute('listesComptes');
            } catch (\Exception $e) {
                return $this->render('MITDirectoryBundle:Compte:updateCompte.html.twig', array(
                    'form' => $form->createView(),
                ));
            }
        }
        return $this->render('MITDirectoryBundle:Compte:updateCompte.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function removeCompteAction(Request $request, $id)
    {
        try {
            $em = $this->getDoctrine()->getEntityManager();

            $compte = $em->getRepository('MITDirectoryBundle:Compte')->find($id);
            $em->remove($compte);
            $em->flush();
        } catch (\ORMException $e) {
            $this->get('session')->getFlashBag()->add('error', 'le compte ne peut pas être supprimé');
            return $this->listComptesAction();
        }
        return $this->listComptesAction();
    }


}