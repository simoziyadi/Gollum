<?php
/**
 * Created by PhpStorm.
 * User: zidan
 * Date: 29/02/2016
 * Time: 19:11
 */

namespace MIT\DirectoryBundle\Controller;


use MIT\DirectoryBundle\MITDirectoryBundle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CompteController extends Controller
{
    public function listComptesAction(){
        $em=$this->getDoctrine()->getEntityManager();
        $comptes=$em->getRepository('MITDirectoryBundle:Compte')->findAll();
        return $this->render('MITDirectoryBundle:Compte:listeComptesAction.html.twig',array('cptes'=>$comptes));


    }
}