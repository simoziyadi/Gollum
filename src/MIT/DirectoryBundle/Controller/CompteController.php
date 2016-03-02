<?php
/**
 * Created by PhpStorm.
 * User: zidan
 * Date: 29/02/2016
 * Time: 19:11
 */

namespace MIT\DirectoryBundle\Controller;


use MIT\DirectoryBundle\Entity\Compte;
use MIT\DirectoryBundle\Form\CompteType;
use MIT\DirectoryBundle\MITDirectoryBundle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CompteController extends Controller
{
    public function listComptesAction(){
        $em=$this->getDoctrine()->getEntityManager();
        $comptes=$em->getRepository('MITDirectoryBundle:Compte')->findAll();
        return $this->render('MITDirectoryBundle:Compte:listeComptesAction.html.twig',array('cptes'=>$comptes));

    }
    public function addCompteAction(Request $request){

         $compte = new Compte();
        $compte->setDateCreation(new \DateTime());
        $form=$this->get('form.factory')->create(new CompteType(),$compte);
        $form->handleRequest($request);
        if($form->isValid()){
            $em=$this->getDoctrine()->getEntityManager();
            $em->persist($compte);
            $em->flush();
            return $this->redirectToRoute('listesComptes');
        }
        return $this->render('MITDirectoryBundle:Compte:addCompte.html.twig',array(
            'form'=>$form->createView(),
        ));



    }
    public function updateCompteAction(Request $request,$id)
    {

        $em = $this->getDoctrine()->getEntityManager();
        $compte = $em->getRepository('MITDirectoryBundle:Compte')->find($id);
        $form = $this->get('form.factory')->create(new CompteType(), $compte);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($compte);
            $em->flush();
            return $this->redirectToRoute('listesComptes');
        }
        return $this->render('MITDirectoryBundle:Compte:updateCompte.html.twig', array(
            'form' => $form->createView(),
        ));
    }
        public function removeCompteAction(Request $request,$id)
        {
            $em = $this->getDoctrine()->getEntityManager();
            $compte = $em->getRepository('MITDirectoryBundle:Compte')->find($id);
            $em->remove($compte);
            $em->flush();
            return $this->listComptesAction();
        }






}